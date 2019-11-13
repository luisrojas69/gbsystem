@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">


@endsection

@section('title-page', "Lotes Granja Boraure")

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
                  <th style="width: 120px">Codigo</th>
                  <th>Descripcion</th>
                  <th style="width: 60px; text-align: center;">Tablones</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($lots as $lot)
                    
                    <tr>
                  <td>{{ $lot->id }}</td>
                  <td>{{ $lot->lot_co }}</td>
                  <td><a href="{{ route("lot.show", $lot ) }}">{{ $lot->lot_de }}</a></td>
                  <td style="text-align: center;"><span class="label label-success">{{ count($lot->planks) }}</span></td>
                  <td style="text-align: center;">
                      @can('lot.edit')  
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $lot->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('lot.edit', $lot) }}"
                            id="form-edit-{{ $lot->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>
                      @endcan

                      @can('lot.destroy')
                        <a href="javascript:void(0)" id="{{ $lot->id }}"
                          class="btn-delete  {{ count($lot->planks)>0 ? 'disabled' : '' }}"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                         <form method="POST"
                            id="form-destroy-{{ $lot->id }}" 
                            action="{{ route('lot.destroy', $lot) }}">
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
            @can('lot.create')
              <div class="box-footer clearfix">
                 <a class="btn btn-primary no-margin pull-right"
                                  title="Crear un nuevo Lote"
                                  href="{{ route('lot.create') }}">
                                  <i class="fa fa-plus"></i> Agregar Nuevo
                       </a>
              </div>
            @endcan
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