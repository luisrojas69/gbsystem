@extends('layouts.master')

@section('title-page', "Rodeos Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_status')
@include('layouts._my_error')
@endsection

@section('content')
        <div class="error-page">
        <h2 class="headline text-red"> 403</h2>

        <div class="error-content">
          <h3><i class="fa fa-hand-stop-o text-red"></i> Oops! Acceso no Autorizado.</h3>

          <p>
            No tienes los Permisos Suficientes para ralizar esta Acci&oacute;n.
            <br>
            Usted puede Volver a la <a href="{{ URL::previous() }}">Pagina Anterior</a> o Ir al<a href="{{ route('home') }}">Inicio</a>.
          </p>
        </div>

        <div class="error-page">
          <img src="{{ asset('img/acceso_denegado.jpg') }}">
        </div>
        <!-- /.error-content -->
      </div>
@endsection