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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        Auth::user()->unreadNotifications()->where('type', '=', NewPost::class)->get()->markAsRead();
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $tags = Auth::user()->followings('App\Tag')->pluck('id')->toArray();
        $posts = Post::whereHas('tags', function ($q) use ($tags) {
            return $q->whereIn('tags.id', $tags);
        })
            ->withCount('likers')
            ->whereNotIn('posts.id', $ids)
            ->with('images', 'user')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        if (!$request->ajax()) {
            return view('home', ['posts' => $posts, 'h' => 'По тегам']);

        } else {
            PostController::loadMore($posts);
        }

    }

    public function byUser(Request $request)
    {
        Auth::user()->unreadNotifications()->where('type', '=', NewPost::class)->get()->markAsRead();
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $users = Auth::user()->followings()->get('id')->toArray();
        $posts = Post::whereNotIn('posts.id', $ids)
            ->whereIn('user_id', $users)
            ->withCount('likers')
            ->with('images', 'user')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        if (!$request->ajax()) {
            return view('home', ['posts' => $posts, 'h' => 'По пользователям']);

        } else {
            PostController::loadMore($posts);
        }
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $tags = Tag::where('name', 'like', '%' . $query . '%')
            ->get();

        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        //broadcast search results with Pusher channels
//        event(new SearchEvent($tags, $posts));

        echo json_encode($tags);
        echo json_encode($posts);
    }

}
