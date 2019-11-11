@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Roles Granja Boraure")


@section('content')
    @include('layouts._my_message')
    @include('layouts._my_error')

<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">ID</th>
                  <th >Nombre</th>
                  <th>Slug</th>
                  <th>Descripcion</th>

    
                  <th style="width: 10px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($roles as $role)
                <tr>
                  <td>{{ $role->id }}</td>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->slug }}</td>
                  <td>{{ $role->description ?: 'Sin Descripcion'}}</td>
                  
                  <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $role->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('role.edit', $role) }}"
                            id="form-edit-{{ $role->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $role->id }}"
                          class="btn-delete"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $role->id }}" 
                        action="{{ route('role.destroy', $role) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    
                  </td>

                  
                </tr>
               @endforeach

              </tbody></table>
             
               <div class="box-footer clearfix">
               <a class="btn btn-primary no-margin pull-right" title="Crear un nuevo Role" href=" {{ route('role.create') }} ">
                                <i class="fa fa-plus"></i> Agregar Nuevo
                     </a>
              </div>
            <!-- /.box-body -->

</div>


@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>
@endsection