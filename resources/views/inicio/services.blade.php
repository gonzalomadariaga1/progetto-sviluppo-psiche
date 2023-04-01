@extends ('layouts.inicio')

@section ('title', 'Services')

@section('contenido')



<main id="main">

<!-- ======= Our Services Section ======= -->
<section class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>{{__('services.titulo')}}</h2>
      <ol>
        <li><a href="/">{{__('menu.home')}}</a></li>
        <li>{{__('services.titulo')}}</li>
      </ol>
    </div>

  </div>
</section><!-- End Our Services Section -->





<!-- ======= Service Details Section ======= -->
{{-- <section class="service-details">
  <div class="container">

    <div class="section-title">

      <p data-aos="fade-up">{{__('services.alert')}}</p>
    </div>

    <div class="row">
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card">

          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard1')}}</h5>
            <p class="card-text">{{__('services.bodycard1')}}</p>
            
          </div>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card">

          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard2')}}</h5>
            <p class="card-text">{{__('services.bodycard2')}}</p>
            
          </div>
        </div>

      </div>
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card">

          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard3')}}</h5>
            <p class="card-text">{{__('services.bodycard3')}}</p>
            
          </div>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card">

          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard4')}}</h5>
            <p class="card-text">{{__('services.bodycard4')}}</p>
            
          </div>
        </div>
      </div>
    </div>

  </div>
</section> --}}
<!-- End Service Details Section -->

<!-- ======= Service Details Section ======= -->
<section class="service-details">
  <div class="container">
    <div class="section-title">

      <p data-aos="fade-up">{{__('services.alert')}}</p>
    </div>

    <div class="row">
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card" style="background-color: transparent; ">
          <div class="card-img">
            <img src="assets/img/service-details-1.png" alt="..." style="height: 95%">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard1')}}</h5>
            <p class="card-text">{{__('services.bodycard1')}}</p>
            
          </div>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card" style="background-color: transparent; ">
          <div class="card-img">
            <img src="assets/img/service-details-2.png" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard2')}}</h5>
            <p class="card-text">{{__('services.bodycard2')}}</p>
            
          </div>
        </div>

      </div>
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card" style="background-color: transparent; ">
          <div class="card-img">
            <img src="assets/img/service-details-3.png" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard3')}}</h5>
            <p class="card-text">{{__('services.bodycard3')}}</p>
            
          </div>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card" style="background-color: transparent; ">
          <div class="card-img" style="padding-bottom: 17px;">
            <img src="assets/img/service-details-4.png" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{__('services.titulocard4')}}</h5>
            <p class="card-text">{{__('services.bodycard4')}}</p>
            
          </div>
        </div>
      </div>
    </div>

  </div>
</section><!-- End Service Details Section -->

</main><!-- End #main -->

@endsection