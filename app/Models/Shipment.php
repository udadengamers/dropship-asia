<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;
use App\Traits\GenerateTrxCodeTrait;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\Log;
use App\Traits\StateMachineTrait;

class Shipment extends Model
{
    use HasFactory, GenerateUuidTrait;

    protected $table = 'shipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price',
        'type',
        'state',
    ];

    // public function product_images()
    // {
    //     return $this->hasMany(ProductImage::class, 'parent_id', 'id');
    // }

}
