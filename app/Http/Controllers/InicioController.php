<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Post;
use App\User;
use App\Cupon;
use App\Paquete;
use App\Termino;
use MercadoPago;
use App\Etiqueta;
use App\LinkUtil;
use App\Servicio;
use App\Categoria;
use App\Modalidad;
use App\UsedCupon;
use App\Privacidad;
use App\CarouselTarifa;
use App\PaymentPlatform;
use App\PoliticaCookies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class InicioController extends Controller
{
    public function index()
    {
        
        //dd($linksutiles);
        return view('inicio.index');
    }

    public function about()
    {
        return view('inicio.about');
    }

    public function services()
    {
        return view('inicio.services');
    }

    public function tarifas()
    {
        $paquetes = Paquete::all();
        $carousel = CarouselTarifa::all();
        //dd($carousel);
        return view('inicio.tarifas', compact('paquetes','carousel'));
    }
    

    

    public function faq()
    {
        $faq = Faq::all();
        return view('inicio.faq', compact('faq'));
    }

    public function terminosycondiciones(){

        $terminos = Termino::all();
        //dd($terminos);
        return view('inicio.terminos', compact('terminos'));
    }

    public function politicacookies(){

        $politica = PoliticaCookies::all();

        return view('inicio.politicacookies', compact('politica'));
    }

    public function privacidad(){

        $privacidad = Privacidad::all();

        return view('inicio.privacidad', compact('privacidad'));
    }

    public function contact()
    {
        return view('inicio.contact');
    }

    public function blog()
    {
        $post_categories = Categoria::all();
        
        $recent_posts = Post::latest('published_at')->where('status','public')->take(4)->get();

        

        $post_tags = Etiqueta::whereHas('taggables',function($query){
            $query->where('taggable_type','App\Post');
        })->get();

        $months = Post::where('status','public')->select(
            DB::raw("count(*) as count"),
            DB::raw("DATE_FORMAT(published_at,'%M %Y') as date")
            )->groupBy('date')->get();
        
            $posts = Post::where('status','public')->paginate(8);
        return view('inicio.blog',compact('posts', 'post_categories' , 'recent_posts' , 'post_tags','months' ));
    }

    public function blog_details (Post $post){
        $post_categories = Categoria::all();

        $recent_posts = Post::latest('published_at')->where('status','public')->take(4)->get();

        $post_tags = Etiqueta::whereHas('taggables',function($query){
            $query->where('taggable_type','App\Post');
        })->get();


        $months = Post::where('status','public')->select(
                DB::raw("count(*) as count"),
                DB::raw("DATE_FORMAT(published_at,'%M %Y') as date")
                )->groupBy('date')->get();

        return view('inicio.blog_details' , compact('post' , 'post_categories','recent_posts','post_tags','months'));
    }

    public function posts_json(){
        $post = Post::where('status','public')->pluck('title_es');
        //dd($post);
        return $post;
    }

    public function get_posts_category(Categoria $category){

        
        
        $post_categories = Categoria::all();

        $recent_posts = Post::latest('published_at')->where('status','public')->take(4)->get();

        $post_tags = Etiqueta::whereHas('taggables',function($query){
            $query->where('taggable_type','App\Post');
        })->get();

        $months = Post::where('status','public')->select(
            DB::raw("count(*) as count"),
            DB::raw("DATE_FORMAT(published_at,'%M %Y') as date")
            )->groupBy('date')->get();
            
        $posts = $category->posts()->paginate(8);
        return view('inicio.blog',compact('post_categories','recent_posts','post_tags','posts','months'));
    }

    public function get_posts_tags(Etiqueta $tag){

        $post_categories = Categoria::all();

        $recent_posts = Post::latest('published_at')->where('status','public')->take(4)->get();

        $post_tags = Etiqueta::whereHas('taggables',function($query){
            $query->where('taggable_type','App\Post');
        })->get();

        $months = Post::where('status','public')->select(
                DB::raw("count(*) as count"),
                DB::raw("DATE_FORMAT(published_at,'%M %Y') as date")
                )->groupBy('date')->get();

        $posts = $tag->posts()->paginate(8);
        return view('inicio.blog',compact('post_categories','recent_posts','post_tags','posts','months'));
    }

    public function get_posts_month($date){

        $oldDate = strtotime($date);
        $newDate = date('m', $oldDate);

        $post_categories = Categoria::all();
        
        $recent_posts = Post::latest('published_at')->where('status','public')->take(4)->get();

        

        $post_tags = Etiqueta::whereHas('taggables',function($query){
            $query->where('taggable_type','App\Post');
        })->get();

        $months = Post::where('status','public')->select(
            DB::raw("count(*) as count"),
            DB::raw("DATE_FORMAT(published_at,'%M %Y') as date")
            )->groupBy('date')->get();

        $posts = Post::where('status','public')->whereMonth('published_at', $newDate)->paginate(8);

        
        return view('inicio.blog',compact('posts', 'post_categories' , 'recent_posts' , 'post_tags','months' ));
    }

    public function lenguaje()
    {
        return view('inicio.lenguaje');
    }

    public function colabora()
    {
        return view('inicio.colabora');
    }

    public function reservar()
    {

        
        
        $servicios = Servicio::all();
        $modalidades= Modalidad::all();
        $especialistas = User::all();
        $paymentPlatforms = PaymentPlatform::all();

        //dd($modalidades);
        return view('inicio.reservar', compact('servicios', 'modalidades','especialistas', 'paymentPlatforms'));
    }

    public function get_fechas($id_especialista,$id_modalidad) 
    {
        $horarios = DB::table('horarios')
        ->select('horarios.dia')
        ->where('horarios.especialista_id','=',$id_especialista)
        ->where('horarios.modalidad_id','=',$id_modalidad)
        ->where('horarios.estado','=','DISPONIBLE')
        ->groupBy('horarios.dia')
        ->pluck('dia');

        //dd($horarios);
        
        
        return $horarios;
    }

    public function get_horas($dia,$id_modalidad)
    {
        $horas = DB::table('horarios')
        ->select('horarios.hora_inicio')
        ->where('horarios.dia','=',$dia)
        ->where('horarios.modalidad_id','=',$id_modalidad)
        ->where('horarios.estado','=','DISPONIBLE')
        ->select('hora_inicio','hora_fin')
        ->get();

        //dd($horas[0]);
        // $data = [];

        // foreach ($horas as $hora){
        //     $tiempo = $hora->hora_inicio.' - '.$hora->hora_fin;
        //     $data[] = $tiempo;
        // }

        //dd($data);
        return json_encode($horas);
    }

    public function reservar_paquete($id){
        $paquetes = Paquete::all();
        $servicios = Servicio::all();
        $modalidades= Modalidad::all();
        $especialistas = User::all();
        $paymentPlatforms = PaymentPlatform::all();

        //dd($modalidades);
        return view('inicio.reservar_paquete', compact('id','paquetes','servicios', 'modalidades','especialistas', 'paymentPlatforms'));
    }

    public function get_fechas_p($id_especialista) 
    {
        $horarios = DB::table('horarios')
        ->select('horarios.dia')
        ->where('horarios.especialista_id','=',$id_especialista)

        ->where('horarios.estado','=','DISPONIBLE')
        ->groupBy('horarios.dia')
        ->pluck('dia');

        //dd($horarios);
        
        
        return $horarios;
    }

    public function get_horas_p($dia)
    {
        $horas = DB::table('horarios')
        ->select('horarios.hora_inicio')
        ->where('horarios.dia','=',$dia)
        ->where('horarios.estado','=','DISPONIBLE')
        ->select('hora_inicio','hora_fin')
        ->get();

        //dd($horas[0]);
        // $data = [];

        // foreach ($horas as $hora){
        //     $tiempo = $hora->hora_inicio.' - '.$hora->hora_fin;
        //     $data[] = $tiempo;
        // }

        //dd($data);
        return json_encode($horas);
    }

    public function get_bono($id){
        $bonos = DB::table('paquetes')
            ->where('paquetes.id','=',$id)
            ->first();
        
        return json_encode($bonos);
    }

    public function check_cupon($cupon,$email,$telefono){

        $cupon_mayus = strtoupper($cupon);
        //dd($cupon_mayus);
        $existecupon = Cupon::where('codigo',$cupon_mayus)->first();
        //dd($existecupon);

        if( $existecupon == null ){ 
            // no existe el cupon
            //dd("no existe cupon");
            return 0;
        }else if( $existecupon->multi_uso == 1){
            //email puede usarlo una vez
            $checkemail = UsedCupon::where('email_paciente',$email)->where('cupon_id',$existecupon->id)->first();
            
            if ( $checkemail == null){
                // el email no ha usado el cupon, por lo tanto si puede utilizarlo
                if ( $existecupon->limite_uso == 0){
                    //cupon no tiene limite de uso, se puede utilizar
                    // $usar_cupon = new UsedCupon;
                    // $usar_cupon->cupon_id = $existecupon->id;
                    // $usar_cupon->email_paciente = $email;
                    // $usar_cupon->telefono_paciente = $telefono;
                    // $usar_cupon->save();
                    $data []  = [
                        'id_cupon' => $existecupon->id,
                        'tiene_limite' => 'no',
                        'tipocupon' => $existecupon->tipo,
                        'valor' => $existecupon->valor,
                    ];

                    //dd("exito. caso: no tiene limite de uso y un paciente puede ocuparlo una sola vez.");
                    //EXITO
                    return json_encode($data);


                }else{
                    // si tiene limite de uso, entonces hay que descontar en 1
                    //dd("tengo limite de uso");
                    $cantidad_usos = $existecupon->quedan_por_usar;
                    
                    if($cantidad_usos >= 1 ){
                        //quedan cupones disponibles, por lo tanto hacer descuento de cupones

                        // $nueva_cantidad_uso = ( $cantidad_usos - 1);
                        // $actualizar_stock = Cupon::findOrFail($existecupon->id);
                        // $actualizar_stock->quedan_por_usar = $nueva_cantidad_uso;
                        // $actualizar_stock->update();

                        //se usa el cupon 

                        // $usar_cupon = new UsedCupon;
                        // $usar_cupon->cupon_id = $existecupon->id;
                        // $usar_cupon->email_paciente = $email;
                        // $usar_cupon->telefono_paciente = $telefono;
                        // $usar_cupon->save();


                        $data []  = [
                            'id_cupon' => $existecupon->id,
                            'tiene_limite' => 'si',
                            'tipocupon' => $existecupon->tipo,
                            'valor' => $existecupon->valor,
                        ];
                        //EXITO
                        //dd("exito. caso: tiene limite de uso y se descuenta y el paciente puede usarlo una sola vez");
                        return json_encode($data);
                    

                    }else{
                        // no quedan cupones disponibles
                        //ERROR
                        //dd("no quedan cupones por usar");
                        return 1;
                    } 
                }

            }else{
                // ya ha utilizado el cupon ese email, no se puede ocupar.
                //ERROR
                //dd("email usado");
                return 2;
            }
            

        }else{
            //el cupon puede utilizarlo un paciente mas de una vez 

            if ( $existecupon->limite_uso == 0){
                //cupon no tiene limite de uso, se puede utilizar
                // $usar_cupon = new UsedCupon;
                // $usar_cupon->cupon_id = $existecupon->id;
                // $usar_cupon->email_paciente = $email;
                // $usar_cupon->telefono_paciente = $telefono;
                // $usar_cupon->save();
                $data []  = [
                    'id_cupon' => $existecupon->id,
                    'tiene_limite' => 'no',
                    'tipocupon' => $existecupon->tipo,
                    'valor' => $existecupon->valor,
                ];

                //dd("exito. caso: no tiene limite de uso y un paciente lo puede ocupar mas de una vez.");
                //EXITO
                return json_encode($data);


            }else{
                // si tiene limite de uso

                $cantidad_usos = $existecupon->quedan_por_usar;

                if($cantidad_usos >= 1 ){
                    //quedan cupones disponibles, por lo tanto hacer descuento de cupones

                    // $nueva_cantidad_uso = ( $cantidad_usos - 1);
                    // $actualizar_stock = Cupon::findOrFail($existecupon->id);
                    // $actualizar_stock->quedan_por_usar = $nueva_cantidad_uso;
                    // $actualizar_stock->update();

                    //se usa el cupon 

                    // $usar_cupon = new UsedCupon;
                    // $usar_cupon->cupon_id = $existecupon->id;
                    // $usar_cupon->email_paciente = $email;
                    // $usar_cupon->telefono_paciente = $telefono;
                    // $usar_cupon->save();


                    $data []  = [
                        'id_cupon' => $existecupon->id,
                        'tiene_limite' => 'si',
                        'tipocupon' => $existecupon->tipo,
                        'valor' => $existecupon->valor,
                    ];
                    //EXITO
                    //dd("exito. caso: tiene limite de uso y se descuenta y un paciente lo puede ocupar mas de una vez.");
                    return json_encode($data);
                

                }else{
                    // no quedan cupones disponibles
                    //ERROR
                    //dd("no quedan cupones por usar");
                    return 3 ;
                } 
            }
        };
    }

    public function formColabora(Request $request){
        //dd($request->all());
        $lang = app()->getLocale();


        Mail::send('emails.colabora', ['request' => $request ], 
            function($message) use ($request){
                $message->to('mariagraziaproietto@gmail.com')
                ->subject('Solicitud de colaboración');
            });

        
        if ( $lang == "es"){
            Alert::success('¡Buen trabajo!', 'La solicitud se ha enviado correctamente. En breve recibirás una respuesta');
            return redirect()->route('colabora');
        }else{
            Alert::success('Bel lavoro!', 'La richiesta è stata inviata con successo. Riceverai una risposta a breve.');
            return redirect()->route('colabora');
        }

    }
    
}
