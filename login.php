<?php 
  require 'application/system.php';
  if ($logged) {
    header("location:index.php");
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Log in</title>
  <?php include 'theme/src_head.php'; ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?=$setting['nama_bisnis'];?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="login_user">
        <div class="input-group mb-3">
          <input type="hidden" name="user_login" value="1">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" checked id="remember">
              <label for="remember">
                Ingatkan Saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="btnLogin" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include 'theme/src_foot.php'; ?>
<script type="text/javascript">
  $('#login_user').submit(function(e){
    e.preventDefault();
    $('#btnLogin').attr("disabled", true);
    $.ajax({
      type : 'POST',
      url : 'application/event.php',
      data : $('#login_user').serialize(),
      dataType : "json",
      success : function(data){
        if (data.success) {
          toastr["success"](data.message);
              setTimeout(function(){
                window.location.replace('index.php');
              }, 2500);
        }else{
          toastr["error"](data.message);
          setTimeout(function(){
            $('#btnLogin').attr("disabled", false);                
              }, 2500);
          
           
        }
      }

    })
  })
</script>
</body>
</html>
