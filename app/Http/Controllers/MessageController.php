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

    public function index(Request $request)
    {
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $messages = [];
        $allMessages = Auth::user()->allMessages()->get();
        foreach ($allMessages as $message) {
            array_push($messages, $message->receiver_id);
            array_push($messages, $message->user_id);
        }
        $result = array_unique($messages);

        if (($key = array_search(Auth::id(), $result)) !== false) {
            unset($result[$key]);
        }
//        dd($result);

        $users = User::with('messages')
            ->whereIn('id', $result)
            ->whereNotIn('id', $ids)
            ->limit(10)->get();

        $allMessages = collect();
        foreach ($users as $user) {
            $user->lastMessage = $user->lastMessage();
            $user->unreads = $user->unreadMessagesBy(Auth::id());
            $allMessages->push($user->lastMessage());
        }
        $allMessages = $allMessages->sortByDesc('created_at');
        $newUsers = collect();

        foreach ($allMessages as $message) {
            for ($i = 0; $i < $users->count(); $i++) {
                if ($message == $users[$i]->lastMessage) {
                    $newUsers->push($users[$i]);
                }
            }
        }
        if (!$request->ajax()) {
            return view('dialogs', ['users' => $newUsers]);
        } else {
            return $newUsers;
        }
    }

    public function chat($id)
    {
        $user = User::find($id);
        Auth::user()->markMessages($id);
        return view('chat', compact('id', 'user'));
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


    public function markMessages($id)
    {
        Auth::user()->markMessages($id);
    }

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
            $input['read_at'] = null;
            $message = auth()->user()->messages()->create($input);
            $message->user()->associate($user);
        }
        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();

        return response(['status' => 'Message private sent successfully', 'message' => $message]);
    }

}
