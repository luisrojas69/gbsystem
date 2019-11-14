@extends('layouts.master-login')

@section('title-page', "Login - Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="login-box-body">
    <p class="login-box-msg">Recuperar Contraseñaa</p>
    @include('layouts._my_error')
    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
     
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
          <button type="submit" class="btn btn-primary">Enviar Reset Link</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

    <a href="{{ route('login') }}">Ir al Login</a><br>

</div>

@endsection

