<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MailVadodara - Task Manager</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 
  <link rel="shortcut icon" href="{{asset('adm')}}/img/task-favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="{{url('adm')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{url('adm')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{url('adm')}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">

@if(Session::get('fail'))
        <div class="alert alert-danger">
            {{Session::get('fail')}}
        </div>
    @endif



  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b class="text-danger">કામગીરી</b>પત્રક</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">કામકાજની વિગત જોવા, અહીંથી લોગીન કરો.</p>


      <form action="{{route('auth.check')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" 
            name="email" value="{{old('email')}}" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <span class="text-danger">@error('email') {{$message}} @enderror</span>


        <div class="input-group mb-3">
          <input type="password" class="form-control" 
            name="password"  placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <span class="text-danger">@error('password') {{$message}} @enderror</span>

        <div class="row">
          <div class="col-4 ">
            <button type="submit" class="btn btn-primary btn-block pull-right">Sign In</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="{{url('adm')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{url('adm')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('adm')}}/dist/js/adminlte.min.js"></script>
</body>
</html>
