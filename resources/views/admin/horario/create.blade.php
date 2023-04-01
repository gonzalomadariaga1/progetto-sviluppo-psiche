@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.horario.headersection',['title' => 'Añadir nuevo horario'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form id="form" method="POST" action="{{ action('HorarioController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Añadir horario</div>
              <div class="card-body">
                <br>

                  
                  
                  <div id="stepper1" class="bs-stepper linear">
                    <div class="bs-stepper-header">
                      <div class="step" data-target="#test-l-1">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Especialista</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#test-l-2">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Días</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#test-l-3">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Horas</span>
                        </button>
                      </div>

                    </div>
                    <div class="bs-stepper-content">
                      <div id="test-l-1" class="content">
                        
                            <div class="row">
                              <div class="col-lg-2 col-xs-12"></div>
                              <div class="col-lg-4 col-xs-12">
                                
                                  <select name="especialista_id" id="especialista_id" class="form-select mb-2"   >
                                    <option value="0" selected disabled>Seleccione especialista</option>
                                    @foreach($users as $especialista)

                                    <option value="{{$especialista->id}}">{{ $especialista->name}}</option>
                                    @endforeach
                                  </select>
                                
                              </div>
                              <div class="col-lg-4 col-xs-12">
                                
                                <select name="modalidad_id" id="modalidad_id" class="form-select mb-2"   >
                                  <option value="0" selected disabled>Seleccione modalidad</option>
                                  @foreach($modalidades as $modalidad)

                                  <option value="{{$modalidad->id}}">{{ $modalidad->name_es}}</option>
                                  @endforeach
                                </select>
                              
                            </div>
                              <div class="col-lg-2 col-xs-12"></div>
                            </div>
                          
                        <button type="button" class="btn btn-primary" onclick="stepper1.next()">Siguiente</button>
                      </div>

                      <div id="test-l-2" class="content">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header">
                                <h5>Seleccione días disponibles</h5>
                              </div>
      
                              <div class="card-body">
                                <div class="d-flex justify-content-center">
                                  <div  id="datepicker" ></div>
                                  <div id="inputs_hidden"></div>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Atrás</button>
                        <button type="button" class="btn btn-primary" onclick="paso1_to_paso2()">Siguiente</button>
                        
                      </div>
                      <div id="test-l-3" class="content">

                        <div class="row">
                          <div class="col-lg-1"></div>
                          <div class="col-lg-10 col-sm-12 col-md-12 col-xs-12 table-responsive">

                            <table id="horario" class="table table-striped" style="border-radius: 4px;">
                                <thead style="background-color:#dec7fc; " >
                                    <th>Hora inicio</th>
                                    <th>Hora final</th>
                                    
                                    <th><button type="button" class="btn btn-sm btn-success-violet" onclick="agregarNew()"> <i class="bi bi-plus-lg"></i> Añadir hora </button></th>
                                    
                                </thead>
      
                                <tbody>
      
      
                                </tbody>
                            </table>
                          </div>
                          <div class="col-lg-1"></div>
                        </div>
                        
                        <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Atrás</button>
                        <input  class="btn btn-success-violet submit-prevent-button" type="submit" value="Finalizar">
                        
                      </div>
                    </div>
                  </div>
      
                  
              {{-- <div class="card-footer">
                <div class="form-group pt-2">
                  
                </div>
              </div> --}}
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>
  </main>
@endsection
@section('code_js')
<script>
  var dias_array = [];

  $('#datepicker').datepicker({
    format: 'dd-mm-yyyy',
    language: "es",
    multidate:true,
    todayHighlight: true,
    clearBtn: true,
  }).on('changeDate', showTestDate);

   var stepper1 = new Stepper(document.querySelector('#stepper1'), {
      animation: true
    })

    

    function paso1_to_paso2(){
      var value_especialista = $("#especialista_id :selected").val();
      console.log(value_especialista);

      dias_array.forEach(function(elemento){
        var inphidden = '<input type="hidden" name="dia[]" value="'+elemento+ '">';
        $('#inputs_hidden').append(inphidden);
      });


      stepper1.to(3);

      // if ( value_servicio == '' ){
      //   Swal.fire({
      //       icon: 'error',
      //       title: '{{__('blog.blog-detail')}}',
      //       confirmButtonText: 'OK',
      //       footer: '',
      //       showCloseButton: true,
      //       timer: 5000
      //   })
      // }else if(value_modalidad == ''){
      //   Swal.fire({
      //       icon: 'error',
      //       title: 'Seleccione modalidad',
      //       confirmButtonText: 'OK',
      //       footer: '',
      //       showCloseButton: true,
      //       timer: 5000
      //   })

      // }else{
      //   stepper1.to(2);
      // }
      

    }

  function showTestDate(evt){
    var value = $('#datepicker').datepicker('getFormattedDate');
    var fecha_selected = $('#datepicker').datepicker('getDate');
    var fecha_selected_cortada = fecha_selected.toString().slice(4,-44)
    

    dias_array = value.split(',');

    $('#DateTest').show();

    ;

    return dias_array;
  
  }

  function mostrarDivHoras(){

    $('#btnAñadir').hide();
    
    

    $('#horas').show();
    $('#btnCrear').show();
  }

  
  
  
  
  
</script>
<script>
  $('#etiquetas').select2({
    tags: true,
  });
  $('#especialistas').select2();
  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var usu_id = button.data('usuid') 
    
    var modal = $(this)
    // modal.find('.modal-footer #role_id').val(role_id)
    modal.find('form').attr('action','/users/' + usu_id);
})



var cont=0;
var detalles=0;

function agregarNew(){
    var fila = '<tr class="filas" id="fila'+cont+'">'+
            '<td><input type="time" id="inputMDEx1" name="hora_inicio[]" class="form-control"></td>'+
            '<td><input type="time" id="inputMDEx1" name="hora_fin[]" class="form-control"></td>'+
            '<td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '</tr>';
        cont++;
        detalles=detalles+1;
        $('#horario').append(fila);
}

  // $("form").submit(function () {

  //   var this_master = $(this);

  //   this_master.find('input[type="checkbox"]').each( function () {
  //       var checkbox_this = $(this);


  //       if( checkbox_this.is(":checked") == true ) {
  //           checkbox_this.attr('value','1');
  //       } else {
  //           checkbox_this.prop('checked',true);
  //           //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA    
  //           checkbox_this.attr('value','0');
  //       }
  //   });
  // });

function eliminarDetalle(indice){
    $("#fila" + indice).remove();
    
    detalles=detalles-1;
  
}
</script>
@endsection


