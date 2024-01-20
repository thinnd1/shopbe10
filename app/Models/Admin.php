<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table="admin";
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
}
