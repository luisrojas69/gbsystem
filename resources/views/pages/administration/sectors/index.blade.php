@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Sectores Granja Boraure")


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
                  <th style="width: 60px">ID</th>
                  <th style="width: 120px">Codigo</th>
                  <th>Descripcion</th>
                   <th style="width: 60px; text-align: center;">Lotes</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($sectors as $sector)
                <tr>
                  <td>{{ $sector->id }}</td>
                  <td>{{ $sector->sector_co }}</td>
                  <td><a href="{{ route('sector.show', $sector ) }}">{{ $sector->sector_de }}</a></td>
                  <td style="text-align: center;"><span class="label label-success">{{ count($sector->lots) }}</span></td>
                   @if (Auth::user()->role == 'ADMIN')
                  <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $sector->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('sector.edit', $sector) }}"
                            id="form-edit-{{ $sector->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $sector->id }}"
                          class="btn-delete  {{ count($sector->lots)>0 ? 'disabled' : '' }}"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $sector->id }}" 
                        action="{{ route('sector.destroy', $sector) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    
                  </td>
                  @else
                  <td style="text-align: center;">
                    <a href="javascript:void(0)" id="normal_user"
                    title="Editar" 
                        class="normal_user">
                    <span class="label label-primary"><i class="fa fa-pencil"></i></span></a>

                    <a href="javascript:void(0)" id="normal_user"
                    title="Eliminar" 
                        class="normal_user">
                    <span class="label label-danger"><i class="fa fa-trash"></i></span></a>
                  </td>
                  @endif
                </tr>
               @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <a class="btn btn-primary no-margin pull-right"
                                title="Crear un nuevo Sector"
                                href="{{ route('sector.create') }}">
                                <i class="fa fa-plus"></i> Agregar Nuevo
                     </a>
            </div>
</div>


@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>
@endsection