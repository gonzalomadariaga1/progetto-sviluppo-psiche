@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.horario.headersection',['title' => 'Editar horario'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{ action('HorarioController@update', $horario->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
              <div class="card">
                @include('includes.form-error')
                <div class="card-header">Editar horario</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      <div class="form-group">
                        <label for="">Especialista</label>
                        <select name="especialista_id" id="especialista_id" class="form-select" >
                               
                          @foreach($especialistas as $sucu)
                             @if($sucu->id == $horario->especialista_id)
                                 <option value="{{$sucu->id}}" selected> {{ $sucu->name}}</option>
                             @elseif($sucu->id != $horario->especialista_id)
                                 <option value="{{$sucu->id}}" id="sucursal_{{$sucu->id}}" > {{ $sucu->name}}</option>
                             @endif
                         @endforeach  
                       </select>
                      </div>
                      <br>
                      <label for="oldfecha">Fecha actual</label>
                      <div class="form-group input-group">
                        <input class="form-control" type="text" name="oldfecha" readonly value="{{ $horario->dia }}">
                        <button class="btn btn-primary-violet" type="button" id="button-addon2" onclick="nuevafecha()">Actualizar fecha</button>
                      </div>
                      <br>
                      
                        {{-- <div class="d-inline col-lg-4">
                        </div> --}}

                        <div class="row">
                          <div class="col">
                            <label for="inputMDEx1">Hora inicio:</label>
                            <input type="time" id="inputMDEx1" name="hora_inicio" value="{{ $horario->hora_inicio }}" class="d-inline form-control">
                          </div>
                          <div class="col">
                            <label for="inputMDEx1">Hora fin:</label>
                            <input type="time" id="inputMDEx1" name="hora_fin" value="{{ $horario->hora_fin }}" class="d-inline form-control">
                          </div>
                        </div>
                        
                      
                      


                    </div>
                    <div class="col-lg-6 col-xs-12">

                      <div id="div_newfecha">
                        <label for="newfecha">Seleccione nueva fecha</label>
                        {{-- <input type="date" name="newfecha" id="newfecha" class="form-control"> --}}
                        <div  id="datepicker" ></div>
                        <input type="hidden" id="my_hidden_input" name="newfecha">
                      </div>
                      
                    </div>
                  </div>
                  

                  

                  
                    
                  
                </div>
                <div class="card-footer">
                  <div class="form-group pt-2">
                    <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Editar">
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
  $("#div_newfecha").hide();
  function nuevafecha(){
    console.log("click");

    $('#datepicker').datepicker({
      format: 'dd-mm-yyyy',
      language: "es",


    })

    $('#datepicker').on('changeDate', function() {
      $('#my_hidden_input').val(
          $('#datepicker').datepicker('getFormattedDate')
      );
    });
    $("#div_newfecha").show();

  }
</script>

@endsection
