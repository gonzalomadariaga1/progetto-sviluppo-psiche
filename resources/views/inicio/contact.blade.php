@extends ('layouts.inicio')

@section ('title', 'Contact')

@section('contenido')

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{__('contact.titulo')}}</h2>
          <ol>
            <li><a href="/">{{__('menu.home')}}</a></li>
            <li>{{__('contact.titulo')}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Contact Section -->

    <!-- ======= Contact Section ======= -->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-envelope"></i>
                  <h3>{{__('contact.contacttitulo')}}</h3>
                  <a href="mailto:proyectosviluppo@psiche.online">proyectosviluppo@psiche.online</a>
                  
                  <p>{{__('contact.texto')}}</p>
                </div>
              </div>
            </div>

          </div>



        </div>

      </div>
    </section><!-- End Contact Section -->

    

  </main><!-- End #main -->

@endsection