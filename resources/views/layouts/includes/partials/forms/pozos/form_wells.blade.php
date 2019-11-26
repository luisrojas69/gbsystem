              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="well_na" id="well_na" placeholder="Nombre del Pozo" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tipo: </label>

                  <div class="col-sm-10 btn-group btn-group-toggle">
                    <label class="btn btn-xs btn-warning active">
                      <input type="radio" name="type" id="sumergible" autocomplete="off" value="sumergible" checked=""> 
                      <i class="fa fa-sort-desc"></i>
                      SUMERGIBLE
                    </label>
                    <label class="btn btn-xs btn-primary">
                      <input type="radio" name="type" id="turbina" autocomplete="off" value="turbina"> 
                      <i class="fa fa-sort-up"></i>
                      TURBINA
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status: </label>

                  <div class="col-sm-10 btn-group btn-group-toggle">
                    <label class="btn btn-xs btn-success active">
                      
                      <input type="radio" name="status" id="operativo" autocomplete="off" value="operativo" checked="">
                      <i class="fa fa-check-square"></i>  
                      OPERATIVO
                    </label>
                    
                    <label class="btn btn-xs btn-danger">
                     
                      <input type="radio" name="status" id="parado" autocomplete="off" value="parado"> 
                      <i class="fa fa-remove"></i>
                      PARADO
                    </label>
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