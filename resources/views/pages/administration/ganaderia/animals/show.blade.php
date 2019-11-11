<?php header('Access-Control-Allow-Origin: *'); ?>
@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Detalles del Animal  $animal->animal_cod")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection


@section('content')

        <!--Modal-->
        <div class="modal fade" tabindex="-1" id="modal-form">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>

              <div class="modal-body">
               <div id="info_modal">

                <!--movetorodeo start -->
                <div id="form-move-to-rodeo" class="form-move">
                  <ul>
                    @foreach($rodeos as $rodeo)

                            <form method="GET"
                                action="{{ route('update_rodeo', [$animal->id, $rodeo->id]) }}"
                                id="form-update-rodeo-{{ $rodeo->id }}"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>

                      <!--li id="movetorodeo"><a href="{{ route('update_rodeo', [$animal->id, $rodeo->id]) }}">{{ $rodeo->rodeo_na }}</a></li-->
                      <li class="btn-update-rodeo" id="{{ $rodeo->id }}"><a href="javascript:void(0)">{{ $rodeo->rodeo_na }}</a></li>
                    @endforeach
                   </ul>
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                </div>  
                </div>    
                <!-- movetorodeo end -->

                <!--movetopadock start -->
                <div id="form-move-to-paddock" class="form-move">
                  <ul>
                    @foreach($paddocks as $paddock)

                            <form method="GET"
                                action="{{ route('update_paddock', [$animal->id, $paddock->id]) }}"
                                id="form-update-paddock-{{ $paddock->id }}"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>

                      <!--li id="movetorodeo"><a href="{{ route('update_rodeo', [$animal->id, $rodeo->id]) }}">{{ $rodeo->rodeo_na }}</a></li-->
                      <li class="btn-update-paddock" id="{{ $paddock->id }}"><a href="javascript:void(0)">{{ $paddock->paddock_na }}</a></li>
                    @endforeach
                   </ul>
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                </div>  
                </div>    
                <!-- movetopadock end -->


                <!--Form Edit Start -->
                <div id="form_edit_animal" class="form-move">
                  <form class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('animal.update', $animal) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" autocomplete="off" class="form-control" name="animal_na" id="animal_na" value="{{ $animal->animal_na }}" placeholder="Nombre del Animal (Opcional)">
                  </div>
                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label">Código: </label>
                  <div class="col-sm-5">
                    <input type="text" maxlength="30" autocomplete="off" class="form-control" name="animal_cod" id="animal_cod" placeholder="Codigo del Animal (Requerido)" value="{{ $animal->animal_cod }}" required="">
                  </div>

                  <div class="col-sm-5">
                    <select class="form-control" name="animal_col" id="animal_col">
                          <option value='{{ $animal->animal_col }}'>{{ $animal->animal_col }}</option>
                          <option value='Negro'>Negro</option>
                          <option value='Blanco'>Blanco</option>
                          <option value='Blanco y Negro'>Blanco y Negro</option>
                          <option value='Negro y Blanco'>Negro y Blanco</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Raza: </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="breed_id" id="breed_id" required value="{{ old('breed_id') }}">
                      <option value=' {{ $animal->breed_id }}'>{{ $animal->breed->breed_na  }}</option>
                        @foreach($species as $specie)
                          <optgroup label="{{ $specie->specie_de }}">
                          @foreach($breeds as $item)
                            @if($specie->id == $item->Specie->id)
                              <option value="{{$item->id}}">
                                <!-- {{ $item->Specie->specie_de }} -->
                                     {{ $item->breed_de }}
                              </option>
                            @endif
                          @endforeach
                          </optgroup>
                        @endforeach
                    </select>
                  </div>

                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-5 btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-xs btn-default active">
                        <i class="fa fa-male"></i>
                        <input type="radio" name="gender" id="macho" autocomplete="off" value="m" checked=""> MACHO
                      </label>
                      <label class="btn btn-xs btn-default">
                        <i class="fa fa-female"></i>
                        <input type="radio" name="gender" id="hembra" autocomplete="off" value="f"> HEMBRA
                      </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ingreso: </label>
                  <div class="col-sm-5">
                    <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" value="{{ $animal->date_in }}" name="date_in" id="date_in" placeholder="Fecha de Ingreso" required>
                  </div>

                  <div class="col-sm-5">
                      <input type="number" maxlength="30" class="form-control" name="weight_in" id="weight_in" placeholder="Peso al Ingresar (Requerido)" required="" value="{{ $animal->weight_in }}">
                  </div>
                </div>

            <div class="form-group">
                  <label class="col-sm-2 control-label">Lote: </label>
                  <div class="col-sm-5">
                    <input type="number" step="1" min="1" class="form-control" value="{{ $animal->lot_id }}" name="lot_id" id="lot_id" placeholder="Lote en el que llegó (Requerido)" required="">
                  </div>

                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-5 btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-xs btn-default active">
                        <i class="fa fa-bank"></i>
                        <input type="radio" name="condition" id="propio" autocomplete="off" value="propia" {{ ($animal->lot_id==2)? "checked" : "" }} > PROPIO
                      </label>
                      <label class="btn btn-xs btn-default">
                        <i class="fa fa-cut"></i>
                        <input type="radio" name="condition" id="mediania" autocomplete="off" value="mediania" {{ ($animal->lot_id==3)? "checked" : "" }}> MEDIANIA
                      </label>
                  </div>
            </div>

             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Potrero: </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="paddock_id" id="paddock_id" required>
                        <option value='{{ $animal->paddock_id }}'>{{ $animal->paddock->paddock_na }}</option>
                          @foreach($paddocks as $paddock)
                              <option value="{{$paddock->id}}">
                                {{ $paddock->paddock_na }}
                              </option>
                          @endforeach
                    </select>
                  </div>

                  <div class="col-sm-5">
                    <select class="form-control" name="rodeo_id" id="rodeo_id" required>
                       <option value='{{ $animal->rodeo_id }}'>{{ $animal->rodeo->rodeo_na }}</option>
                          @foreach($rodeos as $rodeo)
                              <option value="{{$rodeo->id}}">
                                {{ $rodeo->rodeo_na }}
                              </option>
                          @endforeach
                    </select>
                  </div>
             </div>

            <div class="form-group">
              <label  class="col-sm-2 control-label">Observacion: </label>
              <div class="col-sm-10">
                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Observaciones si Existen (Opcional)">{{ $animal->comment }}</textarea>
              </div>
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info pull-right">Actualizar</button>
              </div>
              <!-- /.box-footer -->
          </div>
        </form>
                 
                </div>    
                <!-- movetopadock end -->


                 <!--add-weighing start -->
                <div id="form-add-weigth" class="form-add-weigth">
                            
                            <!-- form start -->
                          @if($animal->rodeo_id == '1')
                            <form class="form-horizontal"
                                    role="form"
                                    method="POST"
                                    action="{{ route('weighing.store') }}">
                                {{ csrf_field() }}
                              <div class="box-body">

                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Fecha: </label>

                                  <div class="col-sm-6">
                                    <input type="date" min="{{ $animal->date_in }}" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control" name="date_read" id="date_read" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Peso: </label>

                                  <div class="col-sm-10">
                                    <input type="number" step="0.1" class="form-control" name="weight" id="weight" placeholder="Introduzca el Peso en Kg" required>
                                  </div>
                                </div>
                              </div>
                              <!-- /.box-body -->
                                  <input type="hidden" name="animal_id" id="animal_id" value="{{ $animal->id }}">
                              <div class="box-footer">
                                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-info pull-right">Guardar</button>
                              </div>
                              <!-- /.box-footer -->
                            </form>
                          @else
                           <div class="box-body">
                             <div class="form-group">
                              <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Ooops.!</h4>
                                  No puede agregar pesajes a Animales pertenecientes al Rodeo de Animales: <strong>{{ $animal->rodeo->rodeo_na }}</strong>.<hr>
                                  Puede Mover este Animal al Rodeo "Animales para Engorde" haciendo click <a href="{{ route('movetorodeo', $animal->id) }}">AQUI</a>
                              </div>
                             </div> 
                           </div>
                          @endif
                          
             
                </div>    
                <!-- add weighing end -->
               </div>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- Fin Modal -->
        


  <div class="row">
    
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset ('img/default_image.jpg') }}" alt="Animal Picture Default">

              <h3 class="profile-username text-center">{{ $animal->animal_na }}</h3>

              <p class="text-muted text-center">Datos Generales de {{ $animal->animal_na }}</p>

              <ul class="nav nav-stacked">

                <li><a href="#">C&oacute;digo <span class="pull-right badge bg-purple">{{ $animal->animal_cod }}</span></a></li>
                <li><a href="#">Peso al Ingresar<span class="pull-right badge bg-aqua">{{ $animal->weight_in }} Kgs</span></a></li>
                <li><a href="#">Rodeo Actual<span class="pull-right badge bg-orange">{{ $animal->rodeo->rodeo_na }}</span></a></li>
                <li><a href="#">Potrero Actual<span class="pull-right badge bg-navy">{{ $animal->paddock->paddock_na }}</span></a></li>
                <li><a href="#">Especie<span class="pull-right badge bg-teal">{{ $animal->breed->specie->specie_na }}</span></a></li>
                <li><a href="#">Raza<span class="pull-right badge bg-maroon">{{ $animal->breed->breed_na }}</span></a></li>
                <li><a href="#">Condici&oacute;n<span class="pull-right badge bg-purple">{{ $animal->condition }}</span></a></li>
                <li><a href="#">Fecha de Ingreso <span class="pull-right badge bg-red">{{ $animal->date_in }}</span></a></li>
                <li><a href="#">Ultimo Pesaje <span class="pull-right badge bg-purple">{{ $weight }} Kgs</span></a></li>
                <li><a href="#">Ganancia de Peso <span class="pull-right badge bg-purple">{{ ($weight - $animal->weight_in) }} Kgs</span></a></li>
                

                </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Menu Animal</a></li>

              <li><a href="#settings" data-toggle="tab">Ganancia de Peso</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('img/bull.png') }}" alt="user image">
                        <span class="username">
                          <a href="#">{{ $animal->animal_na }}</a>
                          
                        </span>
                    <span class="description">Registrado en el Sistema el dia {{  $animal->created_at->format('d-m-Y') }}</span>
                  </div>
                  <!-- /.user-block -->
                  <!-- /.box-header -->
            <div class="box-body" >


              <!-- /.tab-pane -->
 
              <!-- /.tab-pane -->

              <form method="POST"
                        id="form-destroy-{{ $animal->id }}"
                        action="{{ route('animal.destroy', $animal) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
              </form>


              <div class="text-muted well well-sm no-shadow">
              @if($animal->rodeo_id == '1') 

                        <a href="javascript:void(0)" id="movetorodeo"><img src="{{ asset('img/movetorodeo.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="addweighing" class="addweighing"><img src="{{ asset('img/addweighing.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="addheat"><img src="{{ asset('img/addheat.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="addsanity"><img src="{{ asset('img/addsanity.png') }}" alt="..." class="margin"></a>
                        
                        <a href="javascript:void(0)" class="movetopaddock" id="movetopaddock"><img src="{{ asset('img/movetopaddock.png') }}" alt="..." class="margin"></a>
                        
                        <a href="javascript:void(0)" id="editanimal"><img src="{{ asset('img/editanimal.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="{{ $animal->id }}" class="btn-delete"><img src="{{ asset('img/deleteanimal.png') }}" alt="..." class="margin"></a>

                        <a href="{{ route('animal.index') }}"><img src="{{ asset('img/listofanimals.png') }}" alt="..." class="margin"></a>
                                          

              @else

                    <a href="javascript:void(0)" id="movetorodeo"><img src="{{ asset('img/movetorodeo.png') }}" alt="..." class="margin"></a>

                    
                      <a href="{{ route('animal.edit', $animal) }}"><img src="{{ asset('img/editanimal.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="{{ $animal->id }}" class="btn-delete"><img src="{{ asset('img/deleteanimal.png') }}" alt="..." class="margin"></a>

                        <a href="{{ route('animal.index') }}"><img src="{{ asset('img/listofanimals.png') }}" alt="..." class="margin"></a>

                    <ul class="list-inline">      
                      <li class="pull-right">
                        <a href="#" class="link-black text-sm text-red"><i class="fa fa-info-circle"></i>Menú limitado por el Rodeo al que pertenece el Animal</a></li>
                  </ul>

              @endif
                   <ul class="list-inline">
                      <li><a href="{{ route('animal.create') }}" class="link-black text-sm"><i class="fa fa-plus-circle"></i> Nuevo Animal</a></li>
                      <li><a href="{{ route('weighing.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Pesajes</a></li>
                   </ul> 

                   <div class="chart">
                
              </div>
              </div>


            </div>

        
                </div>
                <!-- /.post -->

              </div>



              <div class="tab-pane" id="settings">
                <div class="callout callout-danger" id="errorGraph"><p id="infoErrorGraph"></p></div>  
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
      
  
    <div class="col-md-12">
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Ganancia de Peso</h3>
            </div>
        <div class="box-body">    
            @if($animal->rodeo_id == '1')
            <!-- graph start -->
            <canvas id="lineChart" style="height:200px"></canvas>
            <canvas id="areaChart" style="height:200px"></canvas>
            <!-- graph end -->
            @else
            <div class="callout callout-danger" id="errorGraph">
              <p>Este Animal no Pertenece al Rodeo de Machos para Engorde.</p>
            </div>
            @endif
        </div>
      </div>
    </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->  

@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>

<script type="text/javascript" src="{{ asset('scripts/confirm-update-rodeo.js') }}"></script>

<script type="text/javascript" src="{{ asset('scripts/confirm-update-paddock.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>


<script type="text/javascript">

  $(function(){
      //Funcion Ejecuta Modal para Mover de Rodeo
      $( "#movetorodeo").on('click', function(){
         $('.modal-title').text('Mover de Rodeo');
          $('#form-add-weigth').hide();
          $('#form_edit_animal').hide();
          $('#form-move-to-paddock').hide();
          $('#form-move-to-rodeo').show();
          $('#modal-form').modal('show');
     });

      //Funcion Ejecuta Modal Agregar Pesaje al Animal Actual
      $( "#addweighing").on('click', function(){
         $('.modal-title').text('Agregar Pesaje a Este Animal');
          $('#form-move-to-rodeo').hide();
          $('#form_edit_animal').hide();
          $('#form-move-to-paddock').hide();
          $('#form-add-weigth').show();
          $('#modal-form').modal('show');
     });

      //Funcion Ejecuta Modal Mover de Potrero al Animal Actual
      $( "#movetopaddock").on('click', function(){
         $('.modal-title').text('Mover de Potrero Este Animal');
          $('#form-move-to-rodeo').hide();
          $('#form_edit_animal').hide();
          $('#form-add-weigth').hide();
          $('#form-move-to-paddock').show();
          $('#modal-form').modal('show');
     });

      //Funcion Ejecuta Modal Agregar Pesaje al Animal Actual
      $( "#editanimal").on('click', function(){
         $('.modal-title').text('Editar Este Animal');
          $('#form-move-to-rodeo').hide(); 
          $('#form-move-to-paddock').hide();
          $('#form-add-weigth').hide();
          $('#form_edit_animal').show();
          $('#modal-form').modal('show');
     });

       $( "#addsanity").on('click', function(){
          alert("En Construccion");
     });

       $( "#addheat").on('click', function(){
          alert("En Construccion");
     });



  });

</script>



<script type="text/javascript">

   var url = "/animal/{{$animal->id}}/getweighins";
    $(document).ready(function(){
     $('#errorGraph').hide();
     $('#barChart').hide();
     $('#pieChart').hide();
     $('#areaChart').hide();
     $.ajax({
      dataType: 'json',
      url: url,
      method: "GET",
        success: function(datos)
        {
          console.log(datos.length);
          getGraphic(datos);

        },
       timeout:9000,
         error: function()
         {
          $('#errorGraph').show();
          $('#infoErrorGraph').text('Error al Sincronizar con El Servidor - Error al Obtener Grafico de Ganancias de Peso');
         console.log("Error Sincronizando");
         }

      });
  });

   function getGraphic(datos) {

 
       
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)
    
    //ASIGNAMOS LOS VALORES A LAS ETIQQUETAS Y LOS DATASETS DEL GRAFICO 
    var labels = ['Inicio','{{ $animal->date_in }}'], data=[0,'{{ $animal->weight_in }}'];
    datos.forEach(function(datos) {
      labels.push(datos.date);
      data.push(datos.weight);
    });

    var arrayLaravel= "";
    var areaChartData = {
      labels  : labels,
      datasets: [

        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data
        }
      ]
    }
 
    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
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
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
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
    areaChart.Line(areaChartData, areaChartOptions)

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)


  }

</script>

@endsection