<?php

namespace App\Http\Controllers\admin\user;

use App\core\artist\ArtistInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $artistInterface;

    public function __construct(ArtistInterface $artistInterface)
    {
        $this->artistInterface = $artistInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['artists'] = $this->artistInterface->getAllUser();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $data = $request->only('name', 'biography','password', 'email');
        $data['type'] = 'user'; 
        $store = $this->artistInterface->storeArtistData($data, $websiteData = [], $localizationData = []);
        if ($store) {
            return redirect()->route('users.index')->with('msg', 'New user added successfully.');
        } else {
            return back()->with('msg', 'Some error occur.');
        }
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
        $data['artist'] = $this->artistInterface->getSingleUser(decrypt($id));
        // dd($data);
        if ($data['artist'] == 'Not Found') {
            return back()->with('msg', 'No artist found!');
        }
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $data = $request->only('name');
        $update = $this->artistInterface->updateArtist($data, decrypt($id));
        if ($update) {
            return back()->with('msg', 'user information updated successfully.');
        } elseif ($update == 'No data') {
            return back()->with('msg', 'No artist found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->artistInterface->deleteArtist(decrypt($id));
        if ($delete) {
            return back()->with('msg', 'User has been deleted successfully with his all artist and artworks .');
        } elseif ($delete == 'No data') {
            return back()->with('msg', 'No artwork found.');
        }
    }
}
