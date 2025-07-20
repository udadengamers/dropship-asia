<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class BuyerDetail extends Model
{
    use HasFactory, GenerateUuidTrait;
    
    protected $table = 'buyer_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'address_one',
        'address_two',
        'profile_pict',
        'date_of_birth',
        'phone_number',
        'type',
        'state',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
