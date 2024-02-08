<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class OnlineChat extends Model
{
    // If you need to specify a custom table name, you can do so:
    protected $table = 'onlinechats';
    protected $fillable =[ 
        'message'
        ];
    // Define your relationships, fillable attributes, etc. here.
}
    