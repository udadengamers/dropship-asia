<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class Shop extends Model
{
    use HasFactory, GenerateUuidTrait;

    protected $table = 'shops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'description',
        'slug',
        'supplier_name',
        'invitation_code',
        'description',
        'phone_number',
        'contact_person',
        'id_card',
        'address',
        'merchant_id',
        'payment_method_id',
        'profile_picture',
        'business_license',
        'type',
        'state',
    ];

    public function shop_products()
    {
        return $this->hasMany(ProductShop::class, 'shop_id', 'id');
    }

    // user seller
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'shop_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'shop_id', 'id');
    }
    public function scopeActiveShop($query)
    {
        return $query->where('state', 'active');
    }
    public function getPaymentMethodAttribute()
    {
        return [
            1 => 'TRC-20',
        ];
    }

    public function getMerchantCategoryAttribute()
    {
        return [
            1 => 'All Category',
            2 => 'Fashion',
            3 => 'Electronics',
            4 => 'Home & Garden',
        ];
    }
}
