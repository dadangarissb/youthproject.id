<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>My orders</li>
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

        <div class="col-md-9" id="customer-orders">
            <div class="box">
                <h3>Riwayat pemesanan</h3>
                <hr>

          <div class="clearfix"></div>
          <?php 
          if (is_null($my_order)) {
            echo "<p align='center'>anda tidak memiliki riwayat pemesanan</p>";
            } 
            else{
            ?>
            <div class="table-responsive">      
            <table class="table table-hover">
            <thead>
              <tr>
                <th>ID Transaksi</th>
                <th>Nama Pemesan</th>
                <th>Waktu pesan</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $start = 0;
              foreach ($my_order as $order)
              {
              ?>
              <tr>
                <td><?php echo $order->id_data_order ?></td>
                <td><?php echo $order->nama_order ?></td>
                <td><?php echo $order->waktu_order?></td>
                <td> <?php if ($order->status_order=='belum bayar') 
                {
                ?>
                <div><?php echo $order->status_order ?></div>
                <?php
                }
                elseif($order->status_order=='menunggu konfirmasi'){ 
                ?>
                <div class="label label-info"><?php echo $order->status_order ?></div>
                <?php
                } 
                elseif($order->status_order=='kadaluarsa'){ 
                ?>
                <div class="label label-danger"><?php echo $order->status_order ?></div>
                <?php
                } 
                elseif($order->status_order=='produksi'){ 
                ?>
                <div class="label label-warning"><?php echo $order->status_order ?></div>
                <?php
                } 
                elseif($order->status_order=='pengiriman'){ 
                ?>
                <div class="label label-primary"><?php echo $order->status_order ?></div>
                <?php
                }
                elseif($order->status_order=='selesai'){ 
                ?>
                <div class="label label-success"><?php echo $order->status_order ?></div>
                <?php
                }  
                ?>
            </td>
            <td style="text-align:center" width="300px">
            <div class="btn-group">
                <button onclick="detail(this)" id="btn_detail" class="btn  btn-primary btn-sm" value="<?php echo $order->id_data_order; ?>"><i class="fa fa-eye"></i> detail</button>
                <?php if ($order->status_order=='belum bayar') {
                ?>
                <a class="btn btn-danger btn-sm" href="<?php echo base_url('order/konfirmasi-pembayaran/'.$order->id_data_order) ?>">konfirm pembayaran</a>
                <?php
                  } 
                  elseif ($order->status_order=='selesai') {
                ?>
                  <!-- <button onclick="hasil(this)" id="btn_hasil" class="btn btn-warning btn-sm" value="<?php echo $order->id_data_order; ?>"><i class="fa fa-eye"></i> hasil</button> -->
                <?php
                  }
                ?>
            </div>
            </td>
          </tr>
            <?php
            }
            ?>
          </tbody>      
        </table>
      </div>
      <?php
        }
      ?>
    </div>

</div>
</div>
</div>


<script>
  function detail(elem)
   {
     var id=elem.value;
     $.ajax({
       url:"<?php echo base_url();?>Member/my_order_detail",
       method: "POST",
       cache: false,
       data: {id_data_order: id},
       success: function(response){
       $("#detail_order_saya").html(response);
       },
       dataType:"html"
     });
     return false;
   }

</script>

<script type="text/javascript">
     function hasil(elem)
   {
     var id=elem.value;
     $.ajax({
       url:"<?php echo base_url();?>Member/hasil_pesan",
       method: "POST",
       cache: false,
       data: {id_data_order: id},
       success: function(response){
       $("#hasil_order_saya").html(response);
       },
       dataType:"html"
     });
     return false;
   }
</script>