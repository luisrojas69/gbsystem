<table class="table table-bordered">
  <tbody><tr>
    <th>#</th>
    <th>Nombre</th>
    <th>Cod</th>
    <th>Especie</th>
    <th>Raza</th>
    <th>Genero</th>
    <th>Color</th>
    <th>Condicion</th>
    <th>Potrero</th>
    <th>Lote</th>
    <th>Rodeo</th>
    <th>Peso al Ingresar</th>
    <th>Kgs Ultimo Pesaje</th>
    <th>Total Ganancia de Peso</th>
    <th>Fecha de Ultimo Pesaje</th>
    <th>Dias Ultimo Pesaje</th>
    <th>Ganancia de Peso Diaria</th>
    <th>Fecha Ingreso</th>
    <th>Observaciones</th>

</tr>
@foreach($animals as $animal)
<tr>
    <td>{{ $animal->id }}</td>
    <td>{{ $animal->animal_na }}</td>
    <td>{{ $animal->animal_cod }}</td>
    <td>{{ $animal->breed->specie->specie_na }}</td>
    <td>{{ $animal->breed->breed_na }}</td>
    <td>{{ $animal->gender }}</td>
    <td>{{ $animal->animal_col }}</td>
    <td>{{ $animal->condition }}</td>
    <td>{{ $animal->paddock->paddock_na }}</td>
    <td>{{ $animal->lotAnimal->lot_co }}</td>
    <td>{{ $animal->rodeo->rodeo_na }}</td>
    <td>{{ $animal->weight_in }} Kgs</td> 


@if($animal->numWeighings>0) 

@php
//convertimos la fecha 1 a objeto Carbon
$carbon1 = new \Carbon\Carbon($animal->weighings->last()->date_read);
//convertimos la fecha 2 a objeto Carbon
$carbon2 = new \Carbon\Carbon(date("Y-m-d"));
//de esta manera sacamos la diferencia en minutos
$daysDiff=$carbon1->diffInDays($carbon2);

if($daysDiff == 0)
{
    $dias = 1;
}else{
    $dias = $daysDiff;
}

@endphp
    

    <td style="text-align: center;">  
      {{ $animal->weighings->last()->weight }} Kgs
  </td>

  <td style="text-align: center;">  
    {{ $animal->weighings->last()->weight - $animal->weight_in }} Kgs
</td>

<td>{{ $animal->weighings->last()->date_read}}</td> 

<td>
Hace {{ $daysDiff }} dia(s)
</td>

<td style="text-align: center;">  
    {{ ($animal->weighings->last()->weight - $animal->weight_in)  / $dias }}
</td> 

@else


@php
//convertimos la fecha 1 a objeto Carbon
$carbon1 = new \Carbon\Carbon($animal->date_in);
//convertimos la fecha 2 a objeto Carbon
$carbon2 = new \Carbon\Carbon(date("Y-m-d"));
//de esta manera sacamos la diferencia en minutos
$daysDiff=$carbon1->diffInDays($carbon2);

if($daysDiff == 0)
{
    $dias = 1;
}else{
    $dias = $daysDiff;
}
@endphp

<td style="text-align: center;">
  {{ $animal->weight_in }} Kgs
</td>

<td>Sin Pesajes Recientes</td>

<td>{{ $animal->date_in }}</td>

<td>
Hace {{ $daysDiff }} dia(s)
</td>

<td style="text-align: center;">  
    {{ $animal->weight_in  / $dias }}
</td> 

@endif  

<td>{{ $animal->date_in }}</td>  
<td>{{ $animal->comment }}</td>

</tr>
@endforeach

</tbody></table>