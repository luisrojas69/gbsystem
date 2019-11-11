<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Users
        Permission::create([
        	'name'   		=>  'Navegar Usuarios',
        	'slug'   		=>  'users.index',
        	'description'   =>  'Lista y Navega Todos los Usuarios del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Ver detalle de Usuario',
        	'slug'   		=>  'users.show',
        	'description'   =>  'Ver en Datalle Cada Usuario del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Edicion de Usuarios',
        	'slug'   		=>  'users.edit',
        	'description'   =>  'Editar Cualquier dato de un Usuario del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Eliminar Usuario',
        	'slug'   		=>  'users.destroy',
        	'description'   =>  'Eliminar Cualquier Usuario del Sistema',
        ]);

        

        //Roles
        Permission::create([
        	'name'   		=>  'Navegar Roles',
        	'slug'   		=>  'roles.index',
        	'description'   =>  'Lista y Navega Todos los Roles del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Ver detalle de Rol',
        	'slug'   		=>  'roles.show',
        	'description'   =>  'Ver en Datalle Cada Rol del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Creacion de Roles',
        	'slug'   		=>  'roles.create',
        	'description'   =>  'Crear un Rol en el Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Edicion de Roles',
        	'slug'   		=>  'roles.edit',
        	'description'   =>  'Editar Cualquier dato de un Rol del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Eliminar Roles',
        	'slug'   		=>  'roles.destroy',
        	'description'   =>  'Eliminar Cualquier Rol del Sistema',
        ]);



        //Rodeos
        Permission::create([
        	'name'   		=>  'Navegar Rodeos',
        	'slug'   		=>  'rodeo.index',
        	'description'   =>  'Lista y Navega Todos los Rodeos del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Ver detalle de Rodeo',
        	'slug'   		=>  'rodeo.show',
        	'description'   =>  'Ver en Datalle Cada Rodeo del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Creacion de Rodeos',
        	'slug'   		=>  'rodeo.create',
        	'description'   =>  'Crear un Rodeo en el Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Edicion de Rodeos',
        	'slug'   		=>  'rodeo.edit',
        	'description'   =>  'Editar Cualquier dato de un Rodeo del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Eliminar Rodeos',
        	'slug'   		=>  'rodeo.destroy',
        	'description'   =>  'Eliminar Cualquier Rodeo del Sistema',
        ]);

    }
}
