          <form id="form_breeds" class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('breed.store') }}">
                {{ csrf_field() }}
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Especie: </label>

                  <div class="col-sm-10">
                   <select autofocus="autofocus" class="form-control" name="specie_id" id="specie_id" value="{{ old('specie_id') }}" required>
                      @foreach($species as $specie)
                      <option value="{{ $specie->id }}">{{ $specie->specie_na }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" class="form-control" name="breed_na" id="breed_na" placeholder="Nombre de la Raza"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="breed_de" id="breed_de" placeholder="Descripcion de la Raza" required>
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
