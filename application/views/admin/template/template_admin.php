<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/bootstrap/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/ionicons-2.0.1/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/dist/css/skins/_all-skins.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/iCheck/flat/blue.css') ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/morris/morris.css') ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/datepicker/datepicker3.css') ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/daterangepicker/daterangepicker.css') ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('templates/backend/plugins/datatables/dataTables.bootstrap.css') ?>">
  <!-- DROPZONE -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/backend/dropzone/dropzone.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/backend/dropzone/basic.min.css') ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/backend/dropzone/dropzone.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/backend/dropzone/basic.min.css') ?>">

  <script type="text/javascript" src="<?php echo base_url('templates/backend/dropzone/dropzone.min.js') ?>"></script>
    
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php
    echo $_header;

    echo $_sidebar;

  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Dashboard Produk
        <small>Control panel</small>
      </h1> -->
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

  <section class="content">
    <?php
      echo $_content;
    ?>
  </section>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.5
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('templates/backend/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('templates/backend/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url('templates/backend/plugins/morris/morris.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('templates/backend/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('templates/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
<script src="<?php echo base_url('templates/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('templates/backend/plugins/knob/jquery.knob.js') ?>"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('templates/backend/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('templates/backend/plugins/datepicker/bootstrap-datepicker.js') ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('templates/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('templates/backend/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('templates/backend/plugins/fastclick/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('templates/backend/dist/js/app.min.js') ?>"></script>

<script src="<?php echo base_url('templates/backend/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('templates/backend/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
</body>
</html>

<script>
  $(function () {
    $(".example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<?php 
if($this->session->userdata('message_danger')){ ?>
<script>
    $('#modal_slider').modal('show');
</script>
<?php } ?>