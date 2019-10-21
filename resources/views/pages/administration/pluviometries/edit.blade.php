@extends('layouts.master')

@section('title-page', "Editar Registro de Pluviometr&iacute;a Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
<style type="text/css">
  
</style>
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario de @yield('title-page')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('pluviometry.update', $pluviometry ) }}" >
                {{ csrf_field() }}    
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha: </label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" min="2018-01-01" max="<?php echo date("Y-m-d");?>" value="{{ $pluviometry->getDateRead() }}" name="date_read" id="date_read" placeholder="Fecha del Registro" required>
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
                         @foreach($sectors as $item)     
                            <option value="{{$item->id}}" {{$pluviometry->sector_id == $item->id ? 'selected' : ''}} >
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
                <a href="{{ route('pluviometry.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>    
    </div>


    <div class="row" id="graphic">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Aqui va la Grafica de Lluvias</span>
              <span class="info-box-number" id="info_capacidad"><br></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>s
              </div>
                 
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

    </div>
@endsection

@section('additionals-scripts')


   <script>

    $(function () 
    {    
    $('#graphic').hide();
//---------------------------- OBETENER VARIEDADES DINAMICAMENTE --------------------------------------------

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  $("#sector_id").on('change',function()
  {
    $('#graphic').show('fast');
    var sector_id=$(this).val();

    var url = "/gbsystem/public/sector/"+sector_id;

    if(sector_id!=0)
    {
      $.ajax({
      dataType: 'json', 
      url: url,
      method: "GET",

        success: function(data)
        {
          
          console.log(data);
          $("#milimetros").prop("disabled",false);
          
///////////////////////////////////////////////////////////////////////////////////////////////////////////
          
         

///////////////////////////////////////////////////////////////////////////////////////////////////////////          

        },
        timeout:9000,
         error: function()
         {
          console.log('Tiempo de Espera Agotado');
          $("#activity_id").html("<option value=''>ERROR SINCRONIZANDO..</option>") 
        }
        });
      
    }else
    {
     $("#milimetros").prop("disabled","true");
     $('#graphic').hide();
    }
    
  });

  });


   </script>
  
@endsection

 