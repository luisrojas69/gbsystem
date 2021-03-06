<form class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('role.update', $role->id) }}">
                {{ csrf_field() }}  
                {{ method_field('PUT') }}  
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Codigo del role"  value="{{ $role->name }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Slug: </label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug del Role" required value="{{ $role->slug }}"> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" id="description" placeholder="Descripcion del Rol"  value="{{ $role->description }}">
                  </div>
                </div>
                <div class="form-group">
                  <hr>

                  <div class="col-sm-10">
                  <h4>Persimos Especiales</h4>
                    <label class="radio-inline"><input type="radio" name="special" id="special" value="all-access" {{ $role->id == '1' ? 'checked' : '' }}>Acceso Total</label>
                    <br>
                    <label class="radio-inline"><input type="radio" name="special" id="special" value="no-access" {{ $role->slug == 'suspend' ? 'checked' : '' }}>Sin Acceso</label>
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
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>