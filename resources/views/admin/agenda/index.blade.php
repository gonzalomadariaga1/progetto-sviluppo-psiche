@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.agenda.headersection',['title' => 'Página de inicio de Agenda'])

  <div class="container">
    <div  id="agenda"></div>

  </div>

  <div> 
  
  

</div>
  
    <!-- Button trigger modal -->
  

  <!-- Modal -->
  <div class="modal fade" id="evento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Información de la cita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="">

            {{ csrf_field() }}

            <div class="form-group mb-3">
              <label for="id">ID:</label>
              <input type="text" class="form-control" id="id" readonly>
              
            </div>
            
            <div class="form-group mb-3">
              <label for="nombre_completo">Nombre completo del paciente:</label>
              <input id="nombre_completo" class="form-control" readonly>
            </div>

            <div class="d-flex justify-content-between">
              <div class="form-group mb-3">
                <label for="email_paciente">Email del paciente:</label>
                <input id="paciente_email" class="form-control" readonly>
              </div>

              <div class="form-group mb-3">
                <label for="paciente_telefono">Telefono del paciente:</label>
                <input id="paciente_telefono" class="form-control" readonly>
              </div>
            </div>

            <div class="d-flex justify-content-between">
              <div class="form-group mb-3">
                  <label for="cita_fecha">Fecha cita:</label>
                  <input id="cita_fecha" class="form-control" readonly>
              </div>

              <div class="form-group mb-3">
                <label for="cita_hora">Hora cita:</label>
                <input id="cita_hora" class="form-control" readonly>
              </div>
            </div>

            <div class="d-flex justify-content-between">
              <div class="form-group mb-3">
                  <label for="cita_servicio">Servicio:</label>
                  <input id="cita_servicio" class="form-control" readonly>
              </div>

              <div class="form-group mb-3">
                <label for="cita_modalidad">Modalidad:</label>
                <input id="cita_modalidad" class="form-control" readonly>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
    
  </main>
@endsection

@section('code_js')
<script>

  document.addEventListener('DOMContentLoaded', function() {

    let formulario = document.querySelector("form");

    var calendarEl = document.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      
      initialView: 'dayGridMonth',
      
      locale:"es",
      
      headerToolbar: {
        left:'prev,next today',
        center:'title',
        right:'dayGridMonth timeGridWeek listWeek'
      },

      events: "http://localhost:8000/agenda/mostrar",

      eventColor: '#A84BFF' ,

      // dateClick:function(info){
      //   formulario.reset();

      //   formulario.start.value=info.dateStr;
      //   formulario.end.value=info.dateStr;

      //   $("#evento").modal("show");

      // },

      eventClick:function(info){
        var evento = info.event;
        axios.get("http://localhost:8000/agenda/editar/"+info.event.id).
      then((respuesta) => {
        console.log(respuesta);
        
        formulario.id.value = respuesta.data.id;
        formulario.nombre_completo.value = respuesta.data.paciente_nombres+' '+respuesta.data.paciente_apellidos;
        formulario.paciente_email.value = respuesta.data.paciente_email;
        formulario.paciente_telefono.value = respuesta.data.paciente_telefono;
        formulario.cita_fecha.value = respuesta.data.dia;
        formulario.cita_hora.value = respuesta.data.hora_inicio+' - '+respuesta.data.hora_fin;
        formulario.cita_servicio.value = respuesta.data.servicio_name;
        formulario.cita_modalidad.value = respuesta.data.name_es;
        
      

        $("#evento").modal("show");
      })
      .catch(
        error=>{
          if(error.response){
            console.log(error.response.data);
          }
        }
      )


      }
    });

    

    calendar.render();

  });

</script> 

    
@endsection