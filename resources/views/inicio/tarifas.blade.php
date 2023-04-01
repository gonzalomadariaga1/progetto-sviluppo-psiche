@extends ('layouts.inicio')

@section ('title', 'Portfolio')

@section('contenido')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-cntent-center align-items-center">
  <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

    <!-- Slide 1 -->
    {{-- <div class="carousel-item active">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown crema"><span>{{__('tarifas.carr1')}}</span></h2>
        <p class="animate__animated animate__fadeInUp">{{__('tarifas.subcarr1')}}</p>
        <a href="" class="btn-get-started animate__animated animate__fadeInUp">{{__('inicio.botoncarr1')}}</a> 
      </div>
    </div> --}}

    {{-- <div class="carousel-item">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown crema"><span>{{__('tarifas.carr2')}}</span></h2>
        <p class="animate__animated animate__fadeInUp">{{__('tarifas.subcarr1')}}</p> 
        <a href="" class="btn-get-started animate__animated animate__fadeInUp">{{__('inicio.botoncarr1')}}</a>
      </div>
    </div> --}}
    
    <?php 
      $count = 0;
        foreach ($carousel as $car){
      ?>
        <div class="carousel-item <?php 
            if($count==0){
              echo "active";  
            }
            else{
                echo " ";
            }
        ?>">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown crema">
              {!! $car->{'title_'.app()->getLocale()} !!}
            </h2>
            {{-- <p class="animate__animated animate__fadeInUp">{{__('tarifas.subcarr1')}}</p> --}}
           {{-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">{{__('inicio.botoncarr1')}}</a>  --}}
          </div>
        </div>
        <?php 
        $count++;
        }
        ?>
        


    

    

     <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
    </a>

  </div>
</section><!-- End Hero -->

<main id="main">

    {{-- <!-- ======= Our Portfolio Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{__('tarifas.titulo')}}</h2>
          <ol>
            <li><a href="/">{{__('menu.home')}}</a></li>
            <li>{{__('tarifas.titulo')}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Portfolio Section --> --}}

    <!-- ======= Pricing Section ======= -->
    <section class="pricing section-bg" data-aos="fade-up">
      <div class="container">

        <div class="section-title">
          <h2>{{__('tarifas.sesiones')}}</h2>
          {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
        </div>

        <div class="row ">
          
            <div class="col-lg-5 col-xs-12 box">
              <h3><strong>{{__('tarifas.titulo-video')}}</strong></h3>
              <h4>€50<span>{{__('tarifas.per')}}</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> {{__('tarifas.ticket1-video')}}</li>
                <li><i class="bx bx-check"></i> {{__('tarifas.ticket2-video')}}</li>
                {{-- <li><i class="bx bx-check"></i> {{__('tarifas.ticket3-video')}}</li> --}}
                {{-- <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li> --}}
              </ul>
              <a href="/reservar" class="get-started-btn">{{__('tarifas.boton')}}</a>
            </div>


            <div class="col-lg-5 col-xs-12 box">
              <h3><strong>Chat</strong></h3>
              <h4>€15<span>{{__('tarifas.per')}}</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> {{__('tarifas.ticket1-chat')}}</li>
                <li><i class="bx bx-check"></i> {{__('tarifas.ticket2-chat')}}</li>
                {{-- <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li class="na"><i class="bx bx-x"></i> <span>Pharetra massa massa ultricies</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Massa ultricies mi quis hendrerit</span></li> --}}
              </ul>
              <a href="/reservar" class="get-started-btn">{{__('tarifas.boton')}}</a>
            </div>
          

          

          

        </div>

        <br>
        <hr>
        <br>

        <div class="section-title">
          <h2>{{__('tarifas.paquetes')}}</h2>
          {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
        </div>

        <div class="row no-gutters">

          @foreach ($paquetes as $paquete)

          <div class="col-lg-5 box-p">
            <h3 style="color:#ecb1ee !important"> <strong> {{$paquete->{'name_'.app()->getLocale()} }} </strong> </h3>
            <h4 style="color:#ecb1ee !important">€{{$paquete->precio}}<span style="color:#ecb1ee !important">{{__('tarifas.ahorra')}} €{{$paquete->descuento}}</span></h4>
            <a href="{{ route('reservar_paquete' , $paquete) }}" class="get-started-btn-p">{{__('tarifas.boton')}}</a>
          </div>
              
          @endforeach


        </div>



      </div>
    </section><!-- End Pricing Section -->

  </main><!-- End #main -->

@endsection