<div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Sector: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="sector_id" id="sector_id" value="{{ old('sector_id') }}" required>
                      @foreach($sectors as $sector)
                      <option value="{{ $sector->id }}">{{ $sector->sector_de }}- ({{ $sector->sector_co }})</option>
                      @endforeach                    
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Codigo: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="4" class="form-control" name="lot_co" id="lot_co" placeholder="Codigo del Lote" autofocus="autofocus" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="lot_de" id="lot_de" placeholder="Descripcion del Lote" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->