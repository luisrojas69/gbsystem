@extends('layouts.master')

@section('title-page', "Capture Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

<style type="text/css">
  
</style>
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="form_capture" class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('capture.store') }}"
					onsubmit="return checkSubmit();">
                {{ csrf_field() }}    
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2
                   control-label">Fecha: </label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" min="2018-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="activity_date" id="activity_date" placeholder="Fecha de la Actividad" required>
                  </div>
                </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Lote: </label>
                  
                      <div class="col-sm-10">
                        <select class="form-control" 
                                name="lot_id"
                                id="lot_id"
                                required
                                value="{{ old('lot_id') }}">
                          <option value=''>Seleccione un Lote</option>
                        @foreach($sectors as $sector)
                          <optgroup label="{{ $sector->sector_de }}">      
                          @foreach($lots as $item)  
                            @if($sector->id == $item->Sector->id)   
                              <option value="{{$item->id}}">
                                <!-- {{ $item->Sector->sector_de }} -->
                                {{ $item->lot_de }}
                              </option>
                            @endif  
                          @endforeach
                          </optgroup>
                        @endforeach
                        </select>

                      </div>
					                        
                    </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tablon: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="plank_id" id="plank_id" value="{{ old('plank_id') }}" required>
                      <option value="">Seleccione un Tablon</option>       
                   </select>
                  </div>
                </div>                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Actividad: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="activity_id" id="activity_id" value="{{ old('activity_id') }}" required>
                    <option value=''>Seleccione una Actividad</option>                 
                    </select>
                  </div>
                </div>                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Cultivo: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="crop_id" id="crop_id" value="{{ old('crop_id') }}" required>
                        <option value=''>Seleccione un Cultivo</option>               
                    </select>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Variedad: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="variety_id" id="variety_id" value="{{ old('variety_id') }}" required>
                        <option value=''>Seleccione una Variedad</option>               
                    </select>
                  </div>
                </div>                  

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Hect&aacute;reas: </label>

                  <div class="col-sm-10">
                    <input type="number" min="0" step="0.01" class="form-control" name="area" id="area" placeholder="Cantidad de Hect&aacute;reas" required disabled="">
                  </div>
                </div>

                 <div class="form-group">
                  <label  class="col-sm-2 control-label">Nota</label>
      
                  <div class="col-sm-10">
                  <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Introduzca una Breve Nota ..."></textarea>
                  </div>
                </div> 

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('capture.index') }}" class="btn btn-default">Cancelar</a>
                <input type="submit" id="submitForm" class="btn btn-info pull-right" value="Guardar">
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>


    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Capacidad</span>
              <span class="info-box-number" id="info_capacidad"><br></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Sembrado</span>
              <span class="info-box-number" id="info_area_sembrada"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 80%"></div>
              </div>
                  <span class="progress-description">
                    80% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Cosechado</span>
              <span class="info-box-number" id="info_area_cosechada"><br></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Disponible</span>
              <span class="info-box-number" id="info_area_disponible"><br></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
                <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sembrado Actual</span>
              <span class="info-box-number" id="info_area_sembrada_actual"><br></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-line-chart">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Ajustado</span>
              <span class="info-box-number" id="info_area_total_ajustado"><br></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
@endsection

