<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;
use App\Traits\GenerateTrxCodeTrait;
use App\Observers\WithdrawObserver;
use App\Traits\StateMachineTrait;

class Withdraw extends Model
{
    use HasFactory, GenerateUuidTrait, GenerateTrxCodeTrait, StateMachineTrait;

    protected $table = 'withdraws';

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
        'amount_approved',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'bank_reference_no',
        'proof_file_path',
        'remarks',
        'approved_by_id',
        'approved_at',
        'type',
        'state',
    ];

    public $status = [
        'in_review' => ['rejected', 'approved'],
        'rejected' => [],
        'approved' => [],
    ];

    public $states = [
        'in_review' => 'Under Review',
        'approved' => 'Examination Passed',
        'rejected' => 'Payment Rejected',
        'fail' => 'Fail',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(WithdrawObserver::class);
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
                    'title' => 'Withdraw Confirmation',
                    'description' => 'Are you sure you want to approve this withdraw?',
                    'color' => 'danger',
                ],
                [
                    'text' => 'Reject',
                    'state' => 'rejected',
                    'button_align' => 'text-end',
                    'button' => 'btn btn-danger',
                    'title' => 'Withdraw Confirmation',
                    'description' => 'Are you sure you want to reject this withdraw?',
                    'color' => 'danger',
                ]
            ],
        ];

        return $buttons[$this->state] ?? [];
    }
}
