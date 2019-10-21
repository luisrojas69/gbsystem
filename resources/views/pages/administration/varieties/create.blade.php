@extends('layouts.master')

@section('title-page', "variedades Granja Boraure")

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
                    action="{{ route('variety.store') }}">
                {{ csrf_field() }}    
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Cultivo: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="crop_id" id="crop_id" value="{{ old('crop_id') }}" required>
                      @foreach($crops as $crop)
                      <option value="{{ $crop->id }}">{{ $crop->crop_de }}- ({{ $crop->crop_na }})</option>
                      @endforeach                    
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="50" class="form-control" name="variety_na" id="variety_co" placeholder="Nombre de la Variedad" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="variety_de" id="variety_de" placeholder="Descripcion del Variedad" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('variety.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>
@endsection