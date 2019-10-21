@extends('layouts.master')

@section('title-page', "Tablones Granja Boraure")

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
                    action="{{ route('plank.store') }}">
                {{ csrf_field() }}    
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Lote: </label>

                      <div class="col-sm-10">
                        <select class="form-control" 
                                name="lot_id"
                                id="lot_id"
                                required
                                value="{{ old('lot_id') }}">
                          <option value=''>Seleccione un Lote</option>
                        @foreach($sectors as $sector)
                          <optgroup label="{{ $sector->sector_de }}">      
                          @foreach($lots as $item)  
                            @if($sector->id == $item->Sector->id)   
                              <option value="{{$item->id}}">
                                <!-- {{ $item->Sector->sector_de }} -->
                                {{ $item->lot_de }}
                              </option>
                            @endif  
                          @endforeach
                          </optgroup>
                        @endforeach
                        </select>

                      </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Codigo: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="6" class="form-control" name="plank_co" id="plank_co" placeholder="Codigo del Tablon" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="plank_de" id="plank_de" placeholder="Descripcion del Tablon" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Hect&aacute;reas: </label>

                  <div class="col-sm-10">
                    <input type="number" step="0.01"  min="0" max="8" class="form-control" name="plank_area" id="plank_area" placeholder="Numero de Hectaeras del Tablon" required>
                  </div>
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('plank.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>
@endsection