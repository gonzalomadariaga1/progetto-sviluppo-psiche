@extends ('layouts.inicio')

@section ('title', 'Página de inicio')

@section('contenido')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown crema"><span>{{__('inicio.carr1')}}</span></h2>
          <p class="animate__animated animate__fadeInUp crema">{{__('inicio.subcarr1')}}</p>
          <p class="animate__animated animate__fadeInUp crema">{{__('inicio.subcarr2')}}</p>
          <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">{{__('inicio.botoncarr1')}}</a> -->
        </div>
      </div>

      

      

      <!-- <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a> -->

    </div>
  </section><!-- End Hero -->



  <main id="main">

    <!-- ======= Features Section ======= -->
    <section class="features" style="padding: 0 !important;">
      <div class="container">

        <div class="section-title">
          <!-- <h2>Features</h2> -->
          <p>{{__('inicio.textobajocarrousel')}}</p>
          <p>{{__('inicio.textobajocarrousel2')}}</p>
          <p class="mb-3">{{__('inicio.textobajocarrousel3')}}</p>
          
          <strong><p class="mt-3">{{__('inicio.textobajocarrousel4')}}</p></strong>
          
          <a  class="btn btn-lg crema animate__animated animate__fadeInUp mt-3" style="background-color: #67337a; " href="/reservar" role="button">{{__('inicio.textobotonbajocarr')}}</a>
          
          <p class="mt-3 ">{{__('inicio.textobajocarrousel5')}}</p>
        </div>



      </div>
      
    </section><!-- End Features Section -->

    <!-- ======= Services Section ======= -->
<section class="services" style="padding: 0 !important;" >
  <div class="container">
    <hr>
    <div class="section-title-new mt-5">
      <h2>{{__('inicio.ventajas')}}</h2>

    </div>

    <div class="row">
      
      <div class="col-md-6 col-lg-4 d-flex justify-content-center" data-aos="fade-up">
        <div class="icon-box icon-box-pink">
          <div class="icon"><i class="bx bx-user-check"></i></div>
          <h4 class="title">{{__('services.serv1')}}</h4>
          <p class="description">{{__('services.descriptionserv1')}}</p>
        </div>
      </div>

      {{-- <div class="col-md-6 col-lg-2 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
        <div class="icon-box icon-box-pink">
          <div class="icon"><i class="bx bxs-check-shield"></i></div>
          <h4 class="title">{{__('services.serv2')}}</h4>
          <p class="description"></p>
        </div>
      </div> --}}

      <div class="col-md-6 col-lg-4 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="icon-box icon-box-pink">
          <div class="icon"><i class="bx bx-door-open"></i></div>
          <h4 class="title">{{__('services.serv3')}}</h4>
          <p class="description">{{__('services.descriptionserv3')}}</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="icon-box icon-box-pink">
          <div class="icon"><i class="bx bx-donate-heart"></i></div>
          <h4 class="title">{{__('services.serv4')}}</h4>
          <p class="description">{{__('services.descriptionserv4')}}</p>
        </div>
      </div>

      {{-- <div class="col-md-6 col-lg-2 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="icon-box icon-box-pink">
          <div class="icon"><i class="bx bx-shuffle"></i></div>
          <h4 class="title">{{__('services.serv5')}}</h4>
          <p class="description"></p>
        </div>
      </div> --}}
      

    </div>
    
  </div>
</section><!-- End Services Section -->

    

    

  </main><!-- End #main -->
@endsection