<?php 
  use App\User;
?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Psiche Admin </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets_admin/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets_admin/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets_admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/fileinput/css/fileinput.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/datetimepicker/build/jquery.datetimepicker.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.css')}}" rel="stylesheet">

  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.css">

  <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
  {{-- DataTables --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

  {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}

  {{-- Select2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="{{asset('assets_admin/css/style.css')}}" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('home')}}" class="logo d-flex align-items-center">
        <img src="{{asset('assets_admin/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">PSP Admin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('assets_admin/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
                
              {{Auth::user()->name}}
              
            </h6>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>



            

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar Sesión</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


      {{-- MENU DE ADMINISTRACION --}}

        @if (auth()->user()->can('admin-user-show') ||
                  auth()->user()->can('admin-role-show') ||
                  auth()->user()->can('admin-permission-show')
              )
            <li class="nav-item">
              <a 
                class="nav-link @if ( (request()->segment(1) == 'users') || 
                                      (request()->segment(1) == 'permisos') || 
                                      (request()->segment(1) == 'roles') ) 
                                      ''
                                  @else
                                  collapsed
                                  @endif
                        "
                data-bs-target="#components-nav" 
                data-bs-toggle="collapse" 
                href="#">
                <span>Control de Acceso</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul 
                id="components-nav" 
                class="nav-content @if ( (request()->segment(1) == 'users') || 
                                            (request()->segment(1) == 'permisos') || 
                                            (request()->segment(1) == 'roles') ) 
                                            collapse show
                                        @else
                                          collapse
                                        @endif
                                        "
                data-bs-parent="#sidebar-nav">

                @can('admin-user-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'users') ? '' : 'collapsed' }}" href="{{route('admin.users.index')}}" >
                      <i class="bi bi-person"></i>
                      <span>Usuarios</span>
                    </a>
                  </li>
                @endcan

                @can('admin-permission-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'permisos') ? '' : 'collapsed' }}" href="{{route('admin.permission.index')}}" >
                    
                      <i class="bi bi-file-earmark-lock2-fill"></i>
                      <span>Permisos</span>
                    </a>
                  </li>
                @endcan

                @can('admin-role-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'roles') ? '' : 'collapsed' }}" href="{{route('admin.role.index')}}" >
                    
                      <i class="bi bi-person-lines-fill"></i>
                      <span>Roles</span>
                    </a>
                  </li>
                @endcan
              </ul>
            </li><!-- End Components Nav -->
        @endif
      {{-- FIN MENU DE ADMINISTRACION--}}

      {{-- MENU DE BLOG --}}
        @if( auth()->user()->can('admin-post-show') || auth()->user()->can('admin-categoria-show') ||  auth()->user()->can('admin-etiqueta-show') ) 
            
              <li class="nav-item">
                <a 
                  class="nav-link @if ( (request()->segment(1) == 'posts') || 
                                      (request()->segment(1) == 'categorias') || 
                                      (request()->segment(1) == 'etiquetas') ) 
                                      ''
                                  @else
                                  collapsed
                                  @endif
                        " 
                  data-bs-target="#components-nav1" 
                  data-bs-toggle="collapse" 
                  href="#">
                  <span>Blog</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul 
                    id="components-nav1" 
                    class="nav-content @if ( (request()->segment(1) == 'posts') || 
                                            (request()->segment(1) == 'categorias') || 
                                            (request()->segment(1) == 'etiquetas') ) 
                                            collapse show
                                        @else
                                          collapse
                                        @endif
                                        "
                    data-bs-parent="#sidebar-nav">

                  @can('admin-user-show')
                    <li>
                      <a class="nav-link {{ (request()->segment(1) == 'posts') ? '' : 'collapsed' }}" href="{{route('admin.posts.index')}}" >
                    
                        <i class="bi bi-file-post"></i>
                        <span>Posts</span>
                      </a>
                    </li>
                  @endcan

                  @can('admin-permission-show')
                    <li>
                      <a class="nav-link {{ (request()->segment(1) == 'categorias') ? '' : 'collapsed' }}" href="{{route('admin.categorias.index')}}" >
                    
                        <i class="bi bi-bookmark"></i>
                        <span>Categorias</span>
                      </a>
                    </li>
                  @endcan

                  @can('admin-role-show')
                    <li>
                      <a class="nav-link {{ (request()->segment(1) == 'etiquetas') ? '' : 'collapsed' }}" href="{{route('admin.etiquetas.index')}}" >
                    
                    <i class="bi bi-tag"></i>
                    <span>Etiquetas</span>
                  </a>
                    </li>
                  @endcan
                </ul>
              </li><!-- End Components Nav -->

        


        @endif
      {{-- FIN MENU DE BLOG --}}
      
      {{-- MENU DE AGENDA --}}
        @if( auth()->user()->can('admin-miagenda-show') || 
              auth()->user()->can('admin-horario-show') ||  
              auth()->user()->can('admin-etiqueta-show') || 
              auth()->user()->can('admin-cuentabancaria') || 
              auth()->user()->can('admin-reservasporconfirmar') || 
              auth()->user()->can('admin-servicios-show') || 
              auth()->user()->can('admin-paquetes-show') || 
              auth()->user()->can('admin-cupones-show')  
            )
          <li class="nav-item">
            <a 
              class="nav-link @if ( (request()->segment(1) == 'agenda') || 
                                  (request()->segment(1) == 'horario') || 
                                  (request()->segment(1) == 'reservas') || 
                                  (request()->segment(1) == 'modalidad') || 
                                  (request()->segment(1) == 'servicios') || 
                                  (request()->segment(1) == 'paquetes') ||
                                  (request()->segment(1) == 'cupones') ) 
                                  ''
                              @else
                              collapsed
                              @endif
                    " 
              data-bs-target="#components-nav2" 
              data-bs-toggle="collapse" 
              href="#">
              <span>Agenda</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul 
                id="components-nav2" 
                class="nav-content @if ( (request()->segment(1) == 'agenda') || 
                                          (request()->segment(1) == 'horario') || 
                                          (request()->segment(1) == 'reservas') || 
                                          (request()->segment(1) == 'modalidad') || 
                                          (request()->segment(1) == 'servicios') ||
                                          (request()->segment(1) == 'paquetes') || 
                                          (request()->segment(1) == 'cupones') ) 
                                        collapse show
                                    @else
                                      collapse
                                    @endif
                                    "
                data-bs-parent="#sidebar-nav">

              
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'agenda') ? '' : 'collapsed' }}" href="{{route('admin.agenda.index')}}" >
                    
                    <i class="bi bi-calendar3"></i>
                    <span>Agenda</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'horario') ? '' : 'collapsed' }}" href="{{route('admin.horario.index')}}" >
                    
                    <i class="bi bi-calendar-check"></i>
                    <span>Horario</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'reservas') ? '' : 'collapsed' }}" href="{{route('admin.reservas.index')}}" >
                    
                    <i class="bi bi-card-checklist"></i>
                    <span>Reservas por confirmar</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'modalidad') ? '' : 'collapsed' }}" href="{{route('admin.modalidad.index')}}" >
                    
                    <i class="bi bi-webcam-fill"></i>
                    <span>Modalidad</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'servicios') ? '' : 'collapsed' }}" href="{{route('admin.servicios.index')}}" >
                    
                    <i class="bi bi-clipboard-check"></i>
                    <span>Servicios</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'paquetes') ? '' : 'collapsed' }}" href="{{route('admin.paquetes.index')}}" >
                    
                    <i class="bi bi-box-seam"></i>
                    <span>Paquetes</span>
                  </a>
                </li>

                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'cupones') ? '' : 'collapsed' }}" href="{{route('admin.cupones.index')}}" >
                    
                    <i class="bi bi-gift"></i>
                    <span>Cupones</span>
                  </a>
                </li>
              
            </ul>
          </li><!-- End Components Nav -->
        @endif
      {{-- FIN MENU DE AGENDA --}}

      
      {{-- MENU DE ADMINISTRACION DE PÁGINAS --}}
        @if( auth()->user()->can('admin-faq-show') || 
              auth()->user()->can('admin-policycookies-show') ||  
              auth()->user()->can('admin-privacidad-show') ||
              auth()->user()->can('admin-termino-show') ||
              auth()->user()->can('admin-carouseltarifas-show') 
            )
          <li class="nav-item">
            <a 
              class="nav-link @if ( (request()->segment(1) == 'adminfaq') || 
                                  (request()->segment(1) == 'terms') || 
                                  (request()->segment(1) == 'policycookies') || 
                                  (request()->segment(1) == 'carouseltarifas') || 
                                  (request()->segment(1) == 'privacy')  ) 
                                  ''
                              @else
                              collapsed
                              @endif
                    " 
              data-bs-target="#components-nav3" 
              data-bs-toggle="collapse" 
              href="#">
              <span>Administración de páginas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul 
                id="components-nav3" 
                class="nav-content @if ( (request()->segment(1) == 'adminfaq') || 
                                          (request()->segment(1) == 'terms') || 
                                          (request()->segment(1) == 'policycookies') || 
                                          (request()->segment(1) == 'carouseltarifas') || 
                                          (request()->segment(1) == 'privacy')  ) 
                                        collapse show
                                    @else
                                      collapse
                                    @endif
                                    "
                data-bs-parent="#sidebar-nav">

              
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'adminfaq') ? '' : 'collapsed' }}" href="{{route('admin.faq.index')}}" >
              
                    <i class="bi bi-question-diamond"></i>
                    <span>F.A.Q.</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'terms') ? '' : 'collapsed' }}" href="{{route('admin.terms.index')}}" >
              
                    <i class="bi bi-journal-text"></i>
                    <span>Términos y condiciones</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'policycookies') ? '' : 'collapsed' }}" href="{{route('admin.policycookies.index')}}" >
              
                    <i class="bi bi-file-earmark-ruled"></i>
                    <span>Política de Cookies</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'privacy') ? '' : 'collapsed' }}" href="{{route('admin.privacy.index')}}" >
              
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Política de Privacidad</span>
                  </a>
                </li>
                
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'carouseltarifas') ? '' : 'collapsed' }}" href="{{route('admin.carouseltarifas.index')}}" >
              
                    <i class="bi bi-align-center"></i>
                    <span>Carousel de tarifas</span>
                  </a>
                </li>
            </ul>
          </li><!-- End Components Nav -->
        @endif

      {{-- FIN MENU DE ADMINISTRACION DE PÁGINAS --}}
      
      {{-- MENU DE FOOTER --}}
        @if( auth()->user()->can('admin-contactofooter-show') || 
              auth()->user()->can('admin-infofooter-show') ||  
              auth()->user()->can('admin-linksutiles-show') ||  
              auth()->user()->can('admin-linksredes-show') )
          <li class="nav-item">
            <a 
              class="nav-link @if ( (request()->segment(1) == 'linksutiles') || 
                                  (request()->segment(1) == 'contactofooter') || 
                                  (request()->segment(1) == 'infofooter') || 
                                  (request()->segment(1) == 'linksredes')  ) 
                                  ''
                              @else
                              collapsed
                              @endif
                    " 
              data-bs-target="#components-nav4" 
              data-bs-toggle="collapse" 
              href="#">
              <span>Elementos del footer</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul 
                id="components-nav4" 
                class="nav-content @if ( (request()->segment(1) == 'linksutiles') || 
                                          (request()->segment(1) == 'contactofooter') || 
                                          (request()->segment(1) == 'infofooter') || 
                                          (request()->segment(1) == 'linksredes')  ) 
                                        collapse show
                                    @else
                                      collapse
                                    @endif
                                    "
                data-bs-parent="#sidebar-nav">

              
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'linksutiles') ? '' : 'collapsed' }}" href="{{route('admin.linksutiles.index')}}" >
            
                    <i class="bi bi-link"></i>
                    <span>Links útiles</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'contactofooter') ? '' : 'collapsed' }}" href="{{route('admin.contactofooter.index')}}" >
            
                    <i class="bi bi-person-rolodex"></i>
                    <span>Contacto</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'infofooter') ? '' : 'collapsed' }}" href="{{route('admin.infofooter.index')}}" >
            
                    <i class="bi bi-info-circle"></i>
                    <span>Info</span>
                  </a>
                </li>
          
                <li>
                  <a class="nav-link {{ (request()->segment(1) == 'linksredes') ? '' : 'collapsed' }}" href="{{route('admin.linksredes.index')}}" >
            
                    <i class="bi bi-hand-index"></i>
                    <span>Redes sociales</span>
                  </a>
                </li>  
            </ul>
          </li><!-- End Components Nav -->
        @endif
      {{-- FIN MENU DE FOOTER --}}
    

    </ul>

  </aside><!-- End Sidebar-->

  @yield('contenido')
  

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Madro</span></strong>. All Rights Reserved
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <!-- Template Main JS File -->
   <script src="{{asset('assets_admin/js/main.js')}}"></script>
   <script src="{{ asset('js/app.js') }}"></script>
   
  <!-- Vendor JS Files -->
  <script src="{{asset('assets_admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/fileinput/js/fileinput.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
  
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales-all.js"></script>

 <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
 
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>
 
 
<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/es.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>



<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


  


 

  {{-- DataTables --}}
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

  {{-- Select2 --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
  @include('sweetalert::alert')
  @yield('code_js')

</body>

</html>