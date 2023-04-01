@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.cupones.headersection',['title' => 'Ver cupón'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Detalles del cupón</div>
              <div class="card-body">
                <br>
                  


                <div class="row">
                  <div class="col-lg-4 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Código </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">{{ $row->codigo }} </p>
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
                              <h4>Tipo de cupón </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">{{ $row->tipo }} </p>
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
                              <h4>Valor del descuento </h4>  
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <p style="margin-top:5px;">
                                @if ( $row->tipo == 'cantidadfija')
                                    {{ $row->valor }} euros
                                @else
                                    {{ $row->valor }}%
                                @endif
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
                                <h4>¿Tiene límite? </h4>  
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                              <p style="margin-top:5px;">
                                @if($row->limite_uso == 0)
                                    No, no tiene limite.
                                @else
                                    Si, tiene límite.
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
                                <h4>Cantidad de cupones</h4>  
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="col-lg-8 col-xs-12">
                            <div class="form-group">
                                <p style="margin-top:5px;">
                                    @if($row->limite_uso == 0)
                                        No aplica ya que no tiene limite.
                                    @elseif ($row->limite_uso == 1 AND $row->quedan_por_usar > 1 )
                                        {{ $row->quedan_por_usar }} cupones.
                                    @elseif($row->limite_uso == 1 AND $row->quedan_por_usar == 0)
                                        No quedan cupones.
                                    @else
                                        {{ $row->quedan_por_usar }} cupón.
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
                                <h4> Cantidad de uso  </h4>  
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="col-lg-10 col-xs-12">
                            <div class="form-group">
                              <p style="margin-top:5px;">
                                  @if ( $row->multi_uso == 1)
                                      El paciente puede utilizarlo una sola vez.
                                  @else
                                      El paciente puede utilizarlo mas de una vez.
                                  @endif
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