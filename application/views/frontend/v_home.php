    <div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
                        <?php 
                            foreach ($slider as $slider) {
                        ?>
                        <div class="item">
                            <img src="<?php echo base_url('uploads/images/slider/'.$slider->gambar_slider) ?>" alt="" class="img-responsive">
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <!-- <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a href="#">We love our customers</a></h3>
                                <p>We are known to provide best possible service ever</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a href="#">Best prices</a></h3>
                                <p>You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">100% satisfaction guaranteed</a></h3>
                                <p>Free returns on everything for 3 months.</p>
                            </div>
                        </div>
                    </div> -->
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Hot this week</h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                  <div class="col-md-12">
                    <div class="row products">
                      <?php 
                        foreach ($produk as $produk) {
                      ?>
                        <div class="col-md-3 col-sm-4 col-xs-6">
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
                                    <p class="buttons">
                                        <a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>" class="btn btn-default">View detail</a>
                                        <!-- <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a> -->
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
                      <?php 
                        }
                      ?>
                    </div>
                    <p class="buttons" align="center">
                        <a href="<?php echo base_url('all-products') ?>" class="btn btn-primary">All Products</a>
                    </p>
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->
        </div>
        <!-- /#content -->