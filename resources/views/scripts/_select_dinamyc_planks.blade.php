        @foreach($planks as $item)     
        planks.push( { "id": "{{$item->id}}",
                       "lot_id": "{{$item->lot_id }}",
                       "html": "<option value='{{$item->id}}'>{{ $item->plank_de }}</option>" 
                     });
        @endforeach