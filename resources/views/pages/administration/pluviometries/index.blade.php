@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Pluviometria Granja Boraure")

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
        <h4 class="modal-title">Registrar un Nueva Pluviometria</h4>
      </div>
      <div class="modal-body">
        <form id="form_pluviometry" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('pluviometry.store') }}">
                {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.pluviometry.form_pluviometries')
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
        <form id="form_pluviometry" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('pluviometry.update','test') }}">
                {{ csrf_field() }}
                {{ method_field('patch') }} 
          <input type="hidden" name="pluviometry_id" id="pluviometry_id" value="">             
          @include('layouts.includes.partials.forms.pluviometry.form_pluviometries')
        </form>
      </div>
    </div>
  </div>
</div>

            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

                <a title="Exportar a PDF"
                                      href="{{ route('pluviometries.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
                  <i class="fa fa-download"></i> Generar PDF
                </a>

                <a title="Exportar a Excel"
                                      href="{{ route('pluviometries.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
                  <i class="fa fa-download"></i> Generar EXCEL
                </a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 80px">ID</th>
                   <th style="width: 180px; text-align: center;">Date</th>
                   <th style="width: 80px">Registro MM</th>
                    <th>Sector</th>
                    <th style="width: 180px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($pluviometries as $pluviometry)
                <tr>
                  <td>{{ $pluviometry->id }}</td>
                  <td>{{ $pluviometry->date_read }}</td>
                  <td>{{ $pluviometry->value_mm }}</td>
                  <td><a href="{{ route('sector.show', $pluviometry->sector_id) }}">{{$pluviometry->Sector->sector_de}}</a></td>
                  <td style="text-align: center;">
                        
                         @can('pluviometry.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal"
                              data-target="#modal-form-update"
                              data-sector_id="{{ $pluviometry->sector_id }}"
                              data-value_mm="{{ $pluviometry->value_mm }}"
                              data-date_read="{{ $pluviometry->date_read }}"
                              data-pluviometry_id="{{ $pluviometry->id }}"
                              data-title="Formulario de Edicion - Editar {{ $pluviometry->pluviometry_na }}"
                              >
                       <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>

                        @endcan

                        @can('pluviometry.destroy')
                            <a href="javascript:void(0)" id="{{ $pluviometry->id }}"
                              class="btn-delete"
                              title="Eliminar">
                            <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $pluviometry->id }}"
                              action="{{ route('pluviometry.destroy', $pluviometry) }}">
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
              @can('pluviometry.create')
                <button 
                  type="button" 
                  class="btn btn-primary no-margin pull-right" 
                  data-toggle="modal" 
                  data-target="#modal-form-store">
                  <i class="fa fa-plus"></i>Agregar Nueva
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
        var value_mm = button.data('value_mm') // Extract info from data-* attributes
        var date_read = button.data('date_read')
        var sector_id = button.data('sector_id')
        var pluviometry_id = button.data('pluviometry_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #value_read').val(value_mm)
        modal.find('.modal-body #sector_id').val(sector_id)
        modal.find('.modal-body #date_read').val(date_read)
        modal.find('.modal-body #pluviometry_id').val(pluviometry_id)
})

  });
  
</script>

@endsection