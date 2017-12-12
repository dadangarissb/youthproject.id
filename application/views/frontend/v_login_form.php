
<div id="content">
  <div class="container">

      <div class="col-md-12">
          <ul class="breadcrumb">
              <li><a href="<?php echo base_url() ?>">Home</a>
              </li>
              <li>Login</li>
          </ul>

      </div>

      <div class="col-md-12">
          <div class="box">
            <div class="row"> 
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
              <h2>Login</h2>
              <?php 
                  if($this->session->userdata('msg_success'))
                  {
              ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->userdata('msg_success') ?>
                  </div>
              <?php
                  }
                  elseif($this->session->userdata('msg_error_register'))
                  {
              ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->userdata('msg_error_register') ?>
                  </div>
              <?php
                  } 
                  elseif($this->session->userdata('msg_error_email'))
                  {
              ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php 
                        echo $this->session->userdata('msg_error_email');
                        $to_email     =$this->session->userdata('to_email');
                        $nama_member  =$this->session->userdata('nama_member');
                        $id_member    =$this->session->userdata('id_member');
                    ?>
                    <form action="<?php echo base_url('resend-email-verification') ?>" methode="post">
                      <input type="hidden" name="nama_member" value="<?php $nama_member ?>">
                      <input type="hidden" name="email" value="<?php $to_email ?>">
                      <input type="hidden" name="id_member" value="<?php $id_member ?>">
                      <button type="submit" class="btn btn-primary">Kirim email verifikasi</button>
                    </form>
                  </div>
              <?php
                  } 
                  elseif($this->session->userdata('msg_error_email_non_aktif'))
                  {
              ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->userdata('msg_error_email_non_aktif') ?>
                  </div>
              <?php
                  } 
                  elseif($this->session->userdata('error_login'))
                  {
              ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->userdata('error_login') ?>
                  </div>
              <?php
                  } 
                  elseif($this->session->userdata('msg_login_dulu'))
                  {
              ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->userdata('msg_login_dulu') ?>
                  </div>
              <?php
                  } 
                  elseif($this->session->userdata('msg_email_belum_aktif'))
                  {
              ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php 
                        echo $this->session->userdata('msg_email_belum_aktif');
                        $to_email     =$this->session->userdata('to_email');
                        $nama_member  =$this->session->userdata('nama_member');
                        $id_member    =$this->session->userdata('id_member');
                    ?>
                    <form action="<?php echo base_url('resend-email-verification') ?>" methode="post">
                      <input type="hidden" name="nama_member" value="<?php $nama_member ?>">
                      <input type="hidden" name="email" value="<?php $to_email ?>">
                      <input type="hidden" name="id_member" value="<?php $id_member ?>">
                      <button type="submit" class="btn btn-primary">Kirim email verifikasi</button>
                    </form>
                  </div>
              <?php
                  } 
              ?>
              <hr>
              <div class="row">
              <form name="frm" action="<?php echo base_url('member/login-action') ?>" method="post">
                  <div class="form-group">
                    <label for="description">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="" value="" required> 
                  </div>
                  <div class="form-group">
                    <label for="description">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="" value="" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <br>
                <p class="lead">Belum punya akun? Silahkan mendaftar <a href="<?php echo base_url('member/register') ?>">disini</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


