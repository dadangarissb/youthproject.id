
<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url() ?>">Home</a>
                </li>
                <li>Keranjang belanja</li>
            </ul>
        </div>

        <div class="col-md-9" id="basket">

            <div class="box">

                <form method="post" action="checkout1.html">

                    <h2>Keranjang belanja</h2>
                    <p class="text-muted">kamu mempunyai <?php echo count($my_cart) ?> jenis produk pada keranjang belanja.</p>
                    <?php
                        if (!$my_cart) 
                        {
                    ?>
                        <img src="<?php echo base_url('templates/frontend/img/empty_cart.png') ?>" class="img-responsive">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th style="width: 120px;">Nama Produk</th>
                                    <th style="width: 50px;">jumlah pesan</th>
                                    <th>harga produk</th>
                                    <th>harga kemasan</th>
                                    <th>subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                foreach ($my_cart as $produk)
                                {
                              ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>">
                                            <img src="<?php echo base_url('uploads/images/thumbnails/'.$produk->thumbnail) ?>" alt="White Blouse Armani">
                                        </a>
                                    </td>
                                    <td><a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>">
                                        <?php
                                          $count=strlen($produk->nama_produk);
                                           if ($count<30) 
                                           { 
                                            echo $produk->nama_produk;
                                           }
                                           else
                                           {
                                             echo substr($produk->nama_produk, 0, 27)."...";
                                           }
                                        ?>
                                    </a>
                                    </td>
                                    <td>
                                        <?php echo $produk->jumlah_order ?>
                                    </td>
                                    <td>Rp. <?php echo number_format($produk->harga_produk,0,",","."); ?></td>
                                    <td>Rp. <?php echo number_format($produk->harga_packaging,0,",","."); ?></td>
                                    <td>Rp. <?php echo number_format($produk->subtotal,0,",","."); ?></td>
                                    <td>
                                      <a href="<?php echo base_url('member/cart-delete/'.$produk->id_cart) ?>" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash-o"></i> hapus </a>
                                      <a href="<?php echo base_url('member/detail-cart/'.$produk->id_cart) ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-eye"></i> lihat</a>
                                    </td>
                                </tr>
                                <?php
                                  }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total</th>
                                    <th colspan="2">Rp. <?php echo number_format($total_harga_no_ongkir,0,",","."); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php
                        }
                    ?>
                    <!-- /.table-responsive -->

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="<?php echo base_url('all-products') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Lanjut belanja</a>
                        </div>
                        <div class="pull-right">
                            <!-- <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button> -->
                            <?php 
                              if ($my_cart) 
                              {
                            ?>
                            <a href="<?php echo base_url('order/checkout') ?>" class="btn btn-primary">Checkout <i class="fa fa-chevron-right"></i>
                            </a>
                            <?php
                              }
                              else
                              {
                            ?>
                            <button type="submit" class="btn btn-primary" disabled="">Checkout <i class="fa fa-chevron-right"></i>
                            </button>
                            <?php
                              }
                            ?>
                        </div>
                    </div>

                </form>

            </div>
            <!-- /.box -->


            <div class="row same-height-row">
                <div class="col-md-12">
                  <div class="box">
                    <h4>Produk yang mungkin anda suka</h4>
                  </div>
                </div>
                <?php 
                    $i=0;
                    if ($produk_rel) {
                    foreach ($produk_rel as $produk) {
                ?>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product">
                        <a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>">
                            <img src="<?php echo base_url('uploads/images/thumbnails/'.$produk->thumbnail)?>" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3>
                              <a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>">
                                <?php
                                  $count=strlen($produk->nama_produk);
                                   if ($count<40) 
                                   { 
                                    echo $produk->nama_produk;
                                   }
                                   else
                                   {
                                     echo substr($produk->nama_produk, 0, 37)."...";
                                   }
                                ?>
                              </a>
                            </h3>
                            <p class="price">Rp. <?php echo number_format($produk->harga_produk,0,",","."); ?></p>
                        </div>
                        <!-- /.text -->
                    </div>
                    <!-- /.product -->
                </div>
                <?php 
                    $i++;
                    if ($i==4) {
                       break;
                    } 
                    }
                    }
                ?>
            </div>


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
