<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['user_id', 'reply_id', 'type'];
    
    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }
}
