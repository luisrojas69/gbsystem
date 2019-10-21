@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Movilizaci&oacute;n de Animales a Rodeos")

@section('message')
@include('layouts._my_message')
@include('layouts._my_status')
@include('layouts._my_error')
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
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

        

        <!-- FORMULARIO POR MUERTE  -->

            <form id="form_muerte" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('specie.store') }}">
                            {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>
                      <div class="col-sm-4">
                        <input type="text" maxlength="30" class="form-control" name="animal_na" id="animal_na" value="{{ $animal->animal_na }}" placeholder="Nombre de la Especie" required disabled="">
                      </div>

                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Codigo: </label>
                      <div class="col-sm-4">
                        <input type="text" maxlength="30" class="form-control" name="animal_cod" id="animal_cod" value="{{ $animal->animal_cod }}" placeholder="Nombre de la Especie" required disabled="">
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Fecha: </label>
                        <div class="col-sm-5">
                          <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_read" id="date_read" placeholder="Fecha de la Muerte" required>
                        </div>

                        <div class="col-sm-5">
                          <select id="causa_de_muerte" name="causa_de_muerte" class="form-control" required="">
                            <option value="0"> Seleccione Causa de Muerte</option>
                            <option value="1"> Asfixia Mecanica</option>
                            <option value="2"> Inanici&oacute;n</option>
                            <option value="3"> Acaloramiento</option>
                            <option value="4"> Stress Aguda</option>
                            <option value="5"> Mal manejo al Transportar</option>
                            <option value="6"> Otras Causas</option>
                          </select>

                        </div>
                        </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Adicionales: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="comments" id="comments" placeholder="Detalles adicionales">
                      </div>
                    </div>
                  </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
          </form>

          <!-- FIN FORMULARIO POR MUERTE  -->


          <!--  FORMULARIO POR ROBO  -->

          <form id="form_robo" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('specie.store') }}">
                            {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>
                      <div class="col-sm-4">
                        <input type="text" maxlength="30" class="form-control" name="animal_na" id="animal_na" value="{{ $animal->animal_na }}" placeholder="Nombre de la Especie" required disabled="">
                      </div>

                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Codigo: </label>
                      <div class="col-sm-4">
                        <input type="text" maxlength="30" class="form-control" name="animal_cod" id="animal_cod" value="{{ $animal->animal_cod }}" placeholder="Nombre de la Especie" required disabled="">
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Fecha: </label>
                        <div class="col-sm-5">
                          <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_read" id="date_read" placeholder="Fecha de la Muerte" required>
                        </div>

    
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Adicionales: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="comments" id="comments" placeholder="Detalles adicionales">
                      </div>
                    </div>
                  
                  </div>

              <!-- FIN FORMULARIO POR ROBO  -->



              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
          </form>


               </div>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- Fin Modal -->

        <!-- left column -->

         <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Seleccione Rodeo Destino</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-header with-border">
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
            </div>
          </div>
        </div>
        <!--/.col (left) -->

        <!-- right column -->

        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Administracion de @yield('title-page')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del animal <strong>{{ $animal->animal_na }} - ({{ $animal->animal_cod }})</strong></h3>
                </div>

                Rodeo Actual: {{ $animal->rodeo->rodeo_na }}
            </div>
        </div>
          <!--Rigth Column -->



@endsection

@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')

<script type="text/javascript" src="{{ asset('scripts/confirm-update-rodeo.js') }}"></script>

<script type="text/javascript">

  $(function(){

      //Funcion de Probar el Segundo Formulario
      $( "#movetorodeo1").on('click', function(){
          $('.modal-title').text('Movimiento por Muerte');
          $('#form_robo').hide();
          $('#form_muerte').show();
          $('#modal-form').modal('show');
     });

      $( "#movetorodeo4").on('click', function(){
          daleplay($rodeo->id);
     });

      $( "#movetorodeo5").on('click', function(){
          $('.modal-title').text('Movimiento por Robo');
          $('#form_muerte').hide();
          $('#form_robo').show();
          $('#modal-form').modal('show');
     });


      $("#causa_de_muerte").on('change', function(){
        if($("#causa_de_muerte").val()==6){
          $("#comments").prop('required', true);
        }else{
          $("#comments").prop('required', false);
        }
      });

  });

// FIN Script de Formulario de Areas por Sector


</script>




@endsection