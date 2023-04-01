@extends ('layouts.inicio')



@section('contenido')

<main id="main">

    <!-- ======= Our Team Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{ $privacidad[0]->{'title_'.app()->getLocale()} }}</h2>
          <ol>
            <li><a href="/">{{__('menu.home')}}</a></li>
            <li>{{ $privacidad[0]->{'title_'.app()->getLocale()} }}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Team Section ======= -->
    <section class="team" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500" style="padding-bottom: 339px !important;">
      <div class="container">

        <!-- Accordion without outline borders -->
        <div class="accordion accordion-flush" id="accordionFlushExample">

          {!! $privacidad[0]->{'content_'.app()->getLocale()} !!}
          

           

          


        </div><!-- End Accordion without outline borders -->

        

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->


@endsection



