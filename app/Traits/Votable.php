<?php

namespace App\Traits;


use App\User;
use App\Vote;

trait Votable
{
    /**
     * Check if the option is voted
     *
     * @return bool
     */
    public function isVoted()
    {
        return $this->voters()->count() != 0;
    }

    /**
     * Get the voters who voted to that option
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function voters()
    {
        return $this->belongsToMany(User::class, 'votes')->withTimestamps();
    }

    /**
     * Get number of votes to an option
     *
     * @return mixed
     */
    public function countVotes()
    {
        return Vote::where('option_id', $this->getKey())->count();
    }

    /**
     * Update the total of
     *
     * @return bool
     */
    public function updateTotalVotes()
    {
        $this->votes = $this->countVotes();
        return $this->save();
    }

    /**
     * An option belongs to one poll
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * Count percent of
     *
     * @return double
     */
    public function percent()
    {
        $count = $this->post->votes()->count();
        if ($count > 0) {
            return $this->countVotes() / $this->post->votes()->count() * 100;
        }
        return 0;
    }

}
