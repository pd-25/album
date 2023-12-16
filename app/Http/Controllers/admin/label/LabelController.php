<?php

namespace App\Http\Controllers\admin\label;

use App\core\artist\ArtistInterface;
use App\core\label\LabelInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    private $artistInterface, $labelInterface;

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
        $data['labels']= $this->labelInterface->getAllLabel();
        return view('admin.label.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['users'] = $this->artistInterface->getAllUser();
        return view('admin.label.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'official_name' => 'required|string',
            'email' => 'required|email|unique:labels',
            'description' => 'required|max:1000',
            'number' => 'required|numeric',
            'image' => 'nullable|max:2048',

        ]);

        $labelData = $request->only('official_name','email','description','number','location','image', 'user_id');
        $genreData = $request->only('gener_id');
        $websiteData = $request->only('webSiteName', 'url');
        $store = $this->labelInterface->storeLabel($labelData, $genreData, $websiteData);
        if ($store) {
            return redirect()->route('label.index')->with('msg', 'New Labe added successfully.');
        } else {
            return back()->with('msg', 'Some error occur.');
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
        $data['label']= $this->labelInterface->getSingleLabel(decrypt($id));
        $data['users'] = $this->artistInterface->getAllUser();
        return view('admin.label.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'location' => 'required|string',
            'official_name' => 'required|string',
        
            'description' => 'required|max:1000',
            'number' => 'required|numeric',
            'image' => 'nullable|max:2048',

        ]);

        $labelData = $request->only('official_name','description','number','location','image', 'user_id');
        $genreData = $request->only('gener_id');
        $websiteData = $request->only('webSiteName', 'url');
        $update = $this->labelInterface->updateLabel($labelData, decrypt($id), $genreData, $websiteData);
        if ($update) {
            return back()->with('msg', 'Label information updated successfully.');
        } elseif ($update == 'No data') {
            return back()->with('msg', 'No artist found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->labelInterface->deleteLabel(decrypt($id));
        if ($delete) {
            return back()->with('msg', 'Label has been deleted successfully.');
        } elseif ($delete == 'No data') {
            return back()->with('msg', 'No artwork found.');
        }
    }
}
