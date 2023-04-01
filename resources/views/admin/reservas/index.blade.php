@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.reservas.headersection',['title' => 'Pagina de inicio de reservas'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Lista de las reservas por confirmar.</h4>
                </div>
                <div class="col-md-2">
                    <a href="{{route('admin.reservas.cuenta-bancaria')}}" class="btn btn-primary-violet btn-sm float-md-end" 
                    role="button" aria-pressed="true" style="margin-bottom: 5px;">Datos cuenta bancaria</a>
                </div>
              </div>
            </div>
    
            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Id</th>
                      <th>P. Nombres</th>
                      <th>P. Apellidos</th>
                      <th>Dia</th>
                      <th>Hora</th>
                      <th>Servicio</th>
                      <th>Modalidad</th>
                      <th>Cupón</th>
                      <th>Precio</th>
                      <th>Estado</th>
                      <th>Acciones</th>                     
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->paciente_nombres}}</td>
                            <td>{{ $row->paciente_apellidos}}</td>
                            <td>{{ $row->dia}}</td>
                            <td>{{ $row->hora_inicio}} - {{ $row->hora_fin}}</td>
                            <td>{{ $row->servicio['name_es'] }}</td>
                            <td>{{ $row->modalidad['name_es']}}</td>
                            <td>
                              @if ( is_null($row->cupon_id) )
                                No utilizó
                              @else
                                {{ $row->cupon['codigo'] }}
                              @endif
                            </td>
                            <td>{{ $row->valor}} euros</td>
                            <td>
                              @if($row->estado == 'PENDIENTE')
                                <div class="text-center"><span class="badge bg-secondary">PENDIENTE</span></div>
                              @endif
                              @if($row->estado == 'APROBADA')
                                <div class="text-center"><span class="badge bg-success">APROBADA</span></i></div>
                              @endif
                              @if($row->estado == 'ANULADA')
                                <div class="text-center"><span class="badge bg-danger">ANULADA</span></i></div>
                              @endif
                            </td>
                            <td>
                              @if($row->estado == 'PENDIENTE')
                              <a href="{{URL::action('ReservasController@show',$row->id)}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-eye-fill"></i></a>
                              <a href="{{URL::action('ReservasController@aprobar_cita',$row->id)}}" class="btn btn-success btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-check-lg"></i></a>
                              <a href="{{URL::action('ReservasController@rechazar_cita',$row->id)}}" class="btn btn-danger btn-sm mb-1" ><i class="bi bi-x-lg"></i></a>
                              @endif
                              @if($row->estado == 'APROBADA')
                              <a href="{{URL::action('ReservasController@show',$row->id)}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-eye-fill"></i></a>
                              <a href="{{URL::action('ReservasController@rechazar_cita',$row->id)}}" class="btn btn-danger btn-sm mb-1" ><i class="bi bi-x-lg"></i></a>
                              @endif
                              @if($row->estado == 'ANULADA')
                              <a href="{{URL::action('ReservasController@show',$row->id)}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-eye-fill"></i></a>
                              <a href="{{URL::action('ReservasController@aprobar_cita',$row->id)}}" class="btn btn-success btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-check-lg"></i></a>
                              
                              @endif
                              
                          </td>
                        </tr>
                        @endforeach
                    
                    </tbody>
                </table>
              </div>
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