        
        @foreach($crops as $item)  
       	@if(count($item->varieties))   
        crops.push( { "id": "{{$item->id}}",
                       "html": "<option value='{{$item->id}}'>{{ $item->crop_de }}</option>" 
                     });
         @endif             
        @endforeach

       