<div class="row">
<?php 
  if($this->session->userdata('error_send_email'))
  {
?>
  <div class="col-md-12">
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php 
      echo $this->session->userdata('error_send_email');
      $id_data_order=$this->session->userdata('id_data_order'); 
      $id_konfirmasi=$this->session->userdata('id_konfirmasi'); 
    ?>
    <a href="<?php echo base_url('admin/Order/send_invoice/'.$id_data_order.'/'.$id_konfirmasi) ?>" class="btn btn-primary">kirim ulang invoice</a>
  </div>
  </div>
<?php
  }
  else if ($this->session->userdata('konfirmasi_sukses')) 
  {
?>
  <div class="col-md-12">
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $this->session->userdata('konfirmasi_sukses'); ?>
  </div>
  </div>
<?php
  }
?>
<div class="col-xs-7">
  <div class="box box-primary">
    <div class="box-header">
      <div class="col-md-12 text-left">
        <h3 class="box-title">Detail produk</h3>
      </div>
    </div>
    <div class="box-body">
      <!-- <div class="box"> -->
      <div class="col-md-12">
        <div class="clearfix"></div>
          <table class="table">
            <tr><td>Tagihan pembayaran</td><td><?php echo "Rp. ".number_format($konfirmasi->grand_total,0,",","."); ?></td></tr>
            <tr><td>Bank tujuan</td><td><?php echo $konfirmasi->nama_bank; ?></td></tr>
            <tr><td>Jumlah pembayaran</td><td><?php echo "Rp. ".number_format($konfirmasi->jumlah_pembayaran,0,",","."); ?></td></tr>
            <tr><td>Bank pengirim</td><td><?php echo $konfirmasi->bank_pengirim; ?></td></tr>
            <tr><td>Nama Rek. pengirim</td><td><?php echo $konfirmasi->nama_rek_pengirim; ?></td></tr>
            <tr><td>Tanggal pembayaran</td><td><?php echo $konfirmasi->tanggal_pembayaran; ?></td></tr>
            <tr><td>Metode pembayaran</td><td><?php echo $konfirmasi->metode_pembayaran; ?></td></tr>
            <tr><td>Status konfirmasi</td>
            <td><div class="btn-group">
              <button data-toggle="dropdown" 
              <?php
                  if ($konfirmasi->status_konfirmasi=='belum bayar'){
              ?>
                  class="btn btn-danger dropdown-toggle btn-sm"
              <?php
                  }
                  elseif ($konfirmasi->status_konfirmasi=='menunggu konfirmasi'){
              ?> 
                  class="btn btn-primary dropdown-toggle btn-sm"
              <?php
              }
               elseif ($konfirmasi->status_konfirmasi=='sudah bayar'){
              ?> 
              class="btn btn-success dropdown-toggle btn-sm"
              <?php
              }
              ?>
                  type="button" aria-expanded="false"><?php echo $konfirmasi->status_konfirmasi ?> <span class="caret"></span>
              </button>

              <!--untuk pilihan pada dropddownnya -->
              <ul role="menu" class="dropdown-menu">
              <?php 
                  if($konfirmasi->status_konfirmasi=='menunggu konfirmasi'){
              ?> 
                <li><a href="<?php echo base_url('admin/order/status_pemb_sudah/'.$konfirmasi->id_konfirmasi) ?>">Sudah bayar</a>
                </li>
              <?php 
                  } 
                  elseif ($konfirmasi->status_konfirmasi=='belum bayar') {
              ?>
                <li><a href="<?php echo base_url('admin/order/status_pemb_sudah/'.$konfirmasi->id_konfirmasi) ?>">Sudah bayar</a>
                </li>
              <?php
                  }
              ?>
              </ul>
              </div>
            </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <a href="<?php echo base_url('admin/konfirmasi-pembayaran/list') ?>" class="btn btn-warning">Back</a>
  </div>

<div class="col-xs-5">
  <div class="row">
    <div class="col-md-12">
      <!-- Profile Image -->
      <div class="box box-primary">
        <h4 align="center">Bukti pembayaran</h4>
          <div class="box-body box-profile">
            <?php if ($konfirmasi->bukti_pembayaran) {
             ?>
              <img style="width: 100%; display: block;" src="<?php echo base_url('uploads/images/bukti_pembayaran/'.$konfirmasi->bukti_pembayaran); ?>" class="img-responsive" alt="image" />
            <?php
             }
             else{
            ?>
            <p>Belum ada bukti pembayaran</p>
            <?php
             } 
             ?>
          </div>
      </div>
    </div>
  </div>
</div>



