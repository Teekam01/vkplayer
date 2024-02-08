<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permission extends Model
{
	
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
           'user_type', 'players', 'all_players', 'block_players', 'battle', 'new_battle', 'battle_running', 'battle_result', 'kyc', 'pending_kyc', 'approved_kyc', 'payments', 'payment_received', 'recharge_to_user', 'payment_settings', 'withdraw_request', 'admin_settings', 'support', 'games', 'marquee_notification', 'employees_management', 'employees', 'permission'
    ];

  
}
