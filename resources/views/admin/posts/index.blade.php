@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.posts.headersection',['title' => 'Lista de posts'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Lista de los posts publicados en el sistema.</h4>
                </div>
                <div class="col-md-2">
                    {{-- <a href="{{route('admin.posts.create')}}" class="btn btn-primary-violet btn-sm float-md-end" role="button" aria-pressed="true" style="margin-bottom: 5px;">Crear post</a> --}}
                    <button type="button" class="btn btn-primary-violet btn-sm float-md-end" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                      Crear post
                    </button>
                </div>
               
                <div class="modal fade" id="verticalycentered" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Paso 1 - Creación de post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ action('PostsController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
                        {{ csrf_field() }}
                        
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="title_es">Ingrese título del post - ES <span class="fi fi-es"></span></label>
                            <input type="text" id="title_es" name="title_es" class="form-control"  placeholder="Título español" value="{{ old('title_es') }}" style="margin-top:5px;" required >
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                          <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Siguiente">
                          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        </div>
                      </form>
                    </div>
                  </div>
                </div><!-- End Vertically centered Modal-->
              </div>
            </div>
    
            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Id</th>

                      <th>Titulo español</th>

                      <th>Resumen español</th>
                      <th>Fecha</th>
                      <th>Autor</th>
                      <th>Acciones</th>                     
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>

                            <td>{{ $row->title_es}}</td>
                            <td>{{ $row->resumen_es}}</td>

                            <td>{{ $row->published_at }}</td>
                            <th>{{ $row->user['name'] }}</th>
                            <td>
                              <a href="{{ route('blog_details', $row->id ) }}" class="btn btn-primary-violet btn-sm mb-1" target="_blank" style="margin-right:3px;"><i class="bi bi-eye-fill"></i></a>
                              <a href="{{URL::action('PostsController@edit',$row['id'])}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                              <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid="{{$row['id']}}"><i class="bi bi-x-lg"></i></a>
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
    
    var url = '{{ route("admin.posts.destroy", ":id") }}';
    url = url.replace(':id', usu_id);

    
    
    var modal = $(this)
    // modal.find('.modal-footer #role_id').val(role_id)
    modal.find('form').attr('action',url);
})
</script>
    
@endsection