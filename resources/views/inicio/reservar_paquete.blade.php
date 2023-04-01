@extends ('layouts.inicio')

@section ('title', 'Reservas')

@section('contenido')

<main id="main">
  <!-- ======= Our Services Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>{{__('menu.reserva')}}</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>{{__('menu.reserva')}}</li>
        </ol>
      </div>

    </div>
  </section><!-- End Our Services Section -->

  <!-- ======= Why Us Section ======= -->
  <form id="paymentForm" method="POST" action="{{ action('PaymentController@pay') }}" enctype="multipart/form-data" class="submit-prevent-form " style="padding-bottom: 100px;
  padding-top: 100px;" >
    {{ csrf_field() }}
    <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200" style="padding: 20px !important;">
      <div class="col-lg-12 col-xs-12">  
        <div class="container flex-grow-1 flex-shrink-0 py-5">
          
          
            
          <div class="row">
            
              <div id="stepper1" class="bs-stepper linear">
                <div class="bs-stepper-header">
                  <div class="step" data-target="#test-l-1">
                    <button type="button" class="btn step-trigger">
                      <span class="bs-stepper-circle">1</span>
                      <span class="bs-stepper-label" style="font-size: 15px;">{{__('reservar.bono')}} <br> {{__('reservar.specialist')}} </span>
                    </button>
                  </div>

                  <div class="line"></div>
                  <div class="step" data-target="#test-l-3">
                    <button type="button" class="btn step-trigger">
                      <span class="bs-stepper-circle">2</span>
                      <span class="bs-stepper-label" style="font-size: 15px;">  {{__('reservar.date')}}</span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#test-l-4">
                    <button type="button" class="btn step-trigger">
                      <span class="bs-stepper-circle">3</span>
                      <span class="bs-stepper-label" style="font-size: 15px;"> {{__('reservar.insertar')}} <br>  {{__('reservar.datos')}}</span>
                    </button>
                  </div>
                </div>
                <div class="bs-stepper-content">
                  <div id="test-l-1" class="content">
                    <div class="card" style="border:none;">
                      <div class="card-body fondo-crema" style="border:none;">
                        <div class="row">

                          <div class="col-lg-6 col-xs-12">
                            <select  id="servicio_id" class="form-control selectpicker" title="{{__('reservar.selectPaquete')}}"  >
                              @foreach($paquetes as $paquete)
                                @if( $paquete->id == $id )
                                  <option style="colo: black" value="{{$paquete->id}}" selected> {{ $paquete->{'name_'.app()->getLocale()} }}</option>
                                @elseif($paquete->id != $id)
                                  <option style="colo: black" value="{{$paquete->id}}"> {{ $paquete->{'name_'.app()->getLocale()} }}</option>
                                @endif

                              @endforeach
                            </select>
                          </div>

                          <div class="col-lg-6 col-xs-12">
                            <select name="especialista_id" id="especialista_id" class="form-control selectpicker" title="{{__('reservar.selectSpecialista')}}"  >
                              @foreach($especialistas as $especialista)
                                <option value="{{$especialista->id}}">{{ $especialista->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>                    
                      </div>
                    </div>
                    <button type="button" class="btn " style="background-color: #67337a; color:#f6f4bb;" onclick="paso1_to_paso2()">{{__('reservar.next')}}</button>
                  </div>

                  <div id="test-l-3" class="content">
                    <div class="card" style="border:none;">
                      <div class="card-body fondo-crema" style="border:none;">
                        <div class="row">
                          
                          <div class="col-lg-12 col-xs-12">
                            <div class="d-flex justify-content-center">
                              <input id="datetimepicker3" type="text" >
                              <input type="hidden" id="input_fecha" name="fecha_selected">
                              <input id="datetimepicker5" type="text" >
                              <input type="hidden" id="input_hora" name="hora_selected">
                              <input type="hidden" id="input_hora_fin" name="hora_selected_fin">
                            </div>
                            
                            
                          </div>
                          
                          
                        </div>
        
                        
        
                        
                    
                      </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="stepper1.previous()">{{__('reservar.back')}}</button>
                    <button type="button" id="btnPaso3" class="btn" style="background-color: #67337a; color:#f6f4bb;" onclick="stepper1.next()">{{__('reservar.next')}}</button>
                    
                  </div>
                  <div id="test-l-4" class="content">


                    <div class="card card-outline-secondary" style="margin-bottom: 10px;">
                      <div class="card-header">
                          <h3 class="mb-0">{{__('reservar.datospersonales')}}</h3>
                          <i><small>{{__('reservar.campos')}}</small></i>
                      </div>
                      <div class="card-body ">
                          
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">{{__('reservar.nombres')}}</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" name="paciente_nombres" id="paciente_nombres" >
                                  </div>
                              </div>
                              <br>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">{{__('reservar.apellidos')}}</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" name="paciente_apellidos" id="paciente_apellidos" >
                                  </div>
                              </div>
                              <br>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="email" name="paciente_email" id="paciente_email" >
                                  </div>
                              </div>
                              <br>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Teléfono</label>
                                  <div class="col-lg-4">
                                      
                                      <select class="form-select" id="codigoPais">
                                        <option data-countryCode="GB" value="44" >UK (+44)</option>
                                        <option data-countryCode="US" value="1">USA (+1)</option>
                                        <option data-countryCode="IT" value="39" Selected>Italy (+39)</option>
                                        <optgroup label="Other countries">
                                          <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                          <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                          <option data-countryCode="AO" value="244">Angola (+244)</option>
                                          <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                          <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                          <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                          <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                          <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                          <option data-countryCode="AU" value="61">Australia (+61)</option>
                                          <option data-countryCode="AT" value="43">Austria (+43)</option>
                                          <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                          <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                          <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                          <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                          <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                          <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                          <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                          <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                          <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                          <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                          <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                          <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                          <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                          <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                          <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                          <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                          <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                          <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                          <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                          <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                          <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                          <option data-countryCode="CA" value="1">Canada (+1)</option>
                                          <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                          <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                          <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                          <option data-countryCode="CL" value="56">Chile (+56)</option>
                                          <option data-countryCode="CN" value="86">China (+86)</option>
                                          <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                          <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                          <option data-countryCode="CG" value="242">Congo (+242)</option>
                                          <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                          <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                          <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                          <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                          <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                          <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                          <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                          <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                          <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                          <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                          <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                          <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                          <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                          <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                          <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                          <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                          <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                          <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                          <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                          <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                          <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                          <option data-countryCode="FI" value="358">Finland (+358)</option>
                                          <option data-countryCode="FR" value="33">France (+33)</option>
                                          <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                          <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                          <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                          <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                          <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                          <option data-countryCode="DE" value="49">Germany (+49)</option>
                                          <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                          <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                          <option data-countryCode="GR" value="30">Greece (+30)</option>
                                          <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                          <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                          <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                          <option data-countryCode="GU" value="671">Guam (+671)</option>
                                          <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                          <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                          <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                          <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                          <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                          <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                          <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                          <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                          <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                          <option data-countryCode="IN" value="91">India (+91)</option>
                                          <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                          <option data-countryCode="IR" value="98">Iran (+98)</option>
                                          <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                          <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                          <option data-countryCode="IL" value="972">Israel (+972)</option>
                                          <option data-countryCode="IT" value="39">Italy (+39)</option>
                                          <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                          <option data-countryCode="JP" value="81">Japan (+81)</option>
                                          <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                          <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                          <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                          <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                          <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                          <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                          <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                          <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                          <option data-countryCode="LA" value="856">Laos (+856)</option>
                                          <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                          <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                          <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                          <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                          <option data-countryCode="LY" value="218">Libya (+218)</option>
                                          <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                          <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                          <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                          <option data-countryCode="MO" value="853">Macao (+853)</option>
                                          <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                          <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                          <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                          <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                          <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                          <option data-countryCode="ML" value="223">Mali (+223)</option>
                                          <option data-countryCode="MT" value="356">Malta (+356)</option>
                                          <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                          <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                          <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                          <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                          <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                          <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                          <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                          <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                          <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                          <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                          <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                          <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                          <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                          <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                          <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                          <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                          <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                          <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                          <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                          <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                          <option data-countryCode="NE" value="227">Niger (+227)</option>
                                          <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                          <option data-countryCode="NU" value="683">Niue (+683)</option>
                                          <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                          <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                          <option data-countryCode="NO" value="47">Norway (+47)</option>
                                          <option data-countryCode="OM" value="968">Oman (+968)</option>
                                          <option data-countryCode="PW" value="680">Palau (+680)</option>
                                          <option data-countryCode="PA" value="507">Panama (+507)</option>
                                          <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                          <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                          <option data-countryCode="PE" value="51">Peru (+51)</option>
                                          <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                          <option data-countryCode="PL" value="48">Poland (+48)</option>
                                          <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                          <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                          <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                          <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                          <option data-countryCode="RO" value="40">Romania (+40)</option>
                                          <option data-countryCode="RU" value="7">Russia (+7)</option>
                                          <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                          <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                          <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                          <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                          <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                          <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                          <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                          <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                          <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                          <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                          <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                          <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                          <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                          <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                          <option data-countryCode="ES" value="34">Spain (+34)</option>
                                          <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                          <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                          <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                          <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                          <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                          <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                          <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                          <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                          <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                          <option data-countryCode="SI" value="963">Syria (+963)</option>
                                          <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                          <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                          <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                          <option data-countryCode="TG" value="228">Togo (+228)</option>
                                          <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                          <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                          <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                          <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                          <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                          <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                          <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                          <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                          <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                          <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                          <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                          <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                          <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                          <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                          <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                          <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                          <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                          <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                          <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                          <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                          <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                          <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                          <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                          <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                          <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                          <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                        </optgroup>
                                      </select>
                                  </div>
                                  <div class="col-lg-5">
                                    <input class="form-control" type="number"  id="telefono" >
                                    <input type="hidden" name="paciente_telefono" id="paciente_telefono">
                                  </div>
                              </div>
                              <br>
                              <div class="form-group row">
                                <div class="col-lg-12">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                      {{__('reservar.check1')}} <a href="{{route('terminosycondiciones')}}" target="_blank" rel="noopener noreferrer"> <strong> <u>{{__('reservar.check_link1')}}</u> </strong> </a> {{__('reservar.check2')}}<a href="#" target="_blank" rel="noopener noreferrer"><strong> <u>{{__('reservar.check_link2')}}</u> </strong></a> {{__('reservar.check3')}}

                                    </label>
                                  </div>
                                </div>
                              </div>


                          
                      </div>
                  </div>
                  <!-- /form user info -->
                    <!-- Default form register -->
                    <button type="button" class="btn btn-secondary" onclick="stepper1.previous()">{{__('reservar.back')}}</button>
                    <button type="button" class="btn" style="background-color: #67337a; color:#f6f4bb;" onclick="checkForm()">{{__('reservar.next')}}</button>
                    
                  </div>
                </div>
              </div>
          </div>
          
          
        </div>
      </div>  
    </section><!-- End Why Us Section -->
    <!-- Modal -->
    <div class="modal  fade" id="modal_confirmaypaga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('reservar.confirmaypaga')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{-- Card Detalles de reserva --}}
            <div class="card">
              <div class="card-header"><span><strong>{{__('reservar.detallesreserva')}}</strong></span></div>
              <div class="card-body">

                {{-- <div class="form-group row">
                  <label class="col-lg-3 col-form-label form-control-label"> <strong>{{__('reservar.service')}}:</strong> </label>
                  <div class="col-lg-9">
                      <p class="mt-2" id="row-servicio-modal"></p>

                  </div>
                </div> --}}

                <div class="row">
                  <div class="col-lg-3 col-xs-12">
                    <label for="service"><strong>{{__('reservar.service')}}:</strong></label>
                    <p id="row-servicio-modal"></p>
                    <input type="hidden" id="input_servicio" name="servicio" >
                    <input type="hidden" id="input_servicio_id" name="servicio_id" >
                  </div>

                  <div class="col-lg-3 col-xs-12">
                    <label for="service"><strong>{{__('reservar.modalidad')}}:</strong></label>
                    <p id="row-modalidad-modal"></p>
                    <input type="hidden" id="input_modalidad" name="modalidad" >
                    <input type="hidden" id="input_modalidad_id" name="modalidad_id" >
                  </div>

                  <div class="col-lg-3 col-xs-12">
                    <label for="service"><strong>{{__('reservar.duracion')}}:</strong></label>
                    <p id="row-duracion-modal"></p>
                  </div>

                  <div class="col-lg-3 col-xs-12">
                    <label for="service"><strong>{{__('reservar.valor')}}:</strong></label>
                    <p id="row-valor-modal"></p>
                    <input type="hidden" id="input_valor" name="valor">
                    <input type="hidden" id="input_cupon_id" name="cupon_id">
                    <input type="hidden" id="input_tienelimite" name="tiene_limite">
                  </div>


                </div>

                <div class="row">
                  <div class="col-lg-3 col-xs-12">
                    <label for="service"><strong>{{__('reservar.dia')}}</strong></label>
                    <p id="row-dia-modal"></p>
                  </div>

                  <div class="col-lg-3 col-xs-12">
                    <label for="service"><strong>{{__('reservar.hora')}}</strong></label>
                    <p id="row-hora-modal"></p>
                  </div>

                </div>
              </div>
            </div>
            <br>
            {{-- Card para Cupon de descuento --}}
            <div class="card">
              <div class="card-header"><span><strong>{{__('reservar.codigodescuento')}}</strong></span></div>
              <div class="card-body">

                <div class="row" id="div_ingresecodigo">
                  <div class="col-lg-3 col-xs-12">
                    <label for="service"><strong>{{__('reservar.ingresarcodigo')}}</strong></label>

                  </div>

                  <div class="col-lg-6 col-xs-9">
                    <input type="text"
                    class="form-control mb-3" name="" id="codigo_descuento" aria-describedby="helpId" placeholder="">

                  </div>

                  <div class="col-lg-3 col-xs-3">
                    <button type="button" class="btn mt-2" style="background-color: #67337a; color:#f6f4bb;" onclick="codigodescuento()" > {{__('reservar.botonAplicar')}} </button>

                  </div>

                  


                </div>
                <div class="row" id="div_mensajecupon" style="display:none;">
                  <div id="mensaje_exito" >
                    <br>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        
                        <div>
                            <i class="bx bx-check" style="font-size: 20px;"></i>{{__('reservar.cuponExito')}}
                        </div>
                      </div>
                </div>
                </div>
              </div>
            </div>
            <br>
            {{-- Card Forma de pago --}}
            <div class="card">
              <div class="card-header"><span><strong>{{__('reservar.formadepago')}}</strong></span></div>
              <div class="card-body">

                <table class="table" id="tablaresumen">
                  <tbody>

                    <tr>
                        
                      <td id="td_descuento"><strong>{{__('reservar.descuento')}}</strong></td>
                      <td colspan="3" id="row-descuento-modal"></td>
                    
                    </tr>

                    <tr>
                      <td><strong>{{__('reservar.totalapagar')}}</strong></td>
                      <td colspan="3" id="row-totalvalor-modal"></td>
                    </tr>

                
                  </tbody>
                </table>

              <div class="row mt-3">
                <div class="col">
                  <label for="">{{__('reservar.seleccioneformadepago')}}</label>
                  
                    
                      <div class="form-group" id="toggler">
                        <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                          <div class="row">
                          @foreach ($paymentPlatforms as $paymentPlatform)
                            <div class="col-lg-4 col-xs-12">  
                              <label 
                                class="btn btn-outline-secondary rounded m-2 p-1" 
                                data-bs-target="#{{ $paymentPlatform->name}}Collapse"
                                data-bs-toggle="collapse"
                              >
                                <input 
                                  type="radio"
                                  name="payment_platform"
                                  value="{{$paymentPlatform->id}}"
                                  required
                                >
                                <img class="img-thumbnail" src="../{{$paymentPlatform->image}}" >
                              </label>
                            </div>  
                          @endforeach
                        </div>
                        </div>
                        @foreach ($paymentPlatforms as $paymentPlatform)
                          <div
                            id="{{ $paymentPlatform->name}}Collapse"
                            class="collapse"
                            data-bs-parent="#toggler"
                          >
                            @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
                          </div>
                        @endforeach
                      </div>
                    
                    
                  </div>
                  
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('reservar.cancelar')}}</button>
            <button type="submit" class="btn" style="background-color: #67337a; color:#f6f4bb;" id="payButton" >{{__('reservar.pagar')}}</button>
          </div>
        </div>
      </div>
    </div>
  </form>

