@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Animales Granja Boraure")


@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection
@section('content')


<!--Formulario para Editar Registro-->
<div class="modal fade" id="modal-form-update" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form_animal" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('animal.update','test') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }} 
        <input type="hidden" name="animal_id" id="animal_id" value="">             
        @include('layouts.includes.partials.forms.ganaderia.form_animals')
      </form>
    </div>
  </div>
</div>
</div>


<!--Formulario para Insertar Pesaje-->
<div class="modal fade" id="modal-form-weighing" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form_weighinf" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('weighing.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="animal_id" id="animal_id" value="">             
        <input type="hidden" name="name_animal" id="name_animal" value="">
        @include('layouts.includes.partials.forms.ganaderia.form_weighings2')             
      </form>
    </div>
  </div>
</div>
</div>



<section class="content">
  <div class="row">

    <div class="box-body">
      <!-- left column -->  
      <div class="col-md-9">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Administracion de @yield('title-page') (Activos)</h3>

            <form action="{{ route('animal.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
              <div class="input-group input-group-sm">
                <input type="text" name="name" class="form-control" placeholder="Nombre o Codigo del Animal">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                </span>
              </div>
            </form> 

          </div>

          <div class="box-body">
            <table class="table table-bordered">
              <tbody><tr>
                <th>image</th>
                <th>Nombre</th>
                <th>Cod</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Potrero</th>
                <th>Lote</th>
                <th>U. Pesaje</th>
                <th>Ingreso</th>
                <th style="width: auto; text-align: center;">Acciones</th>
              </tr>
              @foreach($animals_active as $animal)
              <tr>
                <td><a href="{{ route('animal.show', $animal->id) }}"><img src="{{ asset('img/bull.png') }}"></a></td>
                <td><a href="{{ route('animal.show', $animal->id) }}">{{ $animal->animal_na }}</a></td>
                <td>{{ $animal->animal_cod }}</td>
                <td>{{ $animal->breed->specie->specie_na }}</td>
                <td>{{ $animal->breed->breed_na }}</td>
                <td>{{ $animal->paddock->paddock_na }}</td>
                <td>{{ $animal->lotAnimal->lot_co }}</td>

                <td style="text-align: center;">
                  @if($animal->numWeighings>0)   
                  <span class="label label-info">{{ $animal->weighings->last()->weight }} Kgs</span>
                  @else
                  <span class="label bg-maroon">{{ $animal->weight_in }} Kgs</span>
                  @endif  
                </td>

                <td>{{ $animal->date_in }}</td>
                <td style="text-align: center;">

                  @can('animal.edit')
                  <a href=""
                  title="Editar"
                  data-toggle="modal"
                  data-target="#modal-form-update"
                  data-animal_na="{{ $animal->animal_na }}"
                  data-animal_id="{{ $animal->id }}"
                  data-animal_cod="{{ $animal->animal_cod }}"
                  data-animal_breed="{{ $animal->breed_id }}"
                  data-animal_lot="{{ $animal->lot_animal_id }}"
                  data-animal_col="{{ $animal->animal_col }}"
                  data-animal_gender="{{ $animal->gender }}"
                  data-animal_date="{{ $animal->date_in }}"
                  data-animal_weight_in="{{ $animal->weight_in }}"
                  data-animal_condition="{{ $animal->condition }}"
                  data-animal_paddock_id="{{ $animal->paddock_id }}"
                  data-animal_rodeo_id="{{ $animal->rodeo_id }}"
                  data-animal_comment="{{ $animal->comment }}"
                  data-title="Formulario de Edicion - Editar {{ $animal->animal_na }}"

                  >
                  <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                </a>
                @endcan

                @can('weighing.store')
                  <a href=""
                  title="Insertar Pesaje para el Animal: {{ $animal->animal_na }}"
                  data-toggle="modal"
                  data-target="#modal-form-weighing"
                  data-animal_na="{{ $animal->animal_na }}"
                  data-animal_id="{{ $animal->id }}"
                  @if($animal->numWeighings>0)   
                  data-animal_lw="{{ $animal->weighings->last()->weight }} Kgs"
                  @else
                  data-animal_lw="{{ $animal->weight_in }} Kgs"
                  @endif
                  data-title="Insertar Pesaje para el Animal: {{ $animal->animal_na }}"

                  >
                  <span class="label label-warning"><i class="fa fa-balance-scale"></i></span>
                </a>
                @endcan


                @can('animal.destroy')
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
                @endcan 

              </td>
            </tr>
            @endforeach

          </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">

          {{ $animals_active->links() }}


          <a title="Exportar a PDF"
          href="{{ route('animals.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
          <i class="fa fa-download"></i> Generar PDF
        </a>

        <a title="Exportar a Excel"
        href="{{ route('animals.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
        <i class="fa fa-download"></i> Generar EXCEL
      </a>  

      @can('animal.create')
      <a class="btn btn-primary pull-right"
      title="Crear un nueva animal"
      style="margin-right: 5px;"
      href="{{ route('animal.create') }}">
      <i class="fa fa-plus"></i> Agregar Nuevo
      </a>
      @endcan


  </div>

