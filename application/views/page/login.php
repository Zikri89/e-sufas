<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi E-Sufa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<?php $attributes = array('id' => 'form_user','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
<div class="modal modal-info fade" id="modal-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pendaftaran Faskes</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="control-group">
          <label for="username">Username <span style="color:red">*</span></label>
          <input type="username" maxlength="50" class="form-control username" id="username" name="username" placeholder="Enter Username" required>
          <div class="help-block with-errors"></div><div class="emsg"></div>
        </div>
        <div class="control-group">
          <label for="email">Email <span style="color:red">*</span></label>
          <input type="email" class="form-control email" id="email" name="email" placeholder="Enter Email" required>
          <div class="help-block with-errors"></div><div class="emsgemail"></div>
        </div>
        <div class="control-group">
          <label for="password">Password <span style="color:red">*</span></label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="control-group">
          <label for="jns_faskes">Jenis Faskes <span style="color:red">*</span></label>
          <select class="form-control jns_faskes" id="jns_faskes" name="jns_faskes" style="width: 100%;" required>
             <option></option> 
            <?php foreach ($jenis_faskes as $jenis_faskes) {
            ?>
            <option value="<?= $jenis_faskes->name ?>"><?= $jenis_faskes->name ?></option>
            <?php
            }
            ?> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="faskes">Nama Faskes <span style="color:red">*</span></label>
          <select class="form-control faskes" id="faskes" name="faskes" style="width: 100%;" required>  
          </select>
        </div>
        <div class="control-group">
          <label for="alamat">Alamat <span style="color:red">*</span></label>
          <textarea class="form-control alamat" id="alamat" name="alamat" rows="3" placeholder="Contoh :  Jl. Kesehatan No.10, RT.3/RW.6, Petojo" required></textarea>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="kabupaten">Kabupaten / Kota <span style="color:red">*</span></label>
          <select class="form-control kabupaten" id="kabupaten" name="kabupaten" style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="kecamatan">Kecamatan <span style="color:red">*</span></label>
          <select class="form-control kecamatan" id="kecamatan" name="kecamatan"  style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="kelurahan">Kelurahan <span style="color:red">*</span></label>
          <select class="form-control kelurahan" id="kelurahan" name="kelurahan" style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="submit" class="btn btn-outline">DAFTARKAN</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Aplikasi</b>E-Sufas</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php 
    list($width, $height, $type, $attr) = getimagesize('assets/dist/img/loading.gif');
    ?>
    <div id="loading" style="text-align: center;display: none;"><img src="<?= base_url('assets/dist/img/loading.gif') ?>" width="<?= $width/6 ?>" height="<?= $height/6 ?>"></div>
    <?php echo $this->session->flashdata('sukses'); ?>
    <p class="login-box-msg">Sign in untuk memulai aktifitas</p>

    <form action="<?php echo base_url('login') ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" class="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          <button type="button" class="btn btn-success btn-block btn-flat" data-toggle="modal" data-target="#modal-user">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <p style="text-align: right;margin-top: 10px;"><a href="#" class="lupa_pass">Lupa password ?</a></p><br>
    <form action="" method="post" name="send_pass" class="send_pass" id="send_pass" style="display: none;">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Masukan Email" name="send_email" id="send_email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="button" class="btn btn-warning btn-block btn-flat" id="reset_pass" >Reset Password</button>
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
<!-- Select2 -->
<script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- sweetalert -->
<script src="<?php echo base_url('assets/bower_components/sweetalert/sweetalert.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
<script>
  $(function () {
    var $regexname=/^([a-zA-Z]{3,16})$/;
    $('.username').on('keypress keydown keyup',function(){
         if (!$(this).val().match($regexname)) {
             $('.emsg').removeClass('hidden');
             $('.emsg').show().html('<p style="color:red;">Tidak boleh menggunakan spasi</p>');
         }
       else{
            $('.emsg').addClass('hidden');
           }
     });

    var $regemail=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    $('.email').on('keypress keydown keyup',function(){
      if (!$(this).val().match($regemail)) {
        $('.emsgemail').removeClass('hidden');
        $('.emsgemail').show().html('<p style="color:red;">Alamat email tidak valid</p>');
      }
    else{
        $('.emsgemail').addClass('hidden');
      }
    });

    $('.lupa_pass').click(function(){
      $('#send_pass').slideDown();
    });
    $('#reset_pass').click(function(){
      var email = $('#send_email').val();
      if(email==""){
        swal("Gagal!", 'Email tidak boleh kosong', {
                icon : "error",
                buttons: {              
                  confirm: {
                    className : 'btn btn-danger'
                  }
                },
              });
      }else{
        $('#loading').fadeIn();
        $.ajax({
          url : "<?php echo base_url('login/reset_password') ?>", 
          type: "POST", 
          dataType: "json", 
          data: {email:email},
           success: function(data) {
            if(data.notif==1){
              $('#loading').fadeOut();
              swal("Sukses!", 'Silahkan cek email anda untuk mengganti password', {
                  icon : "success",
                  buttons: {              
                    confirm: {
                      className : 'btn btn-success'
                    }
                  },
                });
            }else{
              $('#loading').fadeOut();
              swal("Gagal!", 'Email tidak terdaftar mohon cek kembali email anda', {
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
      }
    });
  //Initialize Select2 Elements
  $('.jns_faskes').select2({
    placeholder: 'Ketikan jenis faskes wilayah DKI Jakarta',
    allowClear: true,
  });

  $('.faskes').select2({
    placeholder: 'Ketikan nama faskes wilayah DKI Jakarta',
    minimumInputLength: 1,
    allowClear: true,
    ajax: {
      url: '<?php echo base_url('login/faskes') ?>',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          faskes: params.term
        };
      },
      processResults: function(data) {
        var results = [];
        $.each(data, function(index, item){
          results.push({
              id: item.id,
              text: item.name
          });
        });
        return {
          results: results
        };
      },
    cache : true
    }
  });

  $('.level').select2({
    placeholder: 'Tentukan level akses',
    allowClear: true,
  });

  $('.kabupaten').select2({
    placeholder: 'Ketikan nama kabupaten wilayah DKI Jakarta',
    minimumInputLength: 1,
    allowClear: true,
    ajax: {
      url: '<?php echo base_url('login/kabupaten') ?>',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          kabupaten: params.term
        };
      },
      processResults: function(data) {
        var results = [];

        $.each(data, function(index, item){
          results.push({
              id: item.name,
              text: item.name
          });
        });
        return {
          results: results
        };
      },
    cache : true
    }
  });

  $('.kecamatan').select2({
    placeholder: 'Ketikan nama kecamatan wilayah DKI Jakarta',
    minimumInputLength: 1,
    allowClear: true,
    ajax: {
      url: '<?php echo base_url('login/kecamatan') ?>',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          kecamatan: params.term
        };
      },
      processResults: function(data) {
        var results = [];

        $.each(data, function(index, item){
          results.push({
              id: item.name,
              text: item.name
          });
        });
        return {
          results: results
        };
      },
    cache : true
    }
  });

  $('.kelurahan').select2({
    placeholder: 'Ketikan nama kelurahan wilayah DKI Jakarta',
    minimumInputLength: 1,
    allowClear: true,
    ajax: {
      url: '<?php echo base_url('login/kelurahan') ?>',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          kelurahan: params.term
        };
      },
      processResults: function(data) {
        var results = [];

        $.each(data, function(index, item){
          results.push({
              id: item.name,
              text: item.name
          });
        });
        return {
          results: results
        };
      },
    cache : true
    }
  });

  //simpan data faskes     
  $("#submit").click(function(e){
    e.preventDefault();
    var validusername = $('.username').val().match($regexname);
    var validemail    = $('.email').val().match($regemail);
    if(!validusername){
      swal("Gagal!", 'Username tidak valid, username hanya mendukung karakter alpha,numeric,underscroe atau "_" tanpa spasi', {
              icon : "error",
              buttons: {              
                confirm: {
                  className : 'btn btn-danger'
                }
              },
            });
    }else if(!validemail){
      swal("Gagal!", 'Email tidak valid, mohon cek kemvbali email anda', {
              icon : "error",
              buttons: {              
                confirm: {
                  className : 'btn btn-danger'
                }
              },
            });
    }else{
      $.ajax({
        url : "<?php echo base_url('login/simpan_data_user') ?>", 
        type: "POST", 
        dataType: "json", 
        data: $("#form_user").serialize(),
         success: function(data) {
          if(data.notif===1){
            swal("Sukses!", 'Pendaftaran berhasil Silahkan hubungi Administrator untuk aktivasi akun', {
                icon : "success",
                buttons: {              
                  confirm: {
                    className : 'btn btn-success'
                  }
                },
              });
          }else{
            swal("Gagal!", 'Username atau Email sudah digunakan', {
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
    }
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
