@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.linksredes.headersection',['title' => 'Crear link'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('LinksRedesController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de link de red social</div>
              <div class="card-body">
                <br>
                  
                  

                  <div class="row">
                    <div class="col-lg-12 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre red social </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"  placeholder="Ingrese nombre red social" value="{{ old('name') }}" style="margin-top:5px;" >
                                    
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>



                      
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-lg-12 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>URL</h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="link" class="form-control"  placeholder="Ingrese URL de la red social" value="{{ old('link') }}" style="margin-top:5px;" >
                                    
                                    <small>Ejemplo: https://www.facebook.com</small>
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>



                      
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-lg-12 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Icono de la red social </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="icono" class="form-control"  placeholder="Ingrese código del icono" value="{{ old('icono') }}" style="margin-top:5px;" >
                                    <small>Los códigos de los iconos se pueden obtener en el siguiente enlace:  <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">Bootstrap Icons</a>  </small>
                                    <br>
                                    <small>Ejemplo: bi-facebook</small>
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>



                      
                    </div>

                  </div>
                  
              </div>
                  
              <div class="card-footer">
                <div class="form-group pt-2">
                  <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>

                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Crear">
                </div>
              </div>
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>
  </main>
@endsection

