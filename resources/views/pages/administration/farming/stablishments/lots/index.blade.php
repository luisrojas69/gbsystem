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

<!--Formulario para Crear un Nuevo Registro-->  
<div class="modal fade" id="modal-form-store" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registrar un Nuevo Lote</h4>
      </div>
      <div class="modal-body">
        <form id="form_lot" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('lot.store') }}">
                {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.capture.form_lots')
        </form>
      </div>
    </div>
  </div>
</div>

<!--Formulario para Editar Registro-->
<div class="modal fade" id="modal-form-update" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form_lot" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('lot.update','test') }}">
                {{ csrf_field() }}
                {{ method_field('patch') }} 
          <input type="hidden" name="lot_id" id="lot_id" value="">             
          @include('layouts.includes.partials.forms.capture.form_lots')
        </form>
      </div>
    </div>
  </div>
</div>

            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

               <form action="{{ route('lot.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
                <div class="input-group input-group-sm">
                <input type="text" name="name" class="form-control" placeholder="Nombre del Lote">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                    </span>
              </div>
              </form> 
                             

          <a title="Exportar a PDF"
                                href="{{ route('sectors.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
            <i class="fa fa-download"></i> Generar PDF
          </a>

          <a title="Exportar a Excel"
                                href="{{ route('lots.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
            <i class="fa fa-download"></i> Generar EXCEL
          </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
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
                  <td>{{ $lot->lot_de }}</td>
                  <td style="text-align: center;"><span class="label label-success">{{ $lot->numPlanks }}</span></td>
                  <td style="text-align: center;">

                       @can('lot.show')
                            <a href="{{ route('lot.show', $lot->id) }}" id="{{ $lot->id }}"
                              title="Ver detalle del {{ $lot->lot_de }}">
                            <span class="label label-success"><i class="fa fa-search"></i></span></a>
                        @endcan

                       @can('lot.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal"
                              data-target="#modal-form-update"
                              data-sector_id="{{ $lot->sector_id }}"
                              data-lot_co="{{ $lot->lot_co }}"
                              data-lot_de="{{ $lot->lot_de }}"
                              data-lot_id="{{ $lot->id }}"
                              data-title="Formulario de Edicion - Editar {{ $lot->lot_de }}"
                              >
                       <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>

                        @endcan
                        @can('lot.destroy')
                            <a href="javascript:void(0)" id="{{ $lot->id }}"
                              class="btn-delete  {{ $lot->numPlanks>0 ? 'disabled' : '' }}"
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
            <div class="box-footer clearfix">
              @can('lot.create')
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

<script type="text/javascript">

  $(function(){
        $('#modal-form-update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var lot_de = button.data('lot_de') // Extract info from data-* attributes
        var lot_co = button.data('lot_co')
        var lot_id = button.data('lot_id')
        var sector_id = button.data('sector_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #sector_id').val(sector_id)
        modal.find('.modal-body #lot_co').val(lot_co)
        modal.find('.modal-body #lot_de').val(lot_de)
        modal.find('.modal-body #lot_id').val(lot_id)
})

  });
  
</script>

@endsection