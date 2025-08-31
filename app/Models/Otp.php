<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = ['identifier', 'otp', 'type', 'expires_at'];
    public $timestamps = true;
}
