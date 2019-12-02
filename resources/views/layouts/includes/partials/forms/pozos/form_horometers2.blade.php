              <div class="box-body">

                <div class="form-group">
                  <div class="alert alert-info alert-dismissible" id="divInfoPozosParados">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Informacion!</h4>
                    Los Pozos con Status <strong>"PARADO"</strong>, NO aparecerán en la Siguiente Lista Desplegable
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="well_id" id="well_id" value="{{ old('well_id') }}" required>
                      <option value="">Seleccione un Pozo</option>
                      @foreach($wells as $well)
                      <option value="{{ $well->id }}">{{ $well->well_na }}</option>
                      @endforeach                    
                    </select>
                  </div>
                  <div class="col-sm-5" id="divInfoHorometer">
                    <p class="text-green">Ultima Lectura:  <span class="badge bg-orange" id="infoLastHorometer"></span></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2
                  control-label">Fecha: </label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_read" id="date_read" placeholder="Fecha de la Lectura" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Valor: </label>

                  <div class="col-sm-4">
                    <input type="number" min="0" step="1" class="form-control" name="value" id="value" placeholder="Horas Leidas" required disabled="" >
                  </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-2 control-label">Observacion: </label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Observaciones si Existen (Opcional)"></textarea>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->