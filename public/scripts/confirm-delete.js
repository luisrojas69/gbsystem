//JQuery por Luis Rojas
        $(document).ready(function(){
            //alert('funcionando');
              $('.btn-delete').on('click', function(){
                
                var id=(this.id);
                //alert(id);
                $.confirm({
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
                            title: 'Est&aacute; Seguro.?',
                            content: 'Se dispone a Eliminar un Registro de la Base de Datos. <br> Accion irreversible',
                            icon: 'fa fa-question-circle',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'Aceptar',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                  
                                        $.confirm({
                                            title: 'Esto puede ser Critico',
                                            content: 'El Registro será Eliminado despues de confirmar.',
                                            icon: 'fa fa-warning',
                                            animation: 'scale',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                confirm: {
                                                    text: 'Si, seguro!',
                                                    btnClass: 'btn-orange',
                                                    action: function () {
                                                        $("#form-destroy-"+id).submit();
                                                        }
                                                },
                                                cancel: function () {
                                                    }
                                            }
                                        });
                                    
                                    }
                                },
                                cancel: function () {
                                //$.alert('you clicked on <strong>cancel</strong>');
                                },
                            }
                        });
           
              });


    //Aviso para usuarios sin permisos administrativos

        $('.normal_user').on('click', function(){
                
                var id=(this.id);
              //alert(id);
                $.confirm({
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'orange',
                            title: 'Accion no Permitida',
                            content: 'Usted NO es administrador del Sistema',
                            icon: 'fa fa-warning',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'Aceptar',
                                    btnClass: 'btn-orange',
                                    action: function () {

                                    }
                                },
                               
                            }
                        });
           
              });


            //Aviso para usuarios sin permisos administrativos

        $('.pozoParado').on('click', function(){
                
                var id=(this.id);
              //alert(id);
                $.confirm({
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'orange',
                            title: 'Accion no Permitida',
                            content: 'No puede agregar Lecturas de Horometros a Pozos Parados. <br/><br/> Por Favor cambie el estatus del Pozo antes de Proceder a Ingresar la Lectura',
                            icon: 'fa fa-warning',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'Aceptar',
                                    btnClass: 'btn-orange',
                                    action: function () {

                                    }
                                },
                               
                            }
                        });
           
              });





        });