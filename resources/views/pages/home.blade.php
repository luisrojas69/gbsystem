@extends('layouts.master')

@section('title-page', "Bienvenido - Granja Boraure")

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/dataTables.bootstrap.min.css') }}">  

<style>
  canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }
</style>
@endsection

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<section class="content">

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ count($sectors) }}</h3>

          <p>Sectores</p>
        </div>
        <div class="icon">
          <i class="fa fa-clone"></i>
        </div>
        <a href="{{ route('sector.index') }}" class="small-box-footer">Ver Lista de Sectores <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($lots) }}</h3>

          <p>Lotes</p>
        </div>
        <div class="icon">
          <i class="fa fa-object-ungroup"></i>
        </div>
        <a href="{{ route('lot.index') }}" class="small-box-footer">Ver Lista de Lotes <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count($planks) }}</h3>

          <p>Tablones</p>
        </div>
        <div class="icon">
          <i class="fa fa-object-group"></i>
        </div>
        <a href="{{ route('plank.index') }}" class="small-box-footer">Ver Lista de Tablones <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3 class="fa fa-umbrella"></h3>

          <p>Precipitaciones</p>
        </div>
        <div class="icon">
          <i class="fa fa-umbrella"></i>
        </div>
        <a href="#" class="small-box-footer">Ver detalle de Precipitaciones <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>


  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabla Resumen - Control Hect&aacute;reas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr class="bg-aqua">
                <th >Producto</th>
                <th>Anterior</th>
                <th>Siembra</th>
                <th>Disponible</th>
                <th>Cosecha</th>
                <th>Otros (+/-)</th>
                <th>Actual</th>
              </tr>
            </thead>
            <tbody>

              @foreach($result as $item) 
              <tr>

                <td class="bg-green">{{ $item->cultivo}}</td>
                <td style="text-align: center;">X</td>
                <td style="text-align: center;">{{ $item->total_sembrado }}</td>
                <td style="text-align: center;">{{ $item->disponible_para_corte }}</td>
                <td style="text-align: center;">{{ $item->total_cosechado }}</td>
                <td style="text-align: center;">{{ $item->total_ajustado }}</td>
                <td style="text-align: center;">{{ $item->disponible_para_siembra }}</td>

              </tr>
              @endforeach
            </tbody>

          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-4">
      <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Estatus de Pozos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChartStatus" height="180" width="151" style="width: 151px; height: 180px;"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Operativos</li>
                    <li><i class="fa fa-circle-o text-green"></i> Parados</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Pozos Operativos <span class="pull-right text-green" id="operativos"></span></a>
                </li>
                <li><a href="#">Pozos Parados
                  <span class="pull-right text-red" id="inoperativos"></span></a></li>
                  <li><a href="#">Total Pozos Registrados
                  <span class="pull-right text-blue" id="totalPozos"></span></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
    </div>


    <div class="col-md-4">
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pozos Segun su Tipo</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChartType" height="180" width="151" style="width: 151px; height: 180px;"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-yellow"></i> Sumergibles</li>
                    <li><i class="fa fa-circle-o text-blue"></i> Turbina</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Pozos de Turbinas <span class="pull-right text-yellow" id="turbinas"></span></a>
                </li>
                <li><a href="#">Pozos Sumergibles
                  <span class="pull-right text-blue" id="sumergibles"></span></a></li>
                  <li><a href="#">Total Pozos Registrados
                  <span class="pull-right text-green" id="totalTipos"></span></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
    </div> 

    <div class="col-md-4">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pozos Recientemente Agregados</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($lastWells as $well)
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('img/pozos.png') }}" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="{{ route('well.show', $well->id) }}" class="product-title">
                      {{ $well->well_na }}
                      <span class="pull-right label {{ $well->status=="parado" ? 'label-danger' : 'label-success' }}">{{ $well->status }}</span></a>
                      
                    <span class="product-description">
                          Pozo de Tipo {{ $well->type }}
                        </span>
                  </div>
                </li>
                @endforeach
                <!-- /.item -->  
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ route('well.index') }}" class="uppercase">Ver Todos los Pozos</a>
            </div>
            <!-- /.box-footer -->
          </div>
    </div>   

    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Grafico de LLuvias - Año Actual</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="container" style="width: 100%;">
            <canvas id="canvas"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
