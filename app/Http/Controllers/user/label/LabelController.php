<?php

namespace App\Http\Controllers\user\label;

use App\core\artist\ArtistInterface;
use App\core\label\LabelInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Label;

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
        $data['labels']= $this->labelInterface->userWiseLabel(auth()->id());
        return view('user.label.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.label.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'location' => 'required|string',
            'official_name' => 'required|string',
            'email' => 'nullable|email|unique:labels',
            'number' => 'nullable|numeric',
            'image' => 'nullable|max:1400|mimes:jpeg,jpg,png',

        ]);
        $labelData = $request->only('official_name','email','description','number','location','image');
        $labelData['user_id'] = auth()->id();
        $genreData = $request->only('gener_id');
        $websiteData = $request->only('webSiteName', 'url');
        $store = $this->labelInterface->storeLabel($labelData, $genreData, $websiteData);
        if ($store) {
            return redirect()->route('labels.index')->with('msg', 'New Labe added successfully.');
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
        $label = Label::find(decrypt($id));
        return view('user.label.edit', compact('label'));
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
        $delete = $this->labelInterface->deleteLabel(decrypt($id));
        if ($delete) {
            return back()->with('msg', 'Label has been deleted successfully.');
        } elseif ($delete == 'No data') {
            return back()->with('msg', 'No artwork found.');
        }
    }
}
