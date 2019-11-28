@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Pozos Granja Boraure")

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
          <h4 class="modal-title">Registrar un Nuevo Pozo</h4>
        </div>
        <div class="modal-body">
          <form id="form_sector" class="form-horizontal"
          role="form"
          method="POST"
          action="{{ route('well.store') }}">
          {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.pozos.form_wells')
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
        <form id="form_sector" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('well.update','test') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }} 
        <input type="hidden" name="well_id" id="well_id" value="">             
        @include('layouts.includes.partials.forms.pozos.form_wells')
      </form>
    </div>
  </div>
</div>
</div>


<!--Formulario para Insertar Hormometro-->
<div class="modal fade" id="modal-form-horometer" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form_sector" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('horometer.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="well_id" id="well_id" value="">             
        <input type="hidden" name="name_pozo" id="name_pozo" value="">             
        @include('layouts.includes.partials.forms.pozos.form_horometers')
      </form>
    </div>
  </div>
</div>
</div>




<div class="box-header with-border">
  <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

  <form action="{{ route('well.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
    <div class="input-group input-group-sm">
      <input type="text" name="name" class="form-control" placeholder="Nombre del Pozo">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-flat">Buscar</button>
      </span>
    </div>
  </form> 


  <a title="Exportar a PDF"
  href="{{ route('wells.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
  <i class="fa fa-download"></i> Generar PDF
</a>

<a title="Exportar a Excel"
href="{{ route('wells.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
<i class="fa fa-download"></i> Generar EXCEL
</a>


</div>
<!-- /.box-header -->
<div class="box-body">

  <table class="table table-bordered">
    <tbody><tr>
      <th>ID</th>
      <th>Nombre</th>
      <th style="text-align: center;">Tipo</th>
      <th style="text-align: center;">Status</th>
      <th>Horometro</th>
      <th>Observaciones</th>
      <th style="text-align: center;">Accion Hrm</th>
      <th style="text-align: center;">Acciones</th>
    </tr>
    @foreach($wells as $well)
    <tr>
      <td>{{ $well->id }}</td>
      <td>{{ $well->well_na }}</td>
      <td style="text-align: center;"><span class="label {{ $well->type=="sumergible" ? 'label-warning' : 'label-primary' }}">{{ $well->type }}</td>
      <td style="text-align: center;"><span class="label {{ $well->status=="parado" ? 'label-danger' : 'label-success' }}">{{ $well->status }}</span></td>
      <td style="text-align: center;">
        
        @if($well->numHorometers>0)   
          <span class="label label-info">{{ $well->horometers->last()->value }}</span>
        @else
          <span class="label bg-maroon">Sin Lecturas</span>
        @endif  
      </td>

        <td>{{ $well->comment }}</td>

      @if($well->status=="operativo")
        @can('horometer.create')   
            <td style="text-align: center;">
                <a href=""
                title="Insertar Lectura de Horometro al Pozo {{ $well->well_na }}"
                data-toggle="modal"
                data-target="#modal-form-horometer"
                data-well_id="{{ $well->id }}"
                data-well_na="{{ $well->well_na }}"
                data-title="Insertar Lectura de Horometro al Pozo {{ $well->well_na }}"
                >
                <span class="badge badge-dark"><i class="fa fa-tachometer"></i></span>
              </a>
            </td>
          @endcan  
          @else
          <td style="text-align: center;">
            <a href="javascript:void(0)"
                id="pozoParado"
                class="pozoParado" 
                title="No puede ingresar Lectura de Horometros a Pozos Parados">
                <span class="badge bg-red"><i class="fa fa-tachometer"></i></span>
              </a>
        </td>
          @endif    

      <td style="text-align: center;">

        @can('well.show')
        <a href="{{ route('well.show', $well->id) }}" id="{{ $well->id }}" class="button_show">
          <span class="label label-success"><i class="fa fa-search"></i></span>
        </a>
        @endcan

        @can('well.edit')
        <a href=""
        title="Editar"
        data-toggle="modal"
        data-target="#modal-form-update"
        data-well_id="{{ $well->id }}"
        data-well_na="{{ $well->well_na }}"
        data-type="{{ $well->type }}"
        data-status="{{ $well->status }}"
        data-comment="{{ $well->comment }}"
        data-title="Formulario de Edicion - Editar {{ $well->well_na }}"
        >
        <span class="label label-primary"><i class="fa fa-pencil"></i></span>
      </a>

      @endcan

      @can('well.destroy')
      <a href="javascript:void(0)" id="{{ $well->id }}"
        class="btn-delete"
        title="Eliminar">
        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

        <form method="POST"
        id="form-destroy-{{ $well->id }}"
        action="{{ route('well.destroy', $well) }}">
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
<!-- /.box-body -->
<div class="box-footer clearfix">
  @can('well.create')
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
        var NameWell = button.data('well_na') // Extract info from data-* attributes
        var StatusWell = button.data('status')
        var TypeWell = button.data('type')
        var Comment = button.data('comment')
        var title = button.data('title')
        var WellId = button.data('well_id')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #well_na').val(NameWell)
        modal.find('.modal-body #comment').val(Comment)
        modal.find('.modal-body #well_id').val(WellId)

        //Verificamos si es Sumergible o de Turbina para Marcar el Radio Button
        if (TypeWell == 'sumergible')
        {
         modal.find('.modal-body #sumergible').prop('checked', true)
       }
       else
       {
         modal.find('.modal-body #turbina').prop('checked', true)
       }

        //Verificamos si esta Operativo o Parado para Marcar el Radio Button
        if (StatusWell == 'parado')
        {
         modal.find('.modal-body #parado').prop('checked', true)
       }
       else
       {
         modal.find('.modal-body #operativo').prop('checked', true)
       }



     });

    {{-- modal Form for Insert Hrometers --}}

    $('#modal-form-horometer').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var NameWell = button.data('well_na') // Extract info from data-* attributes
        var title = button.data('title')
        var WellId = button.data('well_id')

        var url = "/horometer/HorometersByWells/"+WellId;
        $(document).ready(function(){
         $.ajax({
          dataType: 'json',
          url: url,
          method: "GET",
          beforeSend: function() {
            $("#loading").show();
          },
          success: function(datos)
          {
           $("#loading").hide();console.log(datos);
           modal.find('.modal-body #value').prop('min' , datos);
           modal.find('.modal-body #infoLastHorometer').text(datos);         
         },
         timeout:9000,
         error: function()
         {
           console.log("Error Sincronizando");
         }

       });
       }); 
        
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #well_na').val(NameWell).prop('disabled', true);
        modal.find('.modal-body #name_pozo').val(NameWell);
        modal.find('.modal-body #well_id').val(WellId)

      })

  });
  
</script>

@endsection