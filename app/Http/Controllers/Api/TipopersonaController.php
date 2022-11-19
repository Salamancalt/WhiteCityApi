<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tipo_persona;
use Illuminate\Http\Request;

class TipopersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipopersona=Tipo_persona::included()
        ->filter()
        ->sort()
        ->get();
        return $tipopersona;
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
            'nombre' => 'required|max:255',
            
        ]);

        $tipopersona=Tipo_persona::create($request->all());

        return $tipopersona;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipopersona  $tipopersona
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_persona $tipopersona,$id)
    {

        $tipopersona = Tipo_persona::included()->findOrFail($id);
        return $tipopersona;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipopersona  $tipopersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo_persona $tipopersona)
    {
        $request->validate([
            'nombre' => 'required|max:255'.$tipopersona->id,
            
        ]);

        $tipopersona->update($request->all());

        return $tipopersona;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipopersona  $tipopersona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_persona $tipopersona)
    {
        $tipopersona->delete();
        return $tipopersona;
    }
}
