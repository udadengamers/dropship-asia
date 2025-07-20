<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class Seller extends Authenticatable
{
    use HasFactory, Notifiable, GenerateUuidTrait;
    
    protected $table = 'sellers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone_number',
        'remember_token',
        'password',
        'otp',
        'otp_expired_date',
        'otp_verify_date',
        'email_verify_date',
        'type',
        'state',
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
}
