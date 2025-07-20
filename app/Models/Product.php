<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class Product extends Model
{
    use HasFactory, GenerateUuidTrait;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'sku',
        'category_id',
        'description',
        'is_variation',
        'price',
        'type',
        'state',
    ];

    public function product_images()
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

    public function product_shop()
    {
        return $this->hasMany(ProductShop::class, 'product_id', 'id');
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

    public function admin_button_actions()
    {
        $buttons = [
            'active' => [
                [
                    'text' => 'Delete',
                    'state' => 'deleted',
                    'button_align' => 'text-start',
                    'button' => 'btn btn-danger',
                    'title' => 'Product Confirmation',
                    'description' => 'Are you sure you want to approve this product?',
                    'color' => 'danger',
                ],
            ],
        ];

        return $buttons[$this->state] ?? [];
    }
}
