
<div id="content">
  <div class="container">
    <div class="col-md-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() ?>">Home</a>
            </li>
            <li>All products</li>
        </ul>
    </div>

    <div class="col-md-9">
      <?php 
      if (!$produk) {
      ?>
      <div class="box alert alert-danger">
      <p style="font-size: 18pt">NOTICE!</p><p style="font-size: 12pt">Maaf, hasil pencarian tidak ditemukan</p>
      </div>
      <?php
      }
      ?>
        <div class="box info-bar">
            <div class="row">
                <div class="col-sm-12 col-md-4 products-showing">
                    Showing <strong><?php echo $per_page; ?></strong> of <strong><?php echo $jumlah_data; ?></strong> products
                </div>

                <div class="col-sm-12 col-md-8  products-number-sort">
                    <div class="row">
                        <form class="form-inline">
                            <div class="col-md-6 col-sm-6">
                                <!-- <div class="products-number">
                                    <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                </div> -->
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <!-- <div class="products-sort-by">
                                    <strong>Sort by</strong>
                                    <select name="sort-by" class="form-control">
                                        <option>Price</option>
                                        <option>Name</option>
                                        <option>Sales first</option>
                                    </select>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row products">
          <?php 
            foreach ($produk as $produk) {
          ?>
            <div class="col-md-4 col-sm-4 col-xs-6">
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
                            <!-- <a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>" class="btn btn-default">View detail</a> -->
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
        <!-- /.products -->

        <div class="pages">

            <p class="loadMore">
                <!-- <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a> -->
            </p>
            <?php
              echo $this->pagination->create_links();
            ?>
        </div>

    </div>
    <!-- /.col-md-9 -->

    <div class="col-md-3">
        <!-- *** MENUS AND FILTERS ***
_________________________________________________________ -->
        
      <?php
      $this->load->view('frontend/template/right_sidebar');
      ?>
        <!-- *** MENUS AND FILTERS END *** -->
    </div>

  </div>
  <!-- /.container -->
</div>
<!-- /#content -->
