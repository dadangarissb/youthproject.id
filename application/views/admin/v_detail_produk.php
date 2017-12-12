<div class="row">
<div class="col-xs-7">
  <div class="box box-primary">
    <div class="box-header">
      <div class="col-md-12 text-left">
        <h3 class="box-title">Detail produk</h3>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="clearfix"></div>
          <table class="table">
            <tr><td width="180px;">Nama Produk</td><td><?php echo $produk->nama_produk; ?></td></tr>
            <tr><td>Kategori</td><td><?php echo $produk->nama_kategori; ?></td></tr>
            <tr><td>Subkategori</td><td><?php echo $produk->nama_subkategori; ?></td></tr>
            <tr><td>Tema</td><td><?php echo $produk->tema; ?></td></tr>
            <tr><td>Berat produk</td><td><?php echo $produk->berat_produk." gram"; ?></td></tr>
            <tr><td>Harga produk</td><td><?php echo "Rp. ".number_format($produk->harga_produk,0,',','.'); ?></td></tr>
            <tr><td>Status</td>
                <td>
                <div class="btn-group">
                  <button data-toggle="dropdown" 
                  <?php
                    if ($produk->status_produk=='aktif')
                    {
                  ?>
                    class="btn btn-success dropdown-toggle btn-sm"
                  <?php
                    }
                    else
                    {
                  ?> 
                    class="btn btn-danger dropdown-toggle btn-sm"
                  <?php
                    }
                  ?>
                    type="button" aria-expanded="false"><?php echo $produk->status_produk ?> <span class="caret"></span>
                  </button>

                  <!--untuk pilihan pada dropddownnya -->
                  <ul role="menu" class="dropdown-menu">
                  <?php 
                    if($produk->status_produk=='aktif')
                    {
                  ?> 
                    <li><a href="<?php echo base_url('admin/Produk/update_status_produk/'.$produk->id_produk.'/nonaktif') ?>">Non aktif</a>
                    </li>
                  <?php 
                    }
                    else 
                    {
                  ?>
                    <li><a href="<?php echo base_url('admin/Produk/update_status_produk/'.$produk->id_produk.'/aktif') ?>">aktif</a>
                    </li>
                  <?php
                    }
                  ?>
                  </ul>
                </div>
                </td>
            </tr>
            <tr><td>Deskripsi produk</td><td><?php echo $produk->deskripsi_produk; ?></td></tr>
          </table>
        </div>
      </div>
    </div>
    <a href="<?php echo base_url('admin/Produk') ?>" class="btn btn-warning"><i class="fa fa-undo"></i> kembali</a>
  </div>


<div class="col-xs-5">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <h4 align="center">Thumbnail</h4>
        <div class="box-body box-profile">
            <img style="width: 100%; display: block;" src="<?php echo base_url('uploads/images/thumbnails/'.$produk->thumbnail); ?>" alt="image" />
        </div>
      </div>
    </div>

      <?php 
       if(empty($gambar_produk))
        { 
      ?> 
      <div class="col-md-12">
       <h4><?php echo "anda hanya menambahkan thumbnail dan belum menambahkan gambar untuk produk ".$produk->nama_produk;?> </h4>
       <a href="<?php echo base_url('admin/produk/upload_gambar_produk/'.$produk->id_produk)?>" class="btn btn-primary"><i class="fa fa-plus"></i> tambahkan gambar</a>
       </div>
       <?php 
        } 
       else 
       {
          foreach ($gambar_produk as $gambar) 
          {
        ?>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <div class="col-md-12 text-left">
                <h4 style="text-align: center;">Gambar produk</h4>
              </div>
            </div>
            <div class="box-body">
              <div class="col-md-6">
                <div class="box-body box-profile">
                  <img style="width: 100%; display: block;" src="<?php echo base_url('uploads/images/gambar_produk/'.$gambar->nama_gambar_produk); ?>" alt="image" />
                </div>
            </div>
          </div> 
        </div>
        <?php
            }
          }
        ?>
      </div>
    </div>
  </div>
