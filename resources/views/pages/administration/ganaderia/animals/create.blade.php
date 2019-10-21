@extends('layouts.master')

@section('title-page', "Registro de Animales Granja Boraure")


@section('content')
@include('layouts._my_message')
@include('layouts._my_error')
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

                <!--form start -->
            <form id="form_species" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('specie.store') }}">
                            {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                      <div class="col-sm-10">
                        <input type="text" maxlength="30" class="form-control" name="specie_na" id="specie_na" placeholder="Nombre de la Especie"  required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Descripcion: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="specie_de" id="specie_de" placeholder="Descripcion del Especie" required>
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


          <form id="form_breeds" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('breed.store') }}">
                {{ csrf_field() }}
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Especie: </label>

                  <div class="col-sm-10">
                   <select autofocus="autofocus" class="form-control" name="specie_id" id="specie_id" value="{{ old('specie_id') }}" required>
                      @foreach($species as $specie)
                      <option value="{{ $specie->id }}">{{ $specie->specie_na }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" class="form-control" name="breed_na" id="breed_na" placeholder="Nombre de la Raza"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="breed_de" id="breed_de" placeholder="Descripcion de la Raza" required>
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


            <form id="form_rodeo" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('rodeo.store') }}">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" class="form-control" name="rodeo_na" id="rodeo_na" placeholder="Nombre de Rodeo" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="rodeo_de" id="rodeo_de" placeholder="Descripcion del Rodeo" required>
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


            <form id="form_paddock" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('paddock.store') }}">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" class="form-control" name="paddock_na" id="paddock_na" placeholder="Nombre del Potrero" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="paddock_de" id="paddock_de" placeholder="Descripcion del Potrero" required>
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
                <!-- form end -->
               </div>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- Fin Modal -->

        <!-- left column -->
<div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('animal.store') }}">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" autocomplete="off" class="form-control" name="animal_na" id="animal_na" value="{{ old('animal_na') }}" placeholder="Nombre del Animal (Opcional)">
                  </div>
                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label">Código: </label>
                  <div class="col-sm-5">
                    <input type="text" maxlength="30" autocomplete="off" class="form-control" name="animal_cod" id="animal_cod" placeholder="Codigo del Animal (Requerido)" required="">
                  </div>

                  <div class="col-sm-5">
                    <select class="form-control" name="animal_col" id="animal_col">
                          <option value=''>Seleccione un Color (Opcional)</option>
                          <option value='Negro'>Negro</option>
                          <option value='Blanco'>Blanco</option>
                          <option value='Blanco y Negro'>Blanco y Negro</option>
                          <option value='Negro y Blanco'>Negro y Blanco</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Especie: </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="breed_id" id="breed_id" required value="{{ old('breed_id') }}">
                      <option value=''>Seleccione una Raza (Requerido)</option>
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
                    <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_in" id="date_in" placeholder="Fecha de Ingreso" required>
                  </div>

                  <div class="col-sm-5">
                      <input type="number" maxlength="30" class="form-control" name="weight_in" id="weight_in" placeholder="Peso al Ingresar (Requerido)" required="">
                  </div>
                </div>

            <div class="form-group">
                  <label class="col-sm-2 control-label">Lote: </label>
                  <div class="col-sm-5">
                    <input type="number" step="1" min="1" class="form-control" name="lot_id" id="lot_id" placeholder="Lote en el que llegó (Requerido)" required="">
                  </div>

                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-5 btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-xs btn-default active">
                        <i class="fa fa-bank"></i>
                        <input type="radio" name="condition" id="propio" autocomplete="off" value="propia" checked=""> PROPIO
                      </label>
                      <label class="btn btn-xs btn-default">
                        <i class="fa fa-cut"></i>
                        <input type="radio" name="condition" id="mediania" autocomplete="off" value="mediania"> MEDIANIA
                      </label>
                  </div>
            </div>

             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Potrero: </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="paddock_id" id="paddock_id" required>
                        <option value=''>Seleccione un Potrero</option>
                          @foreach($paddocks as $paddock)
                              <option value="{{$paddock->id}}">
                                {{ $paddock->paddock_na }}
                              </option>
                          @endforeach
                    </select>
                  </div>

                  <div class="col-sm-5">
                    <select class="form-control" name="rodeo_id" id="rodeo_id" required>
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
                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Observaciones si Existen (Opcional)"></textarea>
              </div>
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('animal.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
          </div>
        </form>
      </div>
    </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-4">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Acciones Posibles</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <a id="boton_specie" class="btn btn-app">
                <i class="fa fa-cube"></i> Nueva Especie
              </a>
              <a id="boton_breed" class="btn btn-app">
                <i class="fa fa-cubes"></i> Nueva Raza
              </a>
              <a id="boton_paddock" class="btn btn-app">
                <i class="fa fa-bank"></i> Nuevo Potrero
              </a>
              <a id="boton_rodeo" class="btn btn-app">
                <i class="fa fa-database"></i> Nuevo Rodeo
              </a>
              <a id="boton_rodeo" class="btn btn-app" href="{{ route('animal.index') }}">
                <i class="fa fa-paw"></i> Lista de Animales
              </a>
            </div>
          </div>
          <!-- /.box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informaci&oacute;n de Inter&eacute;s</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('img/logo2.png') }}" alt="Logo Gb">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Que son los Rodeos?
                      <span class="label label-warning pull-right">?</span></a>
                    <span class="product-description">
                          <h6>Grupo de animales con características en comun.</h6>
                    </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('img/logo2.png') }}" alt="Logo Gb">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Que son los Potreros?
                      <span class="label label-info pull-right">?</span></a>
                    <span class="product-description">
                          <h6>Lugar fisico donde se ubicar&aacute;n los Animales</h6>
                    </span>
                  </div>
                </li>
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">Ir a la Sección de Preguntas Frecuentes</a>
            </div>
            <!-- /.box-footer -->
          </div>
@endsection

@section('additionals-scripts')


<script type="text/javascript">

  $(function(){
      //Funcion de Probar el Segundo Formulario
      $( "#boton_specie").on('click', function(){
          $('.modal-title').text('Registrar Nueva Especie');
          $('#form_breeds').hide();
          $('#form_paddock').hide();
          $('#form_rodeo').hide();
          $('#form_species').show();
          $('#modal-form').modal('show');
     });

      $( "#boton_breed").on('click', function(){
          $('.modal-title').text('Registrar Nueva Raza');
          $('#form_paddock').hide();
          $('#form_rodeo').hide();
          $('#form_species').hide();
          $('#form_breeds').show();
          $('#modal-form').modal('show');
     });

      $( "#boton_paddock").on('click', function(){
          $('.modal-title').text('Registrar Nuevo Potrero');
          $('#form_rodeo').hide();
          $('#form_species').hide();
          $('#form_breeds').hide();
          $('#form_paddock').show();
          $('#modal-form').modal('show');
     });

      $( "#boton_rodeo").on('click', function(){
          $('.modal-title').text('Registrar Nuevo Rodeo');
          $('#form_species').hide();
          $('#form_breeds').hide();
          $('#form_paddock').hide();
          $('#form_rodeo').show();
          $('#modal-form').modal('show');
     });



  });

// FIN Script de Formulario de Areas por Sector


</script>


@endsection