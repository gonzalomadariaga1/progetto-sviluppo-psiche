<?php

use App\Opcion;
use App\Perfil;
use App\User;
use Illuminate\Database\Seeder;

class MariagraziaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Mariagrazia Proietto',
            'email' => 'mariagraziaproietto@gmail.com',
            'password' => Hash::make('mariagrazia')
        ]);



        // $perfil = Perfil::create([
        //     'nombre_perfil' => 'superadmin'
        // ]);

        // // creación de las opciones generales
        // $opcion100=Opcion::create([
        //     'id'=>'100',
        //     'nombre_menu'=>'Gestión de accesos',
        //     'orden'=>'1',
        //     'id_opcion_padre' => '0',
        //     'descripcion'=>'Titulo de Menu Principal',
        //     'url' => '#',
        //     'alias' => 'Gestión de Accesos',
        //     'icono' => 'bi bi-person-lines-fill'
        // ]);

        // $opcion101=Opcion::create([
        //     'id'=>'101',
        //     'nombre_menu'=>'Creación de usuarios',
        //     'orden'=>'2',
        //     'id_opcion_padre' => '100',
        //     'descripcion'=>'Permite la creación de usuarios del sistema',
        //     'url' => '/users',
        //     'alias' => 'Usuarios',
        //     'icono' => 'bi bi-circle'
        // ]);
        // $opcion102=Opcion::create([
        //     'id'=>'102',
        //     'nombre_menu'=>'Creación de opciones',
        //     'orden'=>'3',
        //     'id_opcion_padre' => '100',
        //     'descripcion'=>'Permite la creación de las opciones que tiene el sistema',
        //     'url' => '/opcion',
        //     'alias' => 'Opciones',
        //     'icono' => 'bi bi-circle'
        // ]);
        // $opcion103=Opcion::create([
        //     'id'=>'103',
        //     'nombre_menu'=>'Creación de perfiles',
        //     'orden'=>'4',
        //     'id_opcion_padre' => '100',
        //     'descripcion'=>'Permite crear los perfiles para cada usuario',
        //     'url' => '/perfiles',
        //     'alias' => 'Perfiles',
        //     'icono' => 'bi bi-circle'
        // ]);

        // $perfil->opciones()->sync([
        //     $opcion100->id,
        //     $opcion101->id,
        //     $opcion102->id,
        //     $opcion103->id

        // ]);


    }
}
