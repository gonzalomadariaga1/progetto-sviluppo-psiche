<?php

use Illuminate\Database\Seeder;

use App\Http\Controllers\FaqController;

use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CuponesController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\PaquetesController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\TerminosController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ModalidadController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\InfoFooterController;
use App\Http\Controllers\LinksRedesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PrivacidadController;
use App\Http\Controllers\LinksUtilesController;
use App\Http\Controllers\PolicyCookiesController;
use App\Http\Controllers\ContactoFooterController;
use App\Http\Controllers\CarouselTarifasController;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['create']],[
            'description' => 'Creación de usuarios'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['show']],[
            'description' => 'Listado y detalle de usuarios'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit']],[
            'description' => 'Edición de usuarios'
        ]);

        /**
         * Admin / Permission
         */
        Permission::updateOrCreate(['name' => PermissionController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de permisos'
        ]);

        /**
         * Admin / Role
         */
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['create']], [
            'description' => 'Creación de roles'
        ]);
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de roles'
        ]);
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['edit']], [
            'description' => 'Edición de rol'
        ]);
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de roles'
        ]);

        /**
         * Admin / Blog / Posts
         */
        Permission::updateOrCreate(['name' => PostsController::PERMISSIONS['create']], [
            'description' => 'Creación de posts'
        ]);
        Permission::updateOrCreate(['name' => PostsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de posts'
        ]);
        Permission::updateOrCreate(['name' => PostsController::PERMISSIONS['edit']], [
            'description' => 'Edición de posts'
        ]);
        Permission::updateOrCreate(['name' => PostsController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de posts'
        ]);

        /**
         * Admin / Blog / Categorias
         */
        Permission::updateOrCreate(['name' => CategoriaController::PERMISSIONS['create']], [
            'description' => 'Creación de categorias'
        ]);
        Permission::updateOrCreate(['name' => CategoriaController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de categorias'
        ]);
        Permission::updateOrCreate(['name' => CategoriaController::PERMISSIONS['edit']], [
            'description' => 'Edición de categorias'
        ]);
        Permission::updateOrCreate(['name' => CategoriaController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de categorias'
        ]);

        /**
         * Admin / Blog / Etiquetas
         */
        Permission::updateOrCreate(['name' => EtiquetaController::PERMISSIONS['create']], [
            'description' => 'Creación de etiquetas'
        ]);
        Permission::updateOrCreate(['name' => EtiquetaController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de etiquetas'
        ]);
        Permission::updateOrCreate(['name' => EtiquetaController::PERMISSIONS['edit']], [
            'description' => 'Edición de etiquetas'
        ]);
        Permission::updateOrCreate(['name' => EtiquetaController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de etiquetas'
        ]);



        /**
         * Admin / Agenda / Mi Agenda
         */

        Permission::updateOrCreate(['name' => AgendaController::PERMISSIONS['show']], [
            'description' => 'Visualización de la Agenda'
        ]);

        /**
         * Admin / Agenda / Horario
         */

        Permission::updateOrCreate(['name' => HorarioController::PERMISSIONS['create']], [
            'description' => 'Creación de horario'
        ]);
        Permission::updateOrCreate(['name' => HorarioController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de horario'
        ]);
        Permission::updateOrCreate(['name' => HorarioController::PERMISSIONS['edit']], [
            'description' => 'Edición de horario'
        ]);
        Permission::updateOrCreate(['name' => HorarioController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de horario'
        ]);

        /**
         * Admin / Agenda / Reservas por confirmar
         */

        Permission::updateOrCreate(['name' => ReservasController::PERMISSIONS['cuentabancaria']], [
            'description' => 'Visualizar y actualizar datos de la cuenta bancaria'
        ]);
        Permission::updateOrCreate(['name' => ReservasController::PERMISSIONS['reservasporconfirmar']], [
            'description' => 'Visualizar, aceptar y rechazar las reservas por confirmar'
        ]);

        /**
         * Admin / Agenda / Modalidad
         */

        Permission::updateOrCreate(['name' => ModalidadController::PERMISSIONS['create']], [
            'description' => 'Creación de modalidad'
        ]);
        Permission::updateOrCreate(['name' => ModalidadController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de modalidad'
        ]);
        Permission::updateOrCreate(['name' => ModalidadController::PERMISSIONS['edit']], [
            'description' => 'Edición de modalidad'
        ]);
        Permission::updateOrCreate(['name' => ModalidadController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de modalidad'
        ]);

        /**
         * Admin / Agenda / Servicio
         */

        Permission::updateOrCreate(['name' => ServiciosController::PERMISSIONS['create']], [
            'description' => 'Creación de servicios'
        ]);
        Permission::updateOrCreate(['name' => ServiciosController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de servicios'
        ]);
        Permission::updateOrCreate(['name' => ServiciosController::PERMISSIONS['edit']], [
            'description' => 'Edición de servicios'
        ]);
        Permission::updateOrCreate(['name' => ServiciosController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de servicios'
        ]);

        /**
         * Admin / Agenda / Paquetes
         */

        Permission::updateOrCreate(['name' => PaquetesController::PERMISSIONS['create']], [
            'description' => 'Creación de paquetes'
        ]);
        Permission::updateOrCreate(['name' => PaquetesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de paquetes'
        ]);
        Permission::updateOrCreate(['name' => PaquetesController::PERMISSIONS['edit']], [
            'description' => 'Edición de paquetes'
        ]);
        Permission::updateOrCreate(['name' => PaquetesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de paquetes'
        ]);


        /**
         * Admin / Agenda / Cupones
         */

        Permission::updateOrCreate(['name' => CuponesController::PERMISSIONS['create']], [
            'description' => 'Creación de cupones'
        ]);
        Permission::updateOrCreate(['name' => CuponesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de cupones'
        ]);
        Permission::updateOrCreate(['name' => CuponesController::PERMISSIONS['edit']], [
            'description' => 'Edición de cupones'
        ]);
        Permission::updateOrCreate(['name' => CuponesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de cupones'
        ]);

        /**
         * Admin / Administracion de pagina / Faq
         */

        Permission::updateOrCreate(['name' => FaqController::PERMISSIONS['create']], [
            'description' => 'Creación de faqs'
        ]);
        Permission::updateOrCreate(['name' => FaqController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de faqs'
        ]);
        Permission::updateOrCreate(['name' => FaqController::PERMISSIONS['edit']], [
            'description' => 'Edición de faqs'
        ]);
        Permission::updateOrCreate(['name' => FaqController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de faqs'
        ]);

        

        /**
         * Admin / Administracion de pagina / Terminos y Condiciones
         */

        Permission::updateOrCreate(['name' => TerminosController::PERMISSIONS['create']], [
            'description' => 'Creación de TyC'
        ]);
        Permission::updateOrCreate(['name' => TerminosController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de TyC'
        ]);
        Permission::updateOrCreate(['name' => TerminosController::PERMISSIONS['edit']], [
            'description' => 'Edición de TyC'
        ]);
        Permission::updateOrCreate(['name' => TerminosController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de TyC'
        ]);


        /**
         * Admin / Administracion de pagina / Politicas de Cookies
         */

        Permission::updateOrCreate(['name' => PolicyCookiesController::PERMISSIONS['create']], [
            'description' => 'Creación de policycookies'
        ]);
        Permission::updateOrCreate(['name' => PolicyCookiesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de policycookies'
        ]);
        Permission::updateOrCreate(['name' => PolicyCookiesController::PERMISSIONS['edit']], [
            'description' => 'Edición de policycookies'
        ]);
        Permission::updateOrCreate(['name' => PolicyCookiesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de policycookies'
        ]);


        /**
         * Admin / Administracion de paginas / Politicas de Privacidad
         */

        Permission::updateOrCreate(['name' => PrivacidadController::PERMISSIONS['create']], [
            'description' => 'Creación de privacidad'
        ]);
        Permission::updateOrCreate(['name' => PrivacidadController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de privacidad'
        ]);
        Permission::updateOrCreate(['name' => PrivacidadController::PERMISSIONS['edit']], [
            'description' => 'Edición de privacidad'
        ]);
        Permission::updateOrCreate(['name' => PrivacidadController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de privacidad'
        ]);

        /**
         * Admin / Elementos del footer / Link utiles
         */

        Permission::updateOrCreate(['name' => LinksUtilesController::PERMISSIONS['create']], [
            'description' => 'Creación de links utiles'
        ]);
        Permission::updateOrCreate(['name' => LinksUtilesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de links utiles'
        ]);
        Permission::updateOrCreate(['name' => LinksUtilesController::PERMISSIONS['edit']], [
            'description' => 'Edición de links utiles'
        ]);
        Permission::updateOrCreate(['name' => LinksUtilesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de links utiles'
        ]);


        /**
         * Admin / Elementos del footer / Contacto
         */

        Permission::updateOrCreate(['name' => ContactoFooterController::PERMISSIONS['create']], [
            'description' => 'Creación de sección contacto del footer'
        ]);
        Permission::updateOrCreate(['name' => ContactoFooterController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de sección contacto del footer'
        ]);
        Permission::updateOrCreate(['name' => ContactoFooterController::PERMISSIONS['edit']], [
            'description' => 'Edición de sección contacto del footer'
        ]);
        Permission::updateOrCreate(['name' => ContactoFooterController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de sección contacto del footer'
        ]);


        /**
         * Admin / Elementos del footer / Contacto
         */

        Permission::updateOrCreate(['name' => InfoFooterController::PERMISSIONS['create']], [
            'description' => 'Creación de sección info del footer'
        ]);
        Permission::updateOrCreate(['name' => InfoFooterController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de sección info del footer'
        ]);
        Permission::updateOrCreate(['name' => InfoFooterController::PERMISSIONS['edit']], [
            'description' => 'Edición de sección info del footer'
        ]);
        Permission::updateOrCreate(['name' => InfoFooterController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de sección info del footer'
        ]);

        /**
         * Admin / Administracion de pagina / Redes sociales
         */

        Permission::updateOrCreate(['name' => LinksRedesController::PERMISSIONS['create']], [
            'description' => 'Creación de sección redes sociales del footer'
        ]);
        Permission::updateOrCreate(['name' => LinksRedesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de sección redes sociales del footer'
        ]);
        Permission::updateOrCreate(['name' => LinksRedesController::PERMISSIONS['edit']], [
            'description' => 'Edición de sección redes sociales del footer'
        ]);
        Permission::updateOrCreate(['name' => LinksRedesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de sección redes sociales del footer'
        ]);

        /**
         * Admin / Administracion de pagina / Carousel Tarifa
         */

        Permission::updateOrCreate(['name' => CarouselTarifasController::PERMISSIONS['create']], [
            'description' => 'Creación de carousel para tarifas'
        ]);
        Permission::updateOrCreate(['name' => CarouselTarifasController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de carousel para tarifas'
        ]);
        Permission::updateOrCreate(['name' => CarouselTarifasController::PERMISSIONS['edit']], [
            'description' => 'Edición de carousel para tarifas'
        ]);
        Permission::updateOrCreate(['name' => CarouselTarifasController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de carousel para tarifas'
        ]);
    }
}
