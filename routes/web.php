<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// // Route::get('/', function () {
// //     return view('welcome');
// // });

Route::get('/optimizar', function () {
        Artisan::call('optimize:clear');
      });


Route::get('/logout', function () {
        Auth::logout();
        session()->flush();
        return Redirect::to('/');
    })->name('logout');


Auth::routes(["register" => false]);


Route::get('/horario/get_horarios','HorarioController@get_horarios')->name('horario.get_horario');

Route::get('/','InicioController@index')->name('inicio');

Route::get('/reservar','InicioController@reservar')->name('reservar');
Route::get('/reservar/{paquete}','InicioController@reservar_paquete')->name('reservar_paquete');
Route::get('/reservar/{id_especialista}/{id_modalidad}/get_fechas/','InicioController@get_fechas')->name('reservar.get_fechas');
Route::get('/reservar/{hora}/{id_modalidad}/get_horas/','InicioController@get_horas')->name('reservar.get_horas');
Route::get('/reservar/{id_especialista}/get_fechas_p/','InicioController@get_fechas_p')->name('reservar.get_fechas_p');
Route::get('/reservar/{hora}/get_horas_p/','InicioController@get_horas_p')->name('reservar.get_horas_p');
Route::get('/reservar/{bono}/get_bono/','InicioController@get_bono');
Route::get('/reservar/{codigo}/{email}/{telefono}/check_cupon/','InicioController@check_cupon');


Route::get('/about','InicioController@about')->name('about');
Route::get('/services','InicioController@services')->name('services');
Route::get('/tarifas','InicioController@tarifas')->name('tarifas');
Route::get('/faq','InicioController@faq')->name('faq');
Route::get('/terminosycondiciones','InicioController@terminosycondiciones')->name('terminosycondiciones');
Route::get('/politicacookies','InicioController@politicacookies')->name('politicacookies');
Route::get('/privacidad','InicioController@privacidad')->name('privacidad');



//---rutas del blog ----

Route::get('/blog','InicioController@blog')->name('blog');
Route::get('/blog_details/{post}','InicioController@blog_details')->name('blog_details');
Route::get('/blog/posts/{date}','InicioController@get_posts_month')->name('get_posts_month');
Route::get('/blog/categorias/{category}' , 'InicioController@get_posts_category')->name('get_posts_category');
Route::get('/blog/tags/{tag}' , 'InicioController@get_posts_tags')->name('get_posts_tags');

Route::get('/posts_json','InicioController@posts_json')->name('posts.json');





Route::post('/payments/pay', 'PaymentController@pay')->name('pay');
Route::get('/payments/approval', 'PaymentController@approval')->name('approval');
Route::get('/payments/cancelled', 'PaymentController@cancelled')->name('cancelled');



Route::get('/contact','InicioController@contact')->name('contact');
Route::get('/colabora','InicioController@colabora')->name('colabora');
Route::post('/colabora/send','InicioController@formColabora')->name('send_colabora');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::post('upload_image/{id}' , 'AjaxController@upload_image')->name('upload.image');
Route::get('get_images/{id}','AjaxController@get_images')->name('get.images');
Route::post('file_delete' , 'AjaxController@file_delete')->name('file.delete');





    


Route::group(['middleware' => 'auth'], function () {
        Route::get('/reservas/cuenta-bancaria','ReservasController@cuenta_bancaria')->name('admin.reservas.cuenta-bancaria');

        Route::get('reservas/cuenta-bancaria/edit','ReservasController@edit_cuenta_bancaria')->name('admin.reservas.edit_cuentabancaria');

        Route::get('reservas/{id}/aprobar','ReservasController@aprobar_cita');

        Route::get('reservas/{id}/rechazar','ReservasController@rechazar_cita');

        

        Route::patch('reservas/{id}/update_cuentabancaria','ReservasController@update_cuentabancaria')->name('admin.reservas.update_cuenta');

        Route::resource('reservas', 'ReservasController')->names('admin.reservas');

        Route::post('horario/selected_reservadas' , 'HorarioController@selected_reservadas');

        Route::post('horario/selected_disponibles' , 'HorarioController@selected_disponibles');
        
        Route::post('horario/selected_delete' , 'HorarioController@selected_delete');

        Route::resource('horario', 'HorarioController')->names('admin.horario');
        
        Route::resource('permisos', 'PermissionController')->names('admin.permission')->parameters(['permisos' => 'permission'])->only(['index','show']);

        Route::get('/users/{id}/edit_permiso', 'UsersController@edit_permission')->name('admin.users.edit_permission');
        
        Route::patch('/users/{id}/update_permiso', 'UsersController@update_permiso')->name('admin.users.update_permission');

        Route::resource('users', 'UsersController')->names('admin.users');


        Route::resource('roles', 'RoleController')->names('admin.role')->parameters(['permisos' => 'role']);

        Route::resource('posts', 'PostsController')->names('admin.posts');

        Route::resource('categorias', 'CategoriaController')->names('admin.categorias');

        Route::resource('etiquetas', 'EtiquetaController')->names('admin.etiquetas');
   
        Route::resource('modalidad', 'ModalidadController')->names('admin.modalidad');

        Route::resource('servicios', 'ServiciosController')->names('admin.servicios');

        Route::resource('paquetes', 'PaquetesController')->names('admin.paquetes');

        Route::resource('adminfaq', 'FaqController')->names('admin.faq');

        Route::resource('cupones', 'CuponesController')->names('admin.cupones');

        Route::resource('terms', 'TerminosController')->names('admin.terms');

        Route::resource('policycookies', 'PolicyCookiesController')->names('admin.policycookies');

        Route::resource('privacy', 'PrivacidadController')->names('admin.privacy');

        Route::resource('linksutiles', 'LinksUtilesController')->names('admin.linksutiles');

        Route::resource('linksredes', 'LinksRedesController')->names('admin.linksredes');

        Route::resource('carouseltarifas', 'CarouselTarifasController')->names('admin.carouseltarifas');

        Route::resource('contactofooter', 'ContactoFooterController')->names('admin.contactofooter');

        Route::resource('infofooter', 'InfoFooterController')->names('admin.infofooter');

        Route::get('/agenda', 'AgendaController@index')->name('admin.agenda.index');

        Route::post('/agenda/agregar', 'AgendaController@store')->name('admin.agenda');

        Route::get('/agenda/editar/{id}', 'AgendaController@edit')->name('admin.agenda');

        Route::get('/agenda/mostrar', 'AgendaController@show')->name('admin.agenda');



    
    });














