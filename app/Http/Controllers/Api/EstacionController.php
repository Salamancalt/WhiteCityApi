<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estacion;
use Illuminate\Http\Request;

class EstacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $estacion=Estacion::included()
        ->filter()
        ->sort()
        ->get();

        return $estacion;
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

            'estacion_servicio' => 'required|max:255',
            'imagen' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|max:255',
            'mun_ubicado' => 'required|max:255',
            'direccion' => 'required|max:255',
            'apertura' => 'required|max:255',
            'cierre' => 'required|max:255',
           
        ]);

        // $estacion=Estacion::create($request->all());

        // return $estacion;
        $estacion =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $estacion['imagen'] = "$nombreArchivo";
        Estacion::create($estacion);
        return redirect('http://127.0.0.1:8000/listarestacioneservicio');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $estacion = Estacion::included()->findOrFail($id);
         return $estacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estacion $estacion)
    {
        $request->validate([

            'estacion_servicio' => 'required|max:255',
            'imagen' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|max:255',
            'mun_ubicado' => 'required|max:255',
            'direccion' => 'required|max:255',
            'apertura' => 'required|max:255',
            'cierre' => 'required|max:255'.$estacion->id,
    
        ]);

        $estacion->update($request->all());
        // $fotografia =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $estacion['imagen'] = "$nombreArchivo";
        // Fotografia::create($fotografia);
        $estacion->save();
        return redirect('http://127.0.0.1:8000/listarestacioneservicio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estacion $estacion)
    {
       
        $estacion->delete();
        return $estacion;
    }
}
