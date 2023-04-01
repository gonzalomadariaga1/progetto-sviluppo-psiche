<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Progetto Sviluppo Psiche </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
  <link href="{{asset('assets_admin/vendor/datetimepicker/build/jquery.datetimepicker.min.css')}}" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/helper.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

  @stack('styles')


</head>

<body>

  @include('cookieConsent::index')

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        {{-- <h1 class="text-light" style="font-family:'Calibri, sans-serif';" ><a href="/"><span>{{__('menu.titulo')}}</span> </a></h1> --}}
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="http://www.pspsiche.com"><img src="assets/img/logo.jpg" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="crema" href="/">{{__('menu.home')}}</a></li>
          
          <li><a class="crema" href="/about">{{__('menu.about')}}</a></li>
          <li><a class="crema" href="/services">{{__('menu.services')}}</a></li>
          <li><a class="crema" href="/tarifas">{{__('menu.tarifas')}}</a></li>
          <li><a class="crema" href="/reservar">{{__('menu.reserva')}}</a></li>

          
          <li><a class="crema" href="/faq">{{__('menu.faq')}}</a></li>

          
          <li><a class="crema" href="/blog">{{__('menu.blog')}}</a></li>
          {{-- <li class="dropdown"><a href="#"><span>{{__('menu.otros')}}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="/contact">{{__('menu.contact')}}</a></li>
              <li><a href="/colabora">{{__('menu.colabora')}}</a></li>
              <li><a href="/faq">{{__('menu.faq')}}</a></li>
              <li><a href="/login">{{__('menu.login')}}</a></li>
            </ul>
          </li> --}}
          <li class="dropdown">
            <a class="nav-link dropdown-toggle crema" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="fi fi-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
            </a>
            <ul>
              @foreach (Config::get('languages') as $lang => $language)
                  @if ($lang != App::getLocale())
                          <li><a class="crema-dropdown" href="{{ route('lang.switch', $lang) }}"> <span class="fi fi-{{$language['flag-icon']}}"></span> {{$language['display']}}</a></li>
                  @endif
              @endforeach
            </ul>
            
        </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
        
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  @yield('contenido')

  

  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

    @php
        use App\LinkUtil;
        use App\LinksRedes;
        use App\ContactoFooter;
        use App\InfoFooter;

        $linksutiles = LinkUtil::all();
        $contacto = ContactoFooter::all();
        $info = InfoFooter::all();
        $redes = LinksRedes::all();

        
    @endphp

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-links">
            {{-- <h4>{{ app()->getLocale() }}</h4> --}}
            <h4 class="crema">{{__('menu.useful')}}</h4>
            <ul>
              {{-- <li><i class="bx bx-chevron-right"></i> <a href="/">{{__('menu.home')}}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/reservar">{{__('menu.reserva')}}</a></li>

              <li><i class="bx bx-chevron-right"></i> <a href="/about">{{__('menu.about')}}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/services">{{__('menu.services')}}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/tarifas">{{__('menu.tarifas')}}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/blog">{{__('menu.blog')}}</a></li> --}}
              {{-- <li><i class="bx bx-chevron-right crema"></i> <a href="/terminosycondiciones">{{__('menu.terminos')}}</a></li>
              <li><i class="bx bx-chevron-right crema"></i> <a href="/politicacookies">{{__('menu.cookies')}}</a></li>
              <li><i class="bx bx-chevron-right crema"></i> <a href="/privacidad">{{__('menu.privacy')}}</a></li>
              <li><i class="bx bx-chevron-right crema"></i> <a href="">{{__('menu.consenso')}}</a></li>
              <li><i class="bx bx-chevron-right crema"></i> <a href="/colabora">{{__('menu.colabora')}}</a></li>
              <li><i class="bx bx-chevron-right crema"></i> <a href="/login">{{__('menu.login')}}</a></li> --}}

              
              @for ($i = 0; $i <= 2; $i++)
                  <li>
                    <i class="bx bx-chevron-right crema"></i> 
                    <a href="{{$linksutiles[$i]->link}}">
                      {{$linksutiles[$i]->{'link_'.app()->getLocale()} }}
                    </a>
                  </li>
              @endfor
              

              <li>
                <i class="bx bx-chevron-right crema"></i> 
                <a href="{{$linksutiles[3]->link}}{{app()->getLocale()}}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  {{$linksutiles[3]->{'link_'.app()->getLocale()} }}
                </a>
              </li>

              @for ($i = 4; $i <= 5; $i++)
                  <li>
                    <i class="bx bx-chevron-right crema"></i> 
                    <a href="{{$linksutiles[$i]->link}}">
                      {{$linksutiles[$i]->{'link_'.app()->getLocale()} }}
                    </a>
                  </li>
              @endfor
              
            </ul>
          </div>

          

          

          <div class="col-lg-4 col-md-6 footer-contact">
            <h4 class="crema">{{__('menu.contact')}}</h4>
            {{-- <p>
              {{__('menu.contati')}} <br><br>
              <strong>Tel:</strong> xxxxxx<br>
              <strong>Email:</strong> xxxxx<br>
              <strong>{{__('menu.sede')}}:</strong> xxxxxxx
            </p> --}}
            {!! $contacto[0]->{'content_'.app()->getLocale()} !!}

          </div>

          <div class="col-lg-4 col-md-6 footer-info">
            <h3 class="crema">Info</h3>

            {!! $info[0]->{'content_'.app()->getLocale()} !!}

            <div class="social-links mt-3">

              @foreach ($redes as $red)
                <a href="{{$red->link}}"><i class="bi {{$red->icono}}"></i></a>
              @endforeach

              

            </div>
          </div>

        </div>
        {{-- <div class="row">
          <div class="copyright">
            &copy; Copyright <strong><span>Madro</span></strong>. All Rights Reserved
          </div>
        </div> --}}
      </div>
    </div>

    {{-- <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Madro</span></strong>. All Rights Reserved
      </div>

    </div> --}}
  </footer><!-- End Footer -->

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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{asset('assets_admin/vendor/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>

  <!-- Template Main JS File -->
  
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Vendor JS Files -->
  
  <script src="{{asset('assets/vendor/purecounter/purecounter.js')}}"></script>
  
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/typehead/typeahead.bundle.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>

  

  

  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>



  <script src="{{asset('assets/js/main.js')}}"></script>
  @include('sweetalert::alert')
  @yield('code_js')
  @stack('scripts')

</body>

</html>