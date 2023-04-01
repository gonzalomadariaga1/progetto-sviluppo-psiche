@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.posts.headersection',['title' => 'Editar post'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('PostsController@update', $post->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Paso 2 - Creación de post</div>
              <div class="card-body">
                <br>
                 
                {{-- Titulo y resumen --}}
                <div class="row">
                  <div class="col-lg-6 col-xs-12">

                    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">

                    {{-- Card nombre post italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h5>Título del post - IT   <span class="fi fi-it"></span> </h5>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                            
                              <div class="form-group">
                                  <input type="text" name="title_it" class="form-control"  placeholder="Título italiano" value="{{ old('title_it', $post->title_it) }}" style="margin-top:5px;" >
                              </div>
                          </div>
                        </div> 
                      </div>
                      
                    </div>

                    {{-- Card descripcion post italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h5>Resumen del post - IT   <span class="fi fi-it"></span> </h5>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <textarea name="resumen_it" id="" cols="30" rows="5" class="form-control" placeholder="Resumen italiano" style="margin-top:5px;" >{{ old('resumen_it', $post->resumen_it) }}</textarea>
                                  <small>Se recomienda de 200 a 300 caracteres.</small>
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>


                    
                  </div>

                  <div class="col-lg-6 col-xs-12">
                    {{-- Card nombre post español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h5>Título del post - ES   <span class="fi fi-es"></span> </h5>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <input type="text" name="title_es" class="form-control"  placeholder="Título español" value="{{ old('title_es' , $post->title_es) }}" style="margin-top:5px;" >
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>

                    {{-- Card descripcion post español --}}
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-lg-12 col-xs-12">
                              <h5>Resumen del post - ES   <span class="fi fi-es"></span> </h5>  
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-body">        
                        <div class="row">
                          <div class="col-lg-12  col-xs-12">
                              <div class="form-group">
                                  <textarea name="resumen_es" id="" cols="30" rows="5" class="form-control" placeholder="Resumen español" style="margin-top:5px;" > {{ old('resumen_es', $post->resumen_es) }} </textarea>
                                  <small>Se recomienda de 200 a 300 caracteres.</small>
                              </div>
                          </div>
                        </div> 
                      </div>
                    </div>


                  </div>
                </div>

                {{-- Contenido --}}
                <div class="row">
                  <div class="col-lg-6 col-xs-12">
                    {{-- Card contenido post italiano --}}
                    <div class="card">
                      <div class="card-header">
                        <h5>Contenido del post - IT <span class="fi fi-it"></span>  </h5> 
                      </div>

                      <div class="card-body">
                        <textarea id="editor_it" name="content_it"> {{old('content_it' , $post->content_it)}} </textarea>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-6 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <h5>Contenido del post - ES <span class="fi fi-es"></span>  </h5> 
                      </div>

                      <div class="card-body">
                        <textarea id="editor_es" name="content_es"> {{old('content_es' , $post->content_es)}} </textarea>  
                      </div>

                    </div>
                  </div>
                </div>

                {{-- Categorias y etiquetas --}}
                <div class="row">
                  <div class="col-lg-10 col-xs-12 ">
                    <div class="card">
                      <div class="card-header">
                        Imágenes del post 
                      </div>
                      <div class="card-body" style="margin-top:10px;">
                        <div class="file-loading">
                            <input id="files" name="files[]" type="file" multiple>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-2 col-xs-12">
                    <div class="row">
                      <div class="card">
                        <div class="card-header">
                          Categorias 
                        </div>
                        <div class="card-body" style="margin-top:10px;">
                          <div class="form-group">
                            
                            <select class="select2" name="categorias_id" id="categorias_id" style=" width:100%">
                              <option value="0" disabled selected>Seleccione...</option>
                              @foreach ($categorias as $categoria)
                                  
                                  <option value="{{ $categoria->id }}" {{old('categorias_id' , $post->categoria_id) == $categoria->id ? 'selected' : ''}}> 
                                    {{$categoria->name_es}} </option>
                              @endforeach
                            </select>  
  
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="card">
                        <div class="card-header">
                          Etiquetas 
                        </div>
                        <div class="card-body" style="margin-top:10px;">
                          <select class="select2" name="etiquetas[]" id="etiquetas" style=" width:100%" multiple>
  
                              @foreach ($etiquetas as $etiqueta)
                                  
                                  <option value="{{ $etiqueta->id }}"
                                    {{ collect(old('etiquetas', $post->tags->pluck('id')))->contains($etiqueta->id) ? 'selected' : ''}}> 
                                    {{$etiqueta->name_es}} </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="card">
                        <div class="card-header">Iframe</div>
                        <div class="card-body">
                          <div class="form-group">
                            
                            <textarea id="iframe" class="form-control" name="iframe" rows="4"> {{old('iframe', $post->iframe )}} </textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    

                  </div>
                  
                  
                </div>

                <div class="row">
                  <div class="col-lg-12 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        Estado de publicación
                      </div>
                      <div class="card-body" style="margin-top:5px;">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <select id="status" class="form-select" name="status" onchange="showInput()">
                              <option value="0" disabled selected>Seleccione...</option>
                              <option value="draft"
                              {{old('status', $post->status) == 'draft' ? 'selected' : ''}}
                              >Borrador</option>
                              <option value="public"
                              {{old('status', $post->status) == 'public' ? 'selected' : ''}}
                              >Público</option>
                              <option value="hidden"
                              {{old('status', $post->status) == 'hidden' ? 'selected' : ''}}
                              >Oculto</option>
                              {{-- <option value="program"
                              {{old('status', $post->status) == 'program' ? 'selected' : ''}}
                              >Programar</option> --}}
                            </select>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row" id="date_published_at">
                  <div class="col-lg-12 col-xs-12">
                    <div class="card" >
                      <div class="card-header">
                        Fecha de publicación
                      </div>
                      <div class="card-body" style="margin-top:5px;">
                        <input id="datetimepicker" type="text" >
                      </div>
                    </div>
                  </div>
                </div>

                
      
                  
              <div class="card-footer">
                <div class="form-group pt-2">
                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Crear">
                </div>
              </div>
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>

    @include('includes.modal-delete')
  </main>
@endsection

@section('code_js')
  <script>
    
    $(document).ready(function() {
      jQuery('#datetimepicker').datetimepicker();
    });
  </script>

  <script>
    $(document).ready(function() {
      getSelectValue = document.getElementById("status").value;
      if(getSelectValue=="program"){
        document.getElementById("date_published_at").style.display = "inline";
      }else{
        document.getElementById("date_published_at").style.display = "none";
      }
    });
    
  </script>
  <script>
    function showInput(){
      getSelectValue = document.getElementById("status").value;
      if(getSelectValue=="program"){
        document.getElementById("date_published_at").style.display = "inline";
      }else{
        document.getElementById("date_published_at").style.display = "none";
      }
    }
  </script>

<script>
  tinymce.init({
  selector: 'textarea#editor_it'
});

tinymce.init({
  selector: 'textarea#editor_es'
});
</script>
  <script>
      $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var usu_id = button.data('usuid') 
        
        var modal = $(this)
        // modal.find('.modal-footer #role_id').val(role_id)
        modal.find('form').attr('action','/users/' + usu_id);
    })

    $(document).ready(function() {
      $('#categorias_id').select2();
      $('#etiquetas').select2();
    });
  </script>
  <script>
    $(document).ready(function() {
      var krajeeGetCount = function(id) {
        var cnt = $('#' + id).fileinput('getFilesCount');
        return cnt === 0 ? 'No le quedan archivos.' :
            'Tienes ' +  cnt + ' archivo' + (cnt > 1 ? 's' : '') + ' por cargar.';
      };
      $("#files").fileinput({
        language: "es",
        theme: "fas",
        browseOnZoneClick: true,
        uploadUrl: "{{url('/upload_image',$post->id)}}",
        
        uploadExtraData: {'_token':$("#csrf_token").val()},

        initialPreview: [
          <?php foreach ($post->images as $image)
          {
            echo '"'.$image->url.'",'; 
          } ?>
        ] ,

        initialPreviewAsData: true,
        initialPreviewFileType: 'image',

        initialPreviewConfig: [<?php foreach ($post->images as $image)
        {
          echo '{width: "120px", key:'.$image->id.'},';
        } ?> ],

        overwriteInitial: false,
        maxFileSize: 2046,

        browseClass: "btn btn-primary-violet btn-block",
        showCaption: false,
        showRemove: false,
        showUpload: false,

        deleteUrl: "/file_delete",
        deleteExtraData:{'_token':$("#csrf_token").val()},

      }).on('filebeforedelete', function() {
        return new Promise(function(resolve, reject) {
            $.confirm({
                title: '¡Atención!',
                content: '¿Estás seguro de eliminar este archivo?',
                type: 'red',
                buttons: {   
                    ok: {
                        btnClass: 'btn-primary text-white',
                        keys: ['enter'],
                        action: function(){
                            resolve();
                        }
                    },
                    cancel: function(){
                        $.alert('Se canceló la eliminación del archivo. ' + krajeeGetCount('files'));
                    }
                }
            });
        });
    }).on('filedeleted', function() {
        setTimeout(function() {
            $.alert('¡El archivo se ha eliminado exitosamente! ' + krajeeGetCount('files'));
        }, 900);
    });

      
    
    
  });
  </script>
    
@endsection

