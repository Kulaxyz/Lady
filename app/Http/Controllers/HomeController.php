<?php

namespace App\Http\Controllers;

use App\Events\SearchEvent;
use App\Notifications\NewPost;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function ms()
    {
        $post = Post::find(20);
        $comments = $post->comments()->count();
        dd($post, $comments);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        define('LIMIT_OF_POSTS', 10);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $nots = Auth::user()->unreadNotifications()->where('type', '=', NewPost::class)->get();
        if (!$nots->isEmpty()) {
            Auth::user()->unreadNotifications()->where('type', '=', NewPost::class)->get()->markAsRead();
        }
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $tags = Auth::user()->followings('App\Tag')->pluck('id')->toArray();
        $posts = Post::whereHas('tags', function ($q) use ($tags) {
            return $q->whereIn('tags.id', $tags);
        })
            ->withCount('likers', 'comments', 'favoriters')
            ->whereNotIn('posts.id', $ids)
            ->with('images', 'user')
            ->orderBy('created_at', 'DESC')
            ->limit(LIMIT_OF_POSTS)
            ->get();
        if (!$request->ajax()) {
            return view('home', compact('posts'));

        } else {
            return $posts;
        }

    }

    public function byUser(Request $request)
    {
        Auth::user()->unreadNotifications()->where('type', '=', NewPost::class)->get()->markAsRead();
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $users = Auth::user()->followings()->get('id')->toArray();
        $posts = Post::whereNotIn('posts.id', $ids)
            ->whereIn('user_id', $users)
            ->withCount('likers', 'comments', 'favoriters')
            ->with('images', 'user')
            ->orderBy('created_at', 'DESC')
            ->limit(LIMIT_OF_POSTS)
            ->get();

        if (!$request->ajax()) {
            return view('home', compact('posts'));

        } else {
            return $posts;
        }
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $tags = Tag::where('name', 'like', '%' . $query . '%')
            ->limit(20)
            ->get();

        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();

        //broadcast search results with Pusher channels
//        event(new SearchEvent($tags, $posts));

        return [$tags, $posts];
    }

}
