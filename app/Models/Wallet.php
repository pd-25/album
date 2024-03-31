<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public function userDetails()
    {
        return $this->belongsTo('App\Models\User','userId', 'id');
    }
}
