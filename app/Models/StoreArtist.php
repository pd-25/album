<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreArtist extends Model
{
    use HasFactory;
    protected $table = 'storeartist';

    public function store_details()
    {
        return $this->hasMany('App\Models\Store','store_id','id');
    }
}
