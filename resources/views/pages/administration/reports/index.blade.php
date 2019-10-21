@extends('layouts.master')

@section('title-page', "Reportes Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">


        <div class="modal fade" tabindex="-1" id="modal-report">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>

              <div class="modal-body">
               <div id="info_modal">
                 <div class="overlay" id=loading>
                    <i class="fa fa-refresh fa-spin"></i>
                  </div>
               </div>
              </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="printButton" class="btn bg-navy margin pull-right"><i class="fa fa-print"></i> Imprimir Reporte</button>

              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


        <div class="col-md-3">
          <!--a href="mailbox.html" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a-->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Reportes Disponibles</h3>

              <div class="box-tools">
                <!--button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button-->
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#" id="by_areas"><i class="fa fa-inbox"></i> Areas
                  <span class="label label-primary pull-right">2</span></a></li>
                <li><a href="#" id="by-pluviometries"><i class="fa fa-envelope-o"></i> Pluviometria</a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">M&oacute;dulo de Reportes GbSystem</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                        <!-- Custom Tabs (Pulled to the right) -->
          <div id="tabs-by-areas" class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right" id="pestanias">
              <li class="active"><a href="#tab_1-1" data-toggle="tab">Reporte de Labores</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Reporte de Siembra</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>
              </li>
              <li class="pull-left header"><i class="fa fa-th"></i> Areas por Sector</li>
            </ul>



<!--###########################################################################################################################-->


            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">

          <form id="form_report_general" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('report_general') }}">
                {{ csrf_field() }}

                <div class="form-group">
                  <label class="col-sm-2
                   control-label">Fecha Inicio: </label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" min="2018-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y");?>-01-01" name="date_start" id="date_start" placeholder="Fecha Inicio">
                  </div>
                </div>

                   <div class="form-group">
                  <label class="col-sm-2
                   control-label">Fecha Fin: </label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" min="2018-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_end" id="date_end" placeholder="Fecha Fin" required>
                  </div>
                </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Sector: </label>

                      <div class="col-sm-10">

                        <select class="selectpicker" multiple data-live-search="true" data-live-search-placeholder="Buscar" data-actions-box="true" required="true" name="sector_id[]" id="sector_id">


                           @foreach($sectors as $sector)
                          <option value="{{$sector->id}}">
                                {{$sector->sector_de}}
                              </option>
                            @endforeach

                        </select>

                      </div>


                    </div>

            <div class="form-group">
               <label class="col-sm-2 control-label"></label>

                  <div class="col-sm-5 btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-xs btn-default active">
                        <i class="fa fa-file-pdf-o"></i>
                        <input type="radio" name="format" id="pdf" autocomplete="off" value="pdf" checked=""> PDF
                      </label>
                      <label class="btn btn-xs btn-default">
                        <i class="fa fa-file-excel-o"></i>
                        <input type="radio" name="format" id="xls" autocomplete="off" value="xls"> XLS
                      </label>
                      <label class="btn btn-xs btn-default">
                        <i class="fa fa-bar-chart-o"></i>
                        <input type="radio" name="format" id="online" autocomplete="off" value="online"> ONLINE
                      </label>
                  </div>

            </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <!--input type="submit" name="enviar" value="Enviar"-->
                <a name="boton_enviar" id="boton_enviar" class="btn btn-info pull-right boton_enviar" href="#">Generar Reporte</a>

              </div>
              <!-- /.box-footer -->
            </form>

              </div>



              <!-- /.tab-pane REPORTE POR LOTES TABLONES -->

              <div class="tab-pane" id="tab_2-2">


              <form id="form_report_by_planks" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('report_by_planks') }}">
                {{ csrf_field() }}

                <div class="form-group">
                  <label class="col-sm-2
                   control-label">Fecha Inicio: </label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" name="date_start" id="date_start_by_planks" placeholder="Fecha Inicio">
                  </div>
                </div>

                   <div class="form-group has-error">
                  <label class="col-sm-2
                   control-label">Fecha Fin: </label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" min="2018-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_end" id="date_end_by_planks" placeholder="Fecha Fin" required>
                  </div>
                </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Sector: </label>

                      <div class="col-sm-6">
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

                  <div class="col-sm-10" id="select_dinamic">
                   <select class="selectpicker" multiple data-live-search="false" data-live-search-placeholder="Buscar" data-actions-box="true" name="plank_id[]" id="plank_id" value="{{ old('plank_id') }}" required>
                        <!--option value="">Seleccione un Tablon</option-->
                   </select>
                  </div>
                </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <a name="boton2" id="boton2" href="#" class="btn btn-default">Probar</a>
                <input type="submit" id="submitForm" class="btn btn-info pull-right" value="Guardar">

              </div>
              <!-- /.box-footer -->
            </form>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->


