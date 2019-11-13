
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
                    action="{{ route('capture.store') }}">
                {{ csrf_field() }}    
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tablon: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="plank_id" id="plank_id" value="{{ old('plank_id') }}" required readonly="true">
                      
                      <option value="{{ $capture->plank_id }}">{{ $capture->plank_de }}</option>                  
                    </select>
                  </div>
                </div>                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Actividad: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="activity_id" id="activity_id" value="{{ old('activity_id') }}" required>
                      @foreach($activities as $activity)
                      <option value="{{ $activity->id }}">{{ $activity->activity_de }}</option>
                      @endforeach                    
                    </select>
                  </div>
                </div>                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Cultivo: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="crop_id" id="crop_id" value="{{ old('crop_id') }}" required>
                      @foreach($crops as $crop)
                      <option value="{{ $crop->id }}">{{ $crop->crop_de }}</option>
                      @endforeach                    
                    </select>
                  </div>
                </div>  
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Variedad: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="crop_id" id="crop_id" value="{{ old('crop_id') }}" required>
                      @foreach($varieties as $variety)
                      <option value="{{ $variety->id }}">{{ $variety->variety_de }}</option>
                      @endforeach                    
                    </select>
                  </div>
                </div>				
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Hect&aacute;reas: </label>

                  <div class="col-sm-10">
                    <input type="number" max="{{ $plank->plank_area}}" min="0" step="0.1" class="form-control" name="area" id="area" placeholder="Cantidad de Hect&aacute;reas" value="{{ $capture->area }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fecha: </label>

                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="activity_date" id="activity_date" placeholder="Fecha de la Actividad" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('capture.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>
@endsection