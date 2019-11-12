
@extends('layouts.master')

@section('title-page', "Razas Animales Granja Boraure")

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
                    action="{{ route('breed.update', $breed) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
              <div class="box-body">


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Sector: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="specie_id" id="specie_id" value="{{ old('specie_id') }}" readonly="true">
                      <option value="{{ $breed->specie->id }}">{{ $breed->specie->specie_na }}</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" class="form-control" name="breed_na" id="breed_na" placeholder="Nombre de la Raza"  value="{{ $breed->breed_na }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="breed_de" id="breed_de" placeholder="Descripcion de la Raza"  value="{{ $breed->breed_de }}" required>
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
          </div>
    </div>
@endsection