<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RefferalHistory extends Model
{
	
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'battle_id', 'by_user_id', 'day', 'month', 'year', 'refferal_id', 'amount', 'closing_balance', 'remark',
    ];

  
}
