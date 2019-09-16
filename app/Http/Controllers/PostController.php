<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Option;
use App\Post;
use App\Tag;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Array_;
use PhpParser\Node\Expr\Cast\Object_;
use vendor\project\StatusTest;
use Carbon\Carbon;
use App\Events\NewPost;
use function Sodium\add;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $filter
     * @param string $time
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        Carbon::setLocale('ru');
        define('LIMIT_OF_POSTS', 10);
    }

    public function all(Request $request, $filter, $time = 'week')
    {
        switch ($filter) {
            case 'live':
                $order_by = 'created_at';
                $time = 'Century';
                break;
            case 'popular':
                $order_by = 'likers_count';
                break;
            case 'discussed';
                $order_by = 'comments_count';
                break;
            default:
                $order_by = 'created_at';
        }
        $ids = $request->post('ids') ? $request->post('ids') : [];
        $sub = 'sub' . $time;
        $posts = Post::with('images', 'tags', 'options', 'user')
            ->withCount('likers', 'comments', 'favoriters')
            ->whereNotIn('id', $ids)
            ->where('created_at', '>', Carbon::now()->$sub())
            ->orderBy($order_by, 'DESC')
            ->limit(LIMIT_OF_POSTS)
            ->get();
        if (!$request->ajax()) {
            return view('post.index', compact('posts', 'filter', 'time'));
        } else {
            return $posts;
        }
    }

    public function favorites(Request $request, $filter = null)
    {
        $order = 'created_at';
        if ($filter) {
            $order = $filter . '.' . $order;
        }

        $ids = $request->post('ids') ? $request->post('ids') : [];
        $posts = Auth::user()->favorites(Post::class)->with('images', 'tags', 'options', 'user')
            ->whereNotIn('id', $ids)
            ->withCount('likers', 'comments', 'favoriters')
            ->orderBy($order, 'DESC')
            ->limit(LIMIT_OF_POSTS)
            ->get();
        if (!$request->ajax()) {
            return view('post.favorites', ['posts' => $posts]);
        } else {
            return $posts;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPost()
    {
        $tags = Tag::get();
        return view('post/add', ['tags' => $tags]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->post('title');
        $post->description = $request->post('description');
        $post->type = $request->post('options')[0] ? 'vote' : 'post';
        $post->is_anonimous = $request->has('anon') ? true : false;
        $post->user_id = Auth::user()->id;
        $post->user()->associate(Auth::user());

        $post->save();

        $tags = $request->input('tags');
        $post->tags()->sync($tags);
        $tags = Tag::whereIn('id', $tags)->get();
        $tags_followers = [];

        foreach($tags as $tag) {
            $tags_followers = array_merge($tags_followers, $tag->followers()->where('id' ,'>' ,0)->pluck('id')->toArray());
        }
        $result = array_merge($tags_followers, Auth::user()->followers()->where('id' ,'>' ,0)->pluck('id')->toArray());
        $result = array_unique($result);

        if (($key = array_search(Auth::id(), $result)) !== false) {
            unset($result[$key]);
        }

        broadcast(new NewPost($result))->toOthers();

        if ($request->has('files')) {

            $images = $request->files->all()['files'];
            foreach ($images as $image) {
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $destination_path = 'public/images/posts';
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->stream(); // <-- Key point

                Storage::disk('local')->put($destination_path . '/' . $fileName, $img, 'public');
                // Start order from 1 instead of 0
                $postImage = new \App\Image;
                $postImage->path = $fileName;
                $postImage->post_id = $post->id;
                $postImage->post()->associate($post);
                $postImage->save();
            }
        }

        if ($post->type == 'vote') {
            foreach ($request->post('options') as $name) {
                $option = new Option();
                $option->name = $name;
                $option->post_id = $post->id;
                $option->post()->associate($post);
                $option->save();
            }
        }
        Auth::user()->favorite($post, Post::class);



        return redirect()->to('posts/single/' . $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = Post::with('images', 'tags', 'options', 'user', 'votes')
            ->withCount('likers', 'comments', 'favoriters')
            ->find($id);
        return view('post.show', [
            'post' => $post, 'tags' => $post->tags,
            'images' => $post->images, 'user' => $post->user,
            'options' => $post->options()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        Post::destroy($post_id);
        return redirect()->route('list', 'live');
    }



    public function getOptions($post_id)
    {
        $results = [];
        $post = Post::with('options')->find($post_id);
        $options = $post->options;
        foreach ($options as $option) {
            $result = [];
            $result["name"] = $option->name;
            $result["id"] = $option->id;
            $result["votesCount"] = $option->countVotes();
            $result["percent"] = (int)$option->percent();
            array_push($results, $result);
        }

        return json_encode($results);
    }

    /**
     * Make a Vote
     *
     * @param Post $post
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */


    public function vote(Request $request)
    {
//        $post = Post::with('options')->find($request->post('post_id'));
//        $options = $post->options;
//
        if (!$request->ajax()) {
            abort(403);
        }
        $post = Post::with('options')->find($request->post('post_id'));
        $options = $post->options()->get();
        try {
            $option = $post->options()->find($request->post('option_id'));
            $vote = $this->resolveVoter($request)
                ->post($post)
                ->vote($option);
            $option->updateTotalVotes();

            if ($vote) {
                $results = [];

                foreach ($options as $option) {
                    $result["name"] = $option->name;
                    $result["id"] = $option->id;
                    $result["votesCount"] = $option->countVotes();
                    $result["percent"] = (int)$option->percent();
                    array_push($results, $result);
                }

                return json_encode($results);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Get the instance of the voter
     *
     * @param Request $request
     * @param Post $post
     * @return Guest|mixed
     */
    protected function resolveVoter(Request $request)
    {
        return $request->user();
    }

    public function like(Request $request)
    {
        $this->checkAjax($request);
        Auth::user()->like($request->post('post_id'), Post::class);
        echo 'dislike';
    }

    public function dislike(Request $request)
    {
        $this->checkAjax($request);
        Auth::user()->unlike($request->post('post_id'), Post::class);
        echo 'like';
    }

    public function favorite(Request $request)
    {
        $this->checkAjax($request);
        Auth::user()->favorite($request->post('post_id'), Post::class);
        echo 'unfavorite';
    }

    public function unfavorite(Request $request)
    {
        $this->checkAjax($request);
        Auth::user()->unfavorite($request->post('post_id'), Post::class);
        echo 'favorite';
    }


    private function checkAjax(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        if (!Auth::user()) {
            abort(403);
        }
        return true;
    }

}
