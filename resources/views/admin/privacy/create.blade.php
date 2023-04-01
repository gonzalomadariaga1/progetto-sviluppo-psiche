@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.privacy.headersection',['title' => 'Crear política'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('PrivacidadController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de política de privacidad</div>
              <div class="card-body">
                <br>
                  
                  <div class="row">
                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Titulo de la política - IT   <span class="fi fi-it"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="title_it" class="form-control"  placeholder="Política italiano" value="{{ old('title_it') }}" style="margin-top:5px;" >
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
                                <h4>Titulo de la política  - ES   <span class="fi fi-es"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="title_es" class="form-control"  placeholder="Política español" value="{{ old('title_es') }}" style="margin-top:5px;" >
                                </div>
                            </div>
                          </div> 
                        </div>
                      </div>

                      


                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      {{-- Card contenido post italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <h5>Contenido política - IT <span class="fi fi-it"></span>  </h5> 
                        </div>
  
                        <div class="card-body">
                          <textarea id="editor_it" name="content_it">  </textarea>
                        </div>
  
                      </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                      <div class="card">
                        <div class="card-header">
                          <h5>Contenido política - ES <span class="fi fi-es"></span>  </h5> 
                        </div>
  
                        <div class="card-body">
                          <textarea id="editor_es" name="content_es">  </textarea>  
                        </div>
  
                      </div>
                    </div>
                  </div>
                  
      
                  
              <div class="card-footer">
                <div class="form-group pt-2">
                  <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>

                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Crear">
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
  tinymce.init({
  selector: 'textarea#editor_it'
});

tinymce.init({
  selector: 'textarea#editor_es'
});
</script>
@endsection