@section('additionals-scripts')


   <script>
   //Bloqueando el Boton Submit al presionarlo
	function checkSubmit()
    {
      $('#submitForm').prop("disabled", true);
      $("#submitForm").val("Enviando...");  
    }
	//-----------------------------------------------//
    $(function () 
    {    
        var planks = [];

        @include('scripts._select_dinamyc_planks')

        $('#lot_id').on('change', function()
        {
          var lot = $(this).val();

          var selects = "<option value=''>Seleccione un Tablon</option>" ;
          
          $.each(planks, function(index, value) 
          {
            if(value.lot_id == lot) { 
              selects += value.html; 
            }
          });

          $("#plank_id").html(selects);
        });

//---------------------------- OBETENER VARIEDADES DINAMICAMENTE --------------------------------------------

        var varieties = [];

        @include('scripts._select_dinamyc_varieties')

        $('#crop_id').on('change', function()
        {
          var crop = $(this).val();

          var selects = "<option value=''>Seleccione una Variedad</option>" ;
          
          $.each(varieties, function(index, value) 
          {
            if(value.crop_id == crop) { 
              selects += value.html; 
            }
          });
          $("#variety_id").html(selects);
        });
///////////////////////////////////////////////////////////////////////////////////////////////////////////

  $("#plank_id").on('change',function()
  {
    var plank_id=$(this).val();

    var url = "/establishments/plank/"+plank_id;

    if(plank_id!=0)
    {
      $.ajax({
      dataType: 'json', 
      url: url,
      method: "GET",

        success: function(data)
        {
          
          console.log(data);
          $("#activity_id").prop("disabled",false);
          $("#area").val("");  
          $("#area").prop("max",data[0].disponible); 
          $('#info_area_disponible').html(data[0].disponible);
          $('#info_capacidad').html(data[0].capacidad_tablon);
          $('#info_area_cosechada').html(data[0].total_cosechado);
          $('#info_area_sembrada').html(data[0].total_sembrado);
          $('#info_area_sembrada_actual').html(data[0].sembrado_actual);
           $('#info_area_total_ajustado').html(data[0].total_ajustado);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
          
          //VALIDADMOS SI HAY ALGO SEMBRADO
          if(data[0].sembrado_actual >0.00)
          {
            //RELLENAMOS EL RUBRO AUTOMATICAMENTE
            //VALIDADMOS SI ESTA FULL
            if(data[0].sembrado_actual >= data[0].capacidad_tablon)
            {
              complete_fields(1, data); 
            }else{
              complete_fields(2, data);
            }

          }
          //SI ESTA VACIO
          else
          {
            complete_fields(3, data);
          }

///////////////////////////////////////////////////////////////////////////////////////////////////////////          

        },
        timeout:9000,
         error: function()
         {
          $("#activity_id").html("<option value=''>ERROR SINCRONIZANDO..</option>") 
        }
        });
      
    }else
    {
     $("#activity_id").prop("disabled","true");
    }
    
  });

  });


    function complete_fields(value, data )
    {
          switch(value) {
            
            case 1:  //Si tiene algo Sembrado y Está Full

                $("#activity_id").html("<option value=''>Seleccione una Actividad</option><option value='' disabled='disabled' class='text-red'>SIEMBRA (Sin Espacio)</option><option value='2'>COSECHA</option><option value='3'>AJUSTE</option>");
                $("#variety_id").html("<option value='"+data[0].id_variedad+"'>"+data[0].variedad+"</option>");

                $('#activity_id').on('change', function(){
                   $('#area').prop('disabled', false);
                });
                
                $('#area').val('');
                $('#area').prop('max', data[0].capacidad_tablon);
                $("#crop_id").html("<option value='"+data[0].id_cultivo+"'>"+data[0].cultivo+"</option>");
                break;
            
            case 2: // Si el Tablon Tiene algo pero no esta FUll
                $("#crop_id").html("<option value='"+data[0].id_cultivo+"'>"+data[0].cultivo+"</option>");
                $("#variety_id").html("<option value='"+data[0].id_variedad+"'>"+data[0].variedad+"</option>");

                $("#activity_id").html("<option value=''>Seleccione una Actividad</option><option value='1'>SIEMBRA</option><option value='2'>COSECHA</option><option value='3'>AJUSTE</option>");

                 $('#activity_id').on('change', function(){
                   $('#area').prop('disabled', false);
                     var activity_id=$(this).val();
                      switch(activity_id) {
                        case '1':// Si es Siembra
                            $('#area').val('');
                            $('#area').prop('max', data[0].disponible);
                            break;
                        case '2':// Si es Cosecha
                            $('#area').val('');
                            $('#area').prop('max', data[0].sembrado_actual);
                            break;
                        case '3'://Si es Ajuste
                            $('#area').val('');
                            $('#area').prop('max', data[0].sembrado_actual);
                            $('#comment').val('');
                            $('#comment').prop('required', true);
                            break;
                  
                          //code block
                      }
                    });
                 break;         

            case 3: // Si el Tablon Esta Vacio
                $("#activity_id").html("<option value=''>Seleccione una Actividad</option><option value='1'>SIEMBRA</option><option value='' disabled='disabled' class='text-red'>COSECHA (Nada para Cosechar)</option><option value='' disabled='disabled' class='text-red'>AJUSTE (Nada para Ajustar)</option>");
                 $('#activity_id').on('change', function(){
                 $('#area').prop('disabled', false);
                 console.log(data[0].capacidad_tablon);
                  $('#area').val('');
                  $('#variety_id').val('');
                 $('#area').prop('max', data[0].capacidad_tablon);
                 get_crops();//Obetenemos los Rubros
                });

                
                break;         

            default:
                //code block
         }
      
    }

    function get_crops(){
             var crops = [];

        @include('scripts._select_dinamyc_crops')

          var selects = "<option value=''>Seleccione un Cultivo</option>" ;
          
          $.each(crops, function(index, value) 
          {
    
              selects += value.html; 
            
          });

          $("#crop_id").html(selects);
    }


          $("#save_capture").on('click', function(){

            $("#save_capture").prop('disabled','true');
           // $("#form_capture").submit();
          });


   </script>

   <script type="text/javascript">
     

    function blockButton() {
        alert("ok");
        return true;\
    }
   </script>
  
@endsection

 