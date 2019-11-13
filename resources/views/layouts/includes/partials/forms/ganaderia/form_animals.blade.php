<form class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('animal.store') }}">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre: </label>

                  <div class="col-sm-10">
                    <input type="text" maxlength="30" autocomplete="off" class="form-control" name="animal_na" id="animal_na" value="{{ old('animal_na') }}" placeholder="Nombre del Animal (Opcional)">
                  </div>
                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label">Código: </label>
                  <div class="col-sm-5">
                    <input type="text" maxlength="30" autocomplete="off" class="form-control" name="animal_cod" id="animal_cod" placeholder="Codigo del Animal (Requerido)" required="">
                  </div>

                  <div class="col-sm-5">
                    <select class="form-control" name="animal_col" id="animal_col">
                          <option value=''>Seleccione un Color (Opcional)</option>
                          <option value='Negro'>Negro</option>
                          <option value='Blanco'>Blanco</option>
                          <option value='Blanco y Negro'>Blanco y Negro</option>
                          <option value='Negro y Blanco'>Negro y Blanco</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Especie: </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="breed_id" id="breed_id" required value="{{ old('breed_id') }}">
                      <option value=''>Seleccione una Raza (Requerido)</option>
                        @foreach($species as $specie)
                          <optgroup label="{{ $specie->specie_de }}">
                          @foreach($breeds as $item)
                            @if($specie->id == $item->Specie->id)
                              <option value="{{$item->id}}">
                                <!-- {{ $item->Specie->specie_de }} -->
                                     {{ $item->breed_de }}
                              </option>
                            @endif
                          @endforeach
                          </optgroup>
                        @endforeach
                    </select>
                  </div>

                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-5 btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-xs btn-default active">
                        <i class="fa fa-male"></i>
                        <input type="radio" name="gender" id="macho" autocomplete="off" value="m" checked=""> MACHO
                      </label>
                      <label class="btn btn-xs btn-default">
                        <i class="fa fa-female"></i>
                        <input type="radio" name="gender" id="hembra" autocomplete="off" value="f"> HEMBRA
                      </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ingreso: </label>
                  <div class="col-sm-5">
                    <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="date_in" id="date_in" placeholder="Fecha de Ingreso" required>
                  </div>

                  <div class="col-sm-5">
                      <input type="number" maxlength="30" class="form-control" name="weight_in" id="weight_in" placeholder="Peso al Ingresar (Requerido)" required="">
                  </div>
                </div>

            <div class="form-group">
                  <label class="col-sm-2 control-label">Lote: </label>
                  <div class="col-sm-5">
                    <input type="number" step="1" min="1" class="form-control" name="lot_id" id="lot_id" placeholder="Lote en el que llegó (Requerido)" required="">
                  </div>

                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-5 btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-xs btn-default active">
                        <i class="fa fa-bank"></i>
                        <input type="radio" name="condition" id="propio" autocomplete="off" value="propia" checked=""> PROPIO
                      </label>
                      <label class="btn btn-xs btn-default">
                        <i class="fa fa-cut"></i>
                        <input type="radio" name="condition" id="mediania" autocomplete="off" value="mediania"> MEDIANIA
                      </label>
                  </div>
            </div>

             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Potrero: </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="paddock_id" id="paddock_id" required>
                        <option value=''>Seleccione un Potrero</option>
                          @foreach($paddocks as $paddock)
                              <option value="{{$paddock->id}}">
                                {{ $paddock->paddock_na }}
                              </option>
                          @endforeach
                    </select>
                  </div>

                  <div class="col-sm-5">
                    <select class="form-control" name="rodeo_id" id="rodeo_id" required>
                          @foreach($rodeos as $rodeo)
                              <option value="{{$rodeo->id}}">
                                {{ $rodeo->rodeo_na }}
                              </option>
                          @endforeach
                    </select>
                  </div>
             </div>

            <div class="form-group">
              <label  class="col-sm-2 control-label">Observacion: </label>
              <div class="col-sm-10">
                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Observaciones si Existen (Opcional)"></textarea>
              </div>
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
          </div>
        </form>