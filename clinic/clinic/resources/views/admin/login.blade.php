<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ url('/') }}/admintheme/index2.html"><b>Admin</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">


      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to Dashboard</p>

        <form method="POST" action="{{ url('auth/login') }}" enctype="multipart/form-data">
         {!! csrf_field() !!}
      
       @if(Session::has('errors'))
            <div style="background: #11304e; border: none;" class="alert alert-success" role="alert">
              <h4 class="alert-heading">Login validation!</h4>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </div>
            @endif 

         @if(Session::has('error'))
         <div class="alert alert-danger">
          {{Session::get('error')}}
        </div>
        @endif
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/') }}/admintheme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/admintheme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/admintheme/dist/js/adminlte.min.js"></script>
</body>
</html>
