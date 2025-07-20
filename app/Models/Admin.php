<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, GenerateUuidTrait;
    
    protected $table = 'admins';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
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

    public function scopeNonSuper ($query)
    {
        return $query->whereNull('type');
    }

    public function scopeActive ($query)
    {
        return $query->where('state', 'active');
    }

    public function scopeDeleted ($query)
    {
        return $query->where('state', '!=' , 'deleted');
    }
}
