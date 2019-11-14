
@extends('layouts.master')

@section('title-page', "Sectores Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario de Edicion de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('sector.update', $sector) }}">
                {{ csrf_field() }}  
                {{ method_field('PUT') }}  
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Codigo: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="4" class="form-control" name="sector_co" id="sector_co" placeholder="Codigo del Sector"  value="{{ $sector->sector_co }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="sector_de" id="sector_de" placeholder="Descripcion del Sector"  value="{{ $sector->sector_de }}" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('sector.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>
@endsection