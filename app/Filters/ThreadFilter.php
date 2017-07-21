<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;


class ThreadFilter extends Filters
{
    protected $filters = ['by', 'popular'];

    /**
     * Filter treads by username
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }


    /**
     * filter the query according to the most popular threads
     * @return mixed
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }
}