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

@section('title-page', "Pesaje de Animales Granja Boraure")

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

            <table id="t_lots" class="table table-hover table-striped" style="font-size: 12px;">
                     <thead>
                        <tr class="bg-green">
                           <th>ID</th>
                           <th>Fecha de Pesaje</th>
                           <th>Peso</th>
                           <th>Animal</th>
                           <th>Creado</th>
                           <th>Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($weighings as $weighing)
                        <tr>
                        <td>{{$weighing->id}}</td>
                        <td>{{$weighing->date_read}}</td>
                        <td>{{$weighing->weight}}</td>
                        <td><a href="{{ route('animal.show', $weighing->animal->id) }}">{{$weighing->animal->animal_cod}}, {{$weighing->animal->animal_na}}</a></td>
                        <td>{{ $weighing->created_at }}</td>
                        <!-- Actions -->
                        <td style="text-align: center;">
                        <a href="javascript:void(0)"
                            title="Editar" 
                            onclick="event.preventDefault(); 
                            document.getElementById('form-edit-{{ $weighing->id }}').submit()">
                             <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                        </a>                    

                        <form method="GET" 
                            action="{{ route('weighing.edit', $weighing) }}"
                            id="form-edit-{{ $weighing->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <a href="javascript:void(0)" id="{{ $weighing->id }}"
                          class="btn-delete"
                          title="Eliminar">
                        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                     <form method="POST"
                        id="form-destroy-{{ $weighing->id }}" 
                        action="{{ route('weighing.destroy', $weighing) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    
                  </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>

            </div>
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
               <a class="btn btn-primary no-margin pull-right"
                                title="Insertar un nuevo Nuevo"
                                href="{{ route('new_weighing') }}">
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
                           '<strong> Animal: '+group+'</strong>' +
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

@endsection