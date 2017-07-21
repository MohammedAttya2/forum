<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attribute = ['user_id' => auth()->id()];

        if (! $this->favorites()->where($attribute)->exists()) {
            return $this->favorites()->create($attribute);
        }
    }

    public function isFavorited()
    {
        $attribute = ['user_id' => auth()->id()];

        return $this->favorites()->where($attribute)->exists();
    }
}
