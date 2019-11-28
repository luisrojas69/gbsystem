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

//ROLES Y PERMISOS

    	//Users
        Permission::create([
        	'name'   		=>  'Navegar Usuarios',
        	'slug'   		=>  'user.index',
        	'description'   =>  'Lista y Navega Todos los Usuarios del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Ver detalle de Usuario',
        	'slug'   		=>  'user.show',
        	'description'   =>  'Ver en Datalle Cada Usuario del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Edicion de Usuarios',
        	'slug'   		=>  'user.edit',
        	'description'   =>  'Editar Cualquier dato de un Usuario del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Eliminar Usuario',
        	'slug'   		=>  'user.destroy',
        	'description'   =>  'Eliminar Cualquier Usuario del Sistema',
        ]);


        //Roles
        Permission::create([
        	'name'   		=>  'Navegar Roles',
        	'slug'   		=>  'role.index',
        	'description'   =>  'Lista y Navega Todos los Roles del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Ver detalle de Rol',
        	'slug'   		=>  'role.show',
        	'description'   =>  'Ver en Datalle Cada Rol del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Creacion de Roles',
        	'slug'   		=>  'role.create',
        	'description'   =>  'Crear un Rol en el Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Edicion de Roles',
        	'slug'   		=>  'role.edit',
        	'description'   =>  'Editar Cualquier dato de un Rol del Sistema',
        ]);

        Permission::create([
        	'name'   		=>  'Eliminar Roles',
        	'slug'   		=>  'role.destroy',
        	'description'   =>  'Eliminar Cualquier Rol del Sistema',
        ]);

//GANADERIA

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


        //Potreros
        Permission::create([
            'name'          =>  'Navegar Potreros',
            'slug'          =>  'paddock.index',
            'description'   =>  'Lista y Navega Todos los Potreros del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Potrero',
            'slug'          =>  'paddock.show',
            'description'   =>  'Ver en Datalle Cada Potrero del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Potreros',
            'slug'          =>  'paddock.create',
            'description'   =>  'Crear un Potrero en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Potreros',
            'slug'          =>  'paddock.edit',
            'description'   =>  'Editar Cualquier dato de un Potrero del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Potreros',
            'slug'          =>  'paddock.destroy',
            'description'   =>  'Eliminar Cualquier Potrero del Sistema',
        ]);

        //Animales
        Permission::create([
            'name'          =>  'Navegar Animales',
            'slug'          =>  'animal.index',
            'description'   =>  'Lista y Navega Todos los Animales del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Animal',
            'slug'          =>  'animal.show',
            'description'   =>  'Ver en Datalle Cada Animal del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Animales',
            'slug'          =>  'animal.create',
            'description'   =>  'Crear un Animal en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Animales',
            'slug'          =>  'animal.edit',
            'description'   =>  'Editar Cualquier dato de un Animal del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Animales',
            'slug'          =>  'animal.destroy',
            'description'   =>  'Eliminar Cualquier Animal del Sistema',
        ]);


        //Especies
        Permission::create([
            'name'          =>  'Navegar Especies',
            'slug'          =>  'specie.index',
            'description'   =>  'Lista y Navega Todos los Especies del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Especie',
            'slug'          =>  'specie.show',
            'description'   =>  'Ver en Datalle Cada Especie del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Especies',
            'slug'          =>  'specie.create',
            'description'   =>  'Crear un Especie en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Especies',
            'slug'          =>  'specie.edit',
            'description'   =>  'Editar Cualquier dato de una Especie del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Especies',
            'slug'          =>  'specie.destroy',
            'description'   =>  'Eliminar Cualquier Especie del Sistema',
        ]);


        //Razas
        Permission::create([
            'name'          =>  'Navegar Razas',
            'slug'          =>  'breed.index',
            'description'   =>  'Lista y Navega Todos los Razas del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Raza',
            'slug'          =>  'breed.show',
            'description'   =>  'Ver en Datalle Cada Raza del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Razas',
            'slug'          =>  'breed.create',
            'description'   =>  'Crear un Raza en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Razas',
            'slug'          =>  'breed.edit',
            'description'   =>  'Editar Cualquier dato de una Raza del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Razas',
            'slug'          =>  'breed.destroy',
            'description'   =>  'Eliminar Cualquier Raza del Sistema',
        ]);

        //Pesajes
        Permission::create([
            'name'          =>  'Navegar Pesajes',
            'slug'          =>  'weighing.index',
            'description'   =>  'Lista y Navega Todos los Pesajes del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Pesaje',
            'slug'          =>  'weighing.show',
            'description'   =>  'Ver en Datalle Cada Pesaje del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Pesajes',
            'slug'          =>  'weighing.create',
            'description'   =>  'Crear un Pesaje en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Pesajes',
            'slug'          =>  'weighing.edit',
            'description'   =>  'Editar Cualquier dato de una Pesaje del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Pesajes',
            'slug'          =>  'weighing.destroy',
            'description'   =>  'Eliminar Cualquier Pesaje del Sistema',
        ]);


        //Clientes
        Permission::create([
            'name'          =>  'Navegar Clientes',
            'slug'          =>  'client.index',
            'description'   =>  'Lista y Navega Todos los Clientes del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Cliente',
            'slug'          =>  'client.show',
            'description'   =>  'Ver en Datalle Cada Cliente del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Clientes',
            'slug'          =>  'client.create',
            'description'   =>  'Crear un Cliente en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Clientes',
            'slug'          =>  'client.edit',
            'description'   =>  'Editar Cualquier dato de una Cliente del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Clientes',
            'slug'          =>  'client.destroy',
            'description'   =>  'Eliminar Cualquier Cliente del Sistema',
        ]);


