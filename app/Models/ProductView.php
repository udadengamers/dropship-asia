<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    use HasFactory;
    
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'parent_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }

    public function getTotalStocksAttribute()
    {
        if ($this->stocks) {
            return $this->stocks()->sum('quantity');
        }
        return 0;
    }

    public function scopeActive($query)
    {
        return $query->where('state', 'active');
    }

    public function scopeOutstock($query)
    {
        return $query->whereHas('stocks', function ($query_stock) {
            $query_stock->where('quantity', '<', 1);
        });
    }

    public function scopeInstock($query)
    {
        return $query->whereHas('stocks', function ($query_stock) {
            $query_stock->where('quantity', '>', 0);
        });
    }

    public function scopeAdded($query)
    {
        return $query->where('product_shop_state', 'added');
    }

    public function scopeRemoved($query)
    {
        return $query->where('product_shop_state', 'removed');
    }
}
