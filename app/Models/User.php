<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => 'string', // If 'role' is an enum, it will be cast to string
    ];

    // You can also add a custom method to check the user's role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }


    // public function setRoleAttribute($value)
    // {
    //     // Set a default role if none is provided
    //     $this->attributes['role'] = $value ?? 'user'; // Defaults to 'user'
    // }

    // In app/Models/User.php
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }



    public function shoes()
    {
        return $this->belongsToMany(Shoe::class, 'user_shoe', 'user_id', 'shoe_id');
    }

}
