@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Tablones del Lote  $lot->lot_de")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tablones del <strong>{{ $lot->lot_de }} - ({{ $lot->sector->sector_de }})</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover">
                <tbody><tr>
                  <th style="width: 60px">ID</th>
                  <th style="width: 120px">Codigo</th>
                  <th>Descripcion</th>
                   <th style="width: 100px; text-align: center;">Hectareas</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                     @foreach($lot->planks as $plank)
                <tr>
                  <td>{{ $plank->id }}</td>
                  <td>{{ $plank->plank_co }}</td>
                  <td>{{ $plank->plank_de }}</td>
                  <td style="text-align: center;"><span class="label label-success">{{ $plank->plank_area }}</span></td>
                  <td style="text-align: center;">
                        @can('plank.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal"
                              data-target="#modal-form-update"
                              data-sector_id="{{ $plank->sector_id }}"
                              data-sector_de="{{ $plank->sector_de }}"
                              data-lot_id="{{ $plank->lot_id }}"
                              data-lot_de="{{ $plank->lot_de }}"
                              data-plank_id="{{ $plank->id }}"
                              data-plank_co="{{ $plank->plank_co }}"
                              data-plank_de="{{ $plank->plank_de }}" 
                              data-title="Formulario de Edicion - Editar {{ $plank->plank_de }}"
                              >
                       <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>

                        @endcan

                        @can('plank.destroy')
                            <a href="javascript:void(0)" id="{{ $plank->id }}"
                              class="btn-delete"
                              title="Eliminar">
                            <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $plank->id }}"
                              action="{{ route('plank.destroy', $plank) }}">
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
              @can('plank.create')
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
@endsection