<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user=User::included()
        ->filter()
        ->sort()
        ->get();
        
        return $user;
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
            
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'tipo_persona_id' => 'required|max:255',  
        ]);


        $user=User::create($request->all());

        return $user;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,$id)
    {
        $user = User::included()->findOrFail($id);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       
        $request->validate([
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'max:255',
            'tipo_persona_id' => 'required|max:255',  
        ]);

       
        $user->update($request->all());

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $user;
    }
}
