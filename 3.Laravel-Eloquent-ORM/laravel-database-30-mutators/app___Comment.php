<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    // retrieved, creating, created, updating, updated, saving, saved, deleting, deleted, restoring, restored
    // When issuing a mass update or delete via Eloquent, the saved, updated, deleting, and deleted model events will not be fired for the affected models. This is because the models are never actually retrieved when issuing a mass update or delete.
    // protected $dispatchesEvents = [
    //     'saved' => 'class to handle saved event',
    //     'deleted' => 'class to deleted saved event'
    // ];

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

    protected static function booted()
    {
        static::retrieved(function ($comment) {
            // echo $comment->rating;
        });
    }

    // public function getRatingAttribute($value)
    // {
    //     return $value + 10;
    // }

    public function getWhoWhatAttribute()
    {
        return "user {$this->user_id} rates {$this->rating}";
    }

    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = $value + 1;
    }
}

