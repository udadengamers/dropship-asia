<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GenerateUuidTrait;
use App\Traits\GenerateAccountIdTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GenerateUuidTrait, GenerateAccountIdTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected $fillable = [
        'uuid',
        'account_id',
        'fname',
        'lname',
        'email',
        'phone',
        'remember_token',
        'wallet_address',
        'password',
        'otp',
        'otp_expired_at',
        'otp_verified_at',
        'email_verified_at',
        'type',
        'state'
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function buyer_detail()
    {
        return $this->hasOne(BuyerDetail::class, 'user_id', 'id');
    }

    public function payment_buyers()
    {
        return $this->hasMany(PaymentBuyer::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function service()
    {
        return $this->hasMany(Service::class, 'user_id', 'id');
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'user_id', 'id');
    }

    public function scopeSeller($query)
    {
        return $query->where('type', 'seller');
    }

    public function scopeActive($query)
    {
        return $query->where('state', 'active');
    }

    public function scopeDeleted($query)
    {
        return $query->where('state', '!=', 'deleted');
    }

    // update

    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'parent_id', 'id');
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class, 'parent_id', 'id');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'parent_id', 'id');
    }

    public function topups()
    {
        return $this->hasMany(Topup::class, 'parent_id', 'id');
    }

    public function getBalanceAttribute()
    {
        return $this->wallets()->sum('amount_in') - $this->wallets()->sum('amount_out');
    }

    public function getTopupAttribute()
    {
        return $this->topups()->where('state', 'approved')->sum('amount_submitted');
    }

    public function getWithdrawAttribute()
    {
        return $this->withdraws()->where('state', 'approved')->sum('amount_approved');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'user_id', 'id');
    }
}
