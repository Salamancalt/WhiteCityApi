<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Estacion extends Model
{
    use HasFactory;

    protected $fillable =[
    'estacion_servicio',
    'imagen', 
    'telefono',
    'correo', 
    'mun_ubicado', 
    'direccion', 
    'apertura', 
    'cierre'
    ];
        
    protected $allowIncluded = ['estaciones', 'Lugarturistico']; // Lista con las posibles relaciones que podemos enviar a travez de la URL
    
    protected $allowFilter = ['id', 'estacion_servicio','telefono', 'mun_ubicado'];

    protected $allowSort = ['id','estacion_servicio', 'telefono', 'mun_ubicado'];

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

    public function Lugarturistico(){
        return $this->hasMany('App\Models\Lugarturistico');
    }
}
