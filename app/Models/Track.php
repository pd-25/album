<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;
    protected $fillable =['asset_id', 'audio', 'language_t', 'track_title_version', 'title_version',
    'track_artist_id', 'has_isrc', 'isrc_code', 'explicit_lyrics', 'original_public', 'genre_one_track', 
    'genre_two_track', 'p_copy_t', 'c_copy_t', 'track_label_id', 'internal_track_id', 'lyrics', 'other_key_artist_list_track'];
}
