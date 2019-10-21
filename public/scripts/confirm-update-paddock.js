         //JQuery por Luis Rojas
        $(document).ready(function(){
            //alert('funcionando');
              $('.btn-update-paddock').on('click', function(){
                
                var id=(this.id);
                //alert(id);
                $.confirm({
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
                            title: 'Est&aacute; Seguro.?',
                            content: 'Se dispone a Realizar un Movimiento de Potrero.',
                            icon: 'fa fa-question-circle',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'Aceptar',
                                    btnClass: 'btn-blue',
                                    action: function () {                                  
                                        $("#form-update-paddock-"+id).submit();
                                    }
                                },
                                cancel: function () {
                                //$.alert('you clicked on <strong>cancel</strong>');
                                },
                            }
                        });
           
              });





        });

          