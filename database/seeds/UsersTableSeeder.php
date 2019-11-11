<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create();

        //Necesitamos crear un Rol Especial llamado "Administrador", este unico rol ns va a servir para iniciar el sistema y a partir de alli crear la configuracion necesaria.
        Role::create([
        	'name' 		=> 'Admin',
        	'slug' 		=> 'admin',
        	'special' 	=> 'all-access',
        ]);
        //Este rol no lo vamos a relacion con nngu permiso, pero tiene el permito ESPECIAl de ALL-ACCESS
        
        Role::create([
            'name'      => 'Suspendido',
            'slug'      => 'suspend',
            'special'   => 'no-access',
        ]);
    }

    
}
