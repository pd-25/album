<?php

namespace App\Http\Controllers\user\artist;

use App\core\artist\ArtistInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ArtistController extends Controller
{

    public $artistInterface;

    public function __construct(ArtistInterface $artistInterface)
    {
        $this->artistInterface = $artistInterface;
    }
    public function editProfile() {
        return view('user.artist.editProfile');
    }

    public function index(){
        $data['artists'] = $this->artistInterface->userWiseArtist(auth()->id());
        return view('user.artist.index', $data);
    }


    public function create(){
        return view('user.artist.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            // 'biography' => 'required|string|max:500',
            // 'spotify_id' => [
            //     'required',
            //     // Rule::custom(function ($value) {
            //     //     // Check if the Spotify ID matches the specified format
            //     //     return preg_match('/^[0-7][0-9a-zA-Z]{21}$/', $value);
            //     // }, 'Invalid Spotify ID. It must start with a number from 0 to 7, followed by 21 characters, which must be either a number or letter from the Latin alphabet.')
            // ],
            // 'apple_id' => 'required|numeric',
            // 'image' => 'nullable|max:2048',
        ]);
        $data = $request->only('name', 'biography', 'spotify_id', 'apple_id', 'image','email');
        $data['password'] = '12345678';
        $data['user_id'] = auth()->id();
        $websiteData = $request->only('webSiteName', 'url');
        $localizationData = $request->only('country', 'artist_name');
        $store = $this->artistInterface->storeArtistData($data, $websiteData, $localizationData);
        if ($store) {
            return redirect()->route('userArtists.index')->with('msg', 'New artist added successfully.');
        } else {
            return back()->with('msg', 'Some error occur.');
        }
    }

    public function edit($id) {
        $data['artist'] = $this->artistInterface->getSingleArtist(decrypt($id));
        // dd($data);
        if ($data['artist'] == 'Not Found') {
            return back()->with('msg', 'No artist found!');
        }
        return view('user.artist.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            // 'biography' => 'required|string|max:500',
            // 'spotify_id' => [
            //     'required',
            //     // Rule::custom(function ($value) {
            //     //     // Check if the Spotify ID matches the specified format
            //     //     return preg_match('/^[0-7][0-9a-zA-Z]{21}$/', $value);
            //     // }, 'Invalid Spotify ID. It must start with a number from 0 to 7, followed by 21 characters, which must be either a number or letter from the Latin alphabet.')
            // ],
            // 'apple_id' => 'required|numeric',
            // 'image' => 'nullable|max:2048',
        ]);
        $data = $request->only('name', 'biography', 'spotify_id', 'apple_id', 'image','email');
        $websiteData = $request->only('webSiteName', 'url');
        $localizationData = $request->only('country', 'artist_name');

        $update = $this->artistInterface->updateArtist($data, decrypt($id),  $websiteData, $localizationData);
        if ($update) {
            return back()->with('msg', 'Artist information updated successfully.');
        } elseif ($update == 'No data') {
            return back()->with('msg', 'No artist found.');
        }
    }

    public function destroy(string $id)
    {
        $delete = $this->artistInterface->deleteArtist(decrypt($id));
        if ($delete) {
            return back()->with('msg', 'Artist has been deleted successfully.');
        } elseif ($delete == 'No data') {
            return back()->with('msg', 'No artwork found.');
        }
    }

    public function GetArtistDetails($userid)
    {
        $user = User::find($userid);
        return response()->json($user);
    }



    public function Artistindex()
    {
        $data = $this->artistInterface->getAllArtist();
        return $data;
    }
}
