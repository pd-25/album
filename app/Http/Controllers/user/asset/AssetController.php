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
use Illuminate\Support\Carbon;


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
        $Getartist = Asset::where('user_id', $userId)->orderBy('id','DESC')->paginate(20);
        return view('user.relese.index', compact('Getartist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['artists'] = $this->artistInterface->getAllArtist();
        $data['labels'] = $this->labelInterface->getAllLabel();
        $data['stores'] = $this->artistInterface->getAllStore(); 
       return view('user.relese.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //to start from here
       $request->validate([
        // section - 1
            'cover_image' => ['required', 'mimes:jpg,png,jpeg,gif', 'dimensions:min_width=1400,min_height=1400,max_width=3000,max_height=3000','min:50','max:10000'],
            'language' => 'required',
            'release_title' => 'required',
            'is_various_artist' => 'required',
            'genre_one' => 'required',
            'p_copy' => 'required',
            'c_copy' => 'required',
            'previously_release' => 'required',
            'label_id' => 'required',
            'internal_release_id' => 'required|unique:assets,internal_release_id',

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
            $asset->release_date = $request->release_date != null ? $request->release_date: NULL;
            $asset->label_id = $request->label_id;
            $asset->internal_release_id = $request->internal_release_id;
            $asset->upc_ean_jan = $request->upc_ean_jan;
            $asset->status = 0;
            if($asset->save()){
                $assetArtist = new AssetArtist;
                $assetArtist->asset_id = $asset->id;
                $assetArtist->asset_artist_id = $request->asset_artist_id;
                $assetArtist->has_spotify_asset = $request->has_spotify_asset;
                $assetArtist->has_applemusic_asset = $request->has_applemusic_asset;
                $assetArtist->spotify_id_ass = $request->spotify_id_ass != null ? $request->spotify_id_ass : null;
                $assetArtist->apple_id_ass = $request->apple_id_ass != null ? $request->apple_id_ass : null;
                $assetArtist->save();
            }

            $allFiles = $request->file('audio');
            $tracks = json_decode($request->tracks);
            foreach($tracks as $index=>$tra){
                $track = new Track;
                if ($request->hasFile('audio')) {
                    $AUDIO = date('Y-m-d-H_i_s').'_' .$allFiles[$index]->getClientOriginalName();
                    $allFiles[$index]->storeAs($AUDIO,['disk' => 'public']);
                    $track->audio = $AUDIO;
                }
                $track->asset_id = $asset->id;
                $track->language_t = $tra->language_t;
                $track->track_title_version = $tra->track_title_version;
                $track->title_version = $tra->title_version;
                $track->track_artist_id = json_encode($tra->track_artist_id);
                $track->has_isrc = $tra->has_isrc;
                $track->isrc_code = $tra->isrc_code;
                $track->explicit_lyrics = $tra->explicit_lyrics;
                $track->original_public = $tra->original_public;
                $track->genre_one_track = $tra->genre_one_track;
                $track->genre_two_track = $tra->genre_two_track;
                $track->p_copy_t = $tra->p_copy_t;
                $track->c_copy_t = $tra->c_copy_t;
                $track->track_label_id = $tra->track_label_id;
                $track->internal_track_id = $tra->internal_track_id;
                $track->lyrics = $tra->lyrics;
                $track->save();
            }
                $trackArtist = new TrackArtist;
                $trackArtist->asset_id = $asset->id;
                $trackArtist->track_artist_name = $request->contritibutor_track_artist_name;
                $trackArtist->role = $request->contritibutor_role;
                $trackArtist->share = $request->contritibutor_share;
                $trackArtist->publishing = $request->contritibutor_publishing;
                $trackArtist->store = $request->CheckStore;
                $trackArtist->save();
            DB::commit();
            return $asset->id;
        }catch (\Throwable $e) {
            DB::rollback();
            throw $e;
            return back()->with('errorMessage', 'Something went wrong');
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
        $data['stores'] = $this->artistInterface->getAllStore(); 
        $data['allDetails'] = Asset::with('asset_artisat_details', 'track_details', 'track_artisat_details')->find($id);
        return view('user.relese.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $asset = Asset::find($request->HiddenAssetId);
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
            $asset->release_date = $request->release_date != null ? $request->release_date: NULL;
            $asset->label_id = $request->label_id;
            // $asset->internal_release_id = $request->internal_release_id;
            $asset->upc_ean_jan = $request->upc_ean_jan;
            // $asset->status = 0;
            if($asset->save()){
                $assetArtist = AssetArtist::find($request->HiddenAssetDetailsId);
                // $assetArtist->asset_id = $asset->id;
                $assetArtist->asset_artist_id = $request->asset_artist_id;
                $assetArtist->has_spotify_asset = $request->has_spotify_asset;
                $assetArtist->has_applemusic_asset = $request->has_applemusic_asset;
                $assetArtist->spotify_id_ass = $request->spotify_id_ass != null ? $request->spotify_id_ass : null;
                $assetArtist->apple_id_ass = $request->apple_id_ass != null ? $request->apple_id_ass : null;
                $assetArtist->save();
            }
            $allFiles = $request->file('audio');
            $tracks = json_decode($request->tracks);
            foreach($tracks as $index=>$tra){
                $track = Track::find(json_decode($request->HiddenTrackId)[$index]);
                if ($request->hasFile('audio')) {
                    $AUDIO = date('Y-m-d-H_i_s').'_' .$allFiles[$index]->getClientOriginalName();
                    $allFiles[$index]->storeAs($AUDIO,['disk' => 'public']);
                    $track->audio = $AUDIO;
                }
                // $track->asset_id = $asset->id;
                $track->language_t = $tra->language_t;
                $track->track_title_version = $tra->track_title_version;
                $track->title_version = $tra->title_version;
                $track->track_artist_id = json_encode($tra->track_artist_id);
                $track->has_isrc = $tra->has_isrc;
                $track->isrc_code = $tra->isrc_code;
                $track->explicit_lyrics = $tra->explicit_lyrics;
                $track->original_public = $tra->original_public;
                $track->genre_one_track = $tra->genre_one_track;
                $track->genre_two_track = $tra->genre_two_track;
                $track->p_copy_t = $tra->p_copy_t;
                $track->c_copy_t = $tra->c_copy_t;
                $track->track_label_id = $tra->track_label_id;
                // $track->internal_track_id = $tra->internal_track_id;
                $track->lyrics = $tra->lyrics;
                $track->save();
            }
                $trackArtist = TrackArtist::find($request->HiddenTrackDetailsId);
                // $trackArtist->asset_id = $asset->id;
                $trackArtist->track_artist_name = $request->contritibutor_track_artist_name;
                $trackArtist->role = $request->contritibutor_role;
                $trackArtist->share = $request->contritibutor_share;
                $trackArtist->publishing = $request->contritibutor_publishing;
                $trackArtist->store = $request->CheckStore;
                $trackArtist->save();
        
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
            $track = Track::where('asset_id',$assetId)->get();
            $trackArtist = TrackArtist::where('asset_id',$assetId)->first();
            $asset->delete();
            $assetArtist->delete();
            $track->each->delete();
            $trackArtist->delete();
            DB::commit();
            return back()->with('success', 'Successfully Deleted');
        }catch (\Throwable $e) {
            DB::rollback();
            return back()->with('errorMessage', 'Something went wrong');
            throw $e;
        }

    }
}
