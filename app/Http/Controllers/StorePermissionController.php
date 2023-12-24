<?php

namespace App\Http\Controllers;

use App\Models\StorePermission;
use App\Models\User;
use Illuminate\Http\Request;

class StorePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::get();
        return view('admin.storepermission.list', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $storePermission = StorePermission::select('user_id')->get();
        return response()->json($storePermission);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storePermis = StorePermission::where('user_id', $request->Checkbox)->first();
        if($storePermis){
            $storePermis->delete();
            return response()->json("Deleted successfully");
        }
        $storePermission = new StorePermission;
        $storePermission->user_id = $request->Checkbox;
        $storePermission->save();
        return response()->json("Added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(StorePermission $storePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StorePermission $storePermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StorePermission $storePermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StorePermission $storePermission)
    {
        //
    }
}
