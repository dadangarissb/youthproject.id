<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin youthproject | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/iCheck/square/blue.css') ?>">


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>youthproject.id</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <div class="text-center">
        <div style="margin-top: 4px"  id="message">
            <?php echo $this->session->userdata('message'); ?>
        </div>
    </div>
    <form action="<?php echo base_url('admin/Login/login_Action') ?>" method="post">
      <div class="form-group has-feedback"><?php echo form_error('username') ?>
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group has-feedback"><?php echo form_error('password') ?>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <!-- <div>
        <select class="form-control" name="hak_akses">
          <option>Admin</option>
          <option>Manajer</option>
        </select>
        <br>
      </div> -->
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

</div>
<!-- /.login-box -->

</body>
</html>
