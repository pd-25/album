<?php

namespace App\Http\Controllers\user\asset;

use App\core\artist\ArtistInterface;
use App\core\label\LabelInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetController extends Controller
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
        return view('user.relese.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['artists'] = $this->artistInterface->getAllArtist();
        $data['labels'] = $this->labelInterface->getAllLabel();
       return view('user.relese.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $assetData = $request->only('cover_image', 'language', 'release_title', 'title_version', 'is_various_artist','asset_artist_id','has_spotify_asset','has_applemusic_asset','apple_id_ass','genre_one','genre_two','p_copy','c_copy','previously_release','release_date','label_id','internal_release_id','upc_ean_jan');
       $assetData['user_id'] = auth()->id();
       $trackData = $request->only('audio', 'language_t', 'track_title', 'track_title_version', 'has_isrc','isrc_code','explicit_lyrics','original_public','genre_one_track','genre_two_track','p_copy_t','c_copy_t','track_label_id','internal_track_id','lyrics');
       $trackContributor = $request->contritibutor;
       //to start from here
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
