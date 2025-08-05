<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'category',
        'name',
        'phone',
        'mykad',
        'passport',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
