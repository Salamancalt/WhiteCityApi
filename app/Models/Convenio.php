<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Convenio extends Model
{
    use HasFactory;

    protected $fillable=[
        'fecha_firma',	
        'fecha_finalizacion', 
        'observaciones', 
        'tipo__convenio_id',	
        'user_id'
    ];
    protected $allowIncluded=['eventos', 'tipoconvenio', 'user'];
    protected $allowFilter = ['id', 'fecha_firma', 'observaciones'];
    protected $allowSort = ['id', 'fecha_firma', 'observaciones'];

    
   /////////////////////////////////////////////////////////////////////////////
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
    public function eventos(){
        return $this->hasMany('App\Models\Evento');
    }

   public function tipoconvenio(){
    return $this->hasOne('App\Models\Tipo_Convenio');
   }

   public function user(){
    return $this->hasOne('App\Models\User');
}
}
