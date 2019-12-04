@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Rodeos Granja Boraure")

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
          <h4 class="modal-title">Registrar un Nuevo Rodeo</h4>
        </div>
        <div class="modal-body">
          <form id="form_rodeo" class="form-horizontal"
          role="form"
          method="POST"
          action="{{ route('rodeo.store') }}">
          {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.ganaderia.form_rodeos')
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
        <form id="form_rodeo" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('rodeo.update','test') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }} 
        <input type="hidden" name="rodeo_id" id="rodeo_id" value="">             
        @include('layouts.includes.partials.forms.ganaderia.form_rodeos')
      </form>
    </div>
  </div>
</div>
</div>



<div class="box-header with-border">
  <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

  

  <a title="Exportar a PDF"
  href="{{ route('rodeos.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
  <i class="fa fa-download"></i> Generar PDF
</a>

<a title="Exportar a Excel"
href="{{ route('rodeos.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
<i class="fa fa-download"></i> Generar EXCEL
</a>

</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th style="width: 60px">ID</th>
      <th style="width: 180px">Nombre</th>
      <th>Descripcion</th>
      <th>Numero de Animales</th>
      <th>Acciones</th>
    </tr>
    @foreach($rodeos as $rodeo)
    <tr>
      <td>{{ $rodeo->id }}</td>
      <td>{{ $rodeo->rodeo_na }}</td>
      <td>{{ $rodeo->rodeo_de }}</td>
      <td style="width: 120px; text-align: center;"><span class="badge bg-aqua">{{ $rodeo->num_animals }}</span></td>
      <td style="text-align: center;">
        
        @can('rodeo.edit')
        <a href=""
        title="Editar"
        data-toggle="modal"
        data-target="#modal-form-update"
        data-rodeo_na="{{ $rodeo->rodeo_na }}"
        data-rodeo_de="{{ $rodeo->rodeo_de }}"
        data-rodeo_id="{{ $rodeo->id }}"
        data-title="Formulario de Edicion - Editar {{ $rodeo->rodeo_na }}"
        >
        <span class="label label-primary"><i class="fa fa-pencil"></i></span>
      </a>

      @endcan

      @can('rodeo.destroy')
      <a href="javascript:void(0)" id="{{ $rodeo->id }}"
        class="btn-delete  {{ count($rodeo->animals)>0 ? 'disabled' : '' }}"
        title="Eliminar">
        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

        <form method="POST"
        id="form-destroy-{{ $rodeo->id }}"
        action="{{ route('rodeo.destroy', $rodeo) }}">
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
  @can('rodeo.create')
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
        var nameRodeo = button.data('rodeo_na') // Extract info from data-* attributes
        var descriptionRodeo = button.data('rodeo_de')
        var idRodeo = button.data('rodeo_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #rodeo_na').val(nameRodeo)
        modal.find('.modal-body #rodeo_de').val(descriptionRodeo)
        modal.find('.modal-body #rodeo_id').val(idRodeo)
      })

  });
  
</script>
@endsection