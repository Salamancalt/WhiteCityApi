<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel=Hotel::included()
        ->filter()
        ->sort()
        ->get();

        return $hotel;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([

        //     'hotel' => 'required|max:255',
        //     'imagen' => 'required|max:255',
        //     'telefono' => 'required|max:255',
        //     'correo' => 'required|max:255',
        //     'mun_ubicado' => 'required|max:255',
        //     'direccion' => 'required|max:255',
        //     'apertura' => 'required|max:255',
        //     'cierre' => 'required|max:255',
            
        // ]);

        // $hotel=Hotel::create($request->all());

        // return $hotel;
        
        $hotel =$request->all();
        $file = $request->file("imagen");
        $nombreArchivo = "img_" . time() . "." . $file->guessExtension();
        $request->file('imagen')->storeAs('public/image', $nombreArchivo);
        $hotel['imagen'] = "$nombreArchivo";
        Hotel::create($hotel);
        return redirect('http://127.0.0.1:8000/listarhoteles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel,$id)
    {
        $hotel = Hotel::included()->findOrFail($id);
        return $hotel;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'hotel' => 'required|max:255',
            'imagen' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|max:255',
            'mun_ubicado' => 'required|max:255',
            'direccion' => 'required|max:255',
            'apertura' => 'required|max:255',
            'cierre' => 'required|max:255'.$hotel->id,
            
        ]);

        $hotel->update($request->all());

        return $hotel;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return $hotel;
    }
}
