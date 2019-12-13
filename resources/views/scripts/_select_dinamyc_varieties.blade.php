@foreach($varieties as $variety)
varieties.push({ 
"id": "{{$variety->id}}",
"crop_id": "{{$variety->crop_id }}",
"html": "<option value='{{$variety->id}}'>{{ $variety->variety_na }}</option>" 
});

@endforeach