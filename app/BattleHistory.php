<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BattleHistory extends Model
{
	
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'user_id', 'battle_id', 'day', 'month', 'year', 'paying_time', 'match_result', 'another_player_id', 'winning_amount', 'lossing_amount', 'closing_balance', 'remark'
    ];

}
