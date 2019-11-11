@extends('layouts.master')

@section('title-page', "Pesajes Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_status')
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
          @if($animal->rodeo_id == '4')
            @include('layouts.includes.partials.forms.ganaderia.form_weighings')
          @else
           <div class="box-body">
             <div class="form-group">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Ooops.!</h4>
                  No puede agregar pesajes a Animales pertenecientes al Rodeo de Animales: <strong>{{ $animal->rodeo->rodeo_na }}</strong>.<hr>
                  Puede Mover este Animal al Rodeo "Animales para Engorde" haciendo click <a href="{{ route('movetorodeo', $animal->id) }}">AQUI</a>
              </div>
             </div> 
           </div>
          @endif
          </div>
    </div>
@endsection