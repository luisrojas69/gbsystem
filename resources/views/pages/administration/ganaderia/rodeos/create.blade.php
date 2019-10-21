@extends('layouts.master')

@section('title-page', "Rodeos Granja Boraure")

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
            <form id="form_rodeo" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('rodeo.store') }}">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" class="form-control" name="rodeo_na" id="rodeo_na" placeholder="Nombre de Rodeo" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="rodeo_de" id="rodeo_de" placeholder="Descripcion del Rodeo" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('rodeo.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
    </div>
@endsection