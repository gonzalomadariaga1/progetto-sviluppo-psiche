@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.horario.headersection',['title' => 'Lista de horarios'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Lista de los horarios registrados en el sistema.</h4>
                </div>
                <div class="col-md-2">
                    <a href="{{route('admin.horario.create')}}" class="btn btn-primary-violet btn-sm float-md-end" role="button" aria-pressed="true" style="margin-bottom: 5px;">Añadir nuevo horario</a>
                </div>
              </div>
            </div>
    
            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="display" style="width:100%">
                    <thead style="background-color:#A27AD6">
                      <th>Id</th>
                      <th>Fecha</th>
                      <th>Hora inicio</th>
                      <th>Hora fin</th>
                      <th>Estado</th>
                      <th>Especialista</th>
                      <th>Modalidad</th>
                      <th>Acciones</th>                     
                    </thead>
                    <tbody>

                    
                    </tbody>
                    <tfoot>
                      <th>Id</th>
                      <th>Fecha</th>
                      <th>Hora inicio</th>
                      <th>Hora fin</th>
                      <th>Estado</th>
                      <th>Especialista</th>
                      <th>Modalidad</th>
                      <th>Acciones</th>  
                    </tfoot>
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
  <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
  <script>
  var selected = [];
  var table = $('#tblarticulos').DataTable( {
        initComplete: function () {
            this.api().columns([1, 2, 3, 5, 6]).every( function () {
                var column = this;
                var select = $('<select class="form-select"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        } , 

        dom: 'lBfrtip',
        
        ajax:{
            url: '/horario/get_horarios',
            type : "get",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },

        select: {
            style: 'multi'
        },

        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },

        buttons: [
            {
                text: 'Marcar como reservadas',
                className: 'red',
                action: function () {
                    let _token = '{{csrf_token()}}'
                    var rows_selected = table.rows( { selected: true } ).data().pluck(0).toArray();
                    
                    $.ajax({
                        url: '/horario/selected_reservadas',
                        data: {data: rows_selected, _token: _token },
                        type: "POST",
                        dataType: "json",
                        
                        error:function(e){
                            alert(e)
                        },
                        success:function(respuesta)
                        {
                          if (respuesta == 1) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Los horarios han sido actualizados correctamente',
                                confirmButtonText: 'OK',
                                footer: '',
                                showCloseButton: true,
                                timer: 15000
                              }).then((result) => {
                                if (result.isConfirmed) {
                                  location.reload();
                                }
                            })

                            

                          }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Hubo un problema al actualizar los horarios. Comunica este error: 145',
                                confirmButtonText: 'OK',
                                footer: '',
                                showCloseButton: true,
                                timer: 5000
                            })
                          }

                        }
                      });
                }
            },
            {
                text: 'Marcar como disponibles',
                className: 'green',
                action: function () {
                    let _token = '{{csrf_token()}}'
                    var rows_selected = table.rows( { selected: true } ).data().pluck(0).toArray();
                    
                    $.ajax({
                        url: '/horario/selected_disponibles',
                        data: {data: rows_selected, _token: _token },
                        type: "POST",
                        dataType: "json",
                        
                        error:function(e){
                            alert(e)
                        },
                        success:function(respuesta)
                        {
                          if (respuesta == 1) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Los horarios han sido actualizados correctamente',
                                confirmButtonText: 'OK',
                                footer: '',
                                showCloseButton: true,
                                timer: 15000
                              }).then((result) => {
                                if (result.isConfirmed) {
                                  location.reload();
                                }
                            })

                            

                          }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Hubo un problema al actualizar los horarios. Comunica este error: 145',
                                confirmButtonText: 'OK',
                                footer: '',
                                showCloseButton: true,
                                timer: 5000
                            })
                          }

                        }
                      });
                }
            },
            {
                text: 'Eliminar',
                className: 'orange',
                action: function () {
                    let _token = '{{csrf_token()}}'
                    var rows_selected = table.rows( { selected: true } ).data().pluck(0).toArray();
                    
                    $.ajax({
                        url: '/horario/selected_delete',
                        data: {data: rows_selected, _token: _token },
                        type: "POST",
                        dataType: "json",
                        
                        error:function(e){
                            alert(e)
                        },
                        success:function(respuesta)
                        {
                          if (respuesta == 1) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Los horarios han sido borrados correctamente',
                                confirmButtonText: 'OK',
                                footer: '',
                                showCloseButton: true,
                                timer: 15000
                              }).then((result) => {
                                if (result.isConfirmed) {
                                  location.reload();
                                }
                            })

                            

                          }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Hubo un problema al borrar los horarios. Comunica este error: 145',
                                confirmButtonText: 'OK',
                                footer: '',
                                showCloseButton: true,
                                timer: 5000
                            })
                          }

                        }
                      });
                }
            }
        ]
  });

  
  



  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var usu_id = button.data('usuid')
    
    var url = '{{ route("admin.horario.destroy", ":id") }}';
    url = url.replace(':id', usu_id);

    
    
    var modal = $(this)
    // modal.find('.modal-footer #role_id').val(role_id)
    modal.find('form').attr('action',url);
  })

  </script>
    
@endsection