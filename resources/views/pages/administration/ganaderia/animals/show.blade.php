<?php header('Access-Control-Allow-Origin: *'); ?>
@extends('layouts.master')

@section('additionals-css')
<link rel="stylesheet" href="{{ asset ('css/jquery-confirm.css') }}">
@endsection

@section('title-page', "Detalles del Animal  $animal->animal_cod")


@section('content')
    @include('layouts._my_message')
    @include('layouts._my_error')



        <!--Modal-->
        <div class="modal fade" tabindex="-1" id="modal-form">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>

              <div class="modal-body">
               <div id="info_modal">

                <!--movetorodeo start -->
                <div id="form-move-to-rodeo" class="form-move">
                  <ul>
                    @foreach($rodeos as $rodeo)

                            <form method="GET"
                                action="{{ route('update_rodeo', [$animal->id, $rodeo->id]) }}"
                                id="form-update-rodeo-{{ $rodeo->id }}"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>

                      <!--li id="movetorodeo"><a href="{{ route('update_rodeo', [$animal->id, $rodeo->id]) }}">{{ $rodeo->rodeo_na }}</a></li-->
                      <li class="btn-update-rodeo" id="{{ $rodeo->id }}"><a href="javascript:void(0)">{{ $rodeo->rodeo_na }}</a></li>
                    @endforeach
                   </ul>
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                </div>  
                </div>    
                <!-- movetorodeo end -->

                <!--movetopadock start -->
                <div id="form-move-to-paddock" class="form-move">
                  <ul>
                    @foreach($paddocks as $paddock)

                            <form method="GET"
                                action="{{ route('update_paddock', [$animal->id, $paddock->id]) }}"
                                id="form-update-paddock-{{ $paddock->id }}"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>

                      <!--li id="movetorodeo"><a href="{{ route('update_rodeo', [$animal->id, $rodeo->id]) }}">{{ $rodeo->rodeo_na }}</a></li-->
                      <li class="btn-update-paddock" id="{{ $paddock->id }}"><a href="javascript:void(0)">{{ $paddock->paddock_na }}</a></li>
                    @endforeach
                   </ul>
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                </div>  
                </div>    
                <!-- movetopadock end -->


                 <!--add-weighing start -->
                <div id="form-add-weigth" class="form-add-weigth">
                            
                            <!-- form start -->
                          @if($animal->rodeo_id == '1')
                            <form class="form-horizontal"
                                    role="form"
                                    method="POST"
                                    action="{{ route('weighing.store') }}">
                                {{ csrf_field() }}
                              <div class="box-body">

                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Fecha: </label>

                                  <div class="col-sm-6">
                                    <input type="date" min="{{ $animal->date_in }}" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control" name="date_read" id="date_read" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Peso: </label>

                                  <div class="col-sm-10">
                                    <input type="number" step="0.1" class="form-control" name="weight" id="weight" placeholder="Introduzca el Peso en Kg" required>
                                  </div>
                                </div>
                              </div>
                              <!-- /.box-body -->
                                  <input type="hidden" name="animal_id" id="animal_id" value="{{ $animal->id }}">
                              <div class="box-footer">
                                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-info pull-right">Guardar</button>
                              </div>
                              <!-- /.box-footer -->
                            </form>
                          @else
                           <div class="box-body">
                             <div class="form-group">
                              <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Ooops.!</h4>
                                  No puede agregar pesajes a Animales pertenecientes al Rodeo de Animales: <strong>{{ $animal->rodeo->rodeo_na }}</strong>.<hr>
                                  Puede Mover este Animal al Rodeo "Animales para Engorde" haciendo click <a href="{{ route('movetorodeo', $animal->id) }}">AQUI</a>
                              </div>
                             </div> 
                           </div>
                          @endif
                          
             
                </div>    
                <!-- add weighing end -->
               </div>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- Fin Modal -->











  <div class="row">
    
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset ('img/default_image.jpg') }}" alt="Animal Picture Default">

              <h3 class="profile-username text-center">{{ $animal->animal_na }}</h3>

              <p class="text-muted text-center">Datos Generales de {{ $animal->animal_na }}</p>

              <ul class="nav nav-stacked">

                <li><a href="#">C&oacute;digo <span class="pull-right badge bg-purple">{{ $animal->animal_cod }}</span></a></li>
                <li><a href="#">Peso al Ingresar<span class="pull-right badge bg-aqua">{{ $animal->weight_in }} Kgs</span></a></li>
                <li><a href="#">Rodeo Actual<span class="pull-right badge bg-orange">{{ $animal->rodeo->rodeo_na }}</span></a></li>
                <li><a href="#">Potrero Actual<span class="pull-right badge bg-navy">{{ $animal->paddock->paddock_na }}</span></a></li>
                <li><a href="#">Especie<span class="pull-right badge bg-teal">{{ $animal->breed->specie->specie_na }}</span></a></li>
                <li><a href="#">Raza<span class="pull-right badge bg-maroon">{{ $animal->breed->breed_na }}</span></a></li>
                <li><a href="#">Condici&oacute;n<span class="pull-right badge bg-purple">{{ $animal->condition }}</span></a></li>
                <li><a href="#">Fecha de Ingreso <span class="pull-right badge bg-red">{{ $animal->date_in }}</span></a></li>
                

                </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Menu Animal</a></li>
              <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('img/bull.png') }}" alt="user image">
                        <span class="username">
                          <a href="#">{{ $animal->animal_na }}</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Registrado en el Sistema el dia {{  $animal->created_at->format('d-m-Y') }}</span>
                  </div>
                  <!-- /.user-block -->
                  <!-- /.box-header -->
            <div class="box-body" >


              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
 
                    
                
              </div>
              <!-- /.tab-pane -->

              <form method="POST"
                        id="form-destroy-{{ $animal->id }}"
                        action="{{ route('animal.destroy', $animal) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
              </form>


              <div class="text-muted well well-sm no-shadow">
              @if($animal->rodeo_id == '1') 

                        <a href="javascript:void(0)" id="movetorodeo"><img src="{{ asset('img/movetorodeo.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="addweighing" class="addweighing"><img src="{{ asset('img/addweighing.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="addheat"><img src="{{ asset('img/addheat.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="addsanity"><img src="{{ asset('img/addsanity.png') }}" alt="..." class="margin"></a>
                        
                        <a href="javascript:void(0)" class="movetopaddock" id="movetopaddock"><img src="{{ asset('img/movetopaddock.png') }}" alt="..." class="margin"></a>
                        
                        <a href="{{ route('animal.edit', $animal) }}"><img src="{{ asset('img/editanimal.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="{{ $animal->id }}" class="btn-delete"><img src="{{ asset('img/deleteanimal.png') }}" alt="..." class="margin"></a>

                        <a href="{{ route('animal.index') }}"><img src="{{ asset('img/listofanimals.png') }}" alt="..." class="margin"></a>
                                          

              @else

                    <a href="javascript:void(0)" id="movetorodeo"><img src="{{ asset('img/movetorodeo.png') }}" alt="..." class="margin"></a>

                    
                      <a href="{{ route('animal.edit', $animal) }}"><img src="{{ asset('img/editanimal.png') }}" alt="..." class="margin"></a>

                        <a href="javascript:void(0)" id="{{ $animal->id }}" class="btn-delete"><img src="{{ asset('img/deleteanimal.png') }}" alt="..." class="margin"></a>

                        <a href="{{ route('animal.index') }}"><img src="{{ asset('img/listofanimals.png') }}" alt="..." class="margin"></a>

                    <ul class="list-inline">      
                      <li class="pull-right">
                        <a href="#" class="link-black text-sm text-red"><i class="fa fa-info-circle"></i>Menú limitado por el Rodeo al que pertenece el Animal</a></li>
                  </ul>

              @endif
                   <ul class="list-inline">
                      <li><a href="{{ route('animal.create') }}" class="link-black text-sm"><i class="fa fa-plus-circle"></i> Nuevo Animal</a></li>
                      <li><a href="{{ route('weighing.index') }}" class="link-black text-sm"><i class="fa fa-bars"></i> Ir a Tabla de Pesajes</a></li>
                   </ul> 
              </div>


            </div>

        
                </div>
                <!-- /.post -->

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->  

@endsection


@section('additionals-js')
<script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
@endsection

@section('additionals-scripts')
<script type="text/javascript" src="{{ asset('scripts/confirm-delete.js') }}"></script>

<script type="text/javascript" src="{{ asset('scripts/confirm-update-rodeo.js') }}"></script>

<script type="text/javascript" src="{{ asset('scripts/confirm-update-paddock.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>


<script type="text/javascript">

  $(function(){
      //Funcion Ejecuta Modal para Mover de Rodeo
      $( "#movetorodeo").on('click', function(){
         $('.modal-title').text('Mover de Rodeo');
          $('#form-add-weigth').hide();
          $('#form-move-to-paddock').hide();
          $('#form-move-to-rodeo').show();
          $('#modal-form').modal('show');
     });

      //Funcion Ejecuta Modal Agregar Pesaje al Animal Actual
      $( "#addweighing").on('click', function(){
         $('.modal-title').text('Agregar Pesaje a Este Animal');
          $('#form-move-to-rodeo').hide();
          $('#form-move-to-paddock').hide();
          $('#form-add-weigth').show();
          $('#modal-form').modal('show');
     });

      //Funcion Ejecuta Modal Mover de Potrero al Animal Actual
      $( "#movetopaddock").on('click', function(){
         $('.modal-title').text('Mover de Potrero Este Animal');
          $('#form-move-to-rodeo').hide();
          $('#form-add-weigth').hide();
          $('#form-move-to-paddock').show();
          $('#modal-form').modal('show');
     });

       $( "#addsanity").on('click', function(){
          alert("En Construccion");
     });

       $( "#addheat").on('click', function(){
          alert("En Construccion");
     });



  });

</script>

@endsection