@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Tablones del Lote  $lot->lot_de")


@section('content')
    @include('layouts._my_message')
    @include('layouts._my_error')

<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tablones del <strong>{{ $lot->lot_de }} - ({{ $lot->sector->sector_de }})</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
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
                  <td><a href="{{ route("plank.show", $plank ) }}">{{ $plank->plank_de }}</a></td>
                  <td style="text-align: center;"><span class="label label-success">{{ $plank->plank_area }}</span></td>
                  <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $plank->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('plank.edit', $plank) }}"
                            id="form-edit-{{ $plank->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $lot->id }}"
                        class="btn-delete">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $lot->id }}" 
                        action="{{ route('plank.destroy', $plank) }}">
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
                                title="Crear un nuevo Tablon"
                                href="{{ route('plank.create') }}">
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