
<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>Checkout - Payment method</li>
            </ul>
        </div>

        <div class="col-md-9" id="checkout">

            <div class="box">
                <form method="post" action="<?php echo $action ?>">
                    <h3>Checkout - Delivery method</h3>
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="<?php echo base_url('order/edit-form/'.$id_data_order) ?>"><i class="fa fa-map-marker"></i><br>Address</a>
                        </li>
                        <li class="active"><a href=""><i class="fa fa-truck"></i><br>Delivery Method</a>
                        </li>
                        <li class="disabled"><a href=""><i class="fa fa-money"></i><br>Payment Method</a>
                        </li>
                        <li class="disabled"><a href=""><i class="fa fa-eye"></i><br>Order Review</a>
                        </li>
                    </ul>

                    <div class="content">
                        <div class="row">
                            <input type="hidden" name="id_data_order" value="<?php echo $id_data_order; ?>" /> 
                            <div class="col-sm-6">
                                <div class="box payment-method">
                                    <h4>Ambil ke Toko</h4>
                                    <p>Pesanan yang sudah selesai dikerjakan dapat diambil langsung ke toko kami yang beralamat di Perumahan Campus Residence Surakarta.</p>
                                    <div class="box-footer text-center">
                                        <input type="radio" name="metode_pengambilan" value="ambil" required="" onclick="hide_form_alamat_kirim()"> Pilih
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box payment-method">
                                    <h4>Kirim Pesanan</h4>
                                    <p>Pesanan anda akan kami kirim menggunakan jasa pengiriman<br><b style="background-color: red; color: white; padding: 5px;">Maaf fitur ini belum tersedia</b></p>
                                    <div class="box-footer text-center">
                                        <input type="radio" name="metode_pengambilan" value="kirim" required="" onclick="view_form_alamat_kirim()"> Pilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="berat" placeholder="gram" id="berat" class="form-control" value="<?php echo $berat_total; ?>" >

                            <div class="col-md-12 text-center" id="loading"></div>
                            <div class="col-md-12" hidden="" id="alamat_kirim_form">
                                
                                
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.content -->

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="<?php echo base_url('order/edit-form/'.$id_data_order) ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Address Form</a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Continue to Payment Method<i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col-md-9 -->

        <div class="col-md-3">
            <div class="box" id="order-summary">
                <div class="box-header">
                    <h3>Order summary</h3>
                </div>
                <p class="text-muted">Ringkasan belanja anda adalah sebagai berikut</p>

                <div class="table-responsive">
                    <table class="table" style="font-size: 11pt;">
                        <tbody>
                            <tr>
                                <td>Order subtotal</td>
                                <td>Rp. <?php echo number_format($total_harga_no_ongkir,0,",","."); ?></td>
                            </tr>
                            <tr>
                                <td>Berat total</td>
                                <td><?php echo number_format($berat_total,0,",",".")." gram"; ?></td>
                            </tr>
                            <tr>
                                <td>Ongkir</td>
                                <td><?php echo "Rp. " ?></td>
                            </tr>
                            <!-- <tr>
                                <td>Diskon</td>
                                <td><?php echo "Rp. " ?></td>
                            </tr> -->
                            <tr>
                                <td>Total</td>
                                <td>Rp. <?php echo number_format($grand_total,0,",","."); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="box">
                <div class="box-header">
                    <h4>Coupon code</h4>
                </div>
                <p class="text-muted">Jika kamu mempunyai kode kupon, silahkan masukan disini</p>
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </form>
            </div>

        </div>
        <!-- /.col-md-3 -->

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->




<script type="text/javascript">
  function view_form_alamat_kirim()
  {
   $.ajax({
     url:"<?php echo base_url();?>Member/view_form_alamat_kirim",
     beforeSend: function (){
       $("#loading").show(1000).html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'></button><img src='<?php echo base_url('templates/frontend/img/AjaxLoader.gif') ?>' height='20'> sedang memuat formulir pengiriman... </div>");
       },
     success: function(response){
        $("#alamat_kirim_form").html(response);
        $("#alamat_kirim_form").show();
        $("#loading").hide();
     },
     dataType:"html"
   });
   return false;
 }
</script>

<script type="text/javascript">
  function hide_form_alamat_kirim()
  {
   $.ajax({
     url:"<?php echo base_url();?>Member/hide_form_alamat_kirim",
     
     success: function(response){
     $("#alamat_kirim_form").html(response);
     $("#loading").hide();
     },
     dataType:"html"
   });
   return false;
 }
</script>