</main><!-- End #main -->


@endsection

@section('code_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  var stepper1 = new Stepper(document.querySelector('#stepper1'), {
      animation: true
    })

 

  function paso1_to_paso2(){
    
    document.getElementById("btnPaso3").disabled = true;
    var value_especialista = $("#especialista_id :selected").val();
    var value_servicio = $("#servicio_id :selected").val();

    if ( value_especialista == ''){

      Swal.fire({
            icon: 'error',
            title: '{{__('reservas.error_seleccione_especialista')}}',
            confirmButtonText: 'OK',
            footer: '',
            showCloseButton: true,
            timer: 5000
        })

    }else{

      var locale = '{{ config('app.locale') }}';

      $.datetimepicker.setLocale(locale);

      $("#datetimepicker5").hide();

      var $fecha_reserva = jQuery('#datetimepicker3')
      var $hora_reserva = jQuery('#datetimepicker5')
      var $dias;
      var $hora; 
      jQuery.ajax({
          url: '/reservar/'+value_especialista+'/get_fechas_p/',
          type: "GET",
          dataType: "json",
          async:false,
          error:function(e){
              alert("Error. Informar este error. Código: 5323")
          },
          success:function(respuesta)
          {
            
            if ( respuesta.length === 0 ){
              Swal.fire({
                  icon: 'error',
                  title: '{{__('reservar.nullfechas')}}',
                  confirmButtonText: 'OK',
                  footer: '',
                  showCloseButton: true,
                  timer: 5000
              }).then(function () {
                stepper1.to(1);
                });
              
            }else{
              $fecha_reserva.datetimepicker({
              format:'d-m-Y',
              inline:true,
              timepicker:false,
              allowDates: respuesta,
              formatDate:'d-m-Y',
              onChangeDateTime:function(dp,$input){
                
                $hora = $input.val();
                //console.log("fechareserva",$hora);
                $('#input_fecha').val($hora);
                $("#datetimepicker5").show();

                jQuery.ajax({
                    url: '/reservar/'+$hora+'/get_horas_p/',
                    type: "GET",
                    dataType: "json",
                    async:false,
                    error:function(e){
                        alert("Error. Informar este error. Código: 1247")
                    },
                    success:function(respuesta_horas)
                    {
                      //console.log("RESPUESTA_HORAS",respuesta_horas);

                      $hora_reserva.datetimepicker({
                        datepicker:false,
                        allowTimes: _.map(respuesta_horas,"hora_inicio"),
                        formatTime:'H:i',
                        inline:true,
                        
                      
                        onChangeDateTime:function(dp,$input){
                          $hora_selected = $input.val();
                          $hora_only = $hora_selected.slice(-5)
                          //console.log("fechareserva",$hora_selected);
                          //.log("fechareservacortada",$hora_only);

                          let obj = respuesta_horas.find(o => o.hora_inicio === $hora_only+':00');
                          
                          $hora_final = obj.hora_fin.substr(0, 5)

                          $('#input_hora').val($hora_only);
                          $('#input_hora_fin').val($hora_final);
                          document.getElementById("btnPaso3").disabled = false;
                          
                          
                        }
                      });

                    }
                  });

              }
            });
            }
            

          }
        });


      

      stepper1.to(2);

    }


    
    
  }

  function checkForm(){
    
    var paciente_nombres = document.getElementById('paciente_nombres').value;
    var paciente_apellidos = document.getElementById('paciente_apellidos').value;
    var paciente_email = document.getElementById('paciente_email').value;
    var paciente_telefono = document.getElementById('telefono').value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    var value_check =$("#flexCheckDefault").is(":checked");
    
    if ( paciente_nombres.length == 0 ) {
      Swal.fire({
            icon: 'error',
            title: '{{__('reservar.error_nombre_vacio')}}',
            confirmButtonText: 'OK',
            footer: '',
            showCloseButton: true,
            timer: 5000
        })
        document.getElementById('paciente_nombres').classList.add("focus-form");
        

    }
    else 

    if ( paciente_apellidos.length == 0 ) {
      Swal.fire({
            icon: 'error',
            title: '{{__('reservar.error_apellido_vacio')}}',
            confirmButtonText: 'OK',
            footer: '',
            showCloseButton: true,
            timer: 5000
        })
        document.getElementById('paciente_nombres').classList.remove("focus-form");
        document.getElementById('paciente_apellidos').classList.add("focus-form");

    }
    else 
    if ( paciente_email.length == 0 ) {
      Swal.fire({
            icon: 'error',
            title: '{{__('reservar.error_email_vacio')}}',
            confirmButtonText: 'OK',
            footer: '',
            showCloseButton: true,
            timer: 5000
        })
        document.getElementById('paciente_nombres').classList.remove("focus-form");
        document.getElementById('paciente_apellidos').classList.remove("focus-form");
        document.getElementById('paciente_email').classList.add("focus-form");

    }
    else
    if ( paciente_telefono.length == 0 ) {
      Swal.fire({
            icon: 'error',
            title: '{{__('reservar.error_telefono_vacio')}}',
            confirmButtonText: 'OK',
            footer: '',
            showCloseButton: true,
            timer: 5000
        })
        document.getElementById('paciente_nombres').classList.remove("focus-form");
        document.getElementById('paciente_apellidos').classList.remove("focus-form");
        document.getElementById('paciente_email').classList.remove("focus-form");
        document.getElementById('telefono').classList.add("focus-form");

    }else
    if (!regex.test(paciente_email)) {
      Swal.fire({
            icon: 'error',
            title: '{{__('reservar.error_email_invalido')}}',
            confirmButtonText: 'OK',
            footer: '',
            showCloseButton: true,
            timer: 5000
        })
        document.getElementById('paciente_nombres').classList.remove("focus-form");
        document.getElementById('paciente_apellidos').classList.remove("focus-form");
        document.getElementById('paciente_email').classList.add("focus-form");
        document.getElementById('telefono').classList.remove("focus-form");

    }else
      if ( value_check == false ){

      Swal.fire({
            icon: 'error',
            title: '{{__('reservar.error_check')}}',
            confirmButtonText: 'OK',
            footer: '',
            showCloseButton: true,
            timer: 5000
        })
        document.getElementById('paciente_nombres').classList.remove("focus-form");
        document.getElementById('paciente_apellidos').classList.remove("focus-form");
        document.getElementById('paciente_email').classList.remove("focus-form");
        document.getElementById('telefono').classList.remove("focus-form");
        document.getElementById('flexCheckDefault').classList.add("focus-form");

      }
      else
      {
        datosModal()
      }

  }

  function datosModal(){

    document.getElementById('paciente_nombres').classList.remove("focus-form");
    document.getElementById('paciente_apellidos').classList.remove("focus-form");
    document.getElementById('paciente_email').classList.remove("focus-form");
    document.getElementById('telefono').classList.remove("focus-form");
    document.getElementById('flexCheckDefault').classList.remove("focus-form");

    var div_descuento = document.getElementById('td_descuento');
    div_descuento.setAttribute('style','display:none;');

    

    var value_bono = $("#servicio_id :selected").val();
    var locale = '{{ config('app.locale') }}';

    jQuery.ajax({
      url: '/reservar/'+value_bono+'/get_bono/',
      type: "GET",
      dataType: "json",
      async:false,
      error:function(e){
          alert("Error. Informar este error. Código: 1247")
      },
      success:function(respuesta)
      {
        resetCupon(respuesta.precio);
        var datoFecha = document.getElementById('datetimepicker3').value;
        var datohora = document.getElementById('datetimepicker5').value;
        var datohora_fin = document.getElementById('input_hora_fin').value;
        var datohora_only = datohora.slice(-5)
        var euro = ' euros.'
        var min = ' min.'

        if ( locale == 'it' ){
          document.getElementById("row-servicio-modal").innerHTML = respuesta.name_it;
          $('#input_servicio').val(respuesta.name_it);
          document.getElementById("row-modalidad-modal").innerHTML = 'Videochiamata';
          $('#input_modalidad').val('Videochiamata');
        }else{
          document.getElementById("row-servicio-modal").innerHTML = respuesta.name_es;
          $('#input_servicio').val(respuesta.name_es);
          document.getElementById("row-modalidad-modal").innerHTML = 'Videollamada';
          $('#input_modalidad').val('Videollamada');
        }
        var serv_video = 1 ;
        $('#input_servicio_id').val(serv_video);
        document.getElementById("row-valor-modal").innerHTML = respuesta.precio+euro;
        document.getElementById("row-totalvalor-modal").innerHTML = respuesta.precio+euro;
        $('#input_valor').val(respuesta.precio);
        document.getElementById("row-duracion-modal").innerHTML = respuesta.duracion+min;
        document.getElementById("row-dia-modal").innerHTML = datoFecha;
        
        document.getElementById("row-hora-modal").innerHTML = datohora_only+' - '+datohora_fin;

        codigopais = document.getElementById("codigoPais").value;
        telefono = document.getElementById("telefono").value;
        //("tetetee",codigopais+' '+telefono);
        $('#paciente_telefono').val(codigopais+' '+telefono);

        $('#input_modalidad_id').val('1');
        
        


        



        $("#modal_confirmaypaga").modal("show");

        
        

      }
    });

    
    
        
        
  }

  function codigodescuento(){
    var value_codigodescuento = $("#codigo_descuento").val();
    var value_email = $("#paciente_email").val();
    var value_telefono = $("#paciente_telefono").val();
    
    // console.log(value_codigodescuento);
    // console.log(value_email);
    // console.log(value_telefono);

    jQuery.ajax({
                  url: '/reservar/'+value_codigodescuento+'/'+value_email+'/'+value_telefono+'/check_cupon/',
                  type: "GET",
                  dataType: "json",
                  async:false,
                  error:function(e){
                      alert("Error. Informar este error. Código: 985")
                  },
                  success:function(respuesta)
                  {
                    
                    if ( respuesta == 0 ){
                      Swal.fire({
                          icon: 'error',
                          title: '{{__('reservar.error_cupon_0')}}',
                          confirmButtonText: 'OK',
                          footer: '',
                          showCloseButton: true,
                          timer: 5000
                      })

                    }else if ( respuesta == 1 ){
                      Swal.fire({
                          icon: 'error',
                          title: '{{__('reservar.error_cupon_1')}}',
                          confirmButtonText: 'OK',
                          footer: '',
                          showCloseButton: true,
                          timer: 5000
                      })
                    }else if ( respuesta == 2) {
                      Swal.fire({
                          icon: 'error',
                          title: '{{__('reservar.error_cupon_2')}}',
                          confirmButtonText: 'OK',
                          footer: '',
                          showCloseButton: true,
                          timer: 5000
                      })
                    }else if ( respuesta == 3) {
                      Swal.fire({
                          icon: 'error',
                          title: '{{__('reservar.error_cupon_3')}}',
                          confirmButtonText: 'OK',
                          footer: '',
                          showCloseButton: true,
                          timer: 5000
                      })
                    }else{
                      // console.log("EXITO. TIPO CUPON:",respuesta[0].tipocupon);
                      // console.log("EXITO. VALOR CUPON:",respuesta[0].valor);

                      

                      var tipo_cupon = respuesta[0].tipocupon;
                      var valor_cupon = respuesta[0].valor
                      var div_descuento = document.getElementById('td_descuento');
                      var mensaje_exito = document.getElementById('div_mensajecupon');
                      var ingrese_codigo = document.getElementById('div_ingresecodigo');
                      var row_descuento = document.getElementById("row-descuento-modal")
                      var porcentaje = ' %.'
                      var euros = ' euros.'

                      var arr = document.getElementById("row-valor-modal").innerHTML;
                      
                      
                      let valor_cortado = arr.split(' ');

                      var valor_original = valor_cortado[0];

                      //console.log("valor cortadooo",valor_original);

                      row_descuento.removeAttribute('style','');
                      ingrese_codigo.setAttribute('style','display:none');
                      mensaje_exito.removeAttribute('style','');

                      if ( tipo_cupon == 'porcentaje'){
                        //cupon de tipo porcentaje

                        var descuento = ( (valor_original * valor_cupon) / 100 ) ;

                        var nuevo_valor_pagar = (valor_original - descuento) ;
                        
                        
                        document.getElementById("row-descuento-modal").innerHTML = valor_cupon+porcentaje;
                        div_descuento.removeAttribute('style','');
                        document.getElementById("row-totalvalor-modal").innerHTML = nuevo_valor_pagar+euros;

                        $('#input_valor').val(nuevo_valor_pagar); 
                        $('#input_cupon_id').val(respuesta[0].id_cupon); 
                        $('#input_tienelimite').val(respuesta[0].tiene_limite); 

                      }else{
                        //cupon de tipo cantidadfija

                        var nuevo_valor_pagar = ( valor_original - valor_cupon );

                        document.getElementById("row-descuento-modal").innerHTML = valor_cupon+euros;
                        mensaje_error.removeAttribute('style','');
                        document.getElementById("row-totalvalor-modal").innerHTML = nuevo_valor_pagar+euros;


                        $('#input_valor').val(nuevo_valor_pagar);
                        $('#input_cupon_id').val(respuesta[0].id_cupon); 
                        $('#input_tienelimite').val(respuesta[0].tiene_limite); 
                      }

                    }

                  }
                });
  }

  function resetCupon(precio){
    
    var mensaje_exito = document.getElementById('div_mensajecupon');
    var ingrese_codigo = document.getElementById('div_ingresecodigo');
    var div_descuento = document.getElementById('td_descuento');
    var row_descuento = document.getElementById("row-descuento-modal")

    $('#input_valor').val(precio);
    ingrese_codigo.removeAttribute('style','')
    mensaje_exito.setAttribute('style','display:none');
    
    div_descuento.setAttribute('style','display:none;');
    row_descuento.setAttribute('style','display:none;');
  }


</script>

<script>

    $('.servicio_id').selectpicker('setStyle','margin-bottom','10px');

   

</script>
@endsection



