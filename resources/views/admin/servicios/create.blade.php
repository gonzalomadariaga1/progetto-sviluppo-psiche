@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.servicios.headersection',['title' => 'Crear categoría'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('ServiciosController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de servicio</div>
              <div class="card-body">
                <br>
                  
                  <div class="row">
                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre del servicio - IT   <span class="fi fi-it"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="name_it" class="form-control"  placeholder="Servicios italiano" value="{{ old('name_it') }}" style="margin-top:5px;" >
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>



                      
                    </div>

                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre del servicio - ES   <span class="fi fi-es"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body" style="margin-top:5px;" >        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="name_es" class="form-control"  placeholder="Servicios español" value="{{ old('name_es') }}" >
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>



                      
                    </div>

                    
                  </div>

                  <div class="row">


                    <div class="col-lg-6 col-xs-12">
                      {{-- Card nombre categoria español --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Especialista </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body" style="margin-top:15px;">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                            
                                <select class="select2" name="user_id" id="user_id" style=" width:100%;  ">
                                  <option value="0" disabled selected>Seleccione especialista...</option>
                                  @foreach ($user as $user)
                                      
                                      <option value="{{ $user->id }}" > 
                                        {{$user->name}} </option>
                                  @endforeach
                                </select>  
      
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

@section('code_js')
<script>
  $(document).ready(function() {
      $('#user_id').select2();

    });
</script>
@endsection
