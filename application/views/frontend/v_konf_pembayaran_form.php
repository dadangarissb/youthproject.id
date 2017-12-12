<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>Konfirmasi pembayaran</li>
            </ul>

        </div>
        <div style="margin-top: 4px"  id="message">
            <?php echo $this->session->userdata('message'); ?>
        </div>

        <?php
            if ($my_detail=='no_data') {
        ?>
        <div class="col-md-12" style="margin-bottom: 40px;">
            <div class="alert alert-danger col-md-12"><p style="font-size: 18pt">NOTICE!</p><p style="font-size: 12pt">Maaf kode yang anda masukkan salah, atau waktu konfirmasi telah kadaluarsa. Hubungi customer service kami untuk info lebih lanjut</p>
            </div>
            <a href="<?php echo base_url() ?>" class="btn btn-warning">kembali ke halaman utama</a>
        </div>
        <?php
            }
            else{
        ?>

        <div class="col-md-4">
            <!-- *** CUSTOMER MENU ***
_________________________________________________________ -->
            <div class="panel panel-default sidebar-menu">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir konfirmasi pembayaran</h3>
                </div>

                <div class="panel-body">

                    <form action="<?php echo base_url('order/konfirmasi-pembayaran-action') ?>" method="post" enctype="multipart/form-data">
                    <div>
                        <label>Kode Transaksi</label>
                        <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" placeholder="Kode Transaksi" value="<?php echo $id_data_order; ?>" readonly/>
                    </div>
                    <div>
                        <input type="hidden" class="form-control" name="id_data_order" id="" value="<?php echo $id_data_order; ?>" />
                    </div><br>
                    <div>
                        <label>Bank Tujuan</label>
                        <br>
                        <select name="nama_bank" class="form-control">
                            <option>BRI</option>
                            <option>BNI</option>
                        </select>
                    </div><br>
                    <div>
                        <label>Jumlah Pembayaran ( Contoh : 150000 )</label>
                        <input type="text" class="form-control" name="jumlah_pembayaran" id="jumlah_pembayaran" placeholder="Jumlah pembayaran" required>
                    </div><br>
                    <div>
                        <label>Bank Pengirim</label>
                        <br>
                        <select name="bank_pengirim" class="form-control">
                            <option>BRI</option>
                            <option>BNI</option>
                            <option>BCA</option>
                            <option>Mandiri</option>
                            <option>BTN</option>
                        </select>
                    </div><br>
                    <div>
                        <label>Nama Rekening pengirim</label>
                        <input type="text" class="form-control" name="nama_rek_pengirim" id="nama_rek_pengirim" placeholder="Nama rekening pengirim" required>
                    </div><br>
                    <div>
                    <label for="description">Tanggal lahir <?php echo form_error('tgl_lahir') ?></label>
                        <div class="input-group date" data-date-format="yyyy-mm-dd" data-provide="datepicker">
                        <div class="input-group-addon">
                            <span class="fa fa-th"></span>
                        </div>
                        <input type="text" name="tanggal_pembayaran" class="form-control" required="" value="">
                        </div>
                    </div><br>
                    <!-- <div>
                        <input type="text" class="form-control" name="waktu_pembayaran" id="" placeholder="Waktu pembayaran" />
                    </div><br> -->
                    Upload bukti pembayaran
                    <input type="file" name="bukti_pembayaran" required="" />
                    <br>
                    <button class="btn btn-primary btn-flat" type="submit">Submit</button>
                    <a href="<?php echo base_url() ?>" class="btn btn-warning btn-flat">Cancel</a>
                  </form>
                </div>

            </div>
            <!-- /.col-md-3 -->

            <!-- *** CUSTOMER MENU END *** -->
        </div>

        <div class="col-md-8" id="customer-orders">

            <div class="box">
                <div class="panel-heading">
                    <h3 class="panel-title">Rincian pemesanan anda</h3>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
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
                            <td colspan="5" align="right">Total Ongkir</td>
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
                    <!-- <h5 style="font-size: 10pt">*mohon untuk melakukan pembayaran sampai 3 digit terakhir</h5> -->
                </div>
            </div>
        </div>
        <?php 
            }
        ?>
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
