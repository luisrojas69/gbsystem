<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class LotsAnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              //Lotes de Animales
        Permission::create([
            'name'          =>  'Navegar Lotes de Animales',
            'slug'          =>  'lotsAnimals.index',
            'description'   =>  'Lista y Navega Todos los Lotes de Animales del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Lote de Animales',
            'slug'          =>  'lotsAnimals.show',
            'description'   =>  'Ver en Datalle Cada Lote de Animales del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Lotes de Animales',
            'slug'          =>  'lotsAnimals.create',
            'description'   =>  'Crear un Lote de Animales en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Lotes de Animales',
            'slug'          =>  'lotsAnimals.edit',
            'description'   =>  'Editar Cualquier dato de una Lote de Animales del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Lotes de Animales',
            'slug'          =>  'lotsAnimals.destroy',
            'description'   =>  'Eliminar Cualquier Lote de Animales del Sistema',
        ]);

    }
}
