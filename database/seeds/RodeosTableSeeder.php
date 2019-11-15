<?php

use Illuminate\Database\Seeder;
use App\Rodeo;

class RodeosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rodeo::create([
        	'rodeo_na' => 'MACHOS PARA ENGORDE',
        	'rodeo_de' => 'RODEO DE ANIMALES PARA LA CEBA Y ENGORDE',
        ]);

        Rodeo::create([
        	'rodeo_na' => 'ANIMALES MUERTOS',
        	'rodeo_de' => 'RODEO DE ANIMALES MUERTOS',
        ]);

        Rodeo::create([
        	'rodeo_na' => 'ANIMALES VENDIDOS',
        	'rodeo_de' => 'RODEO DE ANIMALES QUE HAN SIDO VENDIDOS',
        ]);

        Rodeo::create([
        	'rodeo_na' => 'ANIMALES DONADOS',
        	'rodeo_de' => 'RODEO DE ANIMALES QUE HAN SIDO DONADOS',
        ]);
    }
}
