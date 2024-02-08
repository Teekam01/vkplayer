<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Battle extends Model
{
	
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'game_id', 'battle_id', 'LOBBY_ID', 'amount', 'admin_commision', 'reffer_id', 'reffer_comission', 'creator_id', 'joiner_id', 'creator_result', 'joiner_result', 'entry_fee', 'prize', 'request_status', 'game_status', 'is_running', 'winner_id', 'creator_screenshot', 'joiner_screenshot', 'loser_id', 'creator_cancel_reason', 'joiner_cancel_reason', 'approve', 'label', 'created_at', 'send_request_time', 'accept_request_time', 'creator_result_time', 'joiner_result_time',
    ];

  
}
