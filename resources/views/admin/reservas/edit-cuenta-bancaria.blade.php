@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  <form method="POST" action="{{ action('ReservasController@update', $row->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
    {{csrf_field()}}
    {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Editar datos de la cuenta bancaria</h4>
                </div>

              </div>
            </div>
    
            <div class="card-body">
              <div class="row">
                <div class="col-lg-3 col-xs-12">
                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Nombre del banco:</strong> </label>
                    <input type="text" name="banco" class="form-control"  value="{{ $row->banco }}" style="margin-top:5px;" >
                  </div>
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Tipo de cuenta:</strong> </label>
                    <input type="text" name="tipo_cuenta" class="form-control"  value="{{ $row->tipo_cuenta }}" style="margin-top:5px;" >
                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Número de cuenta:</strong> </label>
                    <input type="text" name="numero_cuenta" class="form-control"  value="{{ $row->numero_cuenta }}" style="margin-top:5px;" >
                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Nombre persona:</strong> </label>
                    <input type="text" name="nombre_persona" class="form-control"  value="{{ $row->nombre_persona }}" style="margin-top:5px;" >
                  </div>
                  
                </div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Email:</strong> </label>
                    <input type="text" name="email" class="form-control"  value="{{ $row->email }}" style="margin-top:5px;" >

                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="bic_swift"><strong>Código BIC/SWIFT:</strong> </label>
                    <input type="text" name="bic_swift" class="form-control"  value="{{ $row->bic_swift }}" style="margin-top:5px;" >

                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">
                  <div class="form-group mt-3">
                    <label for="Rut" class="mb-1"><strong>Cuenta bancaria asociada a:</strong> </label>      
                    <select class="form-select" name="especialista_id" id="especialista_id" style=" width:100%">
                      <option value="0" disabled selected>Seleccione...</option>
                      @foreach ($users as $user)
                          
                          <option value="{{ $user->id }}" {{old('especialista_id' , $row->especialista_id) == $user->id ? 'selected' : ''}}> 
                            {{$user->name}} </option>
                      @endforeach
                    </select>  

                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>
              <button type="submit" class="btn btn-success-violet">Editar</button>
            </div>
            

            
    
        
        
            
          </div>
        </div>
        
      
        
        
    </div>

  </form>
  </main>
@endsection

@section('code_js')


    
@endsection