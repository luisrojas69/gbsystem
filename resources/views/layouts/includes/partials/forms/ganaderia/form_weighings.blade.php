          <form class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('weighing.store') }}">
                {{ csrf_field() }}
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Animal: </label>
                  <div class="col-sm-10">
                     <select autofocus="autofocus" class="form-control" name="animal_id" id="animal_id" required>
                        <option value="{{ $animal->id }}">{{ $animal->animal_na }} - ({{ $animal->id }})</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fecha: </label>

                  <div class="col-sm-6">
                    <input type="date" min="{{ $animal->date_in }}" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control" name="date_read" id="date_read" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Peso: </label>

                  <div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="weight" id="weight" placeholder="Introduzca el Peso en Kg" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>