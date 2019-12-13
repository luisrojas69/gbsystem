@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Razas Animales Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="box">


  <!--Formulario para Crear un Nuevo Registro-->  
  <div class="modal fade" id="modal-form-store" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar un Nuevo Raza</h4>
        </div>
        <div class="modal-body">
          <form id="form_breed" class="form-horizontal"
          role="form"
          method="POST"
          action="{{ route('breed.store') }}">
          {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.ganaderia.form_breeds')
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
        <form id="form_breed" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('breed.update','test') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }} 
        <input type="hidden" name="breed_id" id="breed_id" value="">             
        @include('layouts.includes.partials.forms.ganaderia.form_breeds')
      </form>
    </div>
  </div>
</div>
</div>

<div class="box-header with-border">
  <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive">
 <table class="table table-bordered table-hover" id="example1">
  <tbody><tr>
    <th style="width: 60px">ID</th>
    <th style="width: 120px">Nombre</th>
    <th>Descripcion</th>
    <th>Especie</th>
    <th>Num Animales</th>
    <th style="width: 120px; text-align: center;">Acciones</th>
  </tr>
  @foreach($breeds as $breed)

  <tr>
    <td>{{ $breed->id }}</td>
    <td>{{ $breed->breed_na }}</td>
    <td><a href="#">{{ $breed->breed_de }}</a></td>
    <td>{{ $breed->specie->specie_na }}</td>
    <td style="width: 120px; text-align: center;"><span class="badge bg-aqua">{{ $breed->num_animals }}</span></td>
    <td style="text-align: center;">
     
      @can('breed.edit')
      <a href=""
      title="Editar"
      data-toggle="modal"
      data-target="#modal-form-update"
      data-breed_na="{{ $breed->breed_na }}"
      data-breed_de="{{ $breed->breed_de }}"
      data-specie_id="{{ $breed->specie->id }}"
      data-breed_id="{{ $breed->id }}"
      data-title="Formulario de Edicion - Editar {{ $breed->breed_na }}"
      >
      <span class="label label-primary"><i class="fa fa-pencil"></i></span>
    </a>
    @endcan
    @can('breed.destroy')
    <a href="javascript:void(0)" id="{{ $breed->id }}"
      class="btn-delete  {{ $breed->numAnimals >0 ? 'disabled' : '' }}"
      title="Eliminar">
      <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

      <form method="POST"
      id="form-destroy-{{ $breed->id }}"
      action="{{ route('breed.destroy', $breed) }}">
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


  <ul class="list-inline">
    @can('animal.create')
    <li><a href="{{ route('animal.create') }}" class="link-black text-sm"><i class="fa fa-plus-circle"></i> Nuevo Animal</a></li>
    @endcan
    @can('animal.index')
    <li><a href="{{ route('animal.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Animales</a></li>
    @endcan
  </ul> 



  @can('breed.create')
  <button 
  type="button" 
  class="btn btn-primary no-margin pull-right" 
  data-toggle="modal" 
  data-target="#modal-form-store">
  <i class="fa fa-plus"></i>Agregar Nuevo
</button>
@endcan    
</div>
</div>
</div>

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
        var name = button.data('breed_na') // Extract info from data-* attributes
        var description = button.data('breed_de')
        var specie_id = button.data('specie_id')
        var id = button.data('breed_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #breed_na').val(name)
        modal.find('.modal-body #breed_de').val(description)
        modal.find('.modal-body #specie_id').val(specie_id)
        modal.find('.modal-body #breed_id').val(id)
      })

  });
  
</script>
@endsection