<div class="card">
    <div class="card-body">
      
      <div class="card-title">Seleccione tipo de cupón</div>
    
      <div class="row">
        <div class="col-lg-4">

          
          <div class="form-check">
            @isset($value_check)
              @if($value_check == 'porcentaje')
              <input class="form-check-input" type="radio" name="tipo" value="porcentaje" id="check_porcentaje" checked>
              <label class="form-check-label" for="check_porcentaje">
                Porcentaje
              </label>
              @else
              <input class="form-check-input" type="radio" name="tipo" value="porcentaje" id="check_porcentaje" >
              <label class="form-check-label" for="check_porcentaje">
                Porcentaje
              </label>
              @endif
            @else
              <input class="form-check-input" type="radio" name="tipo" value="porcentaje" id="check_porcentaje" checked>
              <label class="form-check-label" for="check_porcentaje">
                Porcentaje
              </label>
            @endisset
          </div>


          <div class="form-check">

            @isset($value_check)
              @if($value_check == 'cantidadfija')
              <input class="form-check-input" type="radio" name="tipo" value="cantidadfija" id="check_cantidadfija" checked>
              <label class="form-check-label" for="check_cantidadfija">
                Cantidad fija
              </label>
              @else
              <input class="form-check-input" type="radio" name="tipo" value="cantidadfija" id="check_cantidadfija" >
              <label class="form-check-label" for="check_cantidadfija">
                Cantidad fija
              </label>
              @endif
            @else
              <input class="form-check-input" type="radio" name="tipo" value="cantidadfija" id="check_cantidadfija">
              <label class="form-check-label" for="check_cantidadfija">
                Cantidad fija
              </label>
            @endisset
          </div>

        </div>
      </div>
    </div>
  </div>