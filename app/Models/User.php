<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;


    protected $connection = 'mongodb';
    protected $collection = 'users';

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
           // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}







// namespace App\Models;

// use Illuminate\Auth\Authenticatable as LaravelAuthenticatable; // Laravel's Authenticatable trait
// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use MongoDB\Laravel\Eloquent\Model as MongoModel; // Use MongoDB Eloquent Model
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

// class User extends MongoModel implements Authenticatable// Extend MongoDB Eloquent Model
// {
//     use LaravelAuthenticatable, HasFactory, Notifiable, HasApiTokens; // Use Sanctum's HasApiTokens trait

//     // Optional: Specify the connection and collection if not using default values
//     // protected $connection = 'mongodb'; 
//     // protected $collection = 'users'; 

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'password' => 'hashed',
//         ];
//     }
// }
