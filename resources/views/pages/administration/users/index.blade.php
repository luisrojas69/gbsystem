@extends('layouts.master')

@section('title-page', "Perfil del Usuario:")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="row">

  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{asset ('img/uploads/avatars/thumbnail/'.Auth::user()->avatar) }}" alt="User Picture Default">

        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

        <ul class="nav nav-stacked">

          <li><a href="#">Email <span class="pull-right badge bg-purple">{{ Auth::user()->email}}</span></a></li>

        </ul>

        
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab">Edicion de Perfil</a></li>

      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="activity">
          <!-- Post -->
          <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="{{asset ('img/uploads/avatars/thumbnail/'.Auth::user()->avatar) }}" alt="user image">
              <span class="username">
                <a href="#">{{ Auth::user()->name }}</a>

              </span>
              <span class="description">Registrado en el Sistema el dia {{ Auth::user()->created_at->format('d-m-Y') }}</span>
            </div>
            <!-- /.user-block -->
            <!-- /.box-header -->



            <div class="box-body" >
              <form method="POST" action="{{ route('update.profile') }}"  class="form-horizontal" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Introduzca Nombre" value="{{ Auth::user()->name }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="{{ Auth::user()->email }}" 
                    value="{{ Auth::user()->email }}" readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Introduzca Nuevo Password">
                  </div>
                </div>


                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" placeholder="Confirme Password">
                  </div>
                </div>

                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Imagen</label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="avatar" name="avatar">
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Actualizar Perfil</button>
                  </div>
                </div>
              </form>


            </div>


          </div>
          <!-- /.post -->

          
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

@endsection

@section('additionals-scripts')

@endsection