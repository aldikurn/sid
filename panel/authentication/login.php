<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Desa | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../dependencies/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../dependencies/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dependencies/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .login-box {
            display: grid;
        }
        .logo-desa {
            justify-self: center;
            width: 170px;
            height: 170px;
            padding: 15px;
            overflow: hidden;
            border-radius: 50%;
            background-color: white;
            display: flex;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .logo-desa img {
            justify-content: center;
            margin: 0 auto;
            height: 100%;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="bg-login" style="position:absolute; background-image:url(../assets/images/background-login.jpg); background-size: cover; filter: blur(8px);"></div>
<div class="login-box">
    <figure class="logo-desa">
        <img src="../assets/images/logo-desa/logo.png">
    </figure>
  <div class="login-logo">
    <a href="#"><b>Sistem Informasi Desa</b> Sugihwaras</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <form action=".." method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
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
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
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
<script src="../../dependencies/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../dependenciesplugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dependenciesdist/js/adminlte.min.js"></script>

</body>
</html>
