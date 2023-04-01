@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.posts.headersection',['title' => 'Ver post'])
    
    <div class="card">
      <div class="card-header">
        <h4>Datos del rol</h4>
      </div>
      <div class="card-body">
        <br>
        <div class="card">
          <div class="card-header">
              <h4>Nombre y descripción del rol</h4>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-4 col-xs-12">
                      <div class="form-group">
                          <label for="Rut"><strong>Nombre del rol:</strong> </label>
                          <p>{{$row->name}} </p>
                      </div>
                  </div>
  
                  <div class="col-lg-8 col-xs-12">
                    <div class="form-group">
                        <label for="Rut"><strong>Descripción del rol:</strong> </label>
                        <p>{{$row->description}} </p>
                    </div>
                </div>
              </div>  
          </div>
        </div>

        @php
            $can_view_permissions = auth()->user()->can('admin-permission-show');
        @endphp

        @if($can_view_permissions)
          <div class="card">
            <div class="card-header">
              <h4>Permisos asignados</h4>
            </div>

            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Nombre</th>
                      <th>Descripción</th>                    
                    </thead>
                    <tbody>
                      
                        @foreach ($row->permissions as $row)
                        <tr>
                            <td>{{ $row->name }}</a></td>
                            <td>{{ $row->description }}</td>
                        </tr>
                        @endforeach
                    
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif

        

        

        <div class="card">
          <div class="card-header">
            <h4>Usuarios asignados</h4>
          </div>

          <div class="card-body">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
              <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                  <thead style="background-color:#A27AD6">
                    <th>Nombre</th>
                    <th>Email</th>                    
                  </thead>
                  <tbody>
                      
                      @foreach ($row_user->users as $user)
                      <tr>
                          <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></td>
                          
                          <td>{{ $user->email }}</td>
                      </tr>
                      @endforeach
                  
                  </tbody>
              </table>
            </div>

          </div>
        </div>

        


      </div>
      <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>
      </div>
    </div>
  </main>
@endsection

