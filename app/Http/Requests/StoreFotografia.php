<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreFotografia extends FormRequest {
    public function authorize(){
     return true;
    }
    public function rules(){
        return ['imagen'=>'required',];
    }
    public function attributes() {
        return [];
    }
        
    public function messages() {
        return ['imagen.required'=>'Debes cargar una imagen',];
    }
}
?>