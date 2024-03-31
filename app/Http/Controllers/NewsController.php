<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('news_date', 'desc')->paginate(20);
        return view('admin.news.list', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'news_heading'=>'required',
            'news_date'=>'required',
            'status'=>'required',
        ]);

        if($request->id)
        {
            $news = News::find($request->id);
            $news->news_heading = $request->news_heading;
            $news->news_date = $request->news_date;
            $news->status = $request->status;
            $news->short_description = $request->short_description;
            $news->long_description = $request->long_description;
        }else{
            $news = new News; 
            $news->news_heading = $request->news_heading;
            $news->news_date = $request->news_date;
            $news->status = $request->status;
            $news->short_description = $request->short_description;
            $news->long_description = $request->long_description;
        }
        if($news->save()){
            return back()->with('success', 'Added/update successfully!');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
            $assetId = $request->DeleteId;
            $new = News::find($assetId);
            $new->delete();
            return back()->with('success', 'Successfully Deleted');
    }
}
