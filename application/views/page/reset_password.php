<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset Password Akun E-Sufa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css') ?>">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Aplikasi</b>E-Sufas</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php echo $this->session->flashdata('sukses'); ?>
    <p class="login-box-msg">Reset Password Anda</p>

    <form action="<?php echo base_url('reset_password') ?>" name="form_reset_password" class="form_reset_password" id="form_reset_password" method="post">
      <input type="hidden" name="username" class="username" id="username" value="<?= $user_info ?>">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="New Password" name="newPassword">
        <span class="glyphicon glyphicon-key form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="confirmPassword" name="confirmPassword">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- sweetalert -->
<script src="<?php echo base_url('assets/bower_components/sweetalert/sweetalert.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
<script>
  $(function () {
  //reset password     
  $("#submit").click(function(e){
    e.preventDefault();
    $.ajax({
      url : "<?php echo base_url('reset_password/update_pass') ?>", 
      type: "POST", 
      dataType: "json", 
      data: $("#form_reset_password").serialize(),
       success: function(data) {
        if(data.notif===1){
            swal("Sukses!", 'Password Berhasil di Reset klik Ok untuk Login', {
              icon : "success",
              buttons: {              
                confirm: {
                  className : 'btn btn-success'
                }
              },
            }).then(function() {
                window.location.href = "<?php echo base_url() ?>";
            });
        }else{
          swal("Gagal!", 'Kesalahan tidak diketahui silahkan coba lagi', {
              icon : "error",
              buttons: {              
                confirm: {
                  className : 'btn btn-danger'
                }
              },
            });
        }
      },
     error: function(jqXHR, textStatus, errorThrown) {
         console.log(jqXHR.responseText)
      console.log(textStatus, errorThrown);
    }
    });

    return false;
     
   });
  //**end**

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
