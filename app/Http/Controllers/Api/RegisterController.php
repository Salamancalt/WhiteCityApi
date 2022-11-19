<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{   
    public function index()
    {
        $users=User::included()
                            ->filter()
                            ->sort()
                            ->get();
      return $users;
    }

    public function store(Request $request) {

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tipo_persona_id' => 'required',
        ]);

        $user = User::create($request->all());

        return response($user,200);
}


public function show( $id)
{
        $user = User::included()->findOrFail($id);
         return $user;
}

public function update(Request $request, User $user)
{
    $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'email' => 'required|max:255|unique',
        'password' => 'max:8',
        'tipo_persona_id' => 'required',
     
    ]);

    $user->update($request->all());

    return $user;
}


public function destroy(User $user)
{
    $user->delete();
    return $user;
}
}
