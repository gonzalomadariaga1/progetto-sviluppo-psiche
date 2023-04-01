@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.carouseltarifas.headersection',['title' => 'Lista de carouseles de tarifas'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Lista de carouseles de tarifas para la página de inicio.</h4>
                </div>

                <div class="col-md-2">
                    <a href="{{route('admin.carouseltarifas.create')}}" class="btn btn-primary-violet btn-sm float-md-end" 
                    role="button" aria-pressed="true"  style="margin-bottom: 5px;">Crear carousel</a>
                </div>
              </div>
            </div>
    
            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Id</th>
                      <th>Titulo ES</th>
                      <th>Titulo IT</th>
                      <th>Subtitulo ES</th>
                      <th>Subtitulo IT</th>
                      <th>Acciones</th>                     
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                          
                            <td>{{ $row->id }}</td>
                            <td>{!! $row->title_es !!}</td>
                            <td>{!! $row->title_it !!}</td>
                            <td>{!! $row->subtitle_es !!}</td>
                            <td>{!! $row->subtitle_it !!}</td>
                            <td>
                              <a href="{{URL::action('CarouselTarifasController@edit',$row['id'])}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                              <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid="{{$row['id']}}"><i class="bi bi-x-lg"></i></a>
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
        
        var url = '{{ route("admin.carouseltarifas.destroy", ":id") }}';
        url = url.replace(':id', usu_id);

        
        
        var modal = $(this)
        // modal.find('.modal-footer #role_id').val(role_id)
        modal.find('form').attr('action',url);
    })
  </script>
    
@endsection