@extends ('layouts.inicio')

@section ('title', 'Portfolio')

@section('contenido')

<main id="main">

    <!-- ======= Our Team Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{__('menu.terminos')}}</h2>
          <ol>
            <li><a href="/">{{__('menu.home')}}</a></li>
            <li>{{__('menu.terminos')}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Team Section ======= -->
    <section class="team" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500" style="padding-bottom: 339px !important;">
      <div class="container">

        <!-- Accordion without outline borders -->
        <div class="accordion accordion-flush" id="accordionFlushExample">

          {!! $terminos[0]->{'content_'.app()->getLocale()} !!}

           

          


        </div><!-- End Accordion without outline borders -->

        

      </div>
    </section><!-- End Team Section -->

    <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row justify-content-around">
              <div class="col-4">
                <a  
                  class="btn btn-lg crema  mt-3" 
                  style="background-color: #67337a; " 
                  href="https://www.pspsiche.com/consenso/{{app()->getLocale()}}/Consenso_informato_Maggiorenni-PsPsiche.pdf"
                  target="_blank" 
                  role="button"
                  >
                  {{$linksutiles[3]->{'link_'.app()->getLocale()} }} {{__('menu.mayor18')}}
                </a>
              </div>
              <div class="col-4">
                <a  
                  class="btn btn-lg crema  mt-3" 
                  style="background-color: #67337a; " 
                  href="https://www.pspsiche.com/consenso/{{app()->getLocale()}}/Consenso_informato_Minorenni-PsPsiche.pdf"
                  target="_blank" 
                  role="button"
                  >
                  {{$linksutiles[3]->{'link_'.app()->getLocale()} }} {{__('menu.menor18')}}
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  </main><!-- End #main -->


@endsection



