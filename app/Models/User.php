<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's permissions for the JavaScript front end.
     *
     * @return array
     */
    public function jsPermissions()
    {
        // This is just an example. You'll need to replace this with your actual logic
        // for fetching and returning the user's permissions.
        return [
            'can_edit_posts' => $this->canEditPosts(),
            'can_delete_posts' => $this->canDeletePosts(),
            // Add other permissions as needed...
        ];
    }

    // Example methods for determining specific permissions.
    // You'll need to implement these based on your application's logic.
    protected function canEditPosts()
    {
        // Your logic here
        return true; // Example value
    }

    protected function canDeletePosts()
    {
        // Your logic here
        return false; // Example value
    }

}
