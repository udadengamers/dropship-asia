<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;
use App\Observers\ProductImageObserver;

class ProductImage extends Model
{
    use HasFactory, GenerateUuidTrait;
    
    protected $table = 'product_images';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'parent_id',
        'file_label_type',
        'original_file_name',
        'display_file_name',
        'path_file',
        'extension_file',
        'extension_file',
        'remark',
        'type',
        'state',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(ProductImageObserver::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'parent_id', 'id');
    }
}
