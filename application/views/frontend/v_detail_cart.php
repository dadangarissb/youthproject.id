
        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url()?>">Home</a>
                        </li>
                        <li><a href="<?php echo base_url('member/my-cart/'.$id_member) ?>">My cart</a>
                        </li>
                        <li><?php echo $cart->nama_produk ?></li>
                    </ul>

                </div>

                <div class="col-md-12">
                    <div class="row" id="productMain">
                        <div class="col-sm-4">
                            <div id="mainImage">
                                <img src="<?php echo base_url('uploads/images/thumbnails/'.$cart->thumbnail) ?>" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-8">
                          <div class="box">
                            <h4>Detail Pemesanan</h4>
                            <hr>
                            <table>
                              <tr><td width="150px">Nama produk</td><td width="20px"> : </td><td><?php echo $cart->nama_produk; ?></td></tr>
                              <tr><td>Jumlah pesan</td><td> : </td><td><?php echo $cart->jumlah_order; ?></td></tr>
                              <tr><td>Catatan lain</td><td> : </td><td><?php echo $cart->catatan_lain; ?></td></tr>
                            </table>
                          </div>

                          <div class="box" id="details">
                            <h4>Detail Customize</h4>
                            <hr>
                            <?php
                              foreach ($customize as $customize) 
                              {
                                if ($customize->type_cart_customize=='short_text') 
                                {
                              ?>
                                <label><h4><b>[ <?php echo $customize->label_cart_customize ?> ]</b></h4></label>
                                <p><?php echo $customize->content_cart_customize ?></p>
                            <?php
                              }
                              else if($customize->type_cart_customize=='long_text')
                              {
                            ?>
                              <label><h4><b>[ <?php echo $customize->label_cart_customize ?> ]</b></h4></label>
                                <p><?php echo $customize->content_cart_customize ?></p>
                            <?php
                              }
                              else if($customize->type_cart_customize=='image')
                              {
                            ?>
                              <div class="row">
                              <div class="col-sm-6">
                              <label><h4><b>[ <?php echo $customize->label_cart_customize ?> ]</b></h4>
                              <img class="img-responsive" src="<?php echo base_url('uploads/images/image_customize/'.$customize->content_cart_customize) ?>" alt="Avatar" title="Change the avatar">
                              </div>
                              </div>
                            <?php
                              }
                              }
                            ?>
                          </div>
                          <a href="<?php echo base_url('member/my-cart/'.$id_member) ?>" class="btn btn-warning" >kembali</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
  