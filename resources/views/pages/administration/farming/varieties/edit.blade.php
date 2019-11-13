
@extends('layouts.master')

@section('title-page', "Variedades Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario Edicion de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('variety.update', $variety) }}">
                {{ csrf_field() }}  
                {{ method_field('PUT') }}  
              <div class="box-body">


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Variedad: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="crop_id" id="crop_id" value="{{ old('crop_id') }}" readonly="true">
                      <option value="{{ $variety->crop->id }}">{{ $variety->crop->crop_de }}</option>                  
                    </select>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="50" class="form-control" name="variety_na" id="variety_na" placeholder="Nombre de la Variedad"  value="{{ $variety->variety_na }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="variety_de" id="variety_de" placeholder="Descripcion de la Variedad"  value="{{ $variety->variety_de }}" required>
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