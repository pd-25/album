<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store = Store::orderBy('label_name', 'ASC')->paginate(20);
        return view('admin.store.list', compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.store.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->id){
            $store = Store::find($request->id);
            $store->label_name = $request->label_name;
            if ($request->hasFile('cover_image')) {
                $image_path = date('Y-m-d-H_i_s').'_' .$request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('store', $image_path,['disk' => 'public']);
                $store->cover_image = $image_path;
            }
            $store->status = $request->status == 1 ? true : false;
            if($store->save())
            {
                return back()->with('success', 'Store update successfully!');
            }else{
                return back()->with('errorMessage', 'Opps! Something went wrong');

            }
        }else{
            $request->validate([
                'label_name'=>'required',
                'cover_image'=>'required',
            ]);
    
            $store = new Store;
            $store->label_name = $request->label_name;
            if ($request->hasFile('cover_image')) {
                $image_path = date('Y-m-d-H_i_s').'_' .$request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('store', $image_path,['disk' => 'public']);
                $store->cover_image = $image_path;
            }
            $store->status = 1;
            if($store->save())
            {
                return back()->with('success', 'Store added successfully!');
            }else{
                return back()->with('errorMessage', 'Opps! Something went wrong');
    
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return view('admin.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $assetId = $request->DeleteId;
        $store = Store::find($assetId);
        $store->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