//SIEMBRAS COSECHAS Y LLUVIAS

        //Sectores
        Permission::create([
            'name'          =>  'Navegar Sectores',
            'slug'          =>  'sector.index',
            'description'   =>  'Lista y Navega Todos los Sectores del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Sector',
            'slug'          =>  'sector.show',
            'description'   =>  'Ver en Datalle Cada Sector del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Sectores',
            'slug'          =>  'sector.create',
            'description'   =>  'Crear un Sector en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Sectores',
            'slug'          =>  'sector.edit',
            'description'   =>  'Editar Cualquier dato de un Sector del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Sectores',
            'slug'          =>  'sector.destroy',
            'description'   =>  'Eliminar Cualquier Sector del Sistema',
        ]);


        //Lotes
        Permission::create([
            'name'          =>  'Navegar Lotes',
            'slug'          =>  'lot.index',
            'description'   =>  'Lista y Navega Todos los Lotes del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Lote',
            'slug'          =>  'lot.show',
            'description'   =>  'Ver en Datalle Cada Lote del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Lotes',
            'slug'          =>  'lot.create',
            'description'   =>  'Crear un Lote en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Lotes',
            'slug'          =>  'lot.edit',
            'description'   =>  'Editar Cualquier dato de un Lote del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Lotes',
            'slug'          =>  'lot.destroy',
            'description'   =>  'Eliminar Cualquier Lote del Sistema',
        ]);


        //Tablones
        Permission::create([
            'name'          =>  'Navegar Tablones',
            'slug'          =>  'plank.index',
            'description'   =>  'Lista y Navega Todos los Tablones del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Tablon',
            'slug'          =>  'plank.show',
            'description'   =>  'Ver en Datalle Cada Tablon del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Tablones',
            'slug'          =>  'plank.create',
            'description'   =>  'Crear un Tablon en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Tablones',
            'slug'          =>  'plank.edit',
            'description'   =>  'Editar Cualquier dato de un Tablon del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Tablones',
            'slug'          =>  'plank.destroy',
            'description'   =>  'Eliminar Cualquier Tablon del Sistema',
        ]);


         //Actividades
        Permission::create([
            'name'          =>  'Navegar Actividades',
            'slug'          =>  'activity.index',
            'description'   =>  'Lista y Navega Todas los Actividades del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Actividad',
            'slug'          =>  'activity.show',
            'description'   =>  'Ver en Datalle Cada Actividad del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Actividades',
            'slug'          =>  'activity.create',
            'description'   =>  'Crear un Actividad en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Actividad',
            'slug'          =>  'activity.edit',
            'description'   =>  'Editar Cualquier dato de una Actividad del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Actividades',
            'slug'          =>  'activity.destroy',
            'description'   =>  'Eliminar Cualquier Actividad del Sistema',
        ]);


        //Cultivos
        Permission::create([
            'name'          =>  'Navegar Cultivos',
            'slug'          =>  'crop.index',
            'description'   =>  'Lista y Navega Todos los Cultivos del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Cultivo',
            'slug'          =>  'crop.show',
            'description'   =>  'Ver en Datalle Cada Cultivo del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Cultivos',
            'slug'          =>  'crop.create',
            'description'   =>  'Crear un Cultivo en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Cultivos',
            'slug'          =>  'crop.edit',
            'description'   =>  'Editar Cualquier dato de un Cultivo del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Cultivos',
            'slug'          =>  'crop.destroy',
            'description'   =>  'Eliminar Cualquier Cultivo del Sistema',
        ]);


        //Pluviometrias
        Permission::create([
            'name'          =>  'Navegar Pluviometrias',
            'slug'          =>  'pluviometry.index',
            'description'   =>  'Lista y Navega Todas los Pluviometrias del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Pluviometria',
            'slug'          =>  'pluviometry.show',
            'description'   =>  'Ver en Datalle Cada Pluviometria del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Pluviometrias',
            'slug'          =>  'pluviometry.create',
            'description'   =>  'Crear un Pluviometria en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Pluviometria',
            'slug'          =>  'pluviometry.edit',
            'description'   =>  'Editar Cualquier dato de una Pluviometria del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Pluviometrias',
            'slug'          =>  'pluviometry.destroy',
            'description'   =>  'Eliminar Cualquier Pluviometria del Sistema',
        ]);


        //Capturas
        Permission::create([
            'name'          =>  'Navegar Capturas',
            'slug'          =>  'capture.index',
            'description'   =>  'Lista y Navega Todas los Capturas del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Captura',
            'slug'          =>  'capture.show',
            'description'   =>  'Ver en Datalle Cada Pluviometria del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Capturas',
            'slug'          =>  'capture.create',
            'description'   =>  'Crear un Captura en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Captura',
            'slug'          =>  'capture.edit',
            'description'   =>  'Editar Cualquier dato de una Captura del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Capturas',
            'slug'          =>  'capture.destroy',
            'description'   =>  'Eliminar Cualquier Captura del Sistema',
        ]);


        //Variedades
        Permission::create([
            'name'          =>  'Navegar Variedades',
            'slug'          =>  'variety.index',
            'description'   =>  'Lista y Navega Todos los Variedades del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Ver detalle de Variedad',
            'slug'          =>  'variety.show',
            'description'   =>  'Ver en Datalle Cada Variedad del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Creacion de Variedades',
            'slug'          =>  'variety.create',
            'description'   =>  'Crear un Variedad en el Sistema',
        ]);

        Permission::create([
            'name'          =>  'Edicion de Variedades',
            'slug'          =>  'variety.edit',
            'description'   =>  'Editar Cualquier dato de una Variedad del Sistema',
        ]);

        Permission::create([
            'name'          =>  'Eliminar Variedades',
            'slug'          =>  'variety.destroy',
            'description'   =>  'Eliminar Cualquier Variedad del Sistema',
        ]);

    }
}
