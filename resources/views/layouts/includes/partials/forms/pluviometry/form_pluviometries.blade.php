              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha: </label>

                  <div class="col-sm-5">

                    <input type="date" class="form-control" min="2018-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_read" id="date_read" placeholder="Fecha del Registro" required>
                  </div>
                </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Sector: </label>
                  
                      <div class="col-sm-10">
                        <select class="form-control" 
                                name="sector_id"
                                id="sector_id"
                                required
                                value="{{ old('sector_id') }}">
                          <option value=''>Seleccione un Sector</option>      
                          @foreach($sectors as $item)  
                              <option value="{{$item->id}}">
                                {{ $item->sector_de }}
                              </option>
                          @endforeach
                        </select>
                      </div>
                    </div> 
               

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Milimetros: </label>

                  <div class="col-sm-10">
                    <input type="number" min="0" step="0.1" class="form-control" name="value_read" id="value_read" placeholder="Cantidad de Milimetros" required >
                  </div>
                </div>


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->