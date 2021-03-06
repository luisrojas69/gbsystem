@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Captures Granja Boraure")


@section('content')
@include('layouts._my_message')
@include('layouts._my_error')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>


    <a title="Exportar a PDF"
    href="{{ route('sectors.pdf') }}" type="button" class="btn btn-danger pull-right disabled" style="margin-right: 5px; ">
    <i class="fa fa-download"></i> Generar PDF
  </a>

  <a title="Exportar a Excel"
  href="{{ route('captures.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
  <i class="fa fa-download"></i> Generar EXCEL
</a>


</div>
<!-- /.box-header -->
<div class="box-body table-responsive">
  <table class="table table-bordered table-hover">
    <tbody><tr>
      <th style="width: 50px">ID</th>
      <th style="width: 350px">Tablon</th>
      <th style="width: 100px">Actividad</th>
      <th style="width: 80px; text-align: center;">Cultivo</th>
      <th style="width: 80px; text-align: center;">Hect</th>
      <th style="width: 120px; text-align: center;">Fecha</th>
      <th style="width: 180px; text-align: center;">Acciones</th>
    </tr>
    @foreach($captures as $capture)
    <tr>
      <td>{{ $capture->id }}</td>
      <td>{{ $capture->plank_de }}</td>
      <td>{{ $capture->activity_na }}</td>
      <td style="text-align: center;">{{ $capture->crop_na }}</td>
      <td style="text-align: center;">{{ $capture->area }}</td>
      <td style="text-align: center;">{{ Carbon\Carbon::parse($capture->fecha)->format('d-m-Y') }}</td>
      <td style="text-align: center;">

        @can('capture.edit')  
        <a href="javascript:void(0)"
        title="Editar" 
        onclick="event.preventDefault(); 
        document.getElementById('form-edit-{{ $capture->id }}').submit()">
        <span class="label label-primary"><i class="fa fa-pencil"></i></span>
      </a>                    

      <form method="GET" 
      action="{{ route('capture.edit', $capture->id) }}"
      id="form-edit-{{ $capture->id }}"
      style="display: none;">
      {{ csrf_field() }}
    </form>
    @endcan

    @can('capture.destroy')
    <a href="javascript:void(0)" id="{{ $capture->id }}"
      class="btn-delete"
      title="Eliminar">
      <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

      <form method="POST"
      id="form-destroy-{{ $capture->id }}"
      action="{{ route('capture.destroy', $capture->id) }}">
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
@can('capture.create')
<div class="box-footer clearfix">
 <a class="btn btn-primary no-margin pull-right"
 title="Crear un nuevo Capture"
 href="{{ route('capture.create') }}">
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