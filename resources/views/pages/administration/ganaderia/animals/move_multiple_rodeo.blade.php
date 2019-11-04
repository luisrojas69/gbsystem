@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Movilización Multiple de Animales a Rodeos")


@section('content')

    @include('layouts._my_message')
    @include('layouts._my_error')
    <!-- Main content -->
    <section class="content">

      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Administración de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 120px; text-align: center;">Seleccione</th>
                  <th style="width: 60px">image</th>
                  <th>Nombre</th>
                  <th>Codigo</th>
                  <th>Especie</th>
                  <th>Raza</th>
                  <th>Rodeo</th>
                  <th>Potrero</th>
                  <th>Fecha Ingreso</th>
                </tr>
                    @foreach($animals as $animal)
              <form action="{{ url('multimovetorodeo') }}" method="post" id="multiple">
                @csrf
                <tr>
                  <td style="text-align: center;">
                  
                      <input type="checkbox" name="ids[]" value="{{ $animal->id }}">
                      
                  </td>
                  <td><a href="{{ route('animal.show', $animal->id) }}"><img src="{{ asset('img/bull.png') }}"></a></td>
                  <td><a href="{{ route('animal.show', $animal->id) }}">{{ $animal->animal_na }}</a></td>
                  <td>{{ $animal->animal_cod }}</td>
                  <td>{{ $animal->breed->specie->specie_na }}</td>
                  <td>{{ $animal->breed->breed_na }}</td>
                  <td>{{ $animal->rodeo->rodeo_na }}</td>
                  <td>{{ $animal->paddock->paddock_na }}</td>
                  <td>{{ $animal->date_in }}</td>
                  
                </tr>
               
               @endforeach

               <tr>
                  <td colspan="4">
                    <div class="col-sm-10">
                    <select class="form-control" name="rodeo_id" id="rodeo_id" required>
                        <option value=''>Seleccione el Rodeo Destino</option>
                         @foreach($rodeos as $rodeo)
                              <option value="{{$rodeo->id}}">
                                {{ $rodeo->rodeo_na }}
                              </option>
                          @endforeach
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="5">
                <input class="btn btn-primary no-margin pull-right" type="submit" name="enviar" value="Procesar Movimiento"> 
                 
                 </form>  

                  </td>
               </tr>

              </tbody>
            </table>
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

@endsection