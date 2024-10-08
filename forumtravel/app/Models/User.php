<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Thread;
use App\Models\Role; // Dodajemo import za model Role

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function isAdmin()
    {
        // Provjeri da li korisnik ima ulogu
        if ($this->role) {
            return $this->role->role == 'ROLE_ADMIN';
        }
        
        // Ako korisnik nema ulogu, dodijeli mu ulogu korisnika
        $userRole = Role::where('role', 'ROLE_USER')->first();
        $this->role()->associate($userRole);
        $this->save();

        // Sada provjeri da li je korisnik admin
        return false;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function following(Thread $thread)
    {
        return $this->followedThreads()->where('thread_id', $thread->id)->exists();
    }

    public function followedThreads()
    {
        return $this->belongsToMany(Thread::class, 'user_thread')->withTimestamps();
    }

    public function follow(Thread $thread)
    {
        $this->followedThreads()->attach($thread);
    }

    public function unfollow(Thread $thread)
    {
        $this->followedThreads()->detach($thread);
    }
}
