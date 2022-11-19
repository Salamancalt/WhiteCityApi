<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFotografia;
use App\Models\Fotografia;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class FotografiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotografia=Fotografia::included()
        ->filter()
        ->sort()
        ->get();
  
        return $fotografia;
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

            'imagen' => 'required|max:255',
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);

        // $fotografia=Fotografia::create($request->all());

        $fotografia =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $fotografia['imagen'] = "$nombreArchivo";
        Fotografia::create($fotografia);
        return redirect('http://127.0.0.1:8000/listarfotografias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fotografia  $fotografia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fotografia = Fotografia::included()->findOrFail($id);
        return $fotografia;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fotografia  $fotografia
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFotografia $request, Fotografia $fotografia)
    {

        // $request->validate([
        //     'imagen.required' => 'Debe cargar una iagen',
        //     'nombre' => 'required|max:255',
        //     'descripcion' => 'required|max:255'.$fotografia->id,
        // ]);
        
     $fotografia->update($request->all());
        // $fotografia =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $fotografia['imagen'] = "$nombreArchivo";
        // Fotografia::create($fotografia);
        $fotografia->save();
        return redirect('http://127.0.0.1:8000/listarfotografias');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fotografia  $fotografia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fotografia $fotografia)
    {
        $fotografia->delete();
        return $fotografia;
    }
}
