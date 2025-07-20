<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class ProductShop extends Model
{
    use HasFactory, GenerateUuidTrait;
    
    protected $table = 'product_shops';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'shop_id',
        'product_id',
        'type',
        'state',
    ];
    
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function scopeAdded($query)
    {
        return $query->where('state', 'added');
    }

    public function scopeRemoved($query)
    {
        return $query->where('state', 'removed');
    }

    public function scopeProductActive($query)
    {
        return $query->whereHas('product', function ($query) {
            $query->active();
        });
    }
}
