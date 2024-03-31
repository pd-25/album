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
        return $this->hasMany('App\Models\Track','asset_id','id');
    }
    public function track_artisat_details(){
        return $this->hasMany('App\Models\TrackArtist','asset_id','id');
    }

    public function label_name(){
        return $this->belongsTo('App\Models\Label','label_id','id');
    }

    public function artist_name(){
        return $this->belongsTo('App\Models\User','artist_id','id');
    }
}
