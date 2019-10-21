
@extends('layouts.master-login')

@section('title-page', "Register - Granja Boraure")

@section('content')

<div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesion</p>

   <form role="form" method="POST" action="{{ route('register') }}" >
      {{ csrf_field() }}
       <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nombre" name="name" type="name" autofocus required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" type="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" type="password" value="" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
    <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password_confirmation" type="password" value="" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

    <a href="{{ route('login') }}">Ya estoy Registrado</a><br>

</div>

@endsection

