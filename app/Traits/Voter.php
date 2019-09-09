<?php


namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Option;
use App\Post;
use App\Vote;
use Psr\Log\InvalidArgumentException;

trait Voter
{
    protected $post;

    /**
     * Select post
     *
     * @param Post $post
     * @return $this
     */
    public function post(Post $post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Vote for an option
     *
     * @param $options
     * @return bool
     * @throws \Exception
     */
    public function vote(Option $option)
    {
        // if post not selected
        if (is_null($this->post))
            throw new InvalidArgumentException();

        if ($this->hasVoted($this->post->id))
            throw new \Exception("Вы не можете голосовать дважды!");

        return !is_null($this->options()->sync($option, false));
    }

    /**
     * Check if he can vote
     *
     * @param $post_id
     * @return bool
     */
    public function hasVoted($post_id)
    {
        $post = Post::findOrFail($post_id);

        return $this->options()->where('post_id', $post->id)->count() !== 0;
    }

    /**
     * The options he voted to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(Option::class, 'votes')->withTimestamps();
    }
}
