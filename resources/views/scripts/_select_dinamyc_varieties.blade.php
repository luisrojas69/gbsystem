     @foreach($varieties as $item)     
        varieties.push( { "id": "{{$item->id}}",
                       "crop_id": "{{$item->crop_id }}",
                       "html": "<option value='{{$item->id}}'>{{ $item->variety_de }}</option>" 
                     });
        @endforeach