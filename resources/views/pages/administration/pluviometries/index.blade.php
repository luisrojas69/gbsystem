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
                    @foreach($pluviometries as $pluviometry)
                <tr>
                  <td>{{ $pluviometry->id }}</td>
                  <td>{{ $pluviometry->date_read }}</td>
                  <td>{{ $pluviometry->value_mm }}</td>
                  <td><a href="{{ route('sector.show', $pluviometry->sector_id) }}">{{$pluviometry->Sector->sector_de}}</a></td>
                  <td style="text-align: center;">
                        @can('pluviometry.edit')  
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $pluviometry->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('pluviometry.edit', $pluviometry) }}"
                            id="form-edit-{{ $pluviometry->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>
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
            @can('pluviometry.create')
              <div class="box-footer clearfix">
                 <a class="btn btn-primary no-margin pull-right"
                                  title="Crear un nueva Pluviometria"
                                  href="{{ route('pluviometry.create') }}">
                                  <i class="fa fa-plus"></i> Agregar Nuevo
                       </a>
              </div>
            @endcan
</div>

@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>
@endsection