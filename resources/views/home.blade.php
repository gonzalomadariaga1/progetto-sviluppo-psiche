@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total de citas confirmadas</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $citasconfirmadas }}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Total ganancia por cita</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-euro"></i>
                    </div>
                    <div class="ps-3">
                      <h6> {{$ganancia}} </h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Citas por confirmar </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-list-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $citasporconfirmar }}</h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Últimas citas confirmadas</h5>

                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($citas as $cita)
                      <tr>
                        <th scope="row"><a href="#">{{ $cita->id }}</a></th>
                        <td>{{ $cita->paciente_nombres }} {{ $cita->paciente_apellidos }}</td>
                        <td>{{ $cita->dia }} {{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                      </tr>
                      @endforeach
                      

                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

          

            

          </div>
        </div><!-- End Left side columns -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Últimos posts publicados</span></h5>
      
              <div class="news">
                @foreach ($recent_posts as $post)

                  <div class="post-item clearfix">
                    @if ($post->images->count() == 1)
                      <img src="{{$post->images->first()->url}}" alt="">
                      <h4><a href="{{ route('blog_details' , $post) }}" target="_blank">{{$post->title_es }}</a></h4>
                      <p>{{$post->resumen_es }}</p>
                    @elseif( $post->images->count() > 1 )
                      <img src="{{$post->images->first()->url}}" alt="">
                      <h4><a href="{{ route('blog_details' , $post) }}" target="_blank">{{$post->title_es }}</a></h4>
                      <p>{{$post->resumen_es }}</p>
                    @elseif( $post->iframe )
                      <img src="{{asset('assets_admin/img/news-1.jpg')}}" alt="">
                      <h4><a href="{{ route('blog_details' , $post) }}" target="_blank">{{$post->title_es }}</a></h4>
                      <p>{{$post->resumen_es }}</p>
                    @endif
                  </div>
                    
                @endforeach

                <br>
      
              </div><!-- End sidebar recent posts-->
      
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </main>
@endsection

