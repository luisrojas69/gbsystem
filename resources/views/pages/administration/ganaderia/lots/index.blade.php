@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Lotes de Animales Granja Boraure")

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
        <h4 class="modal-title">Registrar un Nuevo Lote Animal</h4>
      </div>
      <div class="modal-body">
        <form id="form_sector" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('lotsAnimals.store') }}">
                {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.ganaderia.form_lotsAnimals')
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
                    action="{{ route('lotsAnimals.update','test') }}">
                {{ csrf_field() }}
                {{ method_field('patch') }} 
          <input type="hidden" name="lot_id" id="lot_id" value="">             
          @include('layouts.includes.partials.forms.ganaderia.form_lotsAnimals')
        </form>
      </div>
    </div>
  </div>
</div>

  

            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

              <form action="{{ route('lotsAnimals.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
                <div class="input-group input-group-sm">
                <input type="text" name="name" class="form-control" placeholder="Nombre del Lote Animal">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                    </span>
              </div>
              </form> 
                             

          <a title="Exportar a PDF"
                                href="{{ route('lots-animals.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
            <i class="fa fa-download"></i> Generar PDF
          </a>

          <a title="Exportar a Excel"
                                href="{{ route('lots-animals.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
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
                   <th style="text-align: center;">Fecha Ingreso</th>
                   <th style="text-align: center;">Num. Animals</th>
                   <th style="text-align: center;">Comentario</th>
                  <th style="width: 120px; text-align: center;">Acciones</th>
                </tr>
                    @foreach($lotsAnimals as $lotAnimal)
                <tr>
                  <td>{{ $lotAnimal->id }}</td>
                  <td>{{ $lotAnimal->lot_co }}</td>
                  <td><a href="{{ route('lotsAnimals.show', $lotAnimal ) }}">{{ $lotAnimal->lot_de }}</a></td>
                  <td style="text-align: center;">{{ $lotAnimal->date_in }}</td>
                  <td style="text-align: center;"><span class="label label-success">{{ $lotAnimal->numAnimals }}</span></td>
                  <td>{{ $lotAnimal->comment }}</td>
                   
                  <td style="text-align: center;">

                      @can('lotsAnimals.show')
                            <a href="{{ route('lotsAnimals.show', $lotAnimal->id) }}" id="{{ $lotAnimal->id }}"
                              title="Ver detalle del {{ $lotAnimal->lot_de }}">
                            <span class="label label-success"><i class="fa fa-search"></i></span></a>
                      @endcan

                      @can('lotsAnimals.edit')
                          <a href=""
                              title="Editar"
                              data-toggle="modal" 
                              data-target="#modal-form-update"
                              data-lot_co="{{ $lotAnimal->lot_co }}"
                              data-lot_de="{{ $lotAnimal->lot_de }}"
                              data-date_in="{{ $lotAnimal->date_in }}"
                              data-comment="{{ $lotAnimal->comment }}"
                              data-lot_id="{{ $lotAnimal->id }}"
                              data-title="Formulario de Edicion - {{ $lotAnimal->lot_de }}"
                              >
                       <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>

                        @endcan

                        @can('lotsAnimals.destroy')
                            <a href="javascript:void(0)" id="{{ $lotAnimal->id }}"
                              class="btn-delete  {{ $lotAnimal->numAnimals>0 ? 'disabled' : '' }}"
                              title="Eliminar">
                            <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $lotAnimal->id }}"
                              action="{{ route('lotsAnimals.destroy', $lotAnimal) }}">
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

              <ul class="list-inline">
                @can('animal.create')
                <li><a href="{{ route('animal.create') }}" class="link-black text-sm"><i class="fa fa-plus-circle"></i> Nuevo Animal</a></li>
                @endcan
                @can('animal.index')
                <li><a href="{{ route('animal.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Animales</a></li>
                @endcan
              </ul>
              
              @can('lotsAnimals.create')
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
        var codLote = button.data('lot_co') // Extract info from data-* attributes
        var descriptionLote = button.data('lot_de')
        var dateLote = button.data('date_in')
        var commentLote = button.data('comment')
        var idLote =  button.data('lot_id')
        var title = button.data('title')
        alert(idLote);
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #lot_co').val(codLote)
        modal.find('.modal-body #lot_de').val(descriptionLote)
        modal.find('.modal-body #date_in').val(dateLote)
        modal.find('.modal-body #comment').val(commentLote)
        modal.find('.modal-body #lot_id').val(idLote)
})

  });
  
</script>

@endsection