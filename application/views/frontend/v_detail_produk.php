<div id="content">
  <div class="container">
    <div class="col-md-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url()?>">Home</a>
            </li>
            <li><a href="<?php echo base_url('sort-by/kategori/'.str_replace(' ','-', $produk->nama_kategori)) ?>"><?php echo $produk->nama_kategori ?></a>
            </li>
            <li><a href="<?php echo base_url('sort-by/subkategori/'.str_replace(' ','-', $produk->nama_subkategori)) ?>"><?php echo $produk->nama_subkategori ?></a>
            </li>
            <li><?php echo $produk->nama_produk ?></li>
        </ul>
    </div>

    <div class="col-md-12">
        <div class="row" id="productMain">
            <div class="col-sm-6">
                <center><div id="loading"></div></center><br>
                <div id="mainImage">
                    <img src="<?php echo base_url('uploads/images/thumbnails/'.$produk->thumbnail) ?>" alt="" class="img-responsive">
                </div>
                <!-- <div class="ribbon sale">
                    <div class="theribbon">SALE</div>
                    <div class="ribbon-background"></div>
                </div> -->
                <!-- /.ribbon -->
                <!-- <div class="ribbon new">
                    <div class="theribbon">NEW</div>
                    <div class="ribbon-background"></div>
                </div> -->
                <!-- /.ribbon -->
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <h1 class="text-center"><?php echo $produk->nama_produk; ?></h1>
                    <p class="goToDescription"><a href="#details" class="scroll-to">Scroll ke bawah untuk melihat deskripsi produk</a>
                    </p>
                    <p class="price">Rp. <?php echo number_format($produk->harga_produk,0,',','.'); ?></p>

                    <?php
                    $title="bagus";
                    $current_url = current_url();
                    $summary = "bagus";
                    ?>

                    <p class="text-center buttons">
                      <?php 
                      $sess_member=$this->session->userdata('sess_member');
                      $id_member=$sess_member['id_member'];
                      if ($id_member) 
                      {
                      ?>
                        <a href="#" data-toggle="modal" data-target="#form_pemesanan" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
                      <?php
                      }
                      else
                      {
                        $current_url = current_url();
                        $this->session->set_userdata('page_url', $current_url);
                        $this->session->set_flashdata('msg_login_dulu','Anda harus login dahulu sebelum membeli barang');
                      ?>
                      <!-- <a href="" data-toggle="modal" data-target="#login-modal-detail-produk" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> --> 
                      <a href="<?php echo base_url('member/login') ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
                      <?php
                      }
                      ?>
                      <!-- <a href="basket.html" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a> -->
                    </p>
                </div>

                <div class="row" id="thumbs">
                <?php
                $gambar= count($gambar_produk);

                if ($gambar>1) 
                {             
                foreach ($gambar_produk as $gambar) 
                  {
                ?>
                    <div class="col-xs-4">
                        <a href="<?php echo base_url('uploads/images/gambar_produk/'.$gambar->nama_gambar_produk) ?>" class="thumb">
                            <img src="<?php echo base_url('uploads/images/gambar_produk/'.$gambar->nama_gambar_produk) ?>" alt="" class="img-responsive">
                        </a>
                    </div>
                <?php
                  }
                }
                ?>
                </div>
            </div>
        </div>


        <div class="box" id="details">
            <p>
                <h3>Detail produk</h3>
                <hr>
                <?php echo $produk->deskripsi_produk; ?>

                <hr>
                <!-- <div class="social">
                    <h4>Bagikan produk ini ke temanmu</h4>
                    <p>
                        <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                    </p>
                </div> -->
        </div>

        <div class="row same-height-row">
            <div class="col-md-12">
              <div class="box">
                    <h3>Produk terkait</h3>
              </div>
            </div>
            <?php 
              foreach ($related as $produk) 
                {
            ?>

            <div class="col-md-3 col-sm-6 col-sm-6 col-xs-6">
                <div class="product same-height">
                    <a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>">
                        <img src="<?php echo base_url('uploads/images/thumbnails/'.$produk->thumbnail) ?>" alt="" class="img-responsive">
                    </a>
                    <div class="text">
                        <h3><a href="<?php echo base_url('produk/'.$produk->id_produk.'/'.$produk->slug) ?>"><?php echo $produk->nama_produk ?></a></h3>
                        <p class="price">Rp. <?php echo number_format($produk->harga_produk,0,',','.') ?></p>
                    </div>
                </div>
                <!-- /.product -->
            </div>
            <?php
              }
            ?>
        </div>
    </div>
    <!-- /.col-md-12 -->
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->



