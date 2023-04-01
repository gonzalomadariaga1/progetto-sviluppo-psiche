@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Datos de la cuenta bancaria</h4>
                </div>
                <div class="col-md-2">
                    <a href="{{route('admin.reservas.edit_cuentabancaria')}}" class="btn btn-primary-violet btn-sm float-md-end" 
                    role="button" aria-pressed="true" style="margin-bottom: 5px;">Editar</a>
                </div>
              </div>
            </div>
    
            <div class="card-body">
              <div class="row">
                <div class="col-lg-3 col-xs-12">
                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Nombre del banco:</strong> </label>
                    <p>{{ $row->banco }}</p>
                  </div>
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Tipo de cuenta:</strong> </label>
                    <p>{{ $row->tipo_cuenta }}</p>
                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Número de cuenta:</strong> </label>
                    <p>{{ $row->numero_cuenta }}</p>
                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Nombre persona:</strong> </label>
                    <p>{{ $row->nombre_persona }}</p>
                  </div>
                  
                </div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Email:</strong> </label>
                    <p>{{ $row->email }}</p>
                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">

                  <div class="form-group mt-3">
                    <label for="Rut"><strong>Código BIC/SWIFT:</strong> </label>
                    <p>{{ $row->bic_swift }}</p>
                  </div>
                  
                </div>

                <div class="col-lg-3 col-xs-12">
                  <div class="form-group mt-3">
                    <label for="Rut" class="mb-1"><strong>Cuenta bancaria asociada a:</strong> </label>      
                    <select class="form-select" name="especialista_id" id="especialista_id" style=" width:100%" disabled>
                      <option value="0" disabled selected>Seleccione...</option>
                      @foreach ($users as $user)
                          
                          <option value="{{ $user->id }}" {{old('especialista_id' , $row->especialista_id) == $user->id ? 'selected' : ''}} readonly> 
                            {{$user->name}} </option>
                      @endforeach
                    </select>  

                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <a href="{{ route('admin.reservas.index') }}" class="btn btn-primary-violet"><i class="bi bi-arrow-left"></i>   Volver</a>
            </div>
            

            
    
        
        
            
          </div>
        </div>
        
      
        
        
    </div>

    @include('includes.modal-delete')
  </main>
@endsection

@section('code_js')
  <script>
      $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var usu_id = button.data('usuid')
        
        var url = '{{ route("admin.reservas.destroy", ":id") }}';
        url = url.replace(':id', usu_id);

        
        
        var modal = $(this)
        // modal.find('.modal-footer #role_id').val(role_id)
        modal.find('form').attr('action',url);
    })
  </script>
    
@endsection