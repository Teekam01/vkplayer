<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'vplay_id', 'name', 'email', 'mobile', 'image', 'otp', 'is_admin', 'user_type', 'wallet', 'wallet_reffer', 'total_deposite_cash','wallet_winning_cash', 'cash_from', 'referral_code', 'total_win', 'total_lost', 'is_blocked','api_status' ,'balance_update_in_progress'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
