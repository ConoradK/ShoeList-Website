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

    // custom method to check the user's role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }


    
    // Find the user by their username for Passport authentication
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    // Define a many-to-many relationship between the user and shoes
    public function shoes()
    {
        return $this->belongsToMany(Shoe::class, 'user_shoe', 'user_id', 'shoe_id');
    }


}
