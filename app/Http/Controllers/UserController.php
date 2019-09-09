<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile($id)
    {
        $user = User::withCount('posts')->find($id);
        $favorites = $user->favorites(Post::class)->count();
        $followings = $user->followings()->count();
        $followers = $user->followers()->count();

        return view('profile', [
                                    'user' => $user,
                                    'favorites' => $favorites,
                                    'followers' => $followers,
                                    'followings' => $followings
                    ]);
    }

    public function addAvatar(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $image      = $request->file('avatar');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/avatars'.'/'.$fileName, $img, 'public');


            $user->avatar = $fileName;
            $user->save();

        }

        return redirect()->route('home');
    }

    public function follow(Request $request)
    {
        if (!$request->ajax())
        {
            abort(403);
        }

        Auth::user()->follow($request->post('user_id'), User::class);
        echo 'unfollow';
    }
    public function unfollow(Request $request)
    {
        if (!$request->ajax())
        {
            abort(403);
        }

        Auth::user()->unfollow($request->post('user_id'), User::class);
        echo 'follow';
    }

    public function posts($id, Request $request)
    {
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $user = User::withCount('posts')->find($id);
        $posts = $user->posts()
            ->with('images', 'user')
            ->withCount('comments', 'likers', 'favoriters')
            ->whereNotIn('posts.id', $ids)
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        if (!$request->ajax()) {
            $followings = $user->followings()->count();
            $followers = $user->followers()->count();
            $favorites = $posts->count();

            return view('user-parts.posts', [
                'user' => $user,
                'favorites' => $favorites,
                'followers' => $followers,
                'followings' => $followings,
                'posts' => $posts
            ]);
        } else {
            PostController::loadMore($posts);
        }

    }


}
