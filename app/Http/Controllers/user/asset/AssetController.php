<?php

namespace App\Http\Controllers\user\asset;

use App\core\artist\ArtistInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public $artistInterface;
    public function __construct(ArtistInterface $artistInterface)
    {
        $this->artistInterface = $artistInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['artists'] = $this->artistInterface->getAllArtist();
       return view('user.relese.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
