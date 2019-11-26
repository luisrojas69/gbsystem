@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Pozos Granja Boraure")

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
        <h4 class="modal-title">Registrar un Nuevo Pozo</h4>
      </div>
      <div class="modal-body">
        <form id="form_sector" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('well.store') }}">
                {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.pozos.form_wells')
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
        <form id="form_sector" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('well.update','test') }}">
                {{ csrf_field() }}
                {{ method_field('patch') }} 
          <input type="hidden" name="sector_id" id="sector_id" value="">             
          @include('layouts.includes.partials.forms.pozos.form_wells')
        </form>
      </div>
    </div>
  </div>
</div>

  

            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

              <form action="{{ route('well.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
                <div class="input-group input-group-sm">
                <input type="text" name="name" class="form-control" placeholder="Nombre del Pozo">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                    </span>
              </div>
              </form> 
                             

          <a title="Exportar a PDF"
                                href="{{ route('wells.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
            <i class="fa fa-download"></i> Generar PDF
          </a>

          <a title="Exportar a Excel"
                                href="{{ route('wells.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
            <i class="fa fa-download"></i> Generar EXCEL
          </a>


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
                    @foreach($wells as $well)
                <tr>
                  <td>{{ $well->id }}</td>
                  <td>{{ $well->well_na }}</td>
                  <td><a href="{{ route('well.show', $well ) }}">{{ $well->sector_de }}</a></td>
                  <td style="text-align: center;"><span class="label label-success">{{ count($well->lots) }}</span></td>
                   
                  <td style="text-align: center;">
                      @can('well.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal"
                              data-target="#modal-form-update"
                              data-well_na="{{ $well->well_na }}"
                              data-type="{{ $well->type }}"
                              data-status="{{ $well->status }}"
                              data-title="Formulario de Edicion - Editar {{ $well->well_na }}"
                              >
                       <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>

                        @endcan

                        @can('well.destroy')
                            <a href="javascript:void(0)" id="{{ $well->id }}"
                              class="btn-delete"
                              title="Eliminar">
                            <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $well->id }}"
                              action="{{ route('well.destroy', $well) }}">
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
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              @can('well.create')
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
        var codSector = button.data('well_na') // Extract info from data-* attributes
        var well = button.data('sector_de')
        var idSector = button.data('sector_id')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #well_na').val(codSector)
        modal.find('.modal-body #sector_de').val(well)
        modal.find('.modal-body #sector_id').val(idSector)
})

  });
  
</script>

@endsection