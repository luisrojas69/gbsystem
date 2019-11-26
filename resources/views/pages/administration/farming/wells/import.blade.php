@extends('layouts.master')

@section('title-page', "Importar Sectores Granja Boraure")

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
            <form class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('sectors.import.excel') }}"
                    enctype="multipart/form-data">
                {{ csrf_field() }}    
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Archivo: </label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="file" id="file" placeholder="Seleccione el Archivo" required>
                  </div>
                </div>
                
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('sector.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Importar Sectores</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>
@endsection