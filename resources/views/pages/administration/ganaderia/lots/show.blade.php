<?php header('Access-Control-Allow-Origin: *'); ?>
@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Lotes del Sector  $sector->sector_de")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="col-md-8">
  <div class="box box-info" >

    <div class="box-header with-border">
      <h3 class="box-title">Lotes del Sector <strong>{{ $sector->sector_de }} - ({{ $sector->sector_co }})</strong></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body" >
      <table class="table table-bordered" >
        <tbody><tr>
          <th style="width: 60px">ID</th>
          <th style="width: 120px">Codigo</th>
          <th>Descripcion</th>
          <th style="width: 60px; text-align: center;">Tablones</th>
          <th style="width: 120px; text-align: center;">Acciones</th>
        </tr>
        @foreach($sector->lots as $lot)
        <tr>
          <td>{{ $lot->id }}</td>
          <td>{{ $lot->lot_co }}</td>
          <td><a href="{{ route("lot.show", $lot ) }}">{{ $lot->lot_de }}</a></td>
          <td style="text-align: center;"><span class="label label-success">{{ count($lot->planks) }}</span></td>
          
          @if (Auth::user()->role == 'ADMIN')
          <td style="text-align: center;">
            <a href="javascript:void(0)"
            title="Editar" 
            onclick="event.preventDefault(); 
            document.getElementById('form-edit-{{ $sector->id }}').submit()">
            <span class="label label-primary"><i class="fa fa-pencil"></i></span>
          </a>                    

          <form method="GET" 
          action="{{ route('lot.edit', $lot) }}"
          id="form-edit-{{ $sector->id }}"
          style="display: none;">
          {{ csrf_field() }}
        </form>

        <a href="javascript:void(0)" id="{{ $sector->id }}"
          class="btn-delete">
          <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

          <form method="POST"
          id="form-destroy-{{ $sector->id }}" 
          action="{{ route('lot.destroy', $lot) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>
        
      </td>
      @else
      <td style="text-align: center;">
        <a href="javascript:void(0)" id="normal_user"
        title="Editar" 
        class="normal_user">
        <span class="label label-primary"><i class="fa fa-pencil"></i></span></a>

        <a href="javascript:void(0)" id="normal_user"
        title="Eliminar" 
        class="normal_user">
        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>
      </td>

      @endif

    </tr>
    @endforeach

  </tbody></table>
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
  @can('sector.create')
  <a class="btn btn-primary no-margin pull-right"
  title="Crear un nuevo Sector"
  href="{{ route('lot.create') }}">
  <i class="fa fa-plus"></i> Agregar Nuevo
</a>
@endcan  
@can('sector.index')
<ul class="list-inline">
  <li><a href="{{ route('sector.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Sectores</a></li>
</ul> 
@endcan
</div>
</div>
</div>

<div class="col-md-4">
  <!-- Widget: user widget style 1 -->
  <div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-aqua">
      <div class="widget-user-image">
        <img class="img-circle" src="{{asset ('img/logo.png') }}" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username">{{ $sector->sector_de }}</h3>
      <h5 class="widget-user-desc">Datos Generales del Sector</h5>
    </div>
    <div class="box-footer no-padding">
      <ul class="nav nav-stacked">

        <li><a href="#">C&oacute;digo <span class="pull-right badge bg-aqua">{{ $sector->sector_co }}</span></a></li>
        <li><a href="#">Perimetro <span class="pull-right badge bg-aqua">31</span></a></li>
        <li><a href="#">Superficie <span class="pull-right badge bg-green">5</span></a></li>
        <li><a href="{{ route('lot.index') }}" title="Haga click para listar tabla de Lotes">N&uacute;mero de Lotes <span class="pull-right badge bg-yellow">{{ count($sector->lots) }}</span></a></li>
      </ul>
    </div>
  </div>
  <!-- /.widget-user -->
</div>


<div class="row" id="graphic">

  <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Precipitaciones en el {{$sector->sector_de}}</h3>
        
        @can('pluviometry.create')
        <a class="btn btn-primary no-margin pull-right" 
        title="Agregar un nueva Precipitacion" 
        href="#">
        <i class="fa fa-plus"></i> Precipitacion
      </a>
      @endcan
      
    </div>
    <div class="box-body">
      <div class="chart">
        <canvas id="barChart" style="height: 285px; width: 632px;" width="632" height="285"></canvas>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
</div>

