<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class WellSeederPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Pozos
        Permission::create([
            'name'          =>  'Navegar Pozos',
            'slug'          =>  'well.index',
            'description'   =>  'Lista y Navega Todos los Pozos del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Pozo',
            'slug'          =>  'well.show',
            'description'   =>  'Ver en Datalle Cada Pozo del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Pozos',
            'slug'          =>  'well.create',
            'description'   =>  'Crear un Pozo en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Pozos',
            'slug'          =>  'well.edit',
            'description'   =>  'Editar Cualquier dato de una Pozo del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Pozos',
            'slug'          =>  'well.destroy',
            'description'   =>  'Eliminar Cualquier Pozo del Sistema',
        ]);


        //Horometros
        Permission::create([
            'name'          =>  'Navegar Horometros',
            'slug'          =>  'horometer.index',
            'description'   =>  'Lista y Navega Todos los Horometros del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Horometro',
            'slug'          =>  'horometer.show',
            'description'   =>  'Ver en Datalle Cada Horometro del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Horometros',
            'slug'          =>  'horometer.create',
            'description'   =>  'Crear un Horometro en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Horometros',
            'slug'          =>  'horometer.edit',
            'description'   =>  'Editar Cualquier dato de una Horometro del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Horometros',
            'slug'          =>  'horometer.destroy',
            'description'   =>  'Eliminar Cualquier Horometro del Sistema',
        ]);

    }
}
