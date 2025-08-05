<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone_number',
        'role',
        'password',
        'avatar',
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Hantar notifikasi reset password untuk admin (ke Mailtrap)
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
