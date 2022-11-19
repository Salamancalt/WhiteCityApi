<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificacion=Notificacion::included()
        ->filter()
        ->sort()
        ->get();

        return $notificacion;
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
          'apectos_clave' => 'required|max:255',
            
        ]);

        $notificacion=Notificacion::create($request->all());

        return $notificacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Notificacion $notificacion,$id)
    {
        $notificacion = Notificacion::included()->findOrFail($id);

        return $notificacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        $request->validate([
            
            'nombre' => 'required|max:255',
            'apectos_clave' => 'required|max:255',
              
          ]);
  
          $notificacion->update($request->all());

        return $notificacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacion $notificacion)
    {
        $notificacion->delete();
        return $notificacion;
    }
}
