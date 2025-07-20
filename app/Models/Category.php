<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class Category extends Model
{
    use HasFactory, GenerateUuidTrait;
    
    protected $table = 'categories';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'type',
        'state',
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
