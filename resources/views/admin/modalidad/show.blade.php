@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.modalidad.headersection',['title' => 'Ver modalidad'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{ action('ModalidadController@update', $row->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Detalles de la modalidad</div>
              <div class="card-body">
                <br>
                  
                <div class="row">
                  <div class="col-lg-6 col-xs-12">

                    {{-- Card nombre modalidad italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre de la modalidad - IT   <span class="fi fi-it"></span> </h4>  
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

         
                  </div>

                  <div class="col-lg-6 col-xs-12">
                    {{-- Card nombre modalidad español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre de la modalidad - ES   <span class="fi fi-es"></span> </h4>  
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
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Duración </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">{{ $row->duracion }} minutos.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Precio </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">{{ $row->precio }} euros.</p>
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