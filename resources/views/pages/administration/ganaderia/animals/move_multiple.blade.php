@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Movilizaci&oacute;n de Animales a Rodeos")


@section('content')

    @include('layouts._my_message')
    @include('layouts._my_error')
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- left column -->

         <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Seleccione Rodeo Destino</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-header with-border">
              <ul>
                @foreach($rodeos as $rodeo)

                        <form method="GET"
                            action="#"
                            id="form-update-rodeo-{{ $rodeo->id }}"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                  <li class="btn-update-rodeo" id="{{ $rodeo->id }}"><a href="javascript:void(0)">{{ $rodeo->rodeo_na }}</a></li>
                @endforeach
              </ul>
            </div>

            <div class="box-header with-border">
              <form action="{{ url('multimovetorodeo') }}" method="post" id="multiple">
                @csrf
                @foreach($animals as $animal)
                  <input type="checkbox" name="ids[]" value="{{ $animal->id }}"><a href="{{ route('animal.show', $animal->id ) }}">{{ $animal->animal_na }}</a><br>
                @endforeach
                @foreach($rodeos as $rodeo)
                  <input type="radio" name="rodeo_id" value="{{ $rodeo->id }}" required=""> {{ $rodeo->rodeo_na }}<br>
                @endforeach
                

                <input type="submit" name="enviar" value="enviar">
              </form>
            </div>
          </div>
        </div>
        <!--/.col (left) -->

        <!-- right column -->

        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Administracion de @yield('title-page')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del animal <strong>Animal</strong></h3>
                </div>

                
            </div>
        </div>
          <!--Rigth Column -->



@endsection

@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')

<script type="text/javascript" src="{{ asset('scripts/confirm-update-rodeo.js') }}"></script>

@endsection