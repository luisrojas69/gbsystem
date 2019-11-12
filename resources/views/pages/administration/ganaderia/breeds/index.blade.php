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
            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="example1">
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
                        <a href="javascript:void(0)"
                            title="Editar"
                            onclick="event.preventDefault();
                            document.getElementById('form-edit-{{ $breed->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>

                        <form method="GET"
                            action="{{ route('breed.edit', $breed) }}"
                            id="form-edit-{{ $breed->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $breed->id }}"
                        class="btn-delete"
                        title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $breed->id }}"
                        action="{{ route('breed.destroy', $breed) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                  </td>
                </tr>

                    @endforeach

              </tbody></table>


            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <a class="btn btn-primary no-margin pull-right"
                                title="Crear un nueva Raza"
                                href="{{ route('breed.create') }}">
                                <i class="fa fa-plus"></i> Agregar Nuevo
                     </a>
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
@endsection