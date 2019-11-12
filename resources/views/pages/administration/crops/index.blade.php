@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Cultivos Granja Boraure")

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
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 60px">ID</th>
                  <th style="width: 180px">Nombre</th>
                  <th>Descripcion</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($crops as $crop)
                <tr>
                  <td>{{ $crop->id }}</td>
                  <td>{{ $crop->crop_na }}</td>
                  <td>{{ $crop->crop_de }}</td>
                  <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $crop->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('crop.edit', $crop) }}"
                            id="form-edit-{{ $crop->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $crop->id }}"
                          class="btn-delete  {{ count($crop->lots)>0 ? 'disabled' : '' }}"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $crop->id }}" 
                        action="{{ route('crop.destroy', $crop) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    
                  </td>
                </tr>
               @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <a class="btn btn-primary no-margin pull-right"
                                title="Crear un nuevo Cultivo"
                                href="{{ route('crop.create') }}">
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