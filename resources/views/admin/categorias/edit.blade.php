@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.categorias.headersection',['title' => 'Editar categoría'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{ action('CategoriaController@update', $row->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Editar categoría</div>
              <div class="card-body">
                <br>
                  
                <div class="row">
                  <div class="col-lg-6 col-xs-12">

                    {{-- Card nombre categoria italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre de la categoría - IT   <span class="fi fi-it"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <input type="text" name="name_it" class="form-control"  placeholder="Categoría italiano" value="{{ $row->name_it }}" style="margin-top:5px;" >
                              </div>
                          </div>
                        </div> 
                      </div>
                      
                    </div>

                    {{-- Card descripcion categoria italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Descripción de la categoría - IT   <span class="fi fi-it"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <textarea name="description_it" id="" cols="30" rows="5" class="form-control" placeholder="Descripción italiano" style="margin-top:5px;" >{{ $row->description_it }}</textarea>
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>


                    
                  </div>

                  <div class="col-lg-6 col-xs-12">
                    {{-- Card nombre categoria español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Nombre de la categoría - ES   <span class="fi fi-es"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <input type="text" name="name_es" class="form-control"  placeholder="Categoría español" value="{{ $row->name_es }}" style="margin-top:5px;" >
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>

                    {{-- Card descripcion categoria español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Descripción de la categoría - ES   <span class="fi fi-es"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <textarea name="description_es" id="" cols="30" rows="5" class="form-control" placeholder="Descripción español" style="margin-top:5px;" >{{ $row->description_es }}</textarea>
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>


                  </div>
                </div>
                
              </div>
              <div class="card-footer">
                <div class="form-group pt-2">
                  <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>

                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Editar">
                </div>
              </div>
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>

    
  </main>
@endsection