@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.etiquetas.headersection',['title' => 'Ver etiqueta'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{ action('EtiquetaController@update', $row->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Detalles de la etiqueta</div>
              <div class="card-body">
                <br>
                  
                <div class="row">
                  <div class="col-lg-6 col-xs-12">

                    {{-- Card nombre etiqueta italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre de la etiqueta - IT   <span class="fi fi-it"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <p style="margin-top:5px;">{{ $row->name_it }}</p> 
                              </div>
                          </div>
                        </div> 
                      </div>
                      
                    </div>

                    {{-- Card descripcion etiqueta italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Descripción de la etiqueta - IT   <span class="fi fi-it"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <textarea name="description_it" id="" cols="30" rows="5" class="form-control" placeholder="Descripción italiano" style="margin-top:5px;" disabled>{{ $row->description_it }}</textarea>

                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>


                    
                  </div>

                  <div class="col-lg-6 col-xs-12">
                    {{-- Card nombre etiqueta español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre de la etiqueta - ES   <span class="fi fi-es"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                <p style="margin-top:5px;">{{ $row->name_es }}</p>
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>

                    {{-- Card descripcion etiqueta español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Descripción de la etiqueta - ES   <span class="fi fi-es"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <textarea name="description_es" id="" cols="30" rows="5" class="form-control" placeholder="Descripción español" style="margin-top:5px;" disabled >{{ $row->description_es }}</textarea>
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>


                  </div>
                </div>
                
              </div>
              <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>
              </div>
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>

    
  </main>
@endsection