            <form id="form_capture" class="form-horizontal" 
            role="form" 
            method="POST" 
            action="{{ route('capture.store') }}"
            onsubmit="return checkSubmit();">
            {{ csrf_field() }}    
            <div class="box-body">

              <div class="form-group">
                <div class="col-xs-4">
                  <input type="date" class="form-control" min="2018-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="activity_date" id="activity_date" placeholder="Fecha de la Actividad" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-6">
                  <select class="form-control" 
                  name="lot_id"
                  id="lot_id"
                  required
                  value="{{ old('lot_id') }}">
                  <option value=''>Seleccione un Lote</option>
                  @foreach($sectors as $sector)
                  <optgroup label="{{ $sector->sector_de }}">      
                    @foreach($lots as $item)  
                    @if($sector->id == $item->Sector->id)   
                    <option value="{{$item->id}}">
                      <!-- {{ $item->Sector->sector_de }} -->
                      {{ $item->lot_de }}
                    </option>
                    @endif  
                    @endforeach
                  </optgroup>
                  @endforeach
                </select>
              </div>

              <div class="col-xs-6">
                <select class="form-control" name="plank_id" id="plank_id" value="{{ old('plank_id') }}" required>
                  <option value="">Seleccione un Tablon</option>       
                </select>
              </div>
            </div>


            <div class="form-group">
              <div class="col-xs-5">
                <select class="form-control" name="activity_id" id="activity_id" value="{{ old('activity_id') }}" required disabled="">
                  <option value=''>Seleccione una Actividad</option>                 
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-6">
               <select class="form-control" name="crop_id" id="crop_id" value="{{ old('crop_id') }}" required>
                <option value=''>Seleccione un Cultivo</option>               
              </select>
            </div>

            <div class="col-xs-6">
             <select class="form-control" name="variety_id" id="variety_id" value="{{ old('variety_id') }}" required>
              <option value=''>Seleccione una Variedad</option>               
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-4">
           <input type="number" min="0" step="0.01" class="form-control" name="area" id="area" placeholder="Cantidad de Hect&aacute;reas" required disabled="">
         </div>

       </div>

       <div class="form-group">
        <div class="col-xs-12">
         <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Introduzca una Breve Nota ..."></textarea>
       </div>

     </div>

   </div>
   <!-- /.box-body -->
   <div class="box-footer">
    <a href="{{ route('capture.index') }}" class="btn btn-default">Cancelar</a>
    <input type="submit" id="submitForm" class="btn btn-info pull-right" value="Guardar">
  </div>
  <!-- /.box-footer -->
</form>