<div class="box-body">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Cultivo: </label>

    <div class="col-sm-10">
     <select class="form-control" name="crop_id" id="crop_id" value="{{ old('crop_id') }}" required>
      @foreach($crops as $crop)
      <option value="{{ $crop->id }}">{{ $crop->crop_de }}- ({{ $crop->crop_na }})</option>
      @endforeach                    
    </select>
  </div>
</div>

<div class="form-group">
  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

  <div class="col-sm-10">
    <input type="text" maxlength="50" class="form-control" name="variety_na" id="variety_na" placeholder="Nombre de la Variedad" required>
  </div>
</div>
<div class="form-group">
  <label for="inputEmail3" class="col-sm-2 control-label">Descripcion: </label>

  <div class="col-sm-10">
    <input type="text" class="form-control" name="variety_de" id="variety_de" placeholder="Descripcion del Variedad" required>
  </div>
</div>
</div>
<!-- /.box-body -->
<div class="box-footer">
 <div class="box-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
  <button type="submit" class="btn btn-info pull-right">Guardar</button>
</div>
</div>
              <!-- /.box-footer -->