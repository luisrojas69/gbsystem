<div class="box-body">


  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Ingreso: </label>
    <div class="col-sm-5">
      <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_in" id="date_in" placeholder="Fecha de Ingreso" required>
    </div>

    <div class="col-sm-5">
      <input type="text" maxlength="4" class="form-control" name="lot_co" id="lot_co" placeholder="Codigo del Lote Animal" autofocus="autofocus" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

    <div class="col-sm-10">
      <input type="text" class="form-control" name="lot_de" id="lot_de" placeholder="Descripcion del Lote Animal" required>
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