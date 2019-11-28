              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="well_na" id="well_na" placeholder="Nombre del Pozo" required>
                  </div>
                  <div class="col-sm-5">
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
                    <input type="number" min="0" step="1" class="form-control" name="value" id="value" placeholder="Horas Leidas" required >
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