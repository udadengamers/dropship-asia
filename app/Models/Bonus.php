<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;
use App\Observers\BonusObserver;

class Bonus extends Model
{
    use HasFactory, GenerateUuidTrait;
    
    protected $table = 'bonuses';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'order_id',
        'parent_id',
        'bonus_percentage',
        'bonus_amount',
        'type',
        'state',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(BonusObserver::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
