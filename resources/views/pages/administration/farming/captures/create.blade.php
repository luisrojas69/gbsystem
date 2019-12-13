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

<section class="content">
  <div class="row">

    <div class="box-body">
      <!-- left column -->  
      <div class="col-md-7">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Formulario de @yield('title-page')</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          @include('layouts.includes.partials.forms.capture.form_captures')
        </div>    
      </div>
      <!--End Left Column-->

      <!-- Rigth column -->  
      <div class="col-md-5">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Caracteristicas del Tablón Seleccionado</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <div class="chart-responsive">
                  <canvas id="pieChartCondition" height="180" width="151" style="width: 151px; height: 180px;"></canvas>
                </div>
                <!-- ./chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-3">
                <ul class="chart-legend clearfix">
                  <li><i class="fa fa-circle-o text-red"></i> Disponible.</li>
                  <li><i class="fa fa-circle-o text-blue"></i> Sembrada.</li>
                  <li><i class="fa fa-circle-o text-green"></i> Capacidad.</li>
                </ul>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="#">Area Sembrada
                <span class="pull-right text-blue" id="info_area_sembrada_actual"></span></a></li>
                <li><a href="#">Area Disponible
                  <span class="pull-right text-red" id="info_area_disponible"></span></a></li>
                  <li><a href="#">Capacidad Total del Tablón
                    <span class="pull-right text-green" id="info_capacidad"></span></a></li>  
                  </ul>
                </div>
                <!-- /.footer -->
                <div class="box-footer text-center" id="timeLine">
                  <a href="{{ route('capture.index') }}" class="uppercase">Ver Linea de Tiempo de Este Tablon</a>
                </div>

              </div>

            </div>

            <!-- END Rigth column -->  


          </div>

        </div>
      </section>


{{-- comment 
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
--}}

@endsection

@section('additionals-scripts')

<script src="{{ asset('js/utils.js') }}"></script>
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/chart.js/Chart.js"></script>

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

  $('#timeLine').hide();
  //---------------------------- OBETENER TABLONES DINAMICAMENTE --------------------------------------------

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

//---------------------------- ACCION ONCHANGE SELECT PLANKS --------------------------------------------

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
        getGraphic(data);
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

            //---------------------------- CASO 1 --------------------------------------------
            case 1:  //Si tiene algo Sembrado y Está Full

            $("#activity_id").html("<option value=''>Seleccione una Actividad</option><option value='' disabled='disabled' class='text-red'>SIEMBRA (Sin Espacio)</option><option value='2'>COSECHA</option><option value='3'>AJUSTE</option>");
            $("#variety_id").html("<option value='"+data[0].id_variedad+"'>"+data[0].variedad+"</option>");

            //---------------------------- ACCION ONCHANGE SELECT ACTIVITIES --------------------------------------------

            $('#activity_id').on('change', function(){
             $('#area').prop('disabled', false);
           });

            $('#area').val('');
            $('#area').prop('max', data[0].capacidad_tablon);
            $("#crop_id").html("<option value='"+data[0].id_cultivo+"'>"+data[0].cultivo+"</option>");
            break;


            //---------------------------- CASO 2 --------------------------------------------
            case 2: // Si el Tablon Tiene algo pero no esta FUll
            $("#crop_id").html("<option value='"+data[0].id_cultivo+"'>"+data[0].cultivo+"</option>");
            $("#variety_id").html("<option value='"+data[0].id_variedad+"'>"+data[0].variedad+"</option>");

            $("#activity_id").html("<option value=''>Seleccione una Actividad</option><option value='1'>SIEMBRA</option><option value='2'>COSECHA</option><option value='3'>AJUSTE</option>");

            
            //---------------------------- ACCION ONCHANGE SELECT ACTIVITIES --------------------------------------------
            
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



            //---------------------------- CASO 3 --------------------------------------------
            case 3: // Si el Tablon Esta Vacio
            $("#activity_id").html("<option value=''>Seleccione una Actividad</option><option value='1'>SIEMBRA</option><option value='' disabled='disabled' class='text-red'>COSECHA (Nada para Cosechar)</option><option value='' disabled='disabled' class='text-red'>AJUSTE (Nada para Ajustar)</option>");
            

            //---------------------------- ACCION ONCHANGE SELECT ACTIVITIES ------------------------------------------

            $('#activity_id').on('change', function(){
             $('#area').prop('disabled', false);
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

             //---------------------------- OBETENER CULTIVOS DINAMICAMENTE --------------------------------------------

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


</script>



<script type="text/javascript">
//---------------------------- FUNCION PARA BLOQUEAR BUTON DE ENVIAR ------------------------------------------
function blockButton() {
  alert("ok");
  return true;
}
</script>




<script type="text/javascript">

  //---------------------------- GRAFICO DOGNUTS TABLONES ------------------------------------------

  function getGraphic(datos){

    var pieChartCanvas = $('#pieChartCondition').get(0).getContext('2d');
    var pieChart       = new Chart(pieChartCanvas);
    var PieData        = [
    {
      value    : datos[0].capacidad_tablon,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'Capacidad'
    },
    {
      value    : datos[0].sembrado_actual,
      color    : '#00c0ef',
      highlight: '#00c0ef',
      label    : 'Sembrado Actual'
    },
    {
      value    : datos[0].disponible,
      color    : '#f56954',
      highlight: '#f56954',
      label    : 'Total Disponible'
    }

    ];

    var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=label %>: <%=value%> Hects'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------
}


</script>

@endsection

