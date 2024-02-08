<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Withdrawal extends Model
{
	
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'beneId', 'name', 'email', 'phone', 'bankAccount', 'ifsc', 'address1', 'city', 'state', 'pincode', 'transferId', 'amount', 'upi_vpa', 'status', 'method',
    ];

  
}
