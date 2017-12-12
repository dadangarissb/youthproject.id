<div class="col-md-3 span_1_of_right">
  <h3 class="m_2">Kado untuk ?</h3>
  <div class="w_nav1">
    <ul>
      <li><a href="<?php echo base_url('all-products') ?>">All Products</a></li>
    </ul>   
  </div>
  
  <section  class="sky-form">
    <h4>Jenis Produk</h4>
      <div class="row row2 scroll-pane">
        <div class="w_nav1">
            <ul>
              <?php
              foreach ($kategori as $kategori) {
              ?>
              <li><a href="<?php echo base_url('sort-by/kategori/'.$kategori->nama_kategori) ?>"><?php echo $kategori->nama_kategori ?></a>
              </li>
              <?php
              }
              ?>
            </ul>
        </div>
      </div>
  </section>
</div>