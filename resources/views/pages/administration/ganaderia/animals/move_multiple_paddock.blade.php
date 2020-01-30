@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Movilización Multiple de Animales a Rodeos")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">

      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Administración de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form action="{{ url('multimovetopaddock') }}" method="post" id="LuisRojas">
                @csrf
                
              <table data-maintain-meta-data="true" id="t_animals" class="table table-bordered table-hover table-striped">
                <thead>

                  <tr>
                  <th><input type="checkbox" id="selectall2"></th>
                  <th style="width: 60px; text-align: center">#</th>
                  <th>Nombre</th>
                  <th style="text-align: center;">Codigo</th>
                  <th>Especie</th>
                  <th>Raza</th>
                  <th>Lote</th>
                  <th>Rodeo</th>
                  <th>Potrero</th>
                  <th>Fecha Ingreso</th>
                </tr>

              </thead>
              <tbody>

                    @foreach($animals as $animal)
             
                @csrf
                <tr>
                  <td style="text-align: center;">
                  
                      <input class="case" type="checkbox" name="ids[]" value="{{ $animal->id }}">
                      
                  </td>
                  <td><a href="{{ route('animal.show', $animal->id) }}"><img src="{{ asset('img/IconoVaca2_28x28.png') }}"></a></td>
                  <td><a href="{{ route('animal.show', $animal->id) }}">{{ $animal->animal_na }}</a></td>
                  <td>{{ $animal->animal_cod }}</td>
                  <td>{{ $animal->breed->specie->specie_na }}</td>
                  <td>{{ $animal->breed->breed_na }}</td>
                  <td>{{ $animal->lotAnimal->lot_de }}</td>
                  <td>{{ $animal->rodeo->rodeo_na }}</td>
                  <td>{{ $animal->paddock->paddock_na }}</td>
                  <td>{{ $animal->date_in }}</td>
                  
                </tr>
               
               @endforeach
             </tbody>

               <tr>
                  <td colspan="4">
                    <div class="col-sm-10">
                    <select class="form-control" name="paddock_id" id="paddock_id" required>
                        <option value=''>Seleccione el Potrero Destino</option>
                         @foreach($paddocks as $paddock)
                              <option value="{{$paddock->id}}">
                                {{ $paddock->paddock_na }}
                              </option>
                          @endforeach
                    </select>
                     
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="5">
                 <input class="btn btn-primary no-margin pull-right" type="submit" name="enviar" value="Procesar Movimiento"> 
                 
                 

                  </td>
               </tr>

            </table>
            </form> 
            </div>
            
           
            <!-- /.box-body -->
            <div class="box-footer clearfix">

              <ul class="list-inline">
                      <li><a href="{{ route('animal.create') }}" class="link-black text-sm"><i class="fa fa-plus-circle"></i> Nuevo Animal</a></li>
                      <li><a href="{{ route('animal.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Animales</a></li>
              </ul> 

               
            </div>

            

          
</div>

   
@endsection

@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')

<script type="text/javascript" src="{{ asset('scripts/confirm-update-rodeo.js') }}"></script>


<script src="{{ asset('js/datatables.min.js') }}"></script>
   <script>
      $(function () 
      {
         var table = $('#t_animals').DataTable(
         {
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "columnDefs": [ { "visible": false, "targets": 3 } ],
            "order": [[ 3, 'asc' ]],
            //"displayLength": 10,
            "drawCallback": function ( settings ) 
            {
               var api = this.api();
               var rows = api.rows( {page:'current'} ).nodes();
               var last = null;

            }            
         });



      });
   </script> 


<!--Funcion para seleccionar todos los animales-->
<script>
  $("#selectall").on("click", function() {  
  $(".case").prop("checked", this.checked);  
});  

  // if all checkbox are selected, check the selectall checkbox and viceversa  
  $(".case").on("click", function() {  
    if ($(".case").length == $(".case:checked").length) {  
      $("#selectall").prop("checked", true);  
    } else {  
      $("#selectall").prop("checked", false);  
    }  
  });
</script>


@endsection