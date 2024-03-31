<?php

namespace App\Http\Controllers\admin\asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\core\artist\ArtistInterface;
use App\core\label\LabelInterface;
use App\Models\Asset;
use App\Models\AssetArtist;
use App\Models\Track;
use App\Models\User;
use App\Models\TrackArtist;
use App\Models\Roles;
use App\Models\StoreArtist;
use App\Models\Distribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AssetsController extends Controller
{
    public $artistInterface, $labelInterface;
    public function __construct(ArtistInterface $artistInterface, LabelInterface $labelInterface)
    {
        $this->artistInterface = $artistInterface;
        $this->labelInterface = $labelInterface;
        
    }

    public function index()
    {
        $Getartist = Asset::with('artist_name','label_name')->orderBy('id','DESC')->paginate(20);
        return view('admin.relese.index', compact('Getartist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['artists'] = $this->artistInterface->getAllArtist();
        $data['labels'] = $this->labelInterface->getAllLabel(); 
        $data['stores'] = $this->artistInterface->getAllStore(); 
        $data['users'] = User::where('type', 'user')->orderBy('name', 'DESC')->get();
        $data['otherkeyartist'] = $this->artistInterface->getAllOtherkeyartist(); 
        $data['roles'] = Roles::get();
       return view('admin.relese.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        ]);
        
        DB::beginTransaction();
        try {
            
            $asset = new Asset;
            if ($request->hasFile('cover_image')) {
                $image_path = date('Y-m-d-H_i_s').'_' .$request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs($image_path,['disk' => 'public']);
                $asset->cover_image = $image_path;
            }
            $asset->user_id = $request->userId;
            $asset->artist_id = $request->asset_artist_id;
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
            $asset->other_key_artist_list = $request->other_key_artist_list;
            $asset->status = 0;
            if($asset->save()){
                $assetArtist = new AssetArtist;
                $assetArtist->asset_id = $asset->id;
                $assetArtist->asset_artist_id = $request->asset_artist_id;
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
                $track->track_artist_id = $tra->track_artist_id;
                $track->other_key_artist_list_track = implode(" ",$tra->other_key_artist_list_track);
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

            $Publishing = json_decode($request->Publishing);
            foreach($Publishing as $index=>$pub){
                $trackArtist = new TrackArtist;
                $trackArtist->asset_id = $asset->id;
                $trackArtist->track_artist_name = $pub->contritibutor_track_artist_name;
                $trackArtist->role = $pub->contritibutor_role;
                $trackArtist->share = $pub->contritibutor_share;
                $trackArtist->publishing = $pub->contritibutor_publishing;
                $trackArtist->publisher_name = $pub->publisher_name;
                $trackArtist->save();
            }
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
        $data['users'] = User::where('type', 'user')->orderBy('name', 'DESC')->get();
        $data['stores'] = $this->artistInterface->getAllStore(); 
        $data['otherkeyartist'] = $this->artistInterface->getAllOtherkeyartist(); 
        $data['roles'] = Roles::get();
        $data['allDetails'] = Asset::with('asset_artisat_details', 'track_details', 'track_artisat_details')->find($id);
        return view('admin.relese.edit', $data);
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
        $asset->user_id = $request->userId;
        $asset->language = $request->language;
        $asset->release_title = $request->release_title;
        $asset->title_version = $request->title_version;
        $asset->is_various_artist = $request->is_various_artist;
        $asset->genre_one = $request->genre_one;
        $asset->genre_two = $request->genre_two;
        $asset->p_copy = $request->p_copy;
        $asset->c_copy = $request->c_copy;
        $asset->previously_release = $request->previously_release;
        $asset->release_date = $request->release_date != NULL ? $request->release_date : NULL;
        $asset->label_id = $request->label_id;
        $asset->internal_release_id = $request->internal_release_id;
        $asset->upc_ean_jan = $request->upc_ean_jan != NULL ? $request->upc_ean_jan : NULL;
        $asset->other_key_artist_list = ($request->other_key_artist_list);

        if($asset->save()){
            $assetArtist = AssetArtist::find($request->HiddenAssetDetailsId);
            $assetArtist->asset_id = $asset->id;
            $assetArtist->asset_artist_id = $request->asset_artist_id;
            $assetArtist->save();
        }
        
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
            $trackArtist = TrackArtist::where('asset_id',$assetId)->get();
            $distribute = Distribute::where('asset_id',$assetId)->get();
            $storeArtist = StoreArtist::where('asset_id',$assetId)->get();

            $asset->delete();
            $assetArtist->delete();
            $track->each->delete();
            $trackArtist->each->delete();
            $distribute->each->delete();
            $storeArtist->each->delete();
            DB::commit();
            return back()->with('success', 'Successfully Deleted');
        }catch (\Throwable $e) {
            DB::rollback();
            return back()->with('errorMessage', 'Something went wrong');
            throw $e;
        }
    }

    public function status(Request $request)
    {
        $asset = Asset::find($request->id);
        $asset->status = $request->status;
        if($request->status == 1){
            $mytime = Carbon::now();
            $asset->relese_date = $mytime;
        }else{
            $asset->relese_date = null;
        }
        if($asset->save()){
            return response()->json('success');
        }else{
            return  response()->json('error');
        }
    }

    public function Updatetracks(Request $request)
    {
        $allFiles = $request->file('audio');
        $tracksRequest = json_decode($request->tracks);
        $track = Track::find($tracksRequest->id);
        if ($request->hasFile('audio')) {
            $AUDIO = date('Y-m-d-H_i_s').'_' .$allFiles[0]->getClientOriginalName();
            $allFiles[0]->storeAs($AUDIO,['disk' => 'public']);
            $track->audio = $AUDIO;
        }
        $track->asset_id = $tracksRequest->asset_id;
        $track->language_t = $tracksRequest->language_t;
        $track->track_title_version = $tracksRequest->track_title_version;
        $track->title_version = $tracksRequest->title_version;
        $track->track_artist_id = $tracksRequest->track_artist_id;
        $track->other_key_artist_list_track = implode(" ",$tracksRequest->other_key_artist_list_track);
        $track->has_isrc = $tracksRequest->has_isrc;
        $track->isrc_code = $tracksRequest->isrc_code;
        $track->explicit_lyrics = $tracksRequest->explicit_lyrics;
        $track->original_public = $tracksRequest->original_public;
        $track->genre_one_track = $tracksRequest->genre_one_track;
        $track->genre_two_track = $tracksRequest->genre_two_track;
        $track->p_copy_t = $tracksRequest->p_copy_t;
        $track->c_copy_t = $tracksRequest->c_copy_t;
        $track->track_label_id = $tracksRequest->track_label_id;
        $track->internal_track_id = $tracksRequest->internal_track_id;
        $track->lyrics = $tracksRequest->lyrics;
        $track->save();
    }
    public function addNewtracks(Request $request)
    {
        $allFiles = $request->file('audio');
        $tracksRequest = json_decode($request->tracks);
        $track = new Track;
        if ($request->hasFile('audio')) {
            $AUDIO = date('Y-m-d-H_i_s').'_' .$allFiles[0]->getClientOriginalName();
            $allFiles[0]->storeAs($AUDIO,['disk' => 'public']);
            $track->audio = $AUDIO;
        }
        $track->asset_id = $request->asset_id;
        $track->language_t = $tracksRequest->language_t;
        $track->track_title_version = $tracksRequest->track_title_version;
        $track->title_version = $tracksRequest->title_version;
        $track->track_artist_id = $tracksRequest->track_artist_id;
        $track->other_key_artist_list_track = implode(" ",$tracksRequest->other_key_artist_list_track);
        $track->has_isrc = $tracksRequest->has_isrc;
        $track->isrc_code = $tracksRequest->isrc_code;
        $track->explicit_lyrics = $tracksRequest->explicit_lyrics;
        $track->original_public = $tracksRequest->original_public;
        $track->genre_one_track = $tracksRequest->genre_one_track;
        $track->genre_two_track = $tracksRequest->genre_two_track;
        $track->p_copy_t = $tracksRequest->p_copy_t;
        $track->c_copy_t = $tracksRequest->c_copy_t;
        $track->track_label_id = $tracksRequest->track_label_id;
        $track->internal_track_id = $tracksRequest->internal_track_id;
        $track->lyrics = $tracksRequest->lyrics;
        $track->save();
    }
    public function deletetrack(Request $request)
    {
        $track = Track::find($request->trackid);
        $track->delete();
    }

    public function addNewpublishing(Request $request)
    {
        $Publishing = json_decode($request->Publishing);
        $trackArtist = new TrackArtist;
        $trackArtist->asset_id = $request->asset_id;
        $trackArtist->track_artist_name = $Publishing->contritibutor_track_artist_name;
        $trackArtist->role = $Publishing->contritibutor_role;
        $trackArtist->share = $Publishing->contritibutor_share;
        $trackArtist->publishing = $Publishing->contritibutor_publishing;
        $trackArtist->publisher_name = $Publishing->publisher_name;
        $trackArtist->save();
    }

    public function Updatepublishing(Request $request)
    {
        $Publishing = json_decode($request->Publishing);
        $trackArtist = TrackArtist::find($Publishing->id);
        $trackArtist->asset_id = $request->asset_id;
        $trackArtist->track_artist_name = $Publishing->contritibutor_track_artist_name;
        $trackArtist->role = $Publishing->contritibutor_role;
        $trackArtist->share = $Publishing->contritibutor_share;
        $trackArtist->publishing = $Publishing->contritibutor_publishing;
        $trackArtist->publisher_name = $Publishing->publisher_name;
        $trackArtist->save();
    }

    public function deletepublishing(Request $request)
    {
        $trackArtist = TrackArtist::find($request->Publishing);
        $trackArtist->delete();
    }
}
