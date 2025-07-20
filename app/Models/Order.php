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

class Order extends Model
{
    use HasFactory, GenerateUuidTrait, GenerateTrxCodeTrait, StateMachineTrait;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $status = [
        'created' => ['payment_submitted','cancelled','approved'],
        'payment_submitted' => ['approved','payment_rejected'],
        'payment_rejected' => ['payment_submitted','cancelled'],
        'approved' => ['preparing_for_shipment'],
        'preparing_for_shipment' => ['shipping'],
        'shipping' => ['received','completed'],
        'received' => ['completed'],
        'completed' => [],
        'cancelled' => []
    ];

    public $states = [
        'created' => 'Awaiting Payment',
        'payment_rejected' => 'Payment Rejected',
        'cancelled' => 'Order has been cancelled',
        'payment_submitted' => 'Payment Submitted',
        'approved' => 'Payment Approved',
        'preparing_for_shipment' => 'Preparing for Shipment',
        'shipping' => 'Shipped',
        'received' => 'Delivered',
        'completed' => 'Completed'
    ];

    protected $dates = [
        'order_date',
        'created_at',
        'updated_at',
        'shipping_date',
    ];

    protected $fillable = [
        'uuid',
        'trx_code',
        'user_id',
        'shop_id',
        'shipment_id',
        'note',
        'total',
        'order_date',
        'shipping_number',
        'shipping_date',
        'shipping_name',
        'shipping_price',
        'type',
        'state',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(OrderObserver::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentBuyer::class, 'order_id', 'id');
    }
    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

    public function user_button_actions()
    {
        $buttons = [
            'created' => [
                [
                    'text' => 'Pay',
                    'state' => 'payment_submitted',
                    'title' => 'Order Confirmation',
                    'description' => 'Are you sure you want to proceed the order to the supplier?',
                    'color' => 'danger',
                ]
            ],
            'shipping' => [
                [
                    'text' => 'Supplier Ship',
                    'state' => 'received',
                    'title' => 'Shipping Confirmation',
                    'description' => 'Are you sure you want to change the status of this order to Shipping?',
                    'color' => 'danger',
                ]
            ],
        ];

        return $buttons[$this->state] ?? [];
    }

    public function button_actions()
    {
        $buttons = [
            // 'created' => [
            //     [
            //         'text' => 'Update',
            //         'state' => 'payment_submitted',
            //         'title' => 'Order Confirmation',
            //         'description' => 'Are you sure you want to proceed the order to the supplier?',
            //         'color' => 'danger',
            //     ]
            // ],
            'approved' => [
                [
                    'text' => 'Supplier Ship',
                    'state' => 'preparing_for_shipment',
                    'title' => 'Shipping Confirmation',
                    'description' => 'Are you sure you want to change the status of this order to Shipping?',
                    'color' => 'danger',
                ]
            ],
        ];

        return $buttons[$this->state] ?? [];
    }

    public function admin_button_actions()
    {
        $buttons = [
            'payment_submitted' => [
                [
                    'text' => 'Update',
                    'state' => 'approved',
                    'title' => 'Order Confirmation',
                    'description' => 'Are you sure you want to approve this payment order?',
                    'color' => 'danger',
                ]
            ],
            'preparing_for_shipment' => [
                [
                    'text' => 'Update',
                    'state' => 'shipping',
                    'title' => 'Shipping Number',
                    'description' => 'Are you sure?',
                    'color' => 'danger',
                ]
            ]
        ];

        return $buttons[$this->state] ?? [];
    }
}
