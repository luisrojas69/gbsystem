
@extends('layouts.master')

@section('title-page', "Roles Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
  <section class="content">

   
<div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario de Edicion de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('role.update', $role->id) }}">
                {{ csrf_field() }}  
                {{ method_field('PUT') }}  
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Codigo del role"  value="{{ $role->name }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Slug: </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug del Role" required value="{{ $role->slug }}"> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-8">
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Introduzca una Breve Descripcion del Rol...">{{ $role->description }}</textarea>
                </div>
                
              </div>
              <hr>
                <div class="form-group">
                  
                  <div class="col-sm-8">
                  <h4>Persimos Especiales</h4>
                    <label class="radio-inline"><input type="radio" name="special" id="special" value="all-access" {{ $role->special == 'all-access' ? 'checked' : '' }}>Acceso Total</label>
                    <br>
                    <label class="radio-inline"><input type="radio" name="special" id="special" value="no-access" {{ $role->special == 'no-access' ? 'checked' : '' }}>Sin Acceso</label>
                  </div>
                </div>

                <hr>
                 <div class="form-group">
                  <div class="col-sm-10">
                  <h4>Seleccione los Permisos</h4>
                 @foreach($permissions as $permission)
                  <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }} >
                    {{ $permission->name }} | <em> {{ $permission->description ?: 'Sin Descripcion' }} </em>
                  </label>
                 @endforeach
                </div> 
                  
                </div>
              
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('role.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

       

        </div>
        <!--/.col (left) -->
      
      </div>
    </section>
@endsection