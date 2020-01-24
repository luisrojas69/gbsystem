@extends('layouts.master')

@section('title-page', "Error 404")

@section('message')
@include('layouts._my_message')
@include('layouts._my_status')
@include('layouts._my_error')
@endsection

@section('content')
        <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Página NO encontrada.</h3>

          <p>
            No pudimos encontrar la ruta que anda buscando.
            Usted puede Volver a la <a href="{{ URL::previous() }}">Pagina Anterior</a> o Ir al <a href="{{ route('home') }}">Inicio</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
@endsection