<!--###########################################################################################################################-->


          <div class="box-body" id="tabs-by-pluviometries">

                <form id="form_report_pluviometry" class="form-horizontal"
                        role="form"
                        method="POST"
                        action="{{ route('report_pluviometry') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label class="col-sm-2
                       control-label">A&ntilde;o: </label>

                       <?php
                        $cont = date('Y');
                        ?>
                      <div class="col-sm-3">
                        <select class="form-control" name="anio" id="anio">
                          <?php while ($cont >= 2000) { ?>
                            <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                          <?php $cont = ($cont-1); } ?>
                        </select>
                      </div>

                    </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Sector: </label>

                          <div class="col-sm-10">

                            <select class="selectpicker" multiple data-live-search="true" data-live-search-placeholder="Buscar" data-actions-box="true" required="true" name="pl_sector_id[]" id="pl_sector_id">


                               @foreach($sectors as $sector)
                              <option value="{{$sector->id}}">
                                    {{$sector->sector_de}}
                                  </option>
                                @endforeach

                            </select>

                          </div>


                        </div>

                <div class="form-group">
                   <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-5 btn-group btn-group-toggle" data-toggle="buttons">
                          <label class="btn btn-xs btn-default active">
                            <i class="fa fa-file-pdf-o"></i>
                            <input type="radio" name="pl_format" id="pl_pdf" autocomplete="off" value="pdf" checked=""> PDF
                          </label>
                          <label class="btn btn-xs btn-default">
                            <i class="fa fa-file-excel-o"></i>
                            <input type="radio" name="pl_format" id="pl_xls" autocomplete="off" value="xls"> XLS
                          </label>
                          <label class="btn btn-xs btn-default">
                            <i class="fa fa-bar-chart-o"></i>
                            <input type="radio" name="pl_format" id="pl_online" autocomplete="off" value="online"> ONLINE
                          </label>
                      </div>

                </div>


                  <!-- /.box-body -->
                  <div class="box-footer">
                    <!--input type="submit" name="enviar" value="Enviar"-->
                    <a name="pl_boton_enviar" id="pl_boton_enviar" class="btn btn-info pull-right boton_enviar" href="#">Generar Reporte</a>


                  </div>
                  <!-- /.box-footer -->
                </form>
        </div>
    </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('additionals-js')
<script src=" {{asset('js/bootstrap-select.js')}}"></script>
<script src=" {{asset('js/jquery.PrintArea.js')}}"></script>
@endsection

@section('additionals-scripts')
<script src=" {{asset('scripts/functions-reports.js')}}"></script>


<script type="text/javascript">


  $(function(){

    //Funcion para tablones dinamicos
    var planks = [];

    @include('scripts._select_dinamyc_planks')

        $('#lot_id').on('change', function()
        {
          var lot = $(this).val();

          var selects;

          $.each(planks, function(index, value)
          {
            if(value.lot_id == lot) {
              selects += value.html;
            }
          });

            $("#plank_id").html(selects);
            $(".selectpicker").selectpicker("refresh");

        });
//fin duncion tablones dinamicos

//Funcion de probar el segundo Formulario
  $("#boton2").on('click', function(){

    var plank_id = $('#plank_id').val();
    var date_start = $('#date_start_by_planks').val();
    var date_end = $('#date_end_by_planks').val();

    if($('#plank_id').val() == null) // Si no selecciono ningun tablon entonces:
    {
    alert ("Seleccione al menos un tablon");
    }
    else//Si no está vacio el select de Tablones entonces:
    {

    var url = "/report/by_planks"

      $.ajax({
        dataType: 'json',
        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
        url: url,
        method: 'POST',
        data: {"plank_id": plank_id, "date_start": date_start, "date_end":date_end},

        //Metodo Success Si TODO OK
        success: function(msg)
        {
           $('.modal-title').text("ESTE REPORTE SE ENCUENTRA EN DESARROLLO") //Cambiamos el Titulo
          $('#modal-report').modal('show');
          console.log(msg);
        },
        timeout:9000,
         error: function()
         {
          alert('error');
        },
      })
    }

  })


//FIN Funcion de probar el segundo Formulario



  });

// FIN Script de Formulario de Areas por Sector


</script>


@endsection