@endsection

@section('additionals-scripts')

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/chart.js/Chart.js"></script>

<script>

  $(document).ready(function(){
    var url = "/home/pluviometryAnualBySector/";
    $('#grafico').hide();  
    $.ajax({
      dataType: 'json',
      url: url,
      method: "GET",
      beforeSend: function() {
        $("#loading").show();
      },
      success: function(datos)
      {
        $("#info-graph").hide();
        $("#loading").hide();
        $("#barChart").hide(300).show(500);
        //console.log(datos);
        //getGraphic(datos);
      },
      timeout:9000,
      error: function()
      {
       console.log("Error Sincronizando");
     }

   });
  });


    $(document).ready(function(){
    var url = "/home/wellsByStatus/";
    $.ajax({
      dataType: 'json',
      url: url,
      method: "GET",
      beforeSend: function() {
        $("#loading").show();
      },
      success: function(datos)
      {
        console.log(datos);
        
        var total = datos[0].numPozos + datos[1].numPozos;
        var porcInoperativos =  parseInt( (datos[0].numPozos / total) * 100 );
        var porcOperativos =  parseInt( (datos[1].numPozos / total) * 100 );
        $('#operativos').text(porcOperativos + "%");
        $('#inoperativos').text(porcInoperativos + "%");
        $('#totalPozos').text(total);
        getGraphicByStatus(datos);
      },
      timeout:9000,
      error: function()
      {
       console.log("Error Sincronizando");
     }

   });
  }); 
 

  $(document).ready(function(){
    var url = "/home/wellsByType/";
    $.ajax({
      dataType: 'json',
      url: url,
      method: "GET",
      beforeSend: function() {
        $("#loading").show();
      },
      success: function(datos)
      {
        console.log(datos);
        
        var total = datos[0].num + datos[1].num;
        $('#sumergibles').text(datos[0].num);
        $('#turbinas').text(datos[1].num);
        $('#totalTipos').text(total);
        getGraphicByType(datos);
      },
      timeout:9000,
      error: function()
      {
       console.log("Error Sincronizando");
     }

   });
  }); 

 //--------------------------------------------------------------------------------------------------------------
 /*function getGraphic(datos){

  var labels = [], data=[];
    datos.forEach(function(datos) {
      labels.push(datos.sector_id);
      data.push(datos.Mar);
      
    });


  var color = Chart.helpers.color;
  var barChartData = {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
      borderColor: window.chartColors.red,
      borderWidth: 1,
      data: [10,20,30,40,50,60,70,80,90,100,110,120]
    }]

  };



  
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myBar = new Chart(ctx, {
      type: 'bar',
      data: barChartData,
      options: {
        responsive: true,
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Pluviometria 2019'
        }
      }
    });



  };*/

</script>


<script type="text/javascript">

  //SELECT COUNT(*) as numero, status from `wells`GROUP BY status
    // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
function getGraphicByStatus(datos){

  var pieChartCanvas = $('#pieChartStatus').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    {
      value    : datos[0].numPozos,
      color    : '#f56954',
      highlight: '#f56954',
      label    : 'Parados'
    },
    {
      value    : datos[1].numPozos,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'Operativos'
    },
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
    tooltipTemplate      : '<%=value %> Pozos <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------
}


  //SELECT COUNT(*) as numero, status from `wells`GROUP BY status
    // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
function getGraphicByType(datos){
  var pieChartCanvas = $('#pieChartType').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    {
      value    : datos[0].num,
      color    : '#f39c12',
      highlight: '#f39c12',
      label    : 'Sumergibles'
    },
    {
      value    : datos[1].num,
      color    : '#3c8dbc',
      highlight: '#3c8dbc',
      label    : 'Turbinas'
    },
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
    tooltipTemplate      : '<%=value %> Pozos <%=label%>'
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