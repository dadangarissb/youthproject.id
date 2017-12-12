<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="<?php echo base_url() ?>">Home</a>
                </li>
                <li>My account</li>
            </ul>

        </div>

        <div class="col-md-3">
            <!-- *** CUSTOMER MENU ***
_________________________________________________________ -->
            <div class="panel panel-default sidebar-menu">

                <div class="panel-heading">
                    <h3 class="panel-title">Customer section</h3>
                </div>

                <div class="panel-body">
                    <?php
                      $this->load->view('frontend/template/member_sidebar');
                    ?>
                </div>

            </div>
            <!-- /.col-md-3 -->

            <!-- *** CUSTOMER MENU END *** -->
        </div>

        <div class="col-md-9">
            <div class="box">
                <h3><?php echo $nama_member; ?></h3>

                <table class="table" style="margin-top: 10px">
                  <tr><td width="250px">Email</td><td><?php echo $email; ?></td></tr>
                  <tr><td>No hp</td><td><?php echo $no_hp; ?></td></tr>
                  <tr><td>Alamat</td><td><?php echo $alamat_member; ?></td></tr>
                  <!-- <tr><td>Provinsi</td><td><?php echo ucwords($nama_provinsi);  ?></td></tr>
                  <tr><td>Kabupaten / kota</td><td><?php echo ucwords($nama_kabupaten); ?></td></tr>
                  <tr><td>Kecamatan</td><td><?php echo ucwords($nama_kecamatan); ?></td></tr> -->
                  <!-- <tr><td>Status</td><td>
                    <?php if ($status_member=='aktif') {
                    ?>
                    <div class="label bg-green"><?php echo $status_member ?></div>
                    <?php
                    }
                    else{ 
                    ?>
                     <div class="label bg-red"><?php echo $status_member ?></div>
                    <?php
                    } 
                    ?>
                  </td></tr> -->              
                </table>

                <hr>
            </div>
        </div>

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->


<script>
  function edit_profil()
   {
    // $('#profil').hide();
     id_member = document.getElementById("edit_profil").value;
     $.ajax({
       url:"<?php echo base_url();?>Member/update/"+id_member+"",
       success: function(response){
       $("#profil").html(response);
       },
       dataType:"html"
     });
     return false;
   }
</script>