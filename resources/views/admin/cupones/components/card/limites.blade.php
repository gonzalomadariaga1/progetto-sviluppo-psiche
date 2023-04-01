<div class="card">
    <div class="card-body">
      
      <div class="card-title">Límites de uso</div>
      
      <div class="row">
        <div class="col-lg-6">
          <div class="form-check">
            @isset($limite_uso)
            
              @if ($limite_uso == 0)
                <input type='hidden' value='0' name='limite_uso'>
                <input class="form-check-input" type="checkbox" name="limite_uso" value="1" id="check_limitetotal">
                <label class="form-check-label" for="check_limitetotal">
                  Limitar el número máximo de veces que puede usarse este descuento
                </label>
                <div id="input_limite_total">
                  <input class="form-control" type="number" placeholder="Ingrese el número máximo de cupones" name="quedan_por_usar" id="input_limitetotal" value="{{$quedan_por_usar ?? ''}}">
                </div>
              @else
                <input type='hidden' value='0' name='limite_uso'>
                <input class="form-check-input" type="checkbox" name="limite_uso" value="1" id="check_limitetotal" checked>
                <label class="form-check-label" for="check_limitetotal">
                  Limitar el número máximo de veces que puede usarse este descuento
                </label>
                <div id="input_limite_total">
                  <input class="form-control" type="number" placeholder="Ingrese el número máximo de cupones" name="quedan_por_usar" id="input_limitetotal" value="{{$quedan_por_usar ?? ''}}">
                </div>   
              @endif
            @else
            <input type='hidden' value='0' name='limite_uso'>
            <input class="form-check-input" type="checkbox" name="limite_uso" value="1" id="check_limitetotal">
            <label class="form-check-label" for="check_limitetotal">
              Limitar el número máximo de veces que puede usarse este descuento
            </label>
            <div id="input_limite_total">
              <input class="form-control" type="number" placeholder="Ingrese el número máximo de cupones" name="quedan_por_usar" id="input_limitetotal" value="{{$quedan_por_usar ?? ''}}">
            </div> 
            @endisset
            
            
          </div>
          <div class="form-check">
            @isset($multi_uso)
              @if ($multi_uso == 1)
                <input type='hidden' value='0' name='multi_uso'>
                <input class="form-check-input" type="checkbox" name="multi_uso" value="1" id="check_unoporpaciente" checked >
                <label class="form-check-label" for="check_unoporpaciente">
                  Limitar a un uso por paciente
                </label>
              @else
                <input type='hidden' value='0' name='multi_uso'>
                <input class="form-check-input" type="checkbox" name="multi_uso" value="1" id="check_unoporpaciente"  >
                <label class="form-check-label" for="check_unoporpaciente">
                  Limitar a un uso por paciente
                </label>
              @endif
            @else
            <input type='hidden' value='0' name='multi_uso'>
                <input class="form-check-input" type="checkbox" name="multi_uso" value="1" id="check_unoporpaciente"  >
                <label class="form-check-label" for="check_unoporpaciente">
                  Limitar a un uso por paciente
                </label>
            @endisset
            
          </div>

        </div>
      </div>
    </div>
  </div>