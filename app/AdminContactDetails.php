<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminContactDetails extends Model
{
    use HasFactory;
    protected $table = 'admin_contact_details';
    protected $fillable = [
        'whatsapp_number',
        'telegram',
        'instagram',
        'email',
        'calling_number',
        'youtube_link',
        'home_page_notice',
    ];
}
