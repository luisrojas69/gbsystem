@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Pluviometr&iacute;a Granja Boraure")


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
                  <th style="width: 80px">ID</th>
                   <th style="width: 180px; text-align: center;">Date</th>
                   <th style="width: 80px">Registro MM</th>
                    <th>Sector</th>
                    <th style="width: 180px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($pluviometries as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->date_read }}</td>
                  <td>{{ $item->value_mm }}</td>
                  <td><a href="{{ route('sector.show', $item->sector_id) }}">{{$item->Sector->sector_de}}</a></td>
                  <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $item->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('pluviometry.edit', $item->id) }}"
                            id="form-edit-{{ $item->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $item->id }}"
                          class="btn-delete"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $item->id }}" 
                        action="{{ route('pluviometry.destroy', $item->id) }}">
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
                                title="Insertar nuevo Registro"
                                href="{{ route('pluviometry.create') }}">
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