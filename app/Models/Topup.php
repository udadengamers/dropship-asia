<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;
use App\Traits\GenerateTrxCodeTrait;
use App\Observers\TopupObserver;
use App\Traits\StateMachineTrait;

class Topup extends Model
{
    use HasFactory, GenerateUuidTrait, GenerateTrxCodeTrait, StateMachineTrait;
    
    protected $table = 'topups';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'trx_code',
        'parent_id',
        'network',
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
        'in_review' => ['approved','rejected'],
        'approved' => [],
        'rejected' => [],
    ];

    public $states = [
        'in_review' => 'Under Review',
        'approved' => 'Examination Passed',
        'rejected' => 'Payment Rejected',
        'fail' => 'Fail',
    ];

    protected static function boot() {
        parent::boot();
        static::observe(TopupObserver::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }
    
    public function approve_by()
    {
        return $this->belongsTo(Admin::class, 'approved_by_id', 'id');
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
                    'title' => 'Topup Confirmation',
                    'description' => 'Are you sure you want to approve this topup?',
                    'color' => 'danger',
                ],
                [
                    'text' => 'Reject',
                    'state' => 'rejected',
                    'button_align' => 'text-end',
                    'button' => 'btn btn-danger',
                    'title' => 'Topup Confirmation',
                    'description' => 'Are you sure you want to reject this topup?',
                    'color' => 'danger',
                ]
            ],
        ];

        return $buttons[$this->state] ?? [];
    }
}
