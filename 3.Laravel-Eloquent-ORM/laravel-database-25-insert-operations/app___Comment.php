<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    // protected $fillable = ['rating', 'content', 'user_id'];
    protected $guarded = [];

    // protected static function booted()
    // {
    //     static::addGlobalScope('rating', function (Builder $builder) {
    //         $builder->where('rating', '>', 2);
    //     });
    // }

    public function scopeRating($query, int $value = 4)
    {
        return $query->where('rating', '>', $value);
    }
}

