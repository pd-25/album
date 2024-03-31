<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    public function messageDetails()
    {
        return $this->hasMany('App\Models\SupportTicketMessages','support_ticektId','id');
    }

    public function userDetails()
    {
        return $this->belongsTo('App\Models\User','userId', 'id');
    }

}
