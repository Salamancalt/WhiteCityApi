<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Fotografia;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        // \App\Models\User::factory(10)->create();
              
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(tipo_personaSeeder::class);
        //$this->call(Rutas_TuristicasSeeder::class);
       // $this->call(RutasaccesoSeeder::class);
        $user=new User;
            $user->nombres ='Tatiana';
            $user-> apellidos = 'Salamanca Erazo';
            $user->email ='salamanca@gmail.com';
            $user->password = '12345';
            $user->tipo_persona_id = ('2');
            $user->save();

            $user=new User;
            $user->nombres ='Nathalia';
            $user-> apellidos = 'Alvarado';
            $user->email ='nathalia@gmail.com';
            $user->password ='12345';
            $user->tipo_persona_id = ('2');
            $user->save();

        
        $fotografia=new Fotografia();
        $fotografia->nombre ='Tatiana';
        $fotografia-> imagen = 'img_1668058648.png';
        $fotografia->descripcion ='salamanca@gmail.com';
        $fotografia->save();
        

        $this->call(PuntosAtencionSeeder::class);
        //$this->call(EventosSeeder::class);
        $this->call(HotelSeeder::class);
        //$this->call(FotografiaSeeder::class);
        //$this->call(EstacionSeeder::class);
        $this->call(TipoConvenioSeeder::class);
        //$this->call(CcomercialSeeder::class);
       // $this->call(AutoridadSeeder::class);
       // $this->call(RecomendadoSeeder::class);
       // $this->call(RestauranteSeeder::class);
        $this->call(ConvenioSeeder::class);
       // $this->call(LugarturisticoSeeder::class);
            
        }
    }

