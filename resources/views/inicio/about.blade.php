@extends ('layouts.inicio')

@section ('title', 'About')

@push('styles')
<style type="text/css">
    .wrapper {
      column-count: 1;
      column-gap: 50px;
    }
    .img-left{
      float: left;
      margin: 15px;
      width: 40%;
    }
    .p-justify{
      text-align: justify;
      
    }

</style>
@endpush

@section('contenido')
<main id="main">

    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2 style="color:#ecb1ee !important ;" >{{__('about.titulo')}}</h2>
          <ol>
            <li><a href="/">{{__('menu.home')}}</a></li>
            <li style="color: #ecb1ee !important; " >{{__('about.titulo')}}</li>
            
          </ol>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
      <div class="container">

        <div class="wrapper">
         
            <img src="assets/img/about.jpg" class="img-left" alt="">
         
          
            
            <p class="p-justify">{!! trans('about.texto1') !!}</p>
            <p class="p-justify">{!! trans('about.texto2') !!}</p>
            <p class="p-justify">{!! trans('about.texto3') !!}</p>
            <p class="p-justify">{!! trans('about.texto4') !!}</p>
            <p class="p-justify">{!! trans('about.texto5') !!}</p>
            <p class="p-justify">{!! trans('about.texto6') !!}</p>
          
        </div>

      </div>
    </section><!-- End About Section -->

    

  </main><!-- End #main -->
@endsection