<div class="col-md-4">
  <!-- Widget: user widget style 1 -->
  <div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-blue">
      <div class="widget-user-image">
        <img class="img-circle" src="{{ asset ('img/logo-lluvia.png') }}" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username">{{$sector->sector_de}}</h3>
      <h5 class="widget-user-desc">Resumen de Precipitaciones</h5>
    </div>

    
    <!-- /.box-body -->
    <!-- Loading (remove the following to stop the loading)-->
    <div class="overlay" id=loading>
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <!-- end loading -->
    

    <div class="box-footer no-padding">

      <ul class="nav nav-stacked">
        <li><a href="#" >Total ultimos 12 Meses <span class="pull-right badge bg-blue " id="acum12meses"></span></a></li>
        <li><a href="#">Total a&ntilde;o Actual<span class="pull-right badge bg-aqua" id="acum_anio_actual"></span></a></li>
        <li><a href="#">Total mes Actual <span class="pull-right badge bg-green" id="acum_mes_actual"></span></a></li>
        <li><a href="#">Total mes Pasado <span class="pull-right badge bg-yellow" id="acum_mes_pasado"></span></a></li>
        <li><a href="#">Total a&ntilde;o Pasado <span class="pull-right badge bg-red" id="acum_anio_pasado"></span></a></li>

      </ul>

      <div class="box-footer">
        
        @can('sector.index')
        <ul class="list-inline">
          <li><a href="{{ route('sector.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Sectores</a></li>
        </ul> 
        @endcan

      </div>
    </div>
  </div>
  <!-- /.widget-user -->
</div>

</div>
@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')

<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>


<script type="text/javascript">

 var url = "/establishments/sector/{{ $sector->id }}/pluviometry";
 $(document).ready(function(){
   $.ajax({
    dataType: 'json',
    url: url,
    method: "GET",
    beforeSend: function() {
      $("#loading").show();
    },
    success: function(datos)
    {
     $("#loading").hide();
     $("#acum12meses").html(datos[0].total+" mm");
     $("#acum_anio_actual").html(datos[0].total_anio_actual+" mm");
     $("#acum_mes_actual").html(datos[0].Mes12+" mm");
     $("#acum_mes_pasado").html(datos[0].mes_pasado+" mm");
     $("#acum_anio_pasado").html(datos[0].total_anio_pasado+" mm");
     getGraphic(datos);
   },
   timeout:9000,
   error: function()
   {
     console.log("Error Sincronizando");
   }

 });
 });

 function getGraphic(datos) {
   
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Activar para usar areaChartGet context with jQuery - using jQuery's .get() method.
    //var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
   // var areaChart       = new Chart(areaChartCanvas)

   var pr = datos[0].posicion
   var areaChartData = {
    
    labels  : pr==12?['Ene','Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep','Oct','Nov','Dic']:
    pr==1?['Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep','Oct','Nov','Dic','Ene']:
    pr==2?['Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep','Oct','Nov','Dic', 'Ene','Feb']:
    pr==3?['Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep','Oct','Nov','Dic','Ene','Feb', 'Mar']:
    pr==4?['May', 'Jun', 'Jul', 'Ago', 'Sep','Oct','Nov','Dic','Ene','Feb', 'Mar', 'Abr']:
    pr==5?['Jun', 'Jul', 'Ago', 'Sep', 'Oct','Nov','Dic','Ene','Feb', 'Mar', 'Abr','May']:
    pr==6?['Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic','Ene','Feb','Mar', 'Abr', 'May', 'Jun']:
    pr==7?['Ago', 'Sep', 'Oct', 'Nov', 'Dic', 'Ene','Feb', 'Mar','Abr', 'May', 'Jun', 'Jul' ]:
    pr==8?['Sep','Oct','Nov','Dic','Ene','Feb', 'Mar', 'Abr','May', 'Jun', 'Jul', 'Ago']:
    pr==9?['Oct','Nov','Dic','Ene','Feb', 'Mar', 'Abr','May','Jun', 'Jul', 'Ago', 'Sep']:
    pr==10?['Nov','Dic', 'Ene','Feb', 'Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep','Oct' ]:
    ['Dic', 'Ene','Feb', 'Mar', 'Abr','May', 'Jun', 'Jul', 'Ago', 'Sep','Oct','Nov'],
    
    datasets: [


    {
      label               : 'Precipitaciones',
      fillColor           : 'rgba(60,141,188,0.9)',
      strokeColor         : 'rgba(60,141,188,0.8)',
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : [datos[0].Mes1, datos[0].Mes2, datos[0].Mes3, datos[0].Mes4, datos[0].Mes5, datos[0].Mes6, datos[0].Mes7, datos[0].Mes8, datos[0].Mes9, datos[0].Mes10, datos[0].Mes11, datos[0].Mes12],
      
    }
    ]
  }
  
//-------------
    //- AREA CHART -
    //-------------

   /* var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : true,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 2,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)*/

   //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    //barChartData.datasets[1].strokeColor = '#00a65a'
   // barChartData.datasets[1].pointColor  = '#00a65a'
   var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
    
  }

</script>



<script>

  var vars;
  var temp_c;
  var temp_f;

  $.ajax({
   type: "GET",
   //url: "http://samples.openweathermap.org/data/2.5/weather?id=2172797&appid=b6907d289e10d714a6e88b30761fae22",
   url: "/sector/1/pluviometry"
   dataType: "json",
   
   success: function (data) {
    vars = data.main;
    temp_c = vars.temp - 273.15;
    temp_f = 1.8 * (vars.temp - 273.15) + 32;
  },
  error: function (jqXHR, textStatus, errorThrown) {
    alert(errorThrown);
  }
});

</script>
@endsection