</div>

</div>
<!-- END left column -->

<!-- right column -->
<div class="col-md-3">
  <!-- Horizontal Form -->
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Acciones Posibles</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
      <a href="{{ route('multimovetorodeo') }}" class="btn btn-app">
        <i class="fa fa-cube"></i> Mover Multiples Animales a otro Rodeo
      </a>
      <a href="{{ route('multimovetopaddock') }}" class="btn btn-app">
        <i class="fa fa-bank"></i> Mover Multiples Animales a otro Potrero
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
      <a title="Exportar a PDF"
      href="{{ route('animals.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
      <i class="fa fa-download"></i> Generar PDF
    </a>

    <a title="Exportar a Excel"
    href="{{ route('animals.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
    <i class="fa fa-download"></i> Generar EXCEL
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

<script type="text/javascript">

  $(function(){
    $('#modal-form-update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var animal_id = button.data('animal_id')
        var animal_cod = button.data('animal_cod') // Extract info from data-* attributes
        var animal_na = button.data('animal_na')
        var animal_breed  = button.data('animal_breed' )
        var animal_lot  = button.data('animal_lot' )
        var animal_col = button.data('animal_col')
        var animal_gender = button.data('animal_gender')
        var animal_date = button.data('animal_date')
        var animal_weight_in = button.data('animal_weight_in')
        var animal_condition = button.data('animal_condition')
        var animal_paddock_id = button.data('animal_paddock_id')
        var animal_rodeo_id = button.data('animal_rodeo_id')
        var animal_comment = button.data('animal_comment')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #animal_id').val(animal_id)
        modal.find('.modal-body #animal_cod').val(animal_cod)
        modal.find('.modal-body #animal_na').val(animal_na)
        modal.find('.modal-body #breed_id').val(animal_breed)
        modal.find('.modal-body #lot_animal_id').val(animal_lot)
        modal.find('.modal-body #animal_col').val(animal_col)
        //modal.find('.modal-body #gender').val(animal_gender)
        modal.find('.modal-body #date_in').val(animal_date)
        modal.find('.modal-body #weight_in').val(animal_weight_in)
        //modal.find('.modal-body #condition').val(animal_condition)
        modal.find('.modal-body #paddock_id').val(animal_paddock_id)
        modal.find('.modal-body #rodeo_id').val(animal_rodeo_id)
        modal.find('.modal-body #comment').val(animal_comment)
       
             //Verificamos el Genero para Marcar el Radio Button
        if (animal_gender == 'm')
        {
         modal.find('.modal-body #macho').prop('checked', true)
       }
       else
       {
         modal.find('.modal-body #hembra').prop('checked', true)
       }

        //Verificamos la Condicion del Animal (Propio o Mediania) para Marcar el Radio Button
        if (animal_condition == 'propia')
        {
         modal.find('.modal-body #propio').prop('checked', true)
       }
       else
       {
         modal.find('.modal-body #mediania').prop('checked', true)
       }


      })

  });
  
</script>

<script type="text/javascript">

  $(function(){
    $('#modal-form-weighing').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var animal_id = button.data('animal_id')
        var animal_na = button.data('animal_na')
        var lastWeight = button.data('animal_lw')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #animal_id').val(animal_id)
        modal.find('.modal-body #animal_na').val(animal_na)
        modal.find('.modal-body #infoLastWeight').text(lastWeight)
      })

  });
  
</script>

@endsection