<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserBankDetail extends Model
{
	
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_id', 'upi_account_holder_name', 'upi_id', 'bank_account_holder_name', 'bank_account_number', 'ifsc_code',
    ];

  
}
