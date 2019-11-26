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
        getGraphic(datos);
      },
      timeout:9000,
      error: function()
      {
       console.log("Error Sincronizando");
     }

   });
  }); 


 //--------------------------------------------------------------------------------------------------------------
 function getGraphic(datos){

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



  };

</script>
@endsection