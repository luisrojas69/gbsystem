@extends('layouts.master')

@section('title-page', "Bienvenido - Granja Boraure")

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/dataTables.bootstrap.min.css') }}">  
@endsection

@section('content')
 @include('layouts._my_message')
 @include('layouts._my_error')
 
<section class="content">

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ count($sectors) }}</h3>

              <p>Sectores</p>
            </div>
            <div class="icon">
              <i class="fa fa-clone"></i>
            </div>
            <a href="{{ route('sector.index') }}" class="small-box-footer">Ver Lista de Sectores <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ count($lots) }}</h3>

              <p>Lotes</p>
            </div>
            <div class="icon">
              <i class="fa fa-object-ungroup"></i>
            </div>
            <a href="{{ route('lot.index') }}" class="small-box-footer">Ver Lista de Lotes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($planks) }}</h3>

              <p>Tablones</p>
            </div>
            <div class="icon">
              <i class="fa fa-object-group"></i>
            </div>
            <a href="{{ route('plank.index') }}" class="small-box-footer">Ver Lista de Tablones <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 class="fa fa-umbrella"></h3>

              <p>Precipitaciones</p>
            </div>
            <div class="icon">
              <i class="fa fa-umbrella"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalle de Precipitaciones <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>


            <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabla Resumen - Control Hect&aacute;reas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr class="bg-aqua">
                  <th >Producto</th>
                  <th>Anterior</th>
                  <th>Siembra</th>
                  <th>Disponible</th>
                  <th>Cosecha</th>
                  <th>Otros (+/-)</th>
                  <th>Actual</th>
                </tr>
                </thead>
                <tbody>

                @foreach($result as $item) 
                <tr>
                   
                  <td class="bg-green">{{ $item->cultivo}}</td>
                  <td style="text-align: center;">X</td>
                  <td style="text-align: center;">{{ $item->total_sembrado }}</td>
                  <td style="text-align: center;">{{ $item->disponible_para_corte }}</td>
                  <td style="text-align: center;">{{ $item->total_cosechado }}</td>
                  <td style="text-align: center;">{{ $item->total_ajustado }}</td>
                  <td style="text-align: center;">{{ $item->disponible_para_siembra }}</td>
                  
                </tr>
                @endforeach
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
              </div>
</section>
@endsection