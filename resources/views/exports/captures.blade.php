<table class="table table-bordered">
  <tbody>
<tr>
    <th>#</th>
    <th>Fecha de la Actividad</th>
    <th>Codigo Tablon</th>
    <th>Nombre Tablon</th>
    <th>Area</th>
    <th>Actividad</th>
    <th>Cultivo</th>
    <th>Fecha de Creacion</th>
</tr>
@foreach($captures as $capture)
<tr>
    <td>{{ $capture->id }}</td>
    <td>{{ Carbon\Carbon::parse($capture->fecha)->format('d-m-Y') }}</td>
    <td>{{ $capture->plank_co }}</td>
    <td>{{ $capture->plank_de }}</td>
    <td>{{ $capture->area }}</td>
    <td>{{ $capture->activity_na }}</td>
    <td>{{ $capture->crop_na }}</td>
    <td>{{ $capture->created_at }}</td>
</tr>
@endforeach
</tbody></table>