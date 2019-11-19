@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Usuarios Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection


@section('content')

    <!--Modal-->
        <div class="modal fade" tabindex="-1" id="modal-form">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalles del Usuario</h4>
              </div>

              <div class="modal-body">
               <div id="info_modal">
            <!-- Loading (remove the following to stop the loading)-->
                <div class="overlay text-center" id=loading>
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
            <!-- end loading -->


          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">

            <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
              <!-- chat item -->
              <div class="item">
              <img id="user-avatar" src="{{ asset('img/user.jpg') }}" alt="user image" class="online">

                <p class="message">
                  <a href="javascript:void(0)" class="name" id="user-name"></a>
                  <cite id="user-email" title="Source Title"></cite>
                </p>
                <div class="attachment">
                  <h4 id="information"></h4>

                  <p class="filename">
                    <div id="list-roles"></div>
                  </p>

                </div>
                <!-- /.attachment -->
              </div>
              <!-- /.item -->
             
            </div>
          </div>
            <!-- /.chat -->
          
      
               </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <a class="btn btn-primary no-margin pull-right"
                                title="Crear un nueva animal"
                                href="{{ route('role.create') }}">
                                <i class="fa fa-plus"></i> Insertar Nuevo Rol
                     </a>
              </div>

            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- Fin Modal -->

<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Administraci&oacute;n de @yield('title-page')</h3>
            
             <form action="{{ route('user.index') }}" method="GET" class="form-inline navbar-form my-2 my-lg-0 pull-right" role="search">
                <div class="input-group input-group-sm">
                <input type="text" name="name" class="form-control" placeholder="Nombre del Usuario">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                    </span>
              </div>
              </form> 

          <a title="Exportar a Excel"
                                href="{{ route('users.excel') }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px; ">
            <i class="fa fa-download"></i> Generar EXCEL
          </a>


            </div>
            <!-- /.box-header -->
            <div class="box-body">

          @foreach($users as $user)    
            <div class="col-md-3">
              <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/'.$user->avatar) }}" alt="Avatar del Usuario {{ $user->name }}">

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center text-blue"> {{ $user->email }} </p>


                    <div class="text-center">

                      @can('user.show') 
                        <a href="javascript:void(0)" id="{{ $user->id }}" class="button_show">
                          <span class="label label-success"><i class="fa fa-search"></i></span>
                        </a>
                      @endcan  
                      @can('user.edit')   
                        <a href="javascript:void(0)"
                              title="Editar" 
                              onclick="event.preventDefault(); 
                              document.getElementById('form-edit-{{ $user->id }}').submit()">
                               <span class="label label-primary"><i class="fa fa-pencil"></i></span>
                          </a>                    

                          <form method="GET" 
                              action="{{ route('user.edit', $user) }}"
                              id="form-edit-{{ $user->id }}"
                              style="display: none;">
                              {{ csrf_field() }}
                          </form>
                      @endcan  
                      @can('user.destroy')     
                          <a href="javascript:void(0)" id="{{ $user->id }}"
                            class="btn-delete"
                            title="Eliminar">
                          <span class="label label-danger"><i class="fa fa-trash"></i></span></a>

                           <form method="POST"
                              id="form-destroy-{{ $user->id }}" 
                              action="{{ route('user.destroy', $user) }}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                          </form>
                      @endcan    
                    </div>
                    
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
           @endforeach   
                
          </div>
            <!-- /.box-body -->

</div>


@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>
<script type="text/javascript">

  $(function(){

    
      //Funcion de Probar el Segundo Formulario
      $( ".button_show").on('click', function(){
 
     var id=$(this).attr('id');
      var url = "/administration/user/"+id;
        $(document).ready(function(){
         $.ajax({
          dataType: 'json',
          url: url,
          method: "GET",
            beforeSend: function() {
              $("#loading").show();              
             },
            success: function(datos)
            {
             $("#loading").hide();
             $("#user-name").html(datos[0].name);
             $("#user-email").html(datos[0].email);
             $("#user-avatar").html(datos[0].avatar);

             console.log(datos[1]);
              if(datos[1].length > 0){ 
                $("#information").text("Roles Asignados a este Usuario:");
                $("#list-roles").append("<ul id='roles'></ul>");
                $.each(datos[1], function (i, item) {
                $("#roles").append("<li>"+datos[1][i].name+" | <em>"+datos[1][i].description+"</em></li>");
                //console.log(datos[1][i].name);
              });
              }else{
                $("#information").text("No tiene Roles Asignados");
                $("#roles" ).remove();
              }
             $('#modal-form').modal('show');
            },
           timeout:9000,
             error: function()
             {
              $("#info_modal").text("Error Sincronizando");
             console.log("Error Sincronizando");
             }

          });
      });    
     });
  });

// FIN Script de Formulario de Areas por Sector
</script>

@endsection