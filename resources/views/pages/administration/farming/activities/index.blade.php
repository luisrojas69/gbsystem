@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Actividades Granja Boraure")

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
        <h4 class="modal-title">Registrar una Nueva Actividad</h4>
      </div>
      <div class="modal-body">
        <form id="form_activity" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('activity.store') }}">
                {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.capture.form_activities')
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
        <form id="form_activity" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('activity.update','test') }}">
                {{ csrf_field() }}
                {{ method_field('patch') }} 
            <input type="hidden" name="activity_id" id="activity_id" value="">             
            @include('layouts.includes.partials.forms.capture.form_activities')
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
                  <th style="width: 180px">Nombre</th>
                  <th>Descripcion</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($activities as $activity)
                <tr>
                  <td>{{ $activity->id }}</td>
                  <td>{{ $activity->activity_na }}</td>
                  <td>{{ $activity->activity_de }}</td>
                  <td style="text-align: center;">
                       @can('activity.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal"
                              data-target="#modal-form-update"
                              data-activity_na="{{ $activity->activity_na }}"
                              data-activity_de="{{ $activity->activity_de }}"
                              data-activity_id="{{ $activity->id }}"
                              data-title="Formulario de Edicion - Editar {{ $activity->activity_na }}"
                              >
                            <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>

                        @endcan

                        @can('activity.destroy')
                            <a href="javascript:void(0)" id="{{ $activity->id }}"
                              class="btn-delete"
                              title="Eliminar">
                            <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $activity->id }}"
                              action="{{ route('activity.destroy', $activity) }}">
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
              @can('activity.create')
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
        var nameActivity = button.data('activity_na') // Extract info from data-* attributes
        var descriptionActivity = button.data('activity_de')
        var idActivity = button.data('activity_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #activity_na').val(nameActivity)
        modal.find('.modal-body #activity_de').val(descriptionActivity)
        modal.find('.modal-body #activity_id').val(idActivity)
})

  });
  
</script>
@endsection