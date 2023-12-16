<?php

namespace App\Http\Controllers\user\asset;

use App\core\artist\ArtistInterface;
use App\core\label\LabelInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetArtist;
use App\Models\Track;
use App\Models\TrackArtist;
use Illuminate\Support\Facades\DB;


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
        $userId = auth()->user()->id;
        $Getartist = Asset::where('user_id', $userId)->get();
        return view('user.relese.index', compact('Getartist'));
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
        // dd($request->all());
    //    $assetData = $request->only('cover_image', 'language', 'release_title', 'title_version', 'is_various_artist','asset_artist_id','has_spotify_asset','has_applemusic_asset','apple_id_ass','genre_one','genre_two','p_copy','c_copy','previously_release','release_date','label_id','internal_release_id','upc_ean_jan');
    //    $assetData['user_id'] = auth()->id();
    //    $trackData = $request->only('audio', 'language_t', 'track_title', 'track_title_version', 'has_isrc','isrc_code','explicit_lyrics','original_public','genre_one_track','genre_two_track','p_copy_t','c_copy_t','track_label_id','internal_track_id','lyrics');
    //    $trackContributor = $request->contritibutor;

       //to start from here
       $request->validate([
        // section - 1
            'cover_image' => 'required',
            'language' => 'required',
            'release_title' => 'required',
            'title_version' => 'required',
            'is_various_artist' => 'required',

            'asset_artist_id' => 'required',
            'has_spotify_asset' => 'required',
            'has_applemusic_asset' => 'required',

            'genre_one' => 'required',
            'genre_two' => 'required',
            'p_copy' => 'required',
            'c_copy' => 'required',
            'previously_release' => 'required',
            'label_id' => 'required',
            'internal_release_id' => 'required',
            'upc_ean_jan' => 'required',
            // end section - 1

            'audio' => 'required',
            'language_t623' => 'required',
            'track_title' => 'required',
            'track_title_version' => 'required',

            'contritibutor_track_artist_id' => 'required',
            'contritibutor_has_spotify' => 'required',
            'contritibutor_has_applemusic' => 'required',

            'has_isrc' => 'required',
            'explicit_lyrics' => 'required',
            'original_public' => 'required',
            'genre_one_track' => 'required',
            'genre_two_track' => 'required',
            'p_copy_t' => 'required',
            'c_copy_t' => 'required',
            'track_label_id' => 'required',
            'internal_track_id' => 'required',
            // // end section 2
            'contritibutor_track_artist_name' => 'required',
            'contritibutor_role' => 'required',
            'contritibutor_share' => 'required',
            'contritibutor_publishing' => 'required'

        ]);
        DB::beginTransaction();
        try {
            $asset = new Asset;
            if ($request->hasFile('cover_image')) {
                $image_path = date('Y-m-d-H_i_s').'_' .$request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs($image_path,['disk' => 'public']);
                $asset->cover_image = $image_path;
            }
            $asset->user_id = auth()->user()->id;
            $asset->language = $request->language;
            $asset->release_title = $request->release_title;
            $asset->title_version = $request->title_version;
            $asset->is_various_artist = $request->is_various_artist;
            $asset->genre_one = $request->genre_one;
            $asset->genre_two = $request->genre_two;
            $asset->p_copy = $request->p_copy;
            $asset->c_copy = $request->c_copy;
            $asset->previously_release = $request->previously_release;
            $asset->release_date = $request->release_date;
            $asset->label_id = $request->label_id;
            $asset->internal_release_id = $request->internal_release_id;
            $asset->upc_ean_jan = $request->upc_ean_jan;
            if($asset->save()){
                $assetArtist = new AssetArtist;
                $assetArtist->asset_id = $asset->id;
                $assetArtist->asset_artist_id = $request->asset_artist_id;
                $assetArtist->has_spotify_asset = $request->has_spotify_asset;
                $assetArtist->has_applemusic_asset = $request->has_applemusic_asset;
                $assetArtist->spotify_id_ass = $request->spotify_id_ass;
                $assetArtist->apple_id_ass = $request->apple_id_ass;
                $assetArtist->save();
            }
            $track = new Track;
            $track->asset_id = $asset->id;
            if ($request->hasFile('audio')) {
                $music_file = $request->file('audio');
                $filename = $music_file->getClientOriginalExtension();
                $location = public_path('audio/' . $filename);
                $music_file->move($location,$filename);
                $track->audio = $filename;
            }
            $track->language_t = $request->language_t623;
            $track->track_title_version = $request->track_title;
            $track->title_version = $request->track_title_version;
            $track->has_isrc = $request->has_isrc;
            $track->isrc_code = $request->isrc_code;
            $track->explicit_lyrics = $request->explicit_lyrics;
            $track->original_public = $request->original_public;
            $track->genre_one_track = $request->genre_one_track;
            $track->genre_two_track = $request->genre_two_track;
            $track->p_copy_t = $request->p_copy_t;
            $track->c_copy_t = $request->c_copy_t;
            $track->track_label_id = $request->track_label_id;
            $track->internal_track_id = $request->internal_track_id;
            $track->lyrics = $request->lyrics;
            if($track->save()){
                $trackArtist = new TrackArtist;
                $trackArtist->asset_id = $asset->id;
                $trackArtist->track_id = $track->id;
                $trackArtist->track_artist_id = $request->contritibutor_track_artist_id;
                $trackArtist->has_spotify = $request->contritibutor_has_spotify;
                $trackArtist->has_applemusic = $request->contritibutor_has_applemusic;
                $trackArtist->track_spotify_id = $request->contritibutor_track_spotify_id;
                $trackArtist->track_apple_id = $request->contritibutor_track_apple_id;
                // $trackArtist->track_artist_name = $request->contritibutor_track_artist_name;
                $trackArtist->role = $request->contritibutor_role;
                $trackArtist->share = $request->contritibutor_share;
                $trackArtist->publishing = $request->contritibutor_publishing;
                $trackArtist->save();
            }
            DB::commit();
            return back()->with('success', 'Successfully Saved');
        }catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['artists'] = $this->artistInterface->getAllArtist();
        $data['labels']= $this->labelInterface->getAllLabel();
        $data['allDetails'] = Asset::with('asset_artisat_details', 'track_details', 'track_artisat_details')->find($id);
        return view('user.relese.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $asset = Asset::find($id);
            if ($request->hasFile('cover_image')) {
                $image_path = date('Y-m-d-H_i_s').'_' .$request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs($image_path,['disk' => 'public']);
                $asset->cover_image = $image_path;
            }
            $asset->user_id = auth()->user()->id;
            $asset->language = $request->language;
            $asset->release_title = $request->release_title;
            $asset->title_version = $request->title_version;
            $asset->is_various_artist = $request->is_various_artist;
            $asset->genre_one = $request->genre_one;
            $asset->genre_two = $request->genre_two;
            $asset->p_copy = $request->p_copy;
            $asset->c_copy = $request->c_copy;
            $asset->previously_release = $request->previously_release;
            $asset->release_date = $request->release_date;
            $asset->label_id = $request->label_id;
            $asset->internal_release_id = $request->internal_release_id;
            $asset->upc_ean_jan = $request->upc_ean_jan;
            if($asset->save()){
                $assetArtist = AssetArtist::where('asset_id',$id)->first();
                $assetArtist->asset_artist_id = $request->asset_artist_id;
                $assetArtist->has_spotify_asset = $request->has_spotify_asset;
                $assetArtist->has_applemusic_asset = $request->has_applemusic_asset;
                $assetArtist->spotify_id_ass = $request->spotify_id_ass;
                $assetArtist->apple_id_ass = $request->apple_id_ass;
                $assetArtist->save();
            }
            $track = Track::where('asset_id',$id)->first();
            if ($request->hasFile('audio')) {
                $music_file = $request->file('audio');
                $filename = $music_file->getClientOriginalExtension();
                $location = public_path('audio/' . $filename);
                $music_file->move($location,$filename);
                $track->audio = $filename;
            }
            $track->language_t = $request->language_t623;
            $track->track_title_version = $request->track_title;
            $track->title_version = $request->track_title_version;
            $track->has_isrc = $request->has_isrc;
            $track->isrc_code = $request->isrc_code;
            $track->explicit_lyrics = $request->explicit_lyrics;
            $track->original_public = $request->original_public;
            $track->genre_one_track = $request->genre_one_track;
            $track->genre_two_track = $request->genre_two_track;
            $track->p_copy_t = $request->p_copy_t;
            $track->c_copy_t = $request->c_copy_t;
            $track->track_label_id = $request->track_label_id;
            $track->internal_track_id = $request->internal_track_id;
            $track->lyrics = $request->lyrics;
            if($track->save()){
                $trackArtist = TrackArtist::where('asset_id',$id)->first();
                $trackArtist->track_id = $track->id;
                $trackArtist->track_artist_id = $request->contritibutor_track_artist_id;
                $trackArtist->has_spotify = $request->contritibutor_has_spotify;
                $trackArtist->has_applemusic = $request->contritibutor_has_applemusic;
                $trackArtist->track_spotify_id = $request->contritibutor_track_spotify_id;
                $trackArtist->track_apple_id = $request->contritibutor_track_apple_id;
                // $trackArtist->track_artist_name = $request->contritibutor_track_artist_name;
                $trackArtist->role = $request->contritibutor_role;
                $trackArtist->share = $request->contritibutor_share;
                $trackArtist->publishing = $request->contritibutor_publishing;
                $trackArtist->save();
            }
        return back()->with('success', 'Successfully Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        DB::beginTransaction();
        try {
            $assetId = $request->DeleteId;
            $asset = Asset::find($assetId);
            $assetArtist = AssetArtist::where('asset_id',$assetId)->first();
            $track = Track::where('asset_id',$assetId)->first();
            $trackArtist = TrackArtist::where('asset_id',$assetId)->first();
            $asset->delete();
            $assetArtist->delete();
            $track->delete();
            $trackArtist->delete();
            DB::commit();
            return back()->with('success', 'Successfully Deleted');
        }catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

    }
}
