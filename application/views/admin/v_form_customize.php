<?php 
  if ($this->session->userdata('message_delete')) {
?>
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $this->session->userdata('message_delete') ?>
  </div>
<?php
  }
  elseif ($this->session->userdata('message_success')) {
?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $this->session->userdata('message_success') ?>
  </div>
<?php
  }
?>
  <!-- echo $this->session->userdata(); --> 

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Form Customize Produk</h3>
      </div>
      <form role="form" action="<?php echo $action ?>" method="<?php echo $method ?>">
        <div class="box-body">
          <input type="hidden" class="form-control" name="id_produk" id="" value="<?php echo $id_produk ?>">
          <div class="form-group">
            <label>Label customize</label>
            <input type="text" class="form-control" name="label_customize" id="label_customize" placeholder="" required="">
          </div>
          <div class="form-group">
            <label>Placeholder customize</label>
            <textarea rows="3" class="form-control" name="placeholder_customize" required=""></textarea>
          </div>
          <div class="form-group">
            <label>Type customize</label>
            <select class="form-control" name="type_customize">
              <option value="short_text">inputan teks singkat</option>
              <option value="long_text">inputan teks panjang</option>
              <option value="image">gambar satu</option>
              <!-- <option value="images">gambar banyak</option> -->
            </select>
          </div>
        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambahkan</button>
          <a href="<?php echo base_url('admin/Produk/finish_customize') ?>" class="btn btn-success"><i class="fa fa-check"></i> Selesai</a>
        </div>
      </form>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Preview Customize Produk</h3>
      </div>
      <form role="form" action="" method="">
        <div class="box-body">
        <img src="<?php echo base_url('uploads/images/thumbnails/'.$preview->thumbnail) ?>" class="img-responsive" alt="thumbnail">
        <br>
        <?php 
        if ($customize) {
          foreach ($customize as $customize) 
          {
            if ($customize->type_customize=='short_text') 
            {
        ?>
            <div class="form-group">
              <label><?php echo $customize->label_customize ?></label>
              <input type="text" class="form-control" name="label_customize" id="label_customize" placeholder="<?php echo $customize->placeholder_customize ?>">
              <a href="<?php echo base_url('admin/Produk/delete_customize/'.$customize->id_customize_rules) ?>" class="btn btn-danger btn-sm"><i class="fa fa-eraser"></i> hapus</a>
            </div>
        <?php
            }
            else if($customize->type_customize=='long_text')
            {
        ?>
            <div class="form-group">
              <label><?php echo $customize->label_customize ?></label>
              <textarea class="form-control" rows="5" placeholder="<?php echo $customize->placeholder_customize ?>"></textarea>
              <a href="<?php echo base_url('admin/Produk/delete_customize/'.$customize->id_customize_rules) ?>" class="btn btn-danger btn-sm"><i class="fa fa-eraser"></i> hapus</a>
            </div>
        <?php
            }
            else if($customize->type_customize=='image')
            {
        ?>
            <div class="form-group">
              <label><?php echo $customize->label_customize ?></label>
              <input type="file" name="">
              <a href="<?php echo base_url('admin/Produk/delete_customize/'.$customize->id_customize_rules) ?>" class="btn btn-danger btn-sm"><i class="fa fa-eraser"></i> hapus</a>
            </div>
        <?php
            }
          }
        ?>
        </div>
      </form>
    </div>
  </div>
  <?php
    }
  ?>
</div>
