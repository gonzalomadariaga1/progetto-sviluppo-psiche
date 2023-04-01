@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.policycookies.headersection',['title' => 'Editar política'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{ action('PolicyCookiesController@update', $row->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Editar política</div>
              <div class="card-body">
                <br>
                  
                <div class="row">
                  <div class="col-lg-6 col-xs-12">

                    {{-- Card nombre Modalidad italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Título de la política - IT   <span class="fi fi-it"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <input type="text" name="title_it" class="form-control"  placeholder="política italiano" value="{{ $row->title_it }}" style="margin-top:5px;" >
                              </div>
                          </div>
                        </div> 
                      </div>
                      
                    </div>

              


                    
                  </div>

                  <div class="col-lg-6 col-xs-12">
                    {{-- Card nombre Modalidad español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h4>Título de la política - ES   <span class="fi fi-es"></span> </h4>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <input type="text" name="title_es" class="form-control"  placeholder="política español" value="{{ $row->title_es }}" style="margin-top:5px;" >
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
                        <h5>Contenido de la política - IT <span class="fi fi-it"></span>  </h5> 
                      </div>

                      <div class="card-body">
                        <textarea id="editor_it" name="content_it"> {{old('content_it' , $row->content_it)}} </textarea>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-6 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <h5>Contenido de la política - ES <span class="fi fi-es"></span>  </h5> 
                      </div>

                      <div class="card-body">
                        <textarea id="editor_es" name="content_es"> {{old('content_es' , $row->content_es)}} </textarea>  
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