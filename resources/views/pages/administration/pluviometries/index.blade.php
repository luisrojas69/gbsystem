@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">

<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset ('css/daterangepicker.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset ('css/bootstrap-datepicker.min.css') }}">  
@endsection

@section('title-page', "Pluviometria Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="col-md-6">
  <div class="box">

    <!--Formulario para Crear un Nuevo Registro-->  
    <div class="modal fade" id="modal-form-store" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Registrar un Nueva Pluviometria</h4>
          </div>
          <div class="modal-body">
            <form id="form_pluviometry" class="form-horizontal"
            role="form"
            method="POST"
            action="{{ route('pluviometry.store') }}">
            {{ csrf_field() }}        
            @include('layouts.includes.partials.forms.pluviometry.form_pluviometries')
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--Formulario para Editar Registro-->
  <div class="modal fade" id="modal-form-update" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <form id="form_pluviometry" class="form-horizontal"
          role="form"
          method="POST"
          action="{{ route('pluviometry.update','test') }}">
          {{ csrf_field() }}
          {{ method_field('patch') }} 
          <input type="hidden" name="pluviometry_id" id="pluviometry_id" value="">             
          @include('layouts.includes.partials.forms.pluviometry.form_pluviometries')
        </form>
      </div>
    </div>
  </div>
</div>


<div class="box-header with-border">
  <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

  <a title="Exportar a PDF"
  href="{{ route('pluviometries.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
  <i class="fa fa-download"></i> Generar PDF
</a>

<a title="Exportar a Excel"
href="{{ route('pluviometries.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
<i class="fa fa-download"></i> Generar EXCEL
</a>

</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
     <th style="text-align: center;">Fecha</th>
     <th>MM</th>
     <th>Sector</th>
     <th style="text-align: center;">Acciones</th>
   </tr>
   @foreach($pluviometries as $pluviometry)
   <tr>
    <td style="text-align: center;">{{ $pluviometry->date_read }}</td>
    <td style="text-align: center;">{{ $pluviometry->value_mm }}</td>
    <td><a href="{{ route('sector.show', $pluviometry->sector_id) }}">{{$pluviometry->Sector->sector_de}}</a></td>
    <td style="text-align: center;">

     @can('pluviometry.edit')
     <a href=""
     title="Editar"
     data-toggle="modal"
     data-target="#modal-form-update"
     data-sector_id="{{ $pluviometry->sector_id }}"
     data-value_mm="{{ $pluviometry->value_mm }}"
     data-date_read="{{ $pluviometry->date_read }}"
     data-pluviometry_id="{{ $pluviometry->id }}"
     data-title="Formulario de Edicion - Editar {{ $pluviometry->pluviometry_na }}"
     >
     <span class="label label-primary"><i class="fa fa-pencil"></i></span>
   </a>

   @endcan

   @can('pluviometry.destroy')
   <a href="javascript:void(0)" id="{{ $pluviometry->id }}"
    class="btn-delete"
    title="Eliminar">
    <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

    <form method="POST"
    id="form-destroy-{{ $pluviometry->id }}"
    action="{{ route('pluviometry.destroy', $pluviometry) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
  </form>
  @endcan

</td>
</tr>
@endforeach

</tbody></table>
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
  @can('pluviometry.create')
  <button 
  type="button" 
  class="btn btn-primary no-margin pull-right" 
  data-toggle="modal" 
  data-target="#modal-form-store">
  <i class="fa fa-plus"></i>Agregar Nueva
</button>
@endcan    
</div>
</div>
</div>


<!--RIGHT SIDE-->
<div class="col-md-6">
  <div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-blue">
      <div class="widget-user-image">
        <img class="img-circle" src="../img/logo-analisis.png" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username" id="nombre_tablon">Grafico de Pluviometria por Fecha</h3>
      <h5 class="widget-user-desc">Informacion Resumida</h5>
    </div>


    <!-- /.box-body -->
    <!-- Loading (remove the following to stop the loading)-->
    <div class="overlay" id="loading" style="display: none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <div class="box-header">
     <div class="pull-right">
      <a class="btn btn-default pull-right" id="daterange-btn">
        <span>
          <i class="fa fa-calendar"></i> Seleccione Rango de Fecha
        </span>
        <i class="fa fa-caret-down"></i>
      </a>
    </div>
  </div>
  <!-- end loading -->

   <canvas id="barChart" style="height:200px"></canvas>
   <!--canvas id="lineChart" style="height:200px"></canvas>
   <canvas id="areaChart" style="height:200px"></canvas-->
  <div class="box-footer no-padding">

    <div class="box-footer">
      @can('pluviometry.create') 
      <a class="btn btn-primary no-margin pull-right" 
      title="Agregar una nueva Precipitacion" 
      href="javascript:void(0)"
      data-toggle="modal" 
      data-target="#modal-form-store">
      <i class="fa fa-plus"></i> Precipitacion
    </a>
    @endcan
  </div>
</div>
</div>
</div>
<!--END RIGHT SIDE-->

@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>

<script type="text/javascript">

  $(function(){
    $('#modal-form-update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var value_mm = button.data('value_mm') // Extract info from data-* attributes
        var date_read = button.data('date_read')
        var sector_id = button.data('sector_id')
        var pluviometry_id = button.data('pluviometry_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #value_read').val(value_mm)
        modal.find('.modal-body #sector_id').val(sector_id)
        modal.find('.modal-body #date_read').val(date_read)
        modal.find('.modal-body #pluviometry_id').val(pluviometry_id)
      })

  });
  
</script>


<!-- date-range-picker -->
<script src="{{ asset('js/moment.min.js') }}"></script>

<script src="{{ asset('js/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>

<script>
  $(function () {

   //Date range as a button
   $('#daterange-btn').daterangepicker(
   {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
      'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
      'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
      'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()

  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'))
    execute(start, end);
  }
  )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })  

  });

  //Function Excute Query
  function execute(st, en){
    var start_date = st.format('YYYY-MM-DD');
    var end_date = en.format('YYYY-MM-DD'); 
    var url = "/pluviometries/pluviometryBySector/"+start_date+"/"+end_date;

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
        console.log(datos);
        getGraphic(datos);
      },
      timeout:9000,
      error: function()
      {
       console.log("Error Sincronizando");
     }

   });
   });
  }


  function getGraphic(datos) {


    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#barChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)
    
    //ASIGNAMOS LOS VALORES A LAS ETIQQUETAS Y LOS DATASETS DEL GRAFICO 
    var labels = [], data=[];
    datos.forEach(function(datos) {
      labels.push(datos.sector_de);
      data.push(datos.total);
    });

    var arrayLaravel= "";
    var areaChartData = {
      labels  : labels,
      datasets: [

      {
        label               : 'Digital Goods',
        fillColor           : 'rgba(10,14,198,0.7)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(0,204,0,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(0,204,0,1)',
        data                : data
      }
      ]
    }
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
      scaleGridLineColor      : 'rgba(0,248,0,.05)',
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
      maintainAspectRatio     : true,

    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)




  }




</script>
@endsection