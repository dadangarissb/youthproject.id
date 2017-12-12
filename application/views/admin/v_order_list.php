
<section class="content-header">
  <h1>
    Data pemesanan
    <small>Youthproject.id</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
  <br>
  <!-- <a href="<?php echo base_url('admin/Order/lihat_pesanan_selesai') ?>" class="btn btn-primary btn-flat">Lihat data pemesanan selesai</a> -->
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12">
      <!-- <div class="box"> -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="clearfix"></div>
          <div class="table-responsive">
          <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                <th width="30px">No</th>
                <th>Id Transaksi</th>
                <th>Nama pemesan</th>
                <th>Email</th>
                <th>No. Hp</th>
                <th>Waktu</th>
                <th>Status order</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $start = 0;
                foreach ($order_data as $order)
                {
              ?>
                <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $order->id_data_order ?></td>
                  <td><?php echo $order->nama_order ?></td>
                  <td><?php echo $order->email_order ?></td>
                  <td><?php echo $order->no_hp ?></td>
                  <td><?php echo $order->waktu_order ?></td>
                  <td> 
                      <?php 
                        if ($order->status_order=='belum bayar') 
                        {
                      ?>
                        <div class="label bg-purple"><?php echo $order->status_order ?></div>
                      <?php
                      }
                        elseif($order->status_order=='sudah bayar'){ 
                      ?>
                      <?php echo $order->status_order ?>
                      <?php
                      } 
                        elseif($order->status_order=='produksi'){ 
                      ?>
                        <div class="label bg-orange"><?php echo $order->status_order ?></div>
                      <?php
                      } 
                        elseif($order->status_order=='kadaluarsa'){ 
                      ?>
                        <div class="label bg-red"><?php echo $order->status_order ?></div>
                      <?php
                      } 
                        elseif($order->status_order=='pengiriman'){ 
                      ?>
                        <div class="label bg-blue"><?php echo $order->status_order ?></div>
                      <?php
                      }
                        elseif($order->status_order=='selesai'){ 
                      ?>
                        <div class="label bg-green"><?php echo $order->status_order ?></div>
                      <?php
                      }  
                      ?>
                  </td>
                  <td style="text-align:center" width="60px">
                   <a href="<?php echo base_url('admin/order/read/'.$order->id_data_order)?>" class="btn btn-social-icon "><i class="fa fa-eye"></i></a>
                  </td>
                  </tr>
                  <?php
                    }
                    ?>
                </tbody>
              </table>
        </div>
</div>
</body>
</div>
</div>
</div>
