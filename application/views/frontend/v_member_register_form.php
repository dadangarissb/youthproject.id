
<div id="content">
  <div class="container">

      <div class="col-md-12">

          <ul class="breadcrumb">
              <li><a href="<?php echo base_url() ?>">Home</a>
              </li>
              <li>New account / Sign in</li>
          </ul>

      </div>

      <div class="col-md-12">
          <div class="box">
              <h2>New account</h2>
              <p class="lead">sudah punya akun? silahkan login <a href="" data-toggle="modal" data-target="#login-modal" ><b>di sini</b></a></p>
              <hr>
              <div class="row">
              <div class="col-md-6">
              <form name="frm" action="<?php echo base_url('member/register-action') ?>" method="post">
                  <div class="form-group">
                    <label for="description">email <?php echo form_error('email') ?></label>
                      <?php if ($this->session->userdata('email')) { ?>
                      <p style="color: red;"><?php echo $this->session->userdata('email'); ?></p>
                      <?php } ?>
                      <input type="text" class="form-control" onchange="cek_email()" name="email" id="email" placeholder="" value="<?php echo $email; ?>" required>
                      <div id="email_digunakan" style="color: red"></div>
                      <span>*pastikan email yang anda gunakan aktif</span>  
                  </div>
                  <div class="form-group">
                    <label for="description">password <?php echo form_error('password') ?></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="description">confirm password <?php echo form_error('confirm_password') ?></label><div id="allert_pass" style="color: red" hidden="">password tidak sama</div>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" onchange="cek_pass()" placeholder="" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="description">nama <?php echo form_error('nama_member') ?></label>
                    <input type="text" class="form-control" name="nama_member" id="nama_member" placeholder="" value="<?php echo $nama_member; ?>" required/>
                  </div>
                  <div class="form-group">
                    <label for="description">no. hp <?php echo form_error('no_hp') ?></label>
                    <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="" value="<?php echo $no_hp; ?>" required>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label for="description">Tanggal lahir <?php echo form_error('tgl_lahir') ?></label>
                    <div class="input-group date" data-date-format="yyyy-mm-dd" data-provide="datepicker">
                        <div class="input-group-addon">
                            <span class="fa fa-th"></span>
                        </div>
                        <input type="text" name="tgl_lahir" class="form-control" required="" value="<?php echo $tgl_lahir; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="description">Provinsi </label>
                    <select class="form-control" name="id_provinsi" id="id_provinsi">
                      <option value="" selected="" disabled="">Pilih Provinsi</option>
                      <?php
                          if ($err) {
                            echo "cURL Error #:" . $err;
                          } else {
                            $data = json_decode($response, true);
                            
                            for ($i=0; $i < count($data['rajaongkir']['results']); $i++){
                            
                              echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
                            }

                          }
                      ?>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="description">Kabupaten / kota </label>
                    <select class="form-control" name="id_kota" id="id_kota">
                        <option value="" selected="" disabled="">Pilih Kota</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="description">alamat <?php echo form_error('alamat_member') ?></label>
                    <textarea rows="3" class="form-control" name="alamat_member" id="alamat_member" placeholder="" value="<?php echo $alamat_member; ?>" required></textarea>
                  </div>
                  <!-- <div>
                    <?php
                    $style_provinsi='class="form-control" id="id_provinsi"  onChange="tampilKabupaten()"';
                    echo form_dropdown('id_provinsi',$provinsi,'',$style_provinsi);
                    ?>
                  </div>
                  <br>
                  <div>
                    <?php
                    $style_kabupaten='class="form-control" id="id_kabupaten" onChange="tampilKecamatan()"';
                    echo form_dropdown("id_kabupaten",array('Pilih Kabupaten'=>'- Pilih Kabupaten -'),'',$style_kabupaten);
                    ?>
                  </div>
                  <br>
                  <div>
                    <?php
                    $style_kecamatan='class="form-control" id="id_kecamatan"';
                    echo form_dropdown("id_kecamatan",array('Pilih Kecamatan'=>'- Pilih Kecamatan -'),'',$style_kecamatan);
                    ?>
                  </div> --> 
                  <br>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-user"></i> Register</button>
                </div>
              </form>
              </div>
              </div>
          </div>
      </div>
  </div>
  <!-- /.container -->
</div>
<!-- /#content -->


<!--//login-->

<script src="<?php echo base_url('templates/frontend/js/jquery-1.11.0.min.js') ?>"></script>

<script>
$(document).ready(function(){

    $("#id_provinsi").click(function(){
        $.post("<?php echo base_url(); ?>/Visitor/get_kota/"+$('#id_provinsi').val(),function(obj){
            $('#id_kota').html(obj);
        });
            
    });

    /*
    $("#cari").click(function(){
        $.post("<?php echo base_url(); ?>index.php/rajaongkir/getCost/"+$('#origin').val()+'&dest='+$('#destination').val()+'&berat='+$('#berat').val()+'&courier='+$('#courier').val(),function(obj){
            $('#hasil').html(obj);
        });
    });

    */
    
});
</script>


<script type="text/javascript">
  function cek_email()
  {
   var email = document.getElementById("email").value;
   $.ajax({
     url:"<?php echo base_url();?>Visitor/cek_email",
     method: "GET",
     cache: false,
     data: {email: email},
     success: function(response){
     $("#email_digunakan").html(response);
     },
     dataType:"html"
   });
   return false;
 }
</script>

<script>
    function cek_pass()
    {
      p1 = document.frm.password.value;
      p2 = document.frm.confirm_password.value;
      if(p1==p2)
      {
        $("#allert_pass").hide();
      }
      else
      {
        $("#allert_pass").show();
      }
    }
  </script>