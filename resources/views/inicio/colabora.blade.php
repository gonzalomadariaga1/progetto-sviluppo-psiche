@extends ('layouts.inicio')

@section ('title', 'Contact')

@section('contenido')

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{__('colabora.titulo')}}</h2>
          <ol>
            <li><a href="/">{{__('menu.home')}}</a></li>
            <li>{{__('colabora.titulo')}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Contact Section -->

    

    <!-- ======= Contact Section ======= -->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="section-title">
        <h2>{{__('colabora.titulobody')}}</h2>
        <p>{{__('colabora.textobody')}}</p>
      </div>
      <div class="container">

        <div class="row">

          
          <div class="col-lg-12">
            <form action="{{ action('InicioController@formColabora') }}" method="post" role="form" enctype="multipart/form-data" class="php-email-form-madro">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="{{__('colabora.nombre')}}" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="{{__('colabora.correo')}}" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <select class="form-select" name="asunto">
                  <option selected disabled>{{__('colabora.select')}}</option>
                  <option value="{{__('colabora.op1')}}">{{__('colabora.op1')}}</option>
                  <option value="{{__('colabora.op2')}}">{{__('colabora.op2')}}</option>
                </select>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="{{__('colabora.mensaje')}}" required></textarea>
              </div>

              <div class="text-center"><button type="submit">{{__('colabora.boton')}}</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

    

  </main><!-- End #main -->

@endsection