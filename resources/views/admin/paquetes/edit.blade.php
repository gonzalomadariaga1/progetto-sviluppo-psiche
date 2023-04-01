@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.paquetes.headersection',['title' => 'Editar paquete'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{ action('PaquetesController@update', $row->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Editar paquete</div>
              <div class="card-body">
                <br>
                  
                <div class="row">
                  <div class="col-lg-6 col-xs-12">

                    {{-- Card nombre Modalidad italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre del paquete - IT   <span class="fi fi-it"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <input type="text" name="name_it" class="form-control"  placeholder="paquete italiano" value="{{ $row->name_it }}" style="margin-top:5px;" >
                              </div>
                          </div>
                        </div> 
                      </div>
                      
                    </div>

              


                    
                  </div>

                  <div class="col-lg-6 col-xs-12">
                    {{-- Card nombre Modalidad español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre del paquete - ES   <span class="fi fi-es"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <input type="text" name="name_es" class="form-control"  placeholder="modalidad español" value="{{ $row->name_es }}" style="margin-top:5px;" >
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>




                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Duración </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body mt-3">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <input type="number" name="duracion" class="form-control"  placeholder="Ingrese minutos de duración" value="{{$row->duracion}}"  >
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Precio </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body mt-3">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <input type="number" name="precio" class="form-control"  placeholder="Ingrese precio en euros" value="{{$row->precio}}"  >
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Descuento </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body mt-3">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <input type="number" name="descuento" class="form-control"  placeholder="Ingrese descuento en euros" value="{{$row->descuento}}"  >
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Especialista </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body mt-3">
                        <div class="col-lg-12 col-xs-12">
                          <div class="form-group">
                            <select name="user_id" id="user_id" class="form-select" >
                               
                              @foreach($especialistas as $sucu)
                                 @if($sucu->id == $row->user_id)
                                     <option value="{{$sucu->id}}" selected> {{ $sucu->name}}</option>
                                 @elseif($sucu->id != $row->user_id)
                                     <option value="{{$sucu->id}}" id="sucursal_{{$sucu->id}}" > {{ $sucu->name}}</option>
                                 @endif
                             @endforeach  
                           </select>                        </div>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
                
              </div>
              <div class="card-footer">
                <div class="form-group pt-2">
                  <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>
                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Editar">
                </div>
              </div>
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>

    
  </main>
@endsection