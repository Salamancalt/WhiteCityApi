<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lugarturistico extends Model
{
    use HasFactory;

    protected $fillable=[

      'lugar_turistico',   
       'imagen',
       'detalles',
       'horario_apertura',
       'horario_cierre',
       'municipio',
       'direccion',
       'telefono',
       'correo_electronico',
       'tipo_lugar', 
       'restaurante_id', 
       'hotel_id', 
       'ccomercial_id', 
       'estacion_id', 
       'autoridad_id', 
       'puntosatencion_id',
       'recomendado_id', 
       'rutas__acceso_id',
       'rutas__turistica_id'];

       
    protected $allowIncluded = ['restaurantes', 'hoteles','ccomerciales','estacioneservicio','puntosatencion',
    'autoridades','recomendados','fotografias','eventos','convenios','rutasturistica','rutasacceso']; // Lista con las posibles relaciones que podemos enviar a travez de la URL

    protected $allowFilter = ['id', 'lugar_turistico', 'detalles','municipio'];

    protected $allowSort = ['id', 'lugar_turistico', 'detalles','municipio'];


       public function scopeIncluded(Builder $query)
    {

        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }
        $relations = explode(',', request('included')); //['posts','relation2']
        //return $relations;

        $allowIncluded = collect($this->allowIncluded); //colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']
       // return $allowIncluded;
        foreach ($relations as $key => $relationship) { //recorremos el array de $relations y los guardamos en una variable llamada relationship

            if (!$allowIncluded->contains($relationship)) { // si un elemento de la variable allowIncluded no esta dentro de $relationship 
                unset($relations[$key]);
            }
        } //
        // return $relations;
        $query->with($relations); //se ejecuta el query con lo que tiene $relations y que son los valores permitidos      
    }                                    // por la variable allowIncluded                               
    //////////////////////

    public function scopeFilter(Builder $query)
    {

        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {

                //$query->where($filter, $value);
                $query->where($filter,'LIKE','%'.$value.'%');
            }
        }
    }


    public function scopeSort(Builder $query)
    {

        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',',request('sort')) ;
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            
            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField,'asc');
               }
        }
    }

    

       public function restaurantes() {
        return $this->hasMany('App\Models\Restaurante');
      }

      public function hoteles() {
        return $this->hasMany('App\Models\Hotel');
      }

      public function ccomerciales() {
        return $this->hasMany('App\Models\Ccomercial');
      }

      public function estacioneservicio() {
        return $this->hasMany('App\Models\Estacion');
      }

      public function puntosatencion() {
        return $this->hasMany('App\Models\Puntosatencion');
      }

      public function autoridades() {
        return $this->hasMany('App\Models\Autoridad');
      }
    public function recomendados(){
        return $this->hasMany('App\Models\Recomendado');
   }

   public function fotografias(){
    return $this->hasMany('App\Models\Fotografia');
   }
     
   public function eventos(){
    return $this->hasMany('App\Models\Evento');
   }
   
   public function convenios(){
    return $this->belongsTo('App\Models\Convenio');
}

public function rutasturistica(){
    return $this->hasMany('App\Models\Rutas_Turistica');
   }

public function rutasacceso(){
    return $this->hasMany('App\Models\Rutas_Acceso');
   }
}
