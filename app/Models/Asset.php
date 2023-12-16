<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    public function asset_artisat_details(){
        return $this->belongsTo('App\Models\AssetArtist','id','asset_id');
    }
    public function track_details(){
        return $this->belongsTo('App\Models\Track','id','asset_id');
    }
    public function track_artisat_details(){
        return $this->belongsTo('App\Models\TrackArtist','id','asset_id');
    }
}
