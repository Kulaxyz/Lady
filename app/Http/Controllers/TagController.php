<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $filter = 'posts')
    {
        $order = $filter . '_count';
        $ids =  $request->post('ids') ? $request->post('ids') : [];
        $tags = Tag::withCount('posts', 'followers')
            ->whereNotIn('id', $ids)
            ->limit(6)
            ->orderBy($order, 'DESC')->get();

        if (!$request->ajax()) {
            return view('tag.index', ['tags' => $tags, 'filter' => $filter]);
        } else {
            $output = '';
            foreach ($tags as $tag)
            {
                $output .= "<div class=\"col-lg-3 col-3 d-flex justify-content-center\">
                                <div class=\"card\" data-id=\"$tag->id\">
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title\"><a href='" . route('tag', $tag->id) ."'>$tag->name</a></h5>
                                        <p class=\"card-text\">$tag->posts_count  Публикаций</p>
                                        <a class=\"btn btn-primary\">Подписаться</a>
                                    </div>
                                </div>
                            </div>";
            }
            echo $output;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->post('name');
        $tag->save();

        return redirect()->to('/tags/' . $tag->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, Request $request)
    {
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $tag = Tag::find($id);
        $posts = $tag->posts()->withCount('likers')
            ->whereNotIn('post_id', $ids)
            ->with('images', 'user')
            ->orderBy('created_at', 'DESC')
            ->limit(6)->get();
        if (!$request->ajax()) {
            return view('tag.single', ['posts' => $posts, 'tag' => $tag]);
        } else {
            PostController::loadMore($posts);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }

    public function follow(Request $request)
    {
        if (!$request->ajax())
        {
            abort(403);
        }

        Auth::user()->follow($request->post('tag_id'), Tag::class);
        echo 'unfollow';
    }
    public function unfollow(Request $request)
    {
        if (!$request->ajax())
        {
            abort(403);
        }

        Auth::user()->unfollow($request->post('tag_id'), Tag::class);
        echo 'follow';
    }
}
