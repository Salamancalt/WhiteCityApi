<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Puntosatencion;
use Illuminate\Http\Request;

class PuntosatencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puntosatencion=Puntosatencion::included()
        ->filter()
        ->sort()
        ->get();
        return $puntosatencion;
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
            'nombre_puntoatencion' => 'required|max:255',
            'imagen' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|max:255',
            'mun_ubicado' => 'required|max:255',
            'direccion' => 'required|max:255',
            'apertura' => 'required|max:255',
            'cierre' => 'required|max:255',
        ]);

        // $punto=Puntosatencion::create($request->all());

        // return $punto;

        $puntosatencion =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $puntosatencion['imagen'] = "$nombreArchivo";
        Puntosatencion::create($puntosatencion);
        return redirect('http://127.0.0.1:8000/listarpuntosatencion');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puntosatencion  $puntosatencion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $puntosatencion = Puntosatencion::included()->findOrFail($id);
        return $puntosatencion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puntosatencion  $puntosatencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puntosatencion $puntosatencion)
    {
        // $request->validate([
        //     'mombre_puntoatencion' => 'required|max:255',
        //     'imagen' => 'required|max:255',
        //     'telefono' => 'required|max:255',
        //     'correo' => 'required|max:255',
        //     'mun_ubicado' => 'required|max:255',
        //     'direccion' => 'required|max:255',
        //     'apertura' => 'required|max:255',
        //     'cierre' => 'required|max:255'.$puntosatencion->id,
            
        // ]);

        $puntosatencion->update($request->all());

        return $puntosatencion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puntosatencion  $puntosatencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puntosatencion $puntosatencion)
    {
        $puntosatencion->delete();
        return $puntosatencion;
    }
}
