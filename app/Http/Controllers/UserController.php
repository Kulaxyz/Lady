<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function profile($id)
    {
        $user = User::withCount('posts')->with('posts')->find($id);
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
            $image = $request->file('avatar');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/avatars' . '/' . $fileName, $img, 'public');


            $user->avatar = $fileName;
            $user->save();

        }

        return redirect()->route('profile', Auth::id());
    }

    public function deleteAvatar()
    {
        Auth::user()->avatar = 'default.jpg';
        Auth::user()->save();
        return redirect()->route('profile', Auth::id());
    }

    public function follow(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
        }

        Auth::user()->follow($request->post('users_id'), User::class);
        echo 'unfollow';
    }

    public function unfollow(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
        }

        Auth::user()->unfollow($request->post('users_id'), User::class);
        echo 'follow';
    }

    public function posts($id, Request $request)
    {
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $user = User::withCount('posts', 'followings', 'followers')->find($id);
        $posts = $user->posts()
            ->with('images', 'user')
            ->withCount('comments', 'likers', 'favoriters', 'bookmarkers')
            ->whereNotIn('posts.id', $ids)
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        $posts = PostController::addActivities($posts);

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
            return $posts;
        }

    }

    public function follows(Request $request, $id)
    {
        $user = User::withCount('posts', 'followings', 'followers')->find($id);
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $ids = array_unique($ids);
        $tags = $user->followings(Tag::class)->withCount('posts', 'followers')
            ->whereNotIn('id', $ids)
            ->limit(16)
            ->orderBy('posts_count', 'DESC')->get();
        $followings = $user->followings_count;
        $followers = $user->followers_count;
        if (!$request->ajax()) {
            return view('user-parts.follows', compact('user', 'tags', 'followings', 'followers'));
        } else {
            TagController::loadTags($tags);
        }
    }

    public function followsUsers(Request $request, $id)
    {
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $ids = array_unique($ids);

        $user = User::withCount('posts', 'followings', 'followers')->find($id);
        $follows = $user->followings()
            ->whereNotIn('id', $ids)
            ->limit(16)
            ->get();
        if (!$request->ajax()) {
            return view('user-parts.followingsUsers', compact('user', 'follows'));
        } else {
            $this->loadUsers($follows);
        }
    }

    public function followers(Request $request, $id)
    {
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $ids = array_unique($ids);
        $user = User::withCount('posts', 'followings', 'followers')->find($id);
        $followers = $user->followers()->whereNotIn('id', $ids)->limit(20)->get();

        $followings = $user->followings_count;
        if (!$request->ajax()) {
            return view('user-parts.followers', compact('user', 'followers', 'followings', 'followers'));
        } else {
            $this->loadUsers($followers);
        }

    }

    public static function loadUsers($users)
    {
        $output = '';
        foreach ($users as $user) {
            $output .= '

            <div class="followers-el" >
                <a href = "' . route('profile', $user->id) .
                '" >
                    <div class="profile_user" >
                        <div class="profile_user_img" style = "background-image: url(/storage/images/avatars/' . $user->avatar . '" ></div >
                        <div class="profile_user_name" >
                            <p >' . $user->name . '
            </p >
                        </div >
                    </div >
                </a >';
            if (Auth::check()) {

            $output .= '
        
                    <div onclick = "ajaxAction($(this), \'users\')" class="follow"';
            if (Auth::user()->isFollowing($user)) {
                $output .= ' hidden ';
            }

            $output .=
                'data - id = "' . $user->id . '" >
                        <div class="btn_subscribe subscribe profile_user_btn btn-green" >
                            <a class="" > Подписаться</a >
                        </div >
                    </div >

                    <div onclick = "ajaxAction($(this), \'users\')" class="unfollow"';
            if (!Auth::user()->isFollowing($user)) {
                $output .= ' hidden ';
            }
            $output .= 'data - id = "' . $user->id . '" >
                        <div class="btn_unscribe profile_user_btn btn-green" >
                            <a class="" > Отписаться</a >
                        </div >
                    </div >';

            }
            $output .= '</div >';
        }

        echo $output;

    }

}
