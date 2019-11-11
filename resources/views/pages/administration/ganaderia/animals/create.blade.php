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
                 
                  @include('layouts.includes.partials.forms.ganaderia.form_breeds')
                  @include('layouts.includes.partials.forms.ganaderia.form_rodeos')
                  @include('layouts.includes.partials.forms.ganaderia.form_paddocks') 
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
            @include('layouts.includes.partials.forms.ganaderia.form_animals')           
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
                    <img src="{{ asset('img/interrogacion.jpg') }}" alt="Logo Gb">
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
                    <img src="{{ asset('img/interrogacion.jpg') }}" alt="Logo Gb">
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
         </div>
      </div>
     </section>     
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