<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Convenio;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenio=Convenio::included()
        ->filter()
        ->sort()
        ->get();
        
        return $convenio;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'fecha_firma' => 'required|max:255',
            'fecha_finalizacion' => 'required|max:255',
            'observaciones' => 'required|max:255',
            'tipo__convenio_id' => 'required',
            'user_id' => 'required',
        ]);

        $convenio=Convenio::create($request->all());

        return $convenio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function show(Convenio $convenio,$id)
    {
        $convenio = Convenio::included()->findOrFail($id);
        return $convenio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Convenio $convenio)
    {
        
        $request->validate([
            'fecha_firma' => 'required|max:255',
            'fecha_finalizacion' => 'required|max:255',
            'observaciones' => 'required|max:255'.$convenio->id,
            'tipo__convenio_id'=> 'required',
            'user_id'=> 'required',
    
        ]);

        $convenio->update($request->all());

        return $convenio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convenio $convenio)
    {
        $convenio->delete();
        return $convenio;
    }
}
