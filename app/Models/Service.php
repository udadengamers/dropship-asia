<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidTrait;

class Service extends Model
{
    use HasFactory, GenerateUuidTrait;

    protected $guarded = ['id'];

    protected $fillable = [
        'uuid',
        'admin_id',
        'user_id',
        'message',
        'img_msg',
        'owner',
        'type',
        'state',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
    public function buyer_detail()
    {
        return $this->hasOne(BuyerDetail::class, 'user_id', 'id');
    }
}
