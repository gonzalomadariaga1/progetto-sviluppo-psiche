@extends ('layouts.inicio')

@section ('title', 'Portfolio')

@section('contenido')

<main id="main">

    <!-- ======= Our Team Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>FAQ</h2>
          <ol>
            <li><a href="/">{{__('menu.home')}}</a></li>
            <li>FAQ</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Team Section ======= -->
    <section class="team" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500" style="padding-bottom: 60px !important;">
      <div class="container">

        <!-- Accordion without outline borders -->
        <div class="accordion accordion-flush" id="accordionFlushExample">

          @foreach ($faq as $faq)

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading{{$faq->id}}">

                <button class="accordion-button acordionfaq" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$faq->id}}" aria-expanded="false" aria-controls="flush-collapse{{$faq->id}}">
                  {{$faq->{'name_'.app()->getLocale()} }}
                </button>

              </h2>

              <div id="flush-collapse{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$faq->id}}" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body acordionfaqbody">
                  {!! $faq->{'content_'.app()->getLocale()} !!}
                </div>
              </div>
            </div> 

            
            
            
              
          @endforeach

           

          


        </div><!-- End Accordion without outline borders -->

        

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->


@endsection



