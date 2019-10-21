// JavaScript Document
// Desarrollado a mano por Luis Rojas

//JQuery por Luis Rojas
	$(document).ready(function(){
	
		
///////////////////////////////////////////////////////////
		
        }	
			
	);

//////////////////////////////////////////////////////////////////////////////////////////////////////

  //*******************************************AL CAMBIAR LABOR *********************************************** 

      $("#activity_id").on('change',function()
  {
    
    var id_labor=$(this).val();
    var plank_id=$("#plank_id").val();
    var url = "/gbsystem/public/plank/"+plank_id;  
    if(id_labor)
    { 
      var url = "/gbsystem/public/plank/"+plank_id;
      $.ajax({
      dataType: 'json', 
      url: url,
      method: "GET",
        
        beforeSend: function()
        {
          $("#crop_id").attr("placeholder","Cargando Cultivos...")
          $("#area").attr("placeholder","Cargando Hectareas...")
        },
        success: function(data)
        {
        console.log(data);
        if (id_labor=='1')
        {   
          
          if(data[0].sembrado_actual > 0 && data[0].sembrado_actual < data[0].capacidad_tablon )
            {
               console.log('hay algo pero no esta full');
               $('#crop_id').html('<option value="'+data[0].id_cultivo+'">'+data[0].cultivo+'</option>');
            }
            else if(data[0].sembrado_actual >= data[0].capacidad_tablon )
            {
               console.log('full');
            }           
            else if(data[0].sembrado_actual <= 0 &&  data[0].disponible == data[0].capacidad_tablon)
            {
               console.log('totalmente vacio');
               $('#crop_id').prop('disabled', false)
            }
         
          $("#area").val(data[0].disponible);
          $('#area').attr('max', data[0].disponible);  
        }
        else if (id_labor=='2')
        {
          $("#area").val(data[0].sembrado_actual);
          $('#area').attr('max', data[0].sembrado_actual);
        }    
        
        },
        timeout:9000,
        
         error: function()
         {
     $("#hect").html("<input type='number' class='form-control has-feedback-left' id='hectareas' name='hectareas' placeholder='ERROR' readonly>")
    
        }
        });
      
    }else
    {
      $('#crop_id').html('<option value="">Seleccione un Cultivo</option>');
      $('#activity_id').html('<option value="">Seleccione un Actividad</option>');
      $('#crop_id').prop('disabled', true);
      $('#area').val("");
      $("#area").attr("placeholder","Cantidad de Hectareas")
    }
  });
            
 
      });