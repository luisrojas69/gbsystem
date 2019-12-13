@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Permisos Granja Boraure")

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
        <h4 class="modal-title">Registrar un Nuevo Permiso</h4>
      </div>
      <div class="modal-body">
        <form id="form_sector" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('permission.store') }}">
                {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.manager.form_permissions')
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
                    action="{{ route('permission.update','test') }}">
                {{ csrf_field() }}
                {{ method_field('patch') }} 
          <input type="hidden" name="permission_id" id="permission_id" value="">             
          @include('layouts.includes.partials.forms.manager.form_permissions')
        </form>
      </div>
    </div>
  </div>
</div>

  

            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

              <form action="{{ route('permission.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
                <div class="input-group input-group-sm">
                <input type="text" name="name" class="form-control" placeholder="Nombre del Permiso">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                    </span>
              </div>
              </form> 
                             

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <table class="table table-bordered table-hover">
                <tbody><tr>
                  <th style="width: 60px">ID</th>
                  <th>Nombre</th>
                  <th>Slug</th>
                  <th>Descripcion</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($permissions as $permission)
                <tr>
                  <td>{{ $permission->id }}</td>
                  <td>{{ $permission->name }}</td>
                  <td>{{ $permission->slug }}</td>
                  <td>{{ $permission->description }}</td>
                   
                  <td style="text-align: center;">
                      @can('permission.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal"
                              data-target="#modal-form-update"
                              data-permission_name="{{ $permission->name }}"
                              data-permission_slug="{{ $permission->slug }}"
                              data-permission_de="{{ $permission->description }}"
                              data-permission_id="{{ $permission->id }}"
                              data-title="Formulario de Edicion - Editar {{ $permission->name }}"
                              >
                       <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>

                        @endcan

                        @can('permission.destroy')
                            <a href="javascript:void(0)" id="{{ $permission->id }}"
                              class="btn-delete"
                              title="Eliminar">
                            <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $permission->id }}"
                              action="{{ route('permission.destroy', $permission) }}">
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

               {{ $permissions->links() }}

              @can('permission.create')
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
        var permission_name = button.data('permission_name') // Extract info from data-* attributes
        var permission_slug = button.data('permission_slug')
        var permission_de = button.data('permission_de')
        var permission_id = button.data('permission_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #permission_na').val(permission_name)
        modal.find('.modal-body #permission_slug').val(permission_slug)
        modal.find('.modal-body #permission_de').val(permission_de)
        modal.find('.modal-body #permission_id').val(permission_id)
})

  });
  
</script>

@endsection