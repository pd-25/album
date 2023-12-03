<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = ['official_name','email','description','number','location','image', 'user_id'];

    public function websitelabels() {
        return $this->hasMany(Website::class, 'user_or_label_id', 'id');
    }

    public function genress() {
        return $this->hasMany(Genres::class, 'label_id', 'id');
    }
}
