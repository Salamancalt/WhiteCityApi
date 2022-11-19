<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lugarturistico;
use Illuminate\Http\Request;

class LugarturisticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $lugarturistico=Lugarturistico::included()
        ->filter() //filtrar
        ->sort()   //permite buscar o filtrar de forma ascednte de acuerdo con el campo con el que se haga la consulta
        ->get();   //Mostar los datos del archivo Android
        
      return $lugarturistico;
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
            'lugar_turistico' => 'required|max:255',
            'imagen' => 'required|max:255',
            'detalles' => 'required|max:255',
            'horario_apertura' => 'required|max:255',
            'horario_cierre' => 'required|max:255',
            'municipio' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo_electronico' => 'required|max:255',
            'tipo_lugar' => 'required|max:255',
        ]);

        //$lugarturistico=Lugarturistico::create($request->all());

        // return $lugarturistico;

        $lugarturistico =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $lugarturistico['imagen'] = "$nombreArchivo";
        Lugarturistico::create($lugarturistico);
        return redirect('http://127.0.0.1:8000/listarlugares');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lugarturistico  $lugarturistico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    $lugarturistico = Lugarturistico::included()->findOrFail($id);
    
       return $lugarturistico;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lugarturistico  $lugarturistico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lugarturistico $lugarturistico)
    {
        
        // $request->validate([
        //     'lugar_turistico' => 'required|max:255',
        //     'imagen' => 'required|max:255',
        //     'detalles' => 'required|max:255',
        //     'horario_apertura' => 'required|max:255',
        //     'horario_cierre' => 'required|max:255',
        //     'municipio' => 'required|max:255',
        //     'direccion' => 'required|max:255',
        //     'telefono' => 'required|max:255',
        //     'correo_electronico' => 'required|max:255',
        //     'tipo_lugar' => 'required|max:255'.$lugarturistico->id,
       
    
        // ]);

        $lugarturistico->update($request->all());

        return $lugarturistico;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lugarturistico  $lugarturistico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lugarturistico $lugarturistico)
    {
        $lugarturistico->delete();
        return $lugarturistico;
    }
}