<!--MODAL -->
   <!--  <a href="#"><span>login to save in wishlist </span></a> -->
   <!-- Modal -->
    <div id="form_pemesanan" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">Form pemesanan</h4>
          </div>
          <div class="modal-body">
            <?php 
                  if($this->session->userdata('message_image_fail'))
                  {
              ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->userdata('message_image_fail') ?>
                  </div>
              <?php
                  }
              ?>
            <form action="<?php echo base_url('Member/add_to_cart'); ?>" method="post"  enctype="multipart/form-data">
               <input type="hidden" class="form-control" name="id_member" placeholder="" value="<?php echo $id_member; ?>" >
               <input type="hidden" class="form-control" name="id_produk" placeholder="" value="<?php echo $id_produk; ?>" >
               <input type="hidden" class="form-control" name="slug" placeholder="" value="<?php echo $produk->slug; ?>" >
               <div class="form-group">
                  <label for="varchar">Jumlah pesan</label>
                  <select class="form-control" name="jumlah_order">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
              </div>
            <hr>
            <?php 
            if ($customize_rules) {
              foreach ($customize_rules as $customize) 
              {
                if ($customize->type_customize=='short_text') 
                {
            ?>
                <div class="form-group">
                  <label><?php echo $customize->label_customize ?></label>
                  <input type="hidden" class="form-control" name="label_cart_customize[]" value="<?php echo $customize->label_customize ?>">
                  <input type="hidden" class="form-control" name="type_cart_customize[]" value="<?php echo $customize->type_customize ?>">
                  <input type="text" class="form-control" name="content_cart_customize[]" id="label_customize" placeholder="<?php echo $customize->placeholder_customize ?>" required/>
                </div>
            <?php
                }
                else if($customize->type_customize=='long_text')
                {
            ?>
                <div class="form-group">
                  <label><?php echo $customize->label_customize ?></label>
                  <input type="hidden" class="form-control" name="label_cart_customize[]" value="<?php echo $customize->label_customize ?>">
                  <input type="hidden" class="form-control" name="type_cart_customize[]" value="<?php echo $customize->type_customize ?>">
                  <textarea class="form-control" rows="5" name="content_cart_customize[]" placeholder="<?php echo $customize->placeholder_customize ?>" required/></textarea>
                </div>
            <?php
                }
              }
            ?>
          <?php
            }
            if ($customize_rules_for_image) 
            {
            foreach ($customize_rules_for_image as $customize) {
            if($customize->type_customize=='image')
                {
            ?>
                <div class="form-group">
                  <label><?php echo $customize->label_customize ?></label>
                  <input type="hidden" class="form-control" name="label_cart_customize[]" value="<?php echo $customize->label_customize ?>">
                  <input type="hidden" class="form-control" name="type_cart_customize[]" value="<?php echo $customize->type_customize ?>">
                  <input type="file" id="image_cart" onclick="image_hide()" name="content_cart_customize[]" multiple accept="image/*" required="">
                  <b>*ukuran file maksimal 1 MB</b>
                </div>
                
            <?php
                }
              }
            }
            
          ?>

          <?php
            if ($packaging) 
            {
          ?>
          <label for="int">Tambahkan kemasan agar kadomu semakin lucu</label>
          <p>(kosongkan jika anda tidak ingin menambahkan kemasan)</p>
            <style type="text/css">
              .box-packing{
                margin: 0.5em 0 0.5em 0;
                border: 1px solid #D6D6D6;
                padding: 2px 5px 5px; 
              }
            </style>
                 
            <div class="col-md-12"><p><input type="radio" name=""><b> pesan tanpa kemasan</b></p></div>   
            <?php
            foreach ($packaging as $packaging) 
              {
            ?>           
              <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="box-packing">
                    <?php
                      if($packaging->gambar_packaging)
                        {
                    ?>
                      <img src="<?php echo base_url('uploads/images/packaging/'.$packaging->gambar_packaging) ?>" class="img-responsive" alt="<?php echo $packaging->nama_packaging ?>">
                    <?php
                      }
                    ?>
                    <p><?php echo "(+) Rp. ".$packaging->harga_packaging ?></p>
                  <input type="radio" name="id_packaging" value="<?php echo $packaging->id_packaging ?>"> pilih    
                </div>
              </div>
              <?php
                }
              }
              ?>
              <div class="form-group">
                <label>Catatan lainnya (opsional)</label>
                <textarea class="form-control" rows="5" name="catatan_lain" placeholder="tambahkan catatan tambahan mengenai pemesanan anda"></textarea>
              </div>
            <div class="clearfix"></div>
            </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"></i>cancel</button>
           <button type="submit" class="btn btn-primary" ><i class="fa fa-shopping-cart"></i>add to cart</button>
          </div>
          </form>
        </div>
    </div>

    <style type="text/css"> 
        /* Modal Header */
      .modal-header {
          padding: 6px 16px;
          background-color: #FFF;
          color: white;
      }

      /* Modal Footer */
      .modal-footer {
          padding: 2px 16px;
          background-color: #FFF;
          color: white;
      }
      </style>
    </div>
  </ul>
</div>
</div>
</div>


