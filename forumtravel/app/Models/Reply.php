<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ["reply", "user_id", 'likes', 'dislikes', 'image'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}

