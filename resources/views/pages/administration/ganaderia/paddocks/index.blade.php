@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Potreros Granja Boraure")

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
        <form id="form_paddock" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('paddock.store') }}">
                {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.ganaderia.form_paddocks')
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
        <form id="form_paddock" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('paddock.update','test') }}">
                {{ csrf_field() }}
                {{ method_field('patch') }} 
          <input type="hidden" name="paddock_id" id="paddock_id" value="">             
          @include('layouts.includes.partials.forms.ganaderia.form_paddocks')
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
                   <th>Nro. Animales</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($paddocks as $paddock)
                <tr>
                  <td>{{ $paddock->id }}</td>
                  <td>{{ $paddock->paddock_na }}</td>
                  <td>{{ $paddock->paddock_de }}</td>
                  <td style="width: 120px; text-align: center;"><span class="badge bg-aqua">{{ $paddock->num_animals }}</span></td>
                  <td style="text-align: center;">
                       @can('paddock.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal"
                              data-target="#modal-form-update"
                              data-paddock_na="{{ $paddock->paddock_na }}"
                              data-paddock_de="{{ $paddock->paddock_de }}"
                              data-paddock_id="{{ $paddock->id }}"
                              data-title="Formulario de Edicion - Editar {{ $paddock->paddock_na }}"
                              >
                               <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>
                        @endcan

                        @can('paddock.destroy')
                            <a href="javascript:void(0)" id="{{ $paddock->id }}"
                              class="btn-delete  {{ count($paddock->animals)>0 ? 'disabled' : '' }}"
                              title="Eliminar">
                            <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $paddock->id }}"
                              action="{{ route('paddock.destroy', $paddock) }}">
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
                            
              @can('paddock.create')
                <button 
                  type="button" 
                  class="btn btn-primary no-margin pull-right" 
                  data-toggle="modal" 
                  data-target="#modal-form-store"paddock_id>
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
        var name = button.data('paddock_na') // Extract info from data-* attributes
        var description = button.data('paddock_de')
        var id = button.data('paddock_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #paddock_na').val(name)
        modal.find('.modal-body #paddock_de').val(description)
        modal.find('.modal-body #paddock_id').val(id)
})

  });
  
</script>

@endsection