
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GBSystem 3.0 | @yield('title-page')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset ('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ('css/font-awesome.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset ('css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('css/AdminLTE.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset ('css/_all-skins.min.css') }}">
  <!-- Estilos CSS Customizados -->
  <link rel="stylesheet" href="{{ asset ('css/customs.css') }}">  

  <!-- jQuery 3 -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  
  @yield('additionals-css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- Google Font -->
  <link rel="stylesheet" href="{{ asset('css/googlefonts.css') }}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('home') }}"><b>Granja Boraure</b></a>
  </div>
  <!-- /.login-logo -->
  @yield('content')
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Additional JS -->
@yield('additionals-js')
<!-- Additional Scripts -->
@yield('additionals-scripts')


</body>
</html>
