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
            <form class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('weighing.store') }}">
                {{ csrf_field() }}
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Animal: </label>
                  <div class="col-sm-10">
                     <select autofocus="autofocus" class="form-control" name="animal_id" id="animal_id" required>
                        <option value="{{ $animal->id }}">{{ $animal->animal_na }} - ({{ $animal->id }})</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fecha: </label>

                  <div class="col-sm-6">
                    <input type="date" min="{{ $animal->date_in }}" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control" name="date_read" id="date_read" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Peso: </label>

                  <div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="weight" id="weight" placeholder="Introduzca el Peso en Kg" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('breed.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
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