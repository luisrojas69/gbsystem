
@extends('layouts.master')

@section('title-page', "Lote Granja Boraure")

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
                    action="{{ route('lot.update', $lot) }}">
                {{ csrf_field() }}  
                {{ method_field('PUT') }}  
              <div class="box-body">


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Sector: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="sector_id" id="sector_id" value="{{ old('sector_id') }}" readonly="true">
                      <option value="{{ $lot->sector->id }}">{{ $lot->sector->sector_de }}- ({{ $lot->sector->sector_co }})</option>                  
                    </select>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Codigo: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="4" class="form-control" name="lot_co" id="lot_co" placeholder="Codigo del Sector"  value="{{ $lot->lot_co }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="lot_de" id="lot_de" placeholder="Descripcion del Sector"  value="{{ $lot->lot_de }}" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('lot.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>
@endsection