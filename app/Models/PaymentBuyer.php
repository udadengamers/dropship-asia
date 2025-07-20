<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;
use App\Traits\GenerateTrxCodeTrait;
use App\Observers\PaymentBuyerObserver;
use App\Traits\StateMachineTrait;

class PaymentBuyer extends Model
{
    use HasFactory, GenerateUuidTrait, GenerateTrxCodeTrait, StateMachineTrait;
    
    protected $table = 'payment_buyers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'trx_code',
        'user_id',
        'order_id',
        'amount_submitted',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'proof_file_path',
        'remarks',
        'approved_by_id',
        'approved_at',
        'paid_at',
        'type',
        'state',
    ];

    public $status = [
        'in_review' => ['rejected','approved'],
        'rejected' => [],
        'approved' => [],
    ];

    public $states = [
        'in_review' => 'Admin Confirmation',
        'approved' => 'Payment Approved',
        'rejected' => 'Payment Rejected',
    ];

    protected $dates = [
        'approved_at',
        'paid_at',
    ];

    protected static function boot() {
        parent::boot();
        static::observe(PaymentBuyerObserver::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function approve_by()
    {
        return $this->belongsTo(Admin::class, 'approved_by_id', 'id');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function admin_button_actions()
    {
        $buttons = [
            'in_review' => [
                [
                    'text' => 'Approve',
                    'state' => 'approved',
                    'button_align' => 'text-start',
                    'button' => 'btn btn-success',
                    'title' => 'Payment Confirmation',
                    'description' => 'Are you sure you want to approve this payment?',
                    'color' => 'danger',
                ],
                [
                    'text' => 'Reject',
                    'state' => 'rejected',
                    'button_align' => 'text-end',
                    'button' => 'btn btn-danger',
                    'title' => 'Payment Confirmation',
                    'description' => 'Are you sure you want to reject this payment?',
                    'color' => 'danger',
                ]
            ],
        ];

        return $buttons[$this->state] ?? [];
    }
}
