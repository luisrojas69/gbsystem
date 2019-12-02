@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">

<style>
 tr.group,
 tr.group:hover {
   background-color: #ddd !important;
 }
</style>
@endsection

@section('title-page', "Horometros de Pozos Granja Boraure")

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
          <h4 class="modal-title">Registrar un Nueva Lectura de Horometro</h4>
        </div>
        <div class="modal-body">
          <form id="form_sector" class="form-horizontal"
          role="form"
          method="POST"
          action="{{ route('horometer.store') }}">
          {{ csrf_field() }}        
          @include('layouts.includes.partials.forms.pozos.form_horometers2')
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
        action="{{ route('horometer.update','test') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }} 
        <input type="hidden" name="horometer_id" id="horometer_id" value="">             
        @include('layouts.includes.partials.forms.pozos.form_horometers2')
      </form>
    </div>
  </div>
</div>
</div>

<div class="box-header with-border">
  <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>

  @can('horometer.create')
  <a class="btn btn-primary no-margin pull-right"
  href=""
  data-toggle="modal"
  data-target="#modal-form-store"
  data-title="Insertar Nueva Lectura de Horometro">

  <i class="fa fa-plus"></i> 
  Insertar Nueva Lectura de Horometro
</a>
@endcan

<a title="Exportar a Excel"
href="{{ route('horometers.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
<i class="fa fa-download"></i> Generar EXCEL
</a>



</div>
<!-- /.box-header -->
<div class="box-body">

  <table id="t_lots" class="table table-bordered" style="font-size: 12px;">
   <thead>
    <tr class="bg-green">
     <th>ID</th>
     <th>Fecha de Lectura</th>
     <th>Lectura Actual</th>
     <th>Pozo</th>
     <th>Observaciones</th>
     <th>Acciones</th>
   </tr>
 </thead>
 <tbody>
  @foreach( $horometers as $horometer )
  <tr>
    <td>{{ $horometer->id }}</td>
    <td>{{ $horometer->date_read }}</td>
    <td>{{ $horometer->value }}</td>
    <td><a href="{{ route('well.show', $horometer->well->id) }}">{{$horometer->well->well_na}}</a></td>
    <td>{{ $horometer->comment }}</td>
    <!-- Actions -->
    <td style="text-align: center;">

      @can('horometer.edit')
      <a href=""
      title="Editar"
      data-toggle="modal"
      data-target="#modal-form-update"
      data-horometer_id="{{ $horometer->id }}"
      data-well_id="{{ $horometer->well_id }}"
      data-date_read="{{ $horometer->date_read }}"
      data-well_na="{{ $horometer->well_na }}" 
      data-value="{{ $horometer->value }}" 
      data-comment="{{ $horometer->comment }}"
      data-title="Formulario de Edicion - Editar {{ $horometer->well_na }}"
      >
      <span class="label label-primary"><i class="fa fa-pencil"></i></span>
    </a>

    @endcan

    @can('horometer.destroy')
    <a href="javascript:void(0)" id="{{ $horometer->id }}"
      class="btn-delete"
      title="Eliminar">
      <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

      <form method="POST"
      id="form-destroy-{{ $horometer->id }}"
      action="{{ route('horometer.destroy', $horometer) }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>

    @endcan


  </td>
</tr>
@endforeach
</tbody>
</table>

</div>
<!-- /.box-body -->
<div class="box-footer clearfix">

  <ul class="list-inline">

    @can('well.create')
    <li>
      <a href="#" class="link-black text-sm"><i class="fa fa-plus-circle"></i> Nuevo Pozo</a>
    </li>
    @endcan

    @can('well.index')
    <li>
      <a href="{{ route('well.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Pozos</a>
    </li>
    @endcan
    
  </ul> 

  @can('horometer.create')
  <a class="btn btn-primary no-margin pull-right"
  href=""
  data-toggle="modal"
  data-target="#modal-form-store"
  data-title="Insertar Nueva Lectura de Horometro">

  <i class="fa fa-plus"></i> 
  Insertar Nueva Lectura de Horometro
</a>
@endcan

</div>
</div>


@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>

<script src="{{ asset('js/datatables.min.js') }}"></script>

<script>
  $(function () 
  {
   var table = $('#t_lots').DataTable(
   {
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "columnDefs": [ { "visible": false, "targets": 3 } ],
    "order": [[ 3, 'asc' ]],
    "displayLength": 10,
    "drawCallback": function ( settings ) 
    {
     var api = this.api();
     var rows = api.rows( {page:'current'} ).nodes();
     var last = null;

     api.column(3, {page:'current'} ).data().each( function ( group, i ) 
     {
       if ( last !== group ) 
       {
         $(rows).eq( i ).before(
           '<tr class="group">' +
           '<td colspan="5">' + 
           '<strong> Pozo: '+group+'</strong>' +
           '</td>' +
           '</tr>'
           );

         last = group;
       }
     } );
   }            
 });

         // Order by the grouping
         $('#example tbody').on( 'click', 'tr.group', function () 
         {
          var currentOrder = table.order()[0];
          if ( currentOrder[0] === 3 && currentOrder[1] === 'asc' ) {
            table.order( [ 3, 'desc' ] ).draw();
          }
          else {
            table.order( [ 3, 'asc' ] ).draw();
          }
        });

       });
     </script> 


    <script type="text/javascript">

        $(function(){
    $('#modal-form-update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var NameWell = button.data('well_na') // Extract info from data-* attributes
        var Comment = button.data('comment')
        var title = button.data('title')
        var WellId = button.data('well_id')
        var DateRead = button.data('date_read')
        var Value = button.data('value')
        var HorometerId = button.data('horometer_id')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #well_id').val(WellId)
        modal.find('.modal-body #well_id').prop('disabled', true);
        modal.find('.modal-body #date_read').val(DateRead)
        modal.find('.modal-body #value').val(Value)
        modal.find('.modal-body #divInfoPozosParados').hide()  
        modal.find('.modal-body #divInfoHorometer').hide()  
        modal.find('.modal-body #value').prop('disabled', false)
        modal.find('.modal-body #comment').val(Comment)
        modal.find('.modal-body #horometer_id').val(HorometerId)

     });

  });
  

      $(function () 
      {    
        
        $('#modal-form-store')
        var modal = $(this);

      $('#well_id').on('change', function()
        {
          modal.find('.modal-body #value').prop('disabled' , true);
          var WellId = $(this).val();
          var url = "/horometer/HorometersByWells/"+WellId;
          $(document).ready(function(){
           $.ajax({
            dataType: 'json',
            url: url,
            method: "GET",
            beforeSend: function() {
              $("#loading").show();
            },
            success: function(datos)
            {
             $("#loading").hide();
             console.log(datos);
             modal.find('.modal-body #value').prop('disabled' , false);
             modal.find('.modal-body #value').prop('min' , datos);
             modal.find('.modal-body #infoLastHorometer').text(datos);         
           },
           timeout:9000,
           error: function()
           {
             console.log("Error Sincronizando");
           }

         });
         }); 

      });



      });
    </script>

    @endsection