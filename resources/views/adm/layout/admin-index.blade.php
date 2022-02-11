<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
	<title>@yield('title')</title>
 
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('adm')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/summernote/summernote-bs4.min.css">

	<link rel="stylesheet" href="{{url('adm')}}/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="{{url('adm')}}/dist/css/custom.css">
  
<link rel="shortcut icon" href="{{asset('adm')}}/img/task-favicon.png" type="image/x-icon">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;600&family=Rasa:wght@300;400;700&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;600&family=Hind+Vadodara:wght@300&family=Kumar+One+Outline&family=Rasa:wght@300;400;700&display=swap" rel="stylesheet"> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{url('adm')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

    @include('adm.ext.header')
    @include('adm.ext.sidebar')
    
	@yield('content')

    @include('adm.ext.footer')

</div>

@include('adm.ext.script')
@yield('toast')
@yield('custom-js')

</body>
<script src="{{asset('adm')}}/dist/js/demo.js"></script>
<script src="{{asset('adm')}}/dist/js/pages/dashboard2.js"></script>
</html>
