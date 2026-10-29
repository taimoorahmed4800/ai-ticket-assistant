<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'customer_name',
        'subject',
        'message',
        'category',
        'priority',
        'summary',
        'suggested_reply',
        'ai_status',
    ];
}
