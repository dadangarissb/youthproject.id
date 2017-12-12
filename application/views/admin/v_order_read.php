<div class="row">
<div class="col-xs-12">
  <div class="box box-success">
    <div class="box-header">
      <div class="col-md-6 text-left">
        <h3 class="box-title">Detail pemesanan produk</h3>
      </div>
      
      <div class="col-md-6 text-right">
      </div>
    </div>
    
    <div class="box-body">
      <div class="col-md-6">
        <div class="clearfix">
        </div>
            <table class="table">
        	    <tr><td>Id Pemesan</td><td><?php echo $id_member; ?></td></tr>
        	    <tr><td>Nama Pemesan</td><td><?php echo $nama_order; ?></td></tr>
        	    <tr><td>Email</td><td><?php echo $email_order; ?></td></tr>
        	    <tr><td>Waktu</td><td><?php echo $waktu_order; ?></td></tr>
              <tr><td>Metode pembayaran</td><td><?php echo $metode_pembayaran; ?></td></tr>
              <tr><td>Metode pengambilan</td><td><?php echo $metode_pengambilan; ?></td></tr>
              <tr><td>Status</td>
                <td><div class="btn-group">
                  <button data-toggle="dropdown" 
                  <?php
                      if ($status_order=='belum bayar'){
                  ?>
                      class="btn btn-danger dropdown-toggle btn-sm"
                  <?php
                      }
                      elseif ($status_order=='produksi'){
                  ?> 
                      class="btn btn-warning dropdown-toggle btn-sm"
                  <?php
                  }
                   elseif ($status_order=='pengiriman'){
                  ?> 
                  class="btn btn-primary dropdown-toggle btn-sm"
                  <?php
                  }
                   elseif ($status_order=='selesai'){
                  ?> 
                  class="btn btn-success dropdown-toggle btn-sm"
                  <?php
                  }
                  ?>
                  
                      type="button" aria-expanded="false"><?php echo $status_order ?> <span class="caret"></span>
                  </button>

                  <!--untuk pilihan pada dropddownnya -->
                  <ul role="menu" class="dropdown-menu">
                  <?php 
                      if($status_order=='belum bayar'){
                  ?> 
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/produksi') ?>">Produksi</a>
                    </li>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/pengiriman') ?>">Pengiriman</a>
                    </li>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/selesai') ?>">Selesai</a>
                    </li>
                  <?php 
                      } 
                      elseif ($status_order=='sudah bayar') {
                  ?>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/produksi') ?>">Produksi</a>
                    </li>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/pengiriman') ?>">Pengiriman</a>
                    </li>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/selesai') ?>">Selesai</a>
                    </li>
                  <?php
                      }
                       elseif ($status_order=='produksi') {
                  ?>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/pengiriman') ?>">Pengiriman</a>
                    </li>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/selesai') ?>">Selesai</a>
                    </li>
                  <?php
                      }
                       elseif ($status_order=='pengiriman') {
                  ?>
                    <li><a href="<?php echo base_url('admin/order/update_status_order/'.$id_data_order.'/selesai') ?>">Selesai</a>
                    </li>
                  <?php
                      }
                  ?>
                 </ul>
                 </div>
                </td></tr>
              </tr>
	          </table>
        </div>
      

        <div class="col-md-6">
            <div class="clearfix">
            </div>
                <table class="table">
                  <tr><td>Alamat</td><td><?php echo $alamat_order; ?></td></tr>
                  <tr><td>Provinsi</td><td><?php echo $nama_provinsi; ?></td></tr>
                  <tr><td>Kabupaten/kota</td><td><?php echo $nama_kota; ?></td></tr>
                  <tr><td>Nama kecamatan</td><td><?php echo $nama_kecamatan; ?></td></tr>
                </table>
        </div>
      </div>
    </div>
    </div>


        <?php 
        if ($detail_order) {
          foreach ($detail_order as $produk) 
          {
        ?>
        <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Produk dipilih</h3>
          </div>
            <div class="box-body">
              <div class="col-md-12">
            <img class="img-responsive avatar-view" src="<?php echo base_url('uploads/images/thumbnails/'.$produk->thumbnail) ?>" alt="Avatar" title="Change the avatar">
          <h4 class="box-title"><b>pilihan customize</b></h4>
          <?php
            foreach ($order_customize as $customize) 
            {
              if ($customize->id_detail_order==$produk->id_detail_order) 
              {
          ?>
          <?php
            if ($customize->type_order_customize=='short_text') 
            {
          ?>
              <label><u><?php echo $customize->label_order_customize ?></u></label>
              <p><?php echo $customize->content_order_customize ?></p>
          <?php
            }
            else if($customize->type_order_customize=='long_text')
            {
          ?>
            <label><?php echo $customize->label_order_customize ?></label>
              <p><?php echo $customize->content_order_customize ?></p>
          <?php
            }
            else if($customize->type_order_customize=='image')
            {
          ?>
            <label><u><?php echo $customize->label_order_customize ?></u></label>
            <img class="img-responsive" src="<?php echo base_url('uploads/images/image_customize/'.$customize->content_order_customize) ?>" alt="Avatar" title="Change the avatar">
          <?php
            }
            }
          }
          ?>
          </div>
        </div>
      </div>
    </div>
        <?php
          }
        }
        ?>
</div>
<a href="<?php echo base_url('admin/order') ?>" class="btn btn-warning btn-flat">kembali</a>

