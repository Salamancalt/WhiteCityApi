<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vids = Video::all();
        return view('vides.index')->with('vids', $vids); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vids = new Video();
        $vids->id = $request->get('id');
        $vids->titulo= $request->get('titulo');
        $vids->url = $request->get('url');
        $vids->video_descripcion = $request->get('video_descripcion');

        $vids->save();

        return redirect('/vids');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vid = Video::find($id);
        return view('vides.edit')->with('vid', $vid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vid = Video::find( $id);

        $vid->titulo= $request->get('titulo');
        $vid->url = $request->get('url');
        $vid->video_descripcion = $request->get('video_descripcion');

        $vid->save();

        return redirect('/vides');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vid = Video::find( $id);
        $vid->delete();
        return redirect('/vids');
    }
}
