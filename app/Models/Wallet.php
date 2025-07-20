<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\GenerateUuidTrait;

class Wallet extends Model
{
    use HasFactory, GenerateUuidTrait;
    
    protected $table = 'wallets';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'uuid',
        'parent_id',
        'description',
        'amount_in',
        'amount_out',
        'detailable_id',
        'detailable_type',
        'detail_url',
        'state',
        'type',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    public function getDetailAttribute() 
    {
        if ($this->detailable_type && $this->detailable_id) {
            return app($this->detailable_type)->find($this->detailable_id);
        }
        return null;
    }

    public function scopeOrder($query)
    {
        return $query->where('detailable_type', 'App\Models\Order');
    }

    public function scopePurchase($query)
    {
        return $query->where('type', 'purchase');
    }

    public function scopeBonus($query)
    {
        return $query->where('detailable_type', 'App\Models\Bonus');
    }

    public function scopeOrderBonus($query)
    {
        return $query->where('detailable_type', 'App\Models\Bonus')->orWhere('detailable_type', 'App\Models\Order');
    }

    public function getOverrideDescriptionAttribute()
    {
        if ($this->detailable_type == 'App\Models\Order') {
            if (str_contains($this->description, 'confirmed')) {
                return 'Payment Order Approved.';
            } else if (str_contains($this->description, 'paid')){
                return 'Payment Order Approved.';
            } else {
                return 'Order Completed.';
            }
        } elseif ($this->detailable_type == 'App\Models\Bonus') {
            return $this->description;
        } elseif ($this->detailable_type == 'App\Models\Topup') {
            return 'USDT Topup';
        } else {
            return 'USDT Withdraw';
        }
    }

