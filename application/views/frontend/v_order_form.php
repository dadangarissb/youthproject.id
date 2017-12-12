<div id="content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>Checkout - Order form</li>
            </ul>
        </div>

        <div class="col-md-9" id="checkout">
            <div class="box">
                <form action="<?php echo $action; ?>" method="post">
                    <h3>Checkout - Order form</h3>
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a href=""><i class="fa fa-map-marker"></i><br>Address</a>
                        </li>
                        <li class="disabled"><a href=""><i class="fa fa-truck"></i><br>Delivery Method</a>
                        </li>
                        <li class="disabled"><a href=""><i class="fa fa-money"></i><br>Payment Method</a>
                        </li>
                        <li class="disabled"><a href=""><i class="fa fa-eye"></i><br>Order Review</a>
                        </li>
                    </ul>

                    <div class="content">
                    <input type="hidden" name="id_data_order" id="id_data_order" value="<?php echo $id_data_order; ?>" /> 
                    <input type="hidden" name="id_member" id="id_member" value="<?php echo $id_member; ?>" />
                    <!-- <input type="hidden" name="total_harga" value="<?php echo $total; ?>">
                    <input type="hidden" name="berat_total" value="<?php echo $berat_total; ?>"> -->
                        <div class="row"> 
                            <input type="hidden" class="form-control" name="total_harga_no_ongkir" id="total_harga_no_ongkir" placeholder="total_harga_no_ongkir" value="<?php echo $total_harga_no_ongkir; ?>" required>
                            <input type="hidden" class="form-control" name="berat_total" id="berat_total" placeholder="berat_total" value="<?php echo $berat_total; ?>" required>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="firstname">Nama</label>
                                    <input type="text" class="form-control" name="nama_order" id="nama_order" placeholder="Nama" value="<?php echo $nama_order; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="lastname">Email</label>
                                    <input type="text" class="form-control" name="email_order" id="email_order" placeholder="Email Penerima" value="<?php echo $email_order; ?>" required>
                                    <p>*email untuk pengiriman invoice</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="company">No. Hp</label>
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor Hp" value="<?php echo $no_hp; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="street">Alamat</label>
                                    <textarea rows="5" class="form-control" name="alamat_order" value="<?php echo $alamat_order ?>"><?php echo $alamat_order ?></textarea>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>

                    <div class="box-footer">
                        <!-- <div class="pull-left">
                            <a href="basket.html" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                        </div> -->
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Continue to Delivery Method<i class="fa fa-chevron-right"></i>
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
                                <td>Rp. <?php echo number_format($total_harga_no_ongkir,0,",","."); ?></td>
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
