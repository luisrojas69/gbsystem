@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">


@endsection

@section('title-page', "Variedad Granja Boraure")

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
          <h4 class="modal-title">Registrar un Nuevo Cultivo</h4>
        </div>
        <div class="modal-body">
          <form id="form_variety" class="form-horizontal"
          role="form"
          method="POST"
          action="{{ route('variety.store') }}">
          {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.capture.form_varieties')
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
        <form id="form_variety" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('variety.update','test') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }} 
        <input type="hidden" name="variety_id" id="variety_id" value="">             
        @include('layouts.includes.partials.forms.capture.form_varieties')
      </form>
    </div>
  </div>
</div>
</div>




<div class="box-header with-border">
  <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th style="width: 60px">ID</th>
      <th style="width: 120px">Nombre</th>
      <th>Descripcion</th>
      <th style="width: 120px; text-align: center;">Acciones</th>
    </tr>
    @foreach($varieties as $variety)

    <tr>
      <td>{{ $variety->id }}</td>
      <td>{{ $variety->variety_na }}</td>
      <td>{{ $variety->variety_de }}</td>

      <td style="text-align: center;">
        @can('variety.edit')
        <a href=""
        title="Editar"
        data-toggle="modal"
        data-target="#modal-form-update"
        data-variety_na="{{ $variety->variety_na }}"
        data-variety_de="{{ $variety->variety_de }}"
        data-variety_id="{{ $variety->id }}"
        data-variety_crop_id="{{ $variety->crop_id }}"
        data-title="Formulario de Edicion - Editar {{ $variety->variety_na }}"
        >
        <span class="label label-primary"><i class="fa fa-pencil"></i></span>
      </a>

      @endcan

      @can('variety.destroy')

      <a href="javascript:void(0)" id="{{ $variety->id }}"
        class="btn-delete"
        title="Eliminar">
        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

        <form method="POST"
        id="form-destroy-{{ $variety->id }}"
        action="{{ route('variety.destroy', $variety) }}">
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
  @can('crop.create')
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


<script type="text/javascript">

</script>
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
        var nameVariety = button.data('variety_na') // Extract info from data-* attributes
        var descriptionVariety = button.data('variety_de')
        var idVariety = button.data('variety_id')
        var cropId = button.data('variety_crop_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #variety_na').val(nameVariety)
        modal.find('.modal-body #variety_de').val(descriptionVariety)
        modal.find('.modal-body #variety_id').val(idVariety)
        modal.find('.modal-body #crop_id').val(cropId)
      })

  });
  
</script>

@endsection