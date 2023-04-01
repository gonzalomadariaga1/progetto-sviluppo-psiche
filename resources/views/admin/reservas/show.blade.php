@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.reservas.headersection',['title' => 'Ver reserva'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Detalles de la reserva</div>
              <div class="card-body">
                <br>
                  


                <div class="row">
                  <div class="col-lg-4 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre paciente </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-12 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">{{ $row->paciente_nombres }} {{ $row->paciente_apellidos}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Email paciente </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-12 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">{{ $row->paciente_email }} </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Telefono paciente</h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-12 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">
                                {{$row->paciente_telefono}}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  
                </div>

                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Horario de la cita </h4>  
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                              <p style="margin-top:5px;">
                                {{ $row->dia }} {{ $row->hora_inicio }} - {{ $row->hora_fin }}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
  
                    <div class="col-lg-4 col-xs-12">
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Servicio</h4>  
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="col-lg-8 col-xs-12">
                            <div class="form-group">
                                <p style="margin-top:5px;">
                                   {{ $row->servicio['name_es'] }}

                                </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
  
                    <div class="col-lg-4 col-xs-12">
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4> Modalidad </h4>  
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="col-lg-10 col-xs-12">
                            <div class="form-group">
                              <p style="margin-top:5px;">
                                {{ $row->modalidad['name_es'] }}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
  
                    
                </div>

                <div class="row">
                  <div class="col-lg-4 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Cupón</h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">
                              @if ( is_null($row->cupon_id) )
                                No utilizó cupón
                              @else
                                {{ $row->cupon['codigo'] }}
                              @endif
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Tipo de cupón y valor de descuento</h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-8 col-xs-12">
                          <div class="form-group">
                              <p style="margin-top:5px;">
                                @if ( is_null($row->cupon_id) )
                                No utilizó cupón
                              @else
                                {{ $row->cupon['tipo'] }} -  {{ $row->cupon['valor'] }}
                              @endif

                              </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4> Valor de la cita </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-10 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">
                              {{ $row->valor }} euros.
                            </p>
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
            

            
         
        </div>
        
      
        
        
    </div>

    
  </main>
@endsection