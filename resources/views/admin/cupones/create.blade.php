@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.cupones.headersection',['title' => 'Crear cupón'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('CuponesController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de cupón</div>
              <div class="card-body">
               <br>
                
                @include('admin.cupones.components.card.nombrecupon') 
                
                @include('admin.cupones.components.card.tipocupon') 
                
                @include('admin.cupones.components.card.cantidadfija')
                @include('admin.cupones.components.card.porcentaje')
                
                @include('admin.cupones.components.card.limites')
                  
      
                  
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
 init();
 function init(){
  $('#cardCantidadfija').hide();
  $('#input_limite_total').hide();
 }


 var checkbox_cantidadfija = document.querySelector("input[name=tipo][id=check_cantidadfija]");
 var checkbox_porcentaje = document.querySelector("input[name=tipo][id=check_porcentaje]");
 var checkbox_limitetotal = document.querySelector("input[name=limite_uso][id=check_limitetotal]");

 checkbox_cantidadfija.addEventListener('change', function() {
    if (this.checked) {
      
      $('#cardCantidadfija').show();
      $('#cardPorcentaje').hide();
    }
  });

  checkbox_porcentaje.addEventListener('change', function() {
    if (this.checked) {
      
      $('#cardCantidadfija').hide();
      $('#cardPorcentaje').show();
    }
  });

  checkbox_limitetotal.addEventListener('change', function() {
    if (this.checked) {
      $('#input_limite_total').show();
    }else{
      $('#input_limite_total').hide();
    }
  });
 
</script>
@endsection
