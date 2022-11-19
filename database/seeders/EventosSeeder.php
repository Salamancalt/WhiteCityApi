<?php

namespace Database\Seeders;

use App\Models\Evento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class EventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evento::factory(10)->create();
            // $events=new Evento();
            // $events->evento='Maiz';
            // $events->municipio='Popayan-cauca';
            // $events->direccion='Cra 39 #17-06';
            // $events->horarios='10:00';
            // $events->fecha_inicio='12/03/20';
            // $events->fecha_fin='12/03/20';
            // $events->descripcion='Tradicion cultural de lugares cercanos a la ciudad de Popayan';
            // $events->tipo_evento='Cultural';
            // $events->user_id=('1');
            // $events->imagen= 'yyyy'; 
            
            // $events->save();
    }
}