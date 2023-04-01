@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.contactofooter.headersection',['title' => 'Crear sección'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('ContactoFooterController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de sección contacto del footer</div>
              <div class="card-body">
                <br>
                  
                  

                  <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      {{-- Card contenido post italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <h5>Contenido  - IT <span class="fi fi-it"></span>  </h5> 
                        </div>
  
                        <div class="card-body">
                          <textarea id="editor_it" name="content_it">  </textarea>
                        </div>
  
                      </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                      <div class="card">
                        <div class="card-header">
                          <h5>Contenido  - ES <span class="fi fi-es"></span>  </h5> 
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
