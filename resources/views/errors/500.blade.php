@extends('layouts.master')

@section('title-page', "Error Interno - 500")

@section('message')
@include('layouts._my_message')
@include('layouts._my_status')
@include('layouts._my_error')
@endsection

@section('content')
        <div class="error-page">
        <h2 class="headline text-red"> 500</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Error Interno.</h3>

          <p>
            Ha ocurrido un Error Interno en El Serivor y su solicitud no ha sido procesada.
            Usted puede Volver a la <a class="text-red" href="{{ URL::previous() }}">Pagina Anterior</a> o Ir al <a class="text-green" href="{{ route('home') }}">Inicio</a>
          </p>
          <br>
          <small>Si el Problema persiste por favor cominiquese con el Administrador de este Sistema</small>
        </div>
        <!-- /.error-content -->
      </div>
@endsection