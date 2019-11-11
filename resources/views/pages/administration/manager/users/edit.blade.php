
@extends('layouts.master')

@section('title-page', "Usuarios Granja Boraure")

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
                    action="{{ route('user.update', $user) }}">
                {{ csrf_field() }}  
                {{ method_field('PUT') }}  
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Codigo del user"  value="{{ $user->name }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email: </label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email del Usuario"  value="{{ $user->email }}" required>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                 @foreach($roles as $role)
                 <div class="col-sm-10">
                  <label>
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                    {{ $role->name }} | <em> {{ $role->description ?: 'Sin Descripcion' }} </em>
                  </label>
                </div>
                 @endforeach 
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('user.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>
@endsection