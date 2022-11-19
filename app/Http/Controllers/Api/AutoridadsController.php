<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Autoridad;
use Illuminate\Http\Request;

class AutoridadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autoridad=Autoridad::included()
        ->filter()
        ->sort()
        ->get();
        return $autoridad;
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
            'nombre_entidad' => 'required|max:255',
            'imagen' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|max:255',
            'mun_ubicado' => 'required|max:255',
            'direccion' => 'required|max:255',
            'apertura' => 'required|max:255',
            'cierre' => 'required|max:255',
        ]);

        // $restaurante=Restaurante::create($request->all());

        // return $restaurante;
        $autoridad =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $autoridad['imagen'] = "$nombreArchivo";
        Autoridad::create($autoridad);
        return redirect('http://127.0.0.1:8000/listarautoridades');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
         $autoridad = Autoridad::included()->findOrFail($id);
         return $autoridad;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autoridad $autoridad)
    {
        // $request->validate([
            
        //     'nombre_entidad' => 'required|max:255',
        //     'imagen' => 'required|max:255',
        //     'telefono' => 'required|max:255',
        //     'correo' => 'required|max:255',
        //     'mun_ubicado' => 'required|max:255',
        //     'direccion' => 'required|max:255',
        //     'apertura' => 'required|max:255',
        //     'cierre' => 'required|max:255',
            
        // ]);

        $autoridad =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $autoridad['imagen'] = "$nombreArchivo";
        Autoridad::create($autoridad);
        return redirect('http://127.0.0.1:8000/listarautoridades');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autoridad $autoridad)
    {
        $autoridad->delete();
        return $autoridad;
    }
}
