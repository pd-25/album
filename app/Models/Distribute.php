<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribute extends Model
{
    use HasFactory;
    public function multistore_details()
    {
        return $this->hasMany('App\Models\StoreArtist','asset_id','asset_id');
    }
}
