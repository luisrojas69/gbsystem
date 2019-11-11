@extends('layouts.master')

@section('title-page', "Razas Animales Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @include('layouts.includes.partials.forms.ganaderia.form_breeds')
          </div>
    </div>
@endsection