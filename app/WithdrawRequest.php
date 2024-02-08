<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WithdrawRequest extends Model
{
	
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_id', 'bank_details_id', 'amount', 'get_amount_via', 'status', 'remark', 'withdraw_id'
    ];

  
}
