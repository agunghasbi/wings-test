<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Login extends Authenticatable
{
    use HasFactory;

    protected $table = 'Login';

    protected $fillable = [
        'User',
        'Password',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'Password' => 'hashed',
    ];

    protected $guarded = ['User'];

    protected $hidden = [
        'Password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }
}
