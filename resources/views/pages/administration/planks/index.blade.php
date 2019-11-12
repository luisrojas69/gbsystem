@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Tablones Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')
 
 <div class="col-md-6">
  <div class="box box-info" >

            <div class="box-header with-border">
              <h3 class="box-title">Seleccione el Tabl&oacute;n a Consultar </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
            
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
           <form class="form-horizontal" 
                    role="form" 
                    method="POST" 
                    action="{{ route('capture.store') }}">

                 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Lote: </label>
                  
                      <div class="col-sm-10">
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
                                  
                    </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tablon: </label>

                  <div class="col-sm-10">
                   <select class="form-control" name="plank_id" id="plank_id" value="{{ old('plank_id') }}" required>
                      <option value="">Seleccione un Tablon</option>       
                   </select>
                  </div>
                </div>             

    </form>
          </div>
          <!-- /.widget-user -->


     
            </div>
            <!-- /.box-body -->

  </div>
</div>


  <div class="col-md-6">
<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img class="img-circle" src="../img/logo-analisis.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username" id="nombre_tablon">SELECCIONE TABLON</h3>
              <h5 class="widget-user-desc">Informacion Resumida</h5>
            </div>

     
            <!-- /.box-body -->
            <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay" id="loading" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
       

            <div class="box-footer no-padding">

              <ul class="nav nav-stacked">
                <li><a href="#">Capacidad <span class="pull-right badge bg-blue " id="capacidad_tablon"></span></a></li>
                <li><a href="#">Codigo<span class="pull-right badge bg-aqua" id="codigo_tablon"></span></a></li>
                <li><a href="#">Cultivo Actual <span class="pull-right badge bg-green" id="cultivo_actual"></span></a></li>
                <li><a href="#">Variedad Actual <span class="pull-right badge bg-green" id="variedad_actual"></span></a></li>
                <li><a href="#">Sembrado Actual <span class="pull-right badge bg-yellow" id="sembrado_actual"></span></a></li>
                <li><a href="#">Hist&oacute;rico Sembrado <span class="pull-right badge bg-blue " id="total_sembrado"></span></a></li>
                <li><a href="#">Hist&oacute;rico Cosechado<span class="pull-right badge bg-aqua" id="total_cosechado"></span></a></li>
                <li><a href="#">Hist&oacute;rico Ajustado <span class="pull-right badge bg-green" id="total_ajustado"></span></a></li>
                
                </ul>

                <div class="box-footer">
                <a href="{{ route('plank.index') }}" class="btn btn-default">Volver a Tablones</a>
                <a class="btn btn-primary no-margin pull-right" title="Agregar un nuevo Lote" href="{{ route('plank.create') }}">
                    <i class="fa fa-plus"></i> Tablon
                </a>
              </div>
            </div>
          </div>
</div>


  


<script type="text/javascript">
        
    </script>
@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>


   <script>

    $(document).ready(function(){  
      

         var planks = [];

        @include('scripts._select_dinamyc_planks')

        $('#lot_id').on('change', function()
        {
          var lot = $(this).val();

          var selects = "<option value=''>Seleccione un Tablon</option>" ;
          
          $.each(planks, function(index, value) 
          {
            if(value.lot_id == lot) { 
              selects += value.html; 
            }
          });

          $("#plank_id").html(selects);
        });


  $("#plank_id").on('change',function()
  {
    
    var plank_id=$(this).val();

    var url = "/establishments/plank/"+plank_id;
console.log(url);
    if(plank_id!=0)
    {
      $.ajax({
      dataType: 'json', 
      url: url,
      method: "GET",

        success: function(data)
        {
          $("#plank_detail").hide();
          console.log(data);
          $('#nombre_tablon').html(data[0].nombre_tablon);
          $('#capacidad_tablon').html(data[0].capacidad_tablon);
           $('#sembrado_actual').html(data[0].sembrado_actual);
           $('#codigo_tablon').html(data[0].codigo_tablon);
           $('#cultivo_actual').html(data[0].cultivo);
           $('#total_ajustado').html(data[0].total_ajustado);
           $('#total_sembrado').html(data[0].total_sembrado);
           $('#total_cosechado').html(data[0].total_cosechado);

///////////////////////////////////////////////////////////////////////////////////////////////////////////          

        },
        timeout:9000,

         error: function()
         {
          console.log("error");
          $("#activity_id").html("<option value=''>ERROR SINCRONIZANDO..</option>") 
        }
        });
      
    }else
    {
     $("#plank_detail").show();
    }
    
  });
       
       });

     </script>
@endsection
