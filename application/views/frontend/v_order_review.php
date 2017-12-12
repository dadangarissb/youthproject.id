<div id="content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>Checkout - Order review</li>
            </ul>
        </div>

        <div class="col-md-9" id="checkout">
            <div class="box">
                <form>
                    <h3>Checkout - Order review</h3>
                    <ul class="nav nav-pills nav-justified">
                        <li class="disabled"><a href=""><i class="fa fa-map-marker"></i><br>Address</a>
                        </li>
                        <li class="disabled"><a href=""><i class="fa fa-truck"></i><br>Delivery Method</a>
                        </li>
                        <li class="disabled"><a href=""><i class="fa fa-money"></i><br>Payment Method</a>
                        </li>
                        <li class="active"><a href=""><i class="fa fa-eye"></i><br>Order Review</a>
                        </li>
                    </ul>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-12" id="customer-orders">
                                <div class="box">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Rincian pemesanan anda</h3>
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                    <table>
                                        <tr><td width="150px;">No. Transaksi</td><td width="10px;">:</td><td width="180px"><?php echo $order->id_data_order; ?></td> </tr>
                                        <tr><td width="150px;">Nama</td><td width="10px;">:</td><td width="180px"><?php echo $order->nama_order; ?></td> </tr>
                                        <tr><td>Email</td><td>:</td><td><?php echo $order->email_order; ?></td> </tr>
                                        <tr><td>No. hp</td><td>:</td><td><?php echo $order->no_hp; ?></td> </tr>
                                        <tr><td>Metode pengambilan</td><td>:</td><td><?php echo $order->metode_pengambilan; ?></td> </tr>
                                        <tr><td>Metode pembayaran</td><td>:</td><td><?php echo $order->metode_pembayaran; ?></td> </tr>
                                    </table>
                                    </div>
                                    <div class="col-md-6">
                                    <table>
                                        <tr><td width="150px;">Alamat</td><td width="10px;">:</td><td width="200px"><?php echo $order->alamat_order; ?></td> </tr>
                                        <tr><td>Provinsi</td><td>:</td><td><?php echo $order->nama_provinsi; ?></td> </tr>
                                        <tr><td>Kabupaten/kota</td><td>:</td><td><?php echo $order->nama_kota; ?></td> </tr>
                                        <tr><td>Kecamatan</td><td>:</td><td><?php echo $order->nama_kecamatan; ?></td> </tr>
                                        <tr><td>Lama pengiriman</td><td>:</td><td><?php echo $order->lama_pengiriman; ?></td> </tr>
                                        <tr><td>Status</td><td>:</td><td><?php echo $order->status_order; ?></td> </tr>
                                    </table>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead style="background-color: #c5c5c5;">
                                            <tr>
                                                <th width="80px">No</th>
                                                <th>Nama Produk</th>
                                                <th>jumlah pesan</th>
                                                <th>harga produk</th>
                                                <th>harga packaging</th>
                                                <th width="120px">subtotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $start = 0;
                                                $total=0;
                                                foreach ($my_detail as $produk)
                                                {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$start ?></td>
                                                <td><?php echo $produk->nama_produk ?></td>
                                                <td><?php echo $produk->jumlah_order ?></td>
                                                <td><?php echo "Rp. ".number_format($produk->harga_produk,0,',','.') ?></td>
                                                <td><?php echo "Rp. ".number_format($produk->harga_packaging,0,',','.') ?></td>
                                                <td align="right"><?php echo "Rp. ".number_format($produk->subtotal,0,',','.') ?></td>

                                            </tr>
                                            <?php
                                            $total=$total+$produk->subtotal;
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" align="right">Total</td>
                                                <td align="right"><?php echo"Rp. ".number_format($total_harga_no_ongkir,0,',','.') ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="right">Berat total</td>
                                                <td align="right"><?php echo number_format($order->berat_total,0,',','.')." gram"; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="right">Total Ongkir (ongkir x berat total)</td>
                                                <td align="right"><?php echo "Rp. ".number_format($total_ongkir,0,',','.') ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td colspan="5" align="right">Kode Unik</td>
                                                <td align="right"><?php echo "Rp. ".number_format($kode_unik,0,',','.') ?></td>
                                            </tr> -->
                                            <tr>
                                                <td colspan="5" align="right">Grand Total</td>
                                                <td align="right"><?php echo "Rp. ".number_format($grand_total,0,',','.') ?></td>
                                            </tr>
                                            
                                          </tbody>
                                        </table>
                                        
                                        <br>
                                        <?php
                                            if ($order->metode_pembayaran=="langsung") 
                                            {
                                        ?>
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h5 style="font-size: 10pt">*Lakukan pembayaran dengan langsung datang ke tempat kami maksimal 10 jam dari sekarang!</h5>
                                            </div>
                                            <b>Alamat kami</b>
                                            <p>Perumahan Griya Campus Residence</p>
                                        <?php
                                            } 
                                            else if($order->metode_pembayaran=="transfer") 
                                            {
                                        ?>
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h5 style="font-size: 10pt">*Segera lakukan pembayaran dan lakukan konfirmasi pembayaran maksimal 10 jam dari sekarang!</h5>
                                            </div>
                                            <b>
                                                Pembayaran dapat dilakukan ke nomer rekening berikut ini.
                                            </b>
                                            <ul>
                                                <li><b>BRI (Bank Rakyat Indonesia)</b></li>
                                                No Rekening 09745344534 <br>a.n. Dadang Aris S
                                            </ul>

                                            <ul>
                                                <li><b>BNI (Bank Nasional Indonesia)</b></li>
                                                No Rekening 09745344534 <br>a.n. Dadang Aris S
                                            </ul>
                                            <ul>
                                                <li><b>BCA (Bank Central Asia)</b></li>
                                                No Rekening 09745344534 <br>a.n. Dadang Aris S
                                            </ul>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="box-footer">
                                        <!-- <div class="pull-left">
                                            <a href="<?php echo base_url('order/edit-form/'.$id_data_order) ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Address Form</a>
                                        </div> -->
                                        <!-- <div class="pull-right">
                                            <a href="<?php echo base_url('Member/download_order_review') ?>" class="btn btn-primary">Download<i class="fa fa-print"></i></a>
                                            </button>
                                        </div> -->
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.container -->
                        </div>
                        <!-- /#content -->
                    </form>
                </div>
            </div>
        </div>
