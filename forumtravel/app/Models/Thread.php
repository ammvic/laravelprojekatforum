<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ["id", "title", "body", "slug", "channel_id"]; // Dodajemo 'id' u fillable

    protected $primaryKey = 'id'; // Postavljamo primaryKey na 'id'

    public $incrementing = false; // Isključujemo automatsko povećanje ključa

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'thread_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
