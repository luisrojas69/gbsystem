
@extends('layouts.master-login')

@section('title-page', "Login - Granja Boraure")

@section('message')
@include('layouts._my_message')
@include('layouts._my_error')
@endsection

@section('content')

<div class="login-box-body">
    <p class="login-box-msg">Resetear Contraseña</p>
    @include('layouts._my_error')
        
        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

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
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    
            </form>

    <!-- /.social-auth-links -->

</div>

@endsection

