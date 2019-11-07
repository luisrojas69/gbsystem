@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Animales Granja Boraure")


@section('content')
    @include('layouts._my_message')
    @include('layouts._my_error')

    <section class="content">
      <div class="row">

      <div class="box-body">
      <!-- left column -->  
        <div class="col-md-8">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Administracion de @yield('title-page') (Activos)</h3>
                <a class="no-margin pull-right"
                                title="Exportar a PDF"
                                href="{{ route('animals.pdf') }}">
                                <span class="label label-danger"><i class="fa fa-file-pdf-o"></i></span>    
               </a>
              </div>

                            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 50px">image</th>
                  <th style="width: auto">Nombre</th>
                  <th style="width: auto">Cod</th>
                  <th>Especie</th>
                  <th>Raza</th>
                  <th>Potrero</th>
                  <th style="width: auto">Ingreso</th>
                  <th style="width: 60px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($animals_active as $animal)
                <tr>
                  <td><a href="{{ route('animal.show', $animal->id) }}"><img src="{{ asset('img/bull.png') }}"></a></td>
                  <td><a href="{{ route('animal.show', $animal->id) }}">{{ $animal->animal_na }}</a></td>
                  <td>{{ $animal->animal_cod }}</td>
                  <td>{{ $animal->breed->specie->specie_na }}</td>
                  <td>{{ $animal->breed->breed_na }}</td>
                  <td>{{ $animal->paddock->paddock_na }}</td>
                  <td>{{ $animal->date_in }}</td>
                  <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar"
                            onclick="event.preventDefault();
                            document.getElementById('form-edit-{{ $animal->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>

                        <form method="GET"
                            action="{{ route('animal.edit', $animal) }}"
                            id="form-edit-{{ $animal->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $animal->id }}"
                          class="btn-delete"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $animal->id }}"
                        action="{{ route('animal.destroy', $animal) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                  </td>
                </tr>
               @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <a class="btn btn-primary no-margin pull-right"
                                title="Crear un nueva animal"
                                href="{{ route('animal.create') }}">
                                <i class="fa fa-plus"></i> Agregar Nuevo
                     </a>
            </div>

          </div>

        </div>
        <!-- END left column -->

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
              <a href="{{ route('animal.create') }}" class="btn btn-app">
                <i class="fa fa-paw"></i> Nuevo Animal
              </a>
              <a href="{{ route('multimovetorodeo') }}" class="btn btn-app">
                <i class="fa fa-cube"></i> Mover Multiples Animales a otro Rodeo
              </a>
              <a href="#" class="btn btn-app">
                <i class="fa fa-bar-chart"></i> Reporte de Ganado
              </a>
              <a href="{{ route('home') }}" class="btn btn-app">
                <i class="fa fa-home"></i> Menu Principal
              </a>
            </div>
          </div>
          <!-- /.box -->
          
        </div>
    <!-- END right column -->


      </div>
             <!-- Animales Inactivos column -->  
        <div class="box-body">
          <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Administracion @yield('title-page') (Inactivos)</h3>
              </div>

          <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 50px">image</th>
                  <th style="width: auto">Nombre</th>
                  <th style="width: auto">Cod</th>
                  <th>Especie</th>
                  <th>Raza</th>
                  <th>Rodeo</th>
                  <th>Potrero</th>
                  <th style="width: auto">Ingreso</th>
                  <th style="width: 80px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($animals_inactive as $animal)
                <tr>
                  <td><a href="{{ route('animal.show', $animal->id) }}"><img src="{{ asset('img/bull.png') }}"></a></td>
                  <td><a href="{{ route('animal.show', $animal->id) }}">{{ $animal->animal_na }}</a></td>
                  <td>{{ $animal->animal_cod }}</td>
                  <td>{{ $animal->breed->specie->specie_na }}</td>
                  <td>{{ $animal->breed->breed_na }}</td>
                  <td>{{ $animal->rodeo->rodeo_na }}</td>
                  <td>{{ $animal->paddock->paddock_na }}</td>
                  <td>{{ $animal->date_in }}</td>
                  <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar"
                            onclick="event.preventDefault();
                            document.getElementById('form-edit-{{ $animal->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>

                        <form method="GET"
                            action="{{ route('animal.edit', $animal) }}"
                            id="form-edit-{{ $animal->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $animal->id }}"
                          class="btn-delete"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $animal->id }}"
                        action="{{ route('animal.destroy', $animal) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                  </td>
                </tr>
               @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->

          </div>

        </div>
        <!-- END Animales Inactivos column -->

    </div>
    </section>    




@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>
@endsection