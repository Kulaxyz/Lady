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
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $ids = array_unique($ids);
        $tags = Tag::withCount('posts', 'followers')
            ->whereNotIn('id', $ids)
            ->limit(6)
            ->orderBy($order, 'DESC')->get();

        if (!$request->ajax()) {
            return view('tag.index', ['tags' => $tags, 'filter' => $filter]);
        } else {
            $this->loadTags($tags);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, Request $request)
    {
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $tag = Tag::find($id);
        $posts = $tag->posts()->withCount('likers', 'comments', 'favoriters')
            ->whereNotIn('post_id', $ids)
            ->with('images', 'user')
            ->orderBy('created_at', 'DESC')
            ->limit(6)->get();
        if (!$request->ajax()) {
            return view('tag.single', ['posts' => $posts, 'tag' => $tag]);
        } else {
            return $posts;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }

    public function follow(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
        }

        Auth::user()->follow($request->post('tag_id'), Tag::class);
        echo 'unfollow';
    }

    public function unfollow(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
        }

        Auth::user()->unfollow($request->post('tag_id'), Tag::class);
        echo 'follow';
    }

    public static function loadTags($tags)
    {
        $output = '';
        foreach ($tags as $tag) {
            $output .= "<div class=\"topic-content-el\">
                            <h4>$tag->name</h4>
                            <ul>
                                <li>Публикаций " . $tag->posts_count . "</li>
                                <li>Подписчиков " . $tag->followers_count . "</li>
                            </ul>";
            if (Auth::user()) {
                $output .= '<div onclick="ajaxAction($(this), \'tag\')" class="follow"';
                if (Auth::user()->isFollowing($tag)) {
                    $output .= ' hidden ';
                }
                $output .= 'data-id="' . $tag->id . '">
                        <div class="btn_subscribe">
                             <a class="btn btn-primary">Подписаться</a>
                        </div>
                    </div>

                    <div onclick="ajaxAction($(this), \'tag\')" class="unfollow"';
                if (!Auth::user()->isFollowing($tag)) {
                    $output .= ' hidden ';
                }
                $output .= 'data-id="' . $tag->id . '">
                        <div class="btn_unscribe">
                                <a class="btn btn-light">Отписаться</a>
                        </div>
                    </div>
                    </div>';
            }
        }
        echo $output;
    }
}

