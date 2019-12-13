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

<!--Formulario para Crear un Nuevo Registro-->  
<div class="modal fade" id="modal-form-store" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registrar un Nuevo Tablon</h4>
      </div>
      <div class="modal-body">
        <form id="form_plank" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('plank.store') }}">
        {{ csrf_field() }}        
        @include('layouts.includes.partials.forms.capture.form_planks')
      </form>
    </div>
  </div>
</div>
</div>

<!--Formulario para Editar Registro-->
<div class="modal fade" id="modal-form-update" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form_plank" class="form-horizontal"
        role="form"
        method="POST"
        action="{{ route('plank.update','test') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }} 
        <input type="hidden" name="plank_id" id="plank_id" value="">             
        @include('layouts.includes.partials.forms.capture.form_planks')
      </form>
    </div>
  </div>
</div>
</div>


<div class="col-md-8">
  <div class="box box-info" >

    <div class="box-header with-border">
      <h3 class="box-title">Seleccione el Tabl&oacute;n a Consultar </h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body" >

      <!-- Widget: user widget style 1 -->

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

<!-- /.widget-user -->



</div>
<!-- /.box-body -->

</div>

<div class="box box-info" >

  <div class="box-header with-border">
    <h3 class="box-title">Tabla de Tablones Registrados </h3>

    <form action="{{ route('plank.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
      <div class="input-group input-group-sm">
        <input type="text" name="name" class="form-control" placeholder="Nombre del Tablon">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
        </span>
      </div>
    </form> 

    <a title="Exportar a PDF"
    href="{{ route('sectors.pdf') }}" type="button" class="btn btn-danger pull-right" style="margin-right: 5px; ">
    <i class="fa fa-download"></i> Generar PDF
  </a>

  <a title="Exportar a Excel"
  href="{{ route('planks.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
  <i class="fa fa-download"></i> Generar EXCEL
</a>

</div>
<!-- /.box-header -->
<div class="box-body table-responsive no-padding" >

  <table class="table table-bordered table-hover">
    <tbody><tr>
      <th style="width: 60px">ID</th>
      <th style="width: 120px">Codigo</th>
      <th>Descripcion</th>
      <th style="width: 100px; text-align: center;">Hectareas</th>
      <th style="width: 120px; text-align: center;">Acciones</th>
    </tr>
    @foreach($planks as $plank)
    <tr>
      <td>{{ $plank->id }}</td>
      <td>{{ $plank->plank_co }}</td>
      <td>{{ $plank->plank_de }}</td>
      <td style="text-align: center;"><span class="label label-success">{{ $plank->plank_area }}</span></td>
      <td style="text-align: center;">  
        @can('plank.edit')
        <a href=""
        title="Editar"
        data-toggle="modal"
        data-target="#modal-form-update"
        data-sector_id="{{ $plank->sector_id }}"
        data-sector_de="{{ $plank->sector_de }}"
        data-lot_id="{{ $plank->lot_id }}"
        data-lot_de="{{ $plank->lot_de }}"
        data-plank_id="{{ $plank->id }}"
        data-plank_co="{{ $plank->plank_co }}"
        data-plank_de="{{ $plank->plank_de }}" 
        data-plank_area="{{ $plank->plank_area }}" 
        data-title="Formulario de Edicion - Editar {{ $plank->plank_de }}"
        >
        <span class="label label-primary"><i class="fa fa-pencil"></i></span>
      </a>

      @endcan

      @can('plank.destroy')
      <a href="javascript:void(0)" id="{{ $plank->id }}"
        class="btn-delete"
        title="Eliminar">
        <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

        <form method="POST"
        id="form-destroy-{{ $plank->id }}"
        action="{{ route('plank.destroy', $plank) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
      </form>
      @endcan

    </td>
  </tr>
  @endforeach

</tbody></table>
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
  @can('plank.create')
  <button 
  type="button" 
  class="btn btn-primary no-margin pull-right" 
  data-toggle="modal" 
  data-target="#modal-form-store">
  <i class="fa fa-plus"></i>Agregar Nuevo
</button>
@endcan    
</div>



</div>
<!-- /.box-body -->
</div>


<div class="col-md-4">
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
        @can('plank.create') 
        <a class="btn btn-primary no-margin pull-right" title="Agregar un nuevo Lote" href="{{ route('plank.create') }}">
          <i class="fa fa-plus"></i> Tablon
        </a>
        @endcan
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


<script type="text/javascript">

  $(function(){
    $('#modal-form-update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var lot_id = button.data('lot_id') // Extract info from data-* attributes
        var lot_de = button.data('lot_de')
        var sector_id = button.data('sector_id')
        var sector_de = button.data('sector_de')
        var plank_id = button.data('plank_id')
        var plank_co = button.data('plank_co')
        var plank_de = button.data('plank_de')
        var plank_area = button.data('plank_area')
        var title = button.data('title')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-body #lot_id').val(lot_id)
        modal.find('.modal-body #plank_id').val(plank_id)
        modal.find('.modal-body #plank_co').val(plank_co)
        modal.find('.modal-body #plank_de').val(plank_de)
        modal.find('.modal-body #plank_area').val(plank_area)
      })

  });
  
</script>


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
