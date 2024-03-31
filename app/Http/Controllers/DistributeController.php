<?php

namespace App\Http\Controllers;
use App\core\artist\ArtistInterface;
use App\core\label\LabelInterface;
use App\Models\Distribute;
use App\Models\Asset;
use App\Models\Store;
use App\Models\StoreArtist;
use Illuminate\Http\Request;

class DistributeController extends Controller
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
    public function index($id)
    {
        $data['Getartist'] = Asset::with('artist_name','label_name')->where('id', $id)->first();
        $data['Distribution'] = Distribute::with('multistore_details')->where('asset_id',$id)->first();
        // dd($data['Distribution']);
        if($data['Distribution']){
            $finalStoreDetails = array();
            foreach ($data['Distribution']->multistore_details as $key => $value) {
                $Store = Store::find($value->store_id);
                $test['label_name']= $Store->label_name;
                $test['cover_image']= $Store->cover_image;
                $test['created_at']= $value->created_at;
                $test['delivered_on']= $value->delivered_on;
                $test['asset_id']= $value->asset_id;
                $test['store_id']= $value->store_id;
                array_push($finalStoreDetails, $test);
            }
            $data['finalStoreDetails'] = $finalStoreDetails;
        }
        // dd($finalStoreDetails);
        $data['stores'] = $this->artistInterface->getAllStore();
        return view('user.distribute.index', $data);
    }

    public function Adminindex($id)
    {
        $data['Getartist'] = Asset::with('artist_name','label_name')->where('id', $id)->first();
        $data['Distribution'] = Distribute::with('multistore_details')->where('asset_id',$id)->first();
        // dd($data['Distribution']);
        if($data['Distribution']){
            $finalStoreDetails = array();
            foreach ($data['Distribution']->multistore_details as $key => $value) {
                $Store = Store::find($value->store_id);
                $test['id']= $value->id;
                $test['label_name']= $Store->label_name;
                $test['cover_image']= $Store->cover_image;
                $test['created_at']= $value->created_at;
                $test['delivered_on']= $value->delivered_on;
                $test['asset_id']= $value->asset_id;
                $test['store_id']= $value->store_id;
                array_push($finalStoreDetails, $test);
            }
            $data['finalStoreDetails'] = $finalStoreDetails;
        }
        // dd($finalStoreDetails);
        $data['stores'] = $this->artistInterface->getAllStore();
        return view('admin.distribute.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['stores'] = $this->artistInterface->getAllStore();
        return view('user.distribute.create', $data);
    }

    public function Admincreate()
    {
        $data['stores'] = $this->artistInterface->getAllStore();
        return view('admin.distribute.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->music_distribution);
        $request->validate([
            'release_start'=>'required',
        ]);
        $distribute = new Distribute;
        $distribute->asset_id = $request->asset_id;
        $distribute->release_start = $request->release_start;
        $distribute->release_start_date = $request->release_start_date;
        $distribute->monetization_facebook = $request->monetization_facebook;
        $distribute->facebook_policy = $request->facebook_policy;
        $distribute->monetization_youTube = $request->monetization_youTube;
        $distribute->youTube_policy = $request->youTube_policy;
        $distribute->save();

        foreach ($request->music_distribution as $key => $value) {
            $storeArtist = new StoreArtist;
            $storeArtist->asset_id = $request->asset_id;
            $storeArtist->store_id = $value;
            $storeArtist->save();
        }
        return back()->with('msg', 'Distribute details send successfully');
    }
    
    public function Adminstore(Request $request)
    {
        // dd($request->music_distribution);
        $request->validate([
            'release_start'=>'required',
        ]);
        $distribute = new Distribute;
        $distribute->asset_id = $request->asset_id;
        $distribute->release_start = $request->release_start;
        $distribute->release_start_date = $request->release_start_date;
        $distribute->monetization_facebook = $request->monetization_facebook;
        $distribute->facebook_policy = $request->facebook_policy;
        $distribute->monetization_youTube = $request->monetization_youTube;
        $distribute->youTube_policy = $request->youTube_policy;
        $distribute->save();

        foreach ($request->music_distribution as $key => $value) {
            $storeArtist = new StoreArtist;
            $storeArtist->asset_id = $request->asset_id;
            $storeArtist->store_id = $value;
            $storeArtist->delivered_on = 0;
            $storeArtist->save();
        }
        return back()->with('msg', 'Distribute details send successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Distribute $distribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distribute $distribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distribute $distribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distribute $distribute)
    {
        //
    }

    public function AdminDelivered(Request $request)
    {
        $distribute = StoreArtist::find($request->id);
        $distribute->delivered_on = $request->delivered_on;
        $distribute->save();
        return back()->with('msg', 'Distribute delivery date send successfully');
    }
}
