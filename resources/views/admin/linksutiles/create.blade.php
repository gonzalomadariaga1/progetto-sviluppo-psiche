@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.linksutiles.headersection',['title' => 'Crear link'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('LinksUtilesController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de link útil</div>
              <div class="card-body">
                <br>
                  
                  <div class="row">
                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre del link - IT   <span class="fi fi-it"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="link_it" class="form-control"  placeholder="Link italiano" value="{{ old('link_it') }}" style="margin-top:5px;" >
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>



                      
                    </div>

                    <div class="col-lg-6 col-xs-12">
                      {{-- Card nombre categoria español --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre del link - ES   <span class="fi fi-es"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="link_es" class="form-control"  placeholder="Link español" value="{{ old('link_es') }}" style="margin-top:5px;" >
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
                                <h4>URL </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="link" class="form-control"  placeholder="Ingrese URL" value="{{ old('link') }}" style="margin-top:5px;" >
                                    <small>Ejemplo: https://www.madro.cl o si la URL corresponde a una del sitio de inicio, solo anteponga un '/'. </small>
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

