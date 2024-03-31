<?php

namespace App\Http\Controllers;

use App\core\artist\ArtistInterface;
use App\core\label\LabelInterface;
use App\Models\OtherKeyArtist;
use Illuminate\Http\Request;

class OtherKeyArtistController extends Controller
{
    public $artistInterface, $labelInterface;
    public function __construct(ArtistInterface $artistInterface, LabelInterface $labelInterface)
    {
        $this->artistInterface = $artistInterface;
        $this->labelInterface = $labelInterface;
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $otherkeyartist = $this->artistInterface->getuserwiseOtherkeyartist(auth()->user()->id); 
        return response()->json($otherkeyartist);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $otherkeyartist = OtherKeyArtist::get(); 
        return response()->json($otherkeyartist);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'other_key_artist_Name'=>'required',
            'OtherKeyArtistRole'=>'required',
        ]);

        $otherKeyArtist = new OtherKeyArtist;
        $otherKeyArtist->user_id = $request->user_id != null ?$request->user_id : auth()->user()->id;
        $otherKeyArtist->other_key_artist_name = $request->other_key_artist_Name;
        $otherKeyArtist->role = $request->OtherKeyArtistRole;
        $otherKeyArtist->other_key_Spotify = $request->otherkey_spotify_id;
        $otherKeyArtist->other_key_Spotify_details = $request->spotify_id_name;
        $otherKeyArtist->other_key_apple_music = $request->otherkey_applemusic_id;
        $otherKeyArtist->other_key_apple_music_details = $request->apple_id_name;
        $otherKeyArtist->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(OtherKeyArtist $otherKeyArtist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OtherKeyArtist $otherKeyArtist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OtherKeyArtist $otherKeyArtist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OtherKeyArtist $otherKeyArtist)
    {
        //
    }
}