    public $model = [
        'App\Models\Topup' => [
            'name' => 'Topup',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="top-up-balance"><path d="M22 4v1H5a1 1 0 0 0 0 2h16a1 1 0 0 1 1 1v11a2 2 0 0 1-2 2h-7v-6.586l1.293 1.293a1 1 0 0 0 1.414-1.414l-3-3a1 1 0 0 0-1.416 0l-3 3a1 1 0 0 0 1.414 1.414L11 14.414V21H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h17a1 1 0 0 1 1 1Z"></path></svg>'
        ],
        'App\Models\Withdraw' => [
            'name' => 'Withdraw',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="withdraw"><path d="M22,2H2A1,1,0,0,0,1,3v8a1,1,0,0,0,1,1H5v9a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V12h3a1,1,0,0,0,1-1V3A1,1,0,0,0,22,2ZM7,20V18a2,2,0,0,1,2,2Zm10,0H15a2,2,0,0,1,2-2Zm0-4a4,4,0,0,0-4,4H11a4,4,0,0,0-4-4V8H17Zm4-6H19V7a1,1,0,0,0-1-1H6A1,1,0,0,0,5,7v3H3V4H21Zm-9,5a3,3,0,1,0-3-3A3,3,0,0,0,12,15Zm0-4a1,1,0,1,1-1,1A1,1,0,0,1,12,11Z"></path></svg>'
        ],
        'App\Models\Order' => [
            'name' => 'Order',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414" clip-rule="evenodd" viewBox="0 0 32 32" id="transaction"><rect width="32" height="32" fill="none"></rect><path fill-rule="nonzero" d="M23.997,28.994l-0.001,0c-5.342,0 -10.685,0.017 -16.028,0c-2.584,-0.024 -4.96,-2.267 -4.968,-4.998l0,-15.998c0.037,-0.769 1.043,-1.286 1.655,-0.756c0.168,0.146 0.284,0.348 0.327,0.567c0.016,0.083 0.014,0.104 0.018,0.189c0,5.345 -0.05,10.69 0,16.034c0.024,1.547 1.363,2.947 2.98,2.962c4.006,0.013 8.011,0 12.017,0c-0.019,-0.024 -0.037,-0.049 -0.055,-0.075c-0.613,-0.855 -0.942,-1.885 -0.945,-2.923l0,-18.998l-14.997,0c0,0 -0.964,-0.22 -0.999,-0.952c-0.025,-0.536 0.443,-1.021 0.999,-1.047l15.997,0c0.537,0.024 0.974,0.45 1,0.999c0,6.678 -0.062,13.357 0,20.034c0.024,1.53 1.341,2.922 2.939,2.962c0.079,-0.009 0.055,0.005 0.235,-0.005c1.502,-0.09 2.82,-1.428 2.825,-2.996l0,-8.996l-3,0c0,0 -0.484,-0.053 -0.733,-0.32c-0.477,-0.515 -0.198,-1.551 0.584,-1.669c0.066,-0.01 0.083,-0.009 0.149,-0.011l4,0c0.024,0.001 0.049,0.002 0.074,0.003c0.229,0.025 0.265,0.05 0.359,0.096c0.337,0.162 0.552,0.523 0.566,0.901c0,3.343 0.011,6.687 0,10.03c-0.024,2.604 -2.305,4.958 -4.997,4.967l-0.001,0Zm-9.999,-5.999l-3.999,0c-0.778,-0.015 -1.301,-1.052 -0.741,-1.671c0.186,-0.206 0.458,-0.323 0.741,-0.329l3.999,0c0.013,0.001 0.027,0.001 0.04,0.001c0.873,0.052 1.316,1.423 0.419,1.887c-0.141,0.073 -0.297,0.109 -0.459,0.112Zm2,-3.999l-7.999,0c-0.229,-0.007 -0.305,-0.037 -0.434,-0.099c-0.613,-0.296 -0.743,-1.292 -0.144,-1.716c0.122,-0.087 0.263,-0.146 0.411,-0.171c0.055,-0.009 0.111,-0.012 0.167,-0.014l7.999,0c0.018,0.001 0.037,0.001 0.056,0.002c0.736,0.062 1.243,1.044 0.689,1.664c-0.188,0.21 -0.379,0.324 -0.745,0.334Zm0,-3.999l-7.999,0c-0.765,-0.022 -1.312,-1.033 -0.745,-1.667c0.187,-0.21 0.379,-0.323 0.745,-0.333l7.999,0c0.018,0 0.037,0.001 0.056,0.001c0.739,0.063 1.227,1.063 0.689,1.665c-0.188,0.21 -0.379,0.323 -0.745,0.334Zm0,-4l-7.999,0c-0.763,-0.021 -1.308,-1.037 -0.745,-1.666c0.187,-0.21 0.379,-0.323 0.745,-0.333l7.999,0c0.018,0 0.037,0.001 0.056,0.001c0.229,0.019 0.302,0.054 0.427,0.123c0.576,0.319 0.682,1.275 0.095,1.691c-0.122,0.086 -0.263,0.145 -0.411,0.17c-0.055,0.009 -0.111,0.013 -0.167,0.014Z"></path></svg>'
        ],
        'App\Models\Bonus' => [
            'name' => 'Bonus',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="bonus"><g data-name="Layer 24"><path d="M21 6a9.98 9.98 0 0 0-7.9833 4.0034L13 10H7a1 1 0 0 0 0 2h4.8409a9.9129 9.9129 0 0 0-.79 3H4a1 1 0 0 0 0 2h7.0507a9.9121 9.9121 0 0 0 .79 3H7a1 1 0 0 0 0 2h6l.0167-.0034A10.0657 10.0657 0 0 0 15.0258 24H12a1 1 0 0 0 0 2h8a.957.957 0 0 0 .2009-.0405c.2644.021.5294.0405.7991.0405A10 10 0 0 0 21 6zm1.0876 14.3967a.6464.6464 0 0 0-.46.6267V21.34a.66.66 0 0 1-.66.66h-.1452a.66.66 0 0 1-.66-.66v-.1347a.6563.6563 0 0 0-.5733-.6515 6.558 6.558 0 0 1-1.4378-.3415.6522.6522 0 0 1-.39-.7795l.1112-.4268a.6655.6655 0 0 1 .8883-.4439 5.17 5.17 0 0 0 1.79.3343c.8522 0 1.4352-.3227 1.4352-.9115 0-.5583-.478-.9115-1.5846-1.28-1.6-.53-2.6907-1.2649-2.6907-2.691A2.6162 2.6162 0 0 1 19.7778 11.51a.6791.6791 0 0 0 .4594-.6579V10.66a.66.66 0 0 1 .66-.66h.1453a.66.66 0 0 1 .66.66v.0281a.657.657 0 0 0 .5742.6519 5.6229 5.6229 0 0 1 .9873.2039.6656.6656 0 0 1 .4579.8027l-.0982.3771a.6624.6624 0 0 1-.8586.4523 4.6429 4.6429 0 0 0-1.4811-.2355c-.9719 0-1.2858.4117-1.2858.8243 0 .485.5232.7937 1.7939 1.2639 1.7787.6185 2.4969 1.427 2.4969 2.75A2.7309 2.7309 0 0 1 22.0876 20.3967zM2 12H4a1 1 0 0 0 0-2H2a1 1 0 0 0 0 2z"></path><path d="M9 24H6a1 1 0 0 0 0 2H9a1 1 0 0 0 0-2zM3 24H2a1 1 0 0 0 0 2H3a1 1 0 0 0 0-2z"></path></g></svg>'
        ],
    ];
}
