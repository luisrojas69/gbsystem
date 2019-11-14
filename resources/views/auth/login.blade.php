@extends('layouts.master-login')

@section('title-page', "Login - Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesion</p>
    @include('layouts._my_error')
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" type="email" autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" type="password" value="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

    <a href="{{ route('password.request') }}">Olvid&eacute; mi Contrase&ntilde;a</a><br>
    <a class="pull-right" href="{{ route('register') }}">Registrarse</a><br>

</div>

@endsection

