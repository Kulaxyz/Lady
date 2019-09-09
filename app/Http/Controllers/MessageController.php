<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Events\PrivateMessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        dd(Auth::user()->messages()->first()->created_at->toDateTimeString());
        $messages = Auth::user()->messages()->pluck('user_id', 'receiver_id')->toArray();
        $receivers = array_keys($messages);
        $result = array_merge($receivers, $messages);
        $result = array_unique($result);

        if (($key = array_search(Auth::id(), $result)) !== false) {
            unset($result[$key]);
        }

        $users = User::with('messages')->whereIn('id', $result)->get();
        $users->sort(function ($user){
            return $user->messages()
                ->first()->created_at->toDateTimeString();
        });
        $users = $users->reverse();

        return view('dialogs', compact('users'));

    }

    public function chat($id)
    {
        return view('chat', compact('id'));
    }

    public function privateMessages(User $user)
    {
        $privateCommunication = Message::with('user')
            ->where(['user_id' => auth()->id(), 'receiver_id' => $user->id])
            ->orWhere(function ($query) use ($user) {
                $query->where(['user_id' => $user->id, 'receiver_id' => auth()->id()]);
            })
            ->get();
        return $privateCommunication;
    }

//    public function sendMessage(Request $request)
//    {
//        if(request()->has('file')){
//            $filename = request('file')->store('chat');
//            $message=Message::create([
//                'user_id' => request()->user()->id,
//                'image' => $filename,
//                'receiver_id' => request('receiver_id')
//            ]);
//        }else{
//            $message = auth()->user()->messages()->create(['message' => $request->message]);
//        }
//        broadcast(new MessageSent(auth()->user(),$message->load('user')))->toOthers();
//
//        return response(['status'=>'Message sent successfully','message'=>$message]);
//    }

    public function sendPrivateMessage(Request $request, User $user)
    {
        if (request('file')) {
            $image = request('file');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/chat' . '/' . $fileName, $img, 'public');
            $message = Message::create([
                'user_id' => request()->user()->id,
                'image' => $fileName,
                'receiver_id' => $user->id,
                'message' => '',
            ]);
        } else {
            $input = $request->all();
            $input['receiver_id'] = $user->id;
            $message = auth()->user()->messages()->create($input);
            $message->user()->associate($user);
        }
        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();

        return response(['status' => 'Message private sent successfully', 'message' => $message]);
    }

}
