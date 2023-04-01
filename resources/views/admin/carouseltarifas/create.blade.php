@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.carouseltarifas.headersection',['title' => 'Crear carousel'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('CarouselTarifasController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de carousel</div>
              <div class="card-body">
                <br>
                  
                  <div class="row">
                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Título del carousel - IT   <span class="fi fi-it"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">
                          <textarea id="editor_it" name="title_it">  </textarea>
                        </div>
                        
                      </div>



                      
                    </div>

                    <div class="col-lg-6 col-xs-12">
                      {{-- Card nombre categoria español --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Título del carousel  - ES   <span class="fi fi-es"></span> </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">
                          <textarea id="editor_it" name="title_es">  </textarea>
                        </div>
                      </div>

                      


                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      {{-- Card contenido post italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <h5>Subtítulo del carousel - IT <span class="fi fi-it"></span>  </h5> 
                        </div>
  
                        <div class="card-body">
                          <textarea id="editor2_it" name="subtitle_it">  </textarea>
                        </div>
  
                      </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                      <div class="card">
                        <div class="card-header">
                          <h5>Subtítulo del carousel - ES <span class="fi fi-es"></span>  </h5> 
                        </div>
  
                        <div class="card-body">
                          <textarea id="editor2_es" name="subtitle_es">  </textarea>  
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
  selector: 'textarea#editor_it',
  plugins: 'link, code',
  menubar: 'file | edit | view | insert | format',
  toolbar: 'undo redo | styles | fontselect | bold italic underline | forecolor | alignleft aligncenter alignright | bullist numlist | link | code',
  default_link_target: '_blank'
});

tinymce.init({
  selector: 'textarea#editor_es',
  plugins: 'link, code',
  menubar: 'file | edit | view | insert | format',
  toolbar: 'undo redo | styles | fontselect | bold italic underline | forecolor | alignleft aligncenter alignright | bullist numlist | link | code',
  default_link_target: '_blank'
});

tinymce.init({
  selector: 'textarea#editor2_es',
  plugins: 'link, code',
  menubar: 'file | edit | view | insert | format',
  toolbar: 'undo redo | styles | fontselect | bold italic underline | forecolor | alignleft aligncenter alignright | bullist numlist | link | code',
  default_link_target: '_blank'
});

tinymce.init({
  selector: 'textarea#editor2_it',
  plugins: 'link, code',
  menubar: 'file | edit | view | insert | format',
  toolbar: 'undo redo | styles | fontselect | bold italic underline | forecolor | alignleft aligncenter alignright | bullist numlist | link | code',
  default_link_target: '_blank'
});
</script>
@endsection
