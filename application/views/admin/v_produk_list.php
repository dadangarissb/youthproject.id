<div class="row">
  <div class="col-md-12">
  <?php 
  if ($this->session->userdata('message_success')) {
  ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?php echo $this->session->userdata('message_success') ?>
    </div>
  <?php
    }
    elseif($this->session->userdata('message_danger')) {
  ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?php echo $this->session->userdata('message_danger') ?>
    </div>
  <?php
    }
  ?>

  
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?php if($aktif=='tab_produk') {echo 'active';} ?>"><a href="#tab_1" data-toggle="tab">Produk</a></li>
        <li class="<?php if($aktif=='tab_kategori') {echo 'active';} ?>"><a href="#tab_2" data-toggle="tab">Kategori</a></li>
        <li class="<?php if($aktif=='tab_subkategori') {echo 'active';} ?>"><a href="#tab_3" data-toggle="tab">Subkategori</a></li>
        <li class="<?php if($aktif=='tab_tema') {echo 'active';} ?>"><a href="#tab_4" data-toggle="tab">Tema</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?php if($aktif=='tab_produk') {echo 'tab-pane active';} else {echo "tab-pane";} ?>" id="tab_1">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Produk [ <?php echo count($produk); ?> ]</h3>
              <a href="<?php echo base_url('admin/Produk/insert') ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Tambah produk
              </a>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Kategori</th>
                  <th>Subkategori</th>
                  <th>Berat</th>
                  <th>Harga</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $number =1;
                  foreach ($produk as $produk) 
                  {
                ?>
                <tr>
                  <td><?php echo $number; ?></td>
                  <td><?php echo $produk->nama_produk; ?></td>
                  <td><?php echo $produk->nama_kategori; ?></td>
                  <td><?php echo $produk->nama_subkategori; ?></td>
                  <td><?php echo number_format($produk->berat_produk,0,',','.')." gram" ?></td>
                  <td><?php echo "Rp. ".number_format($produk->harga_produk,0,',','.') ?></td>
                  <td>
                    <?php 
                      if ($produk->status_produk=='aktif') {
                        $class = 'btn btn-success btn-xs';
                        $action= 'nonaktif';
                      } else {
                        $class = 'btn btn-danger btn-xs';
                        $action= 'aktif';
                      }
                    ?>
                    <div class="btn-group">
                      <button type="button" class="<?php echo $class; ?>"><?php echo $produk->status_produk ?></button>
                    </div>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/produk/detail/'.$produk->id_produk) ?>"><i class="fa fa-eye"></i> lihat</a>
                  </td>
                </tr>
                <?php
                  $number++;
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="<?php if($aktif=='tab_kategori') {echo 'tab-pane active';} else {echo "tab-pane";} ?>" id="tab_2">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kategori [ <?php echo count($kategori); ?> ]</h3>
              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_kategori"><i class="fa fa-plus"></i> Tambah kategori</button>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th style="width: 30px;">No</th>
                  <th>Nama Kategori</th>
                  <th>Jumlah Subkategori</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach ($kategori as $kategori) {
                ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $kategori->nama_kategori ?></td>
                  <td>
                    <?php 
                      $jumlah =0;
                      foreach ($subkategori as $sub) {
                      if ($kategori->id_kategori==$sub->id_kategori) {
                        $jumlah=$jumlah+1;
                      }
                      }
                      echo $jumlah."  subkategori";
                    ?>
                  </td>
                </tr>
                <?php
                  $no++;
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="<?php if($aktif=='tab_subkategori') {echo 'tab-pane active';} else {echo "tab-pane";} ?>" id="tab_3">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Subkategori [ <?php echo count($subkategori); ?> ]</h3>
              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_subkategori"><i class="fa fa-plus"></i> Tambah subkategori</button>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Subkategori</th>
                  <th>Nama Kategori</th>
                  <th style="width: 100px;">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  foreach ($subkategori as $subkategori) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $subkategori->nama_subkategori; ?></td>
                  <td><?php echo $subkategori->nama_kategori; ?></td>
                  <td>
                    <?php 
                      if ($subkategori->status_subkategori=='aktif') {
                        $class = 'btn btn-success btn-xs';
                        $action= 'nonaktif';
                      } else {
                        $class = 'btn btn-danger btn-xs';
                        $action= 'aktif';
                      }
                    ?>
                    <div class="btn-group">
                      <button type="button" class="<?php echo $class; ?>"><?php echo $subkategori->status_subkategori ?></button>
                      <button type="button" class="<?php echo $class; ?>" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><?php echo $action; ?></a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php
                  $no++;
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="<?php if($aktif=='tab_tema') {echo 'tab-pane active';} else {echo "tab-pane";} ?>" id="tab_4">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Tema [ <?php echo count($tema); ?> ]</h3>
              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_tema"><i class="fa fa-plus"></i> Tambah tema</button>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Tema</th>
                  <th style="width: 100px;">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  foreach ($tema as $tema) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $tema->nama_tema; ?></td>
                  <td>
                    <?php 
                      if ($tema->status_tema=='aktif') {
                        $class = 'btn btn-success btn-xs';
                        $action= 'nonaktif';
                      } else {
                        $class = 'btn btn-danger btn-xs';
                        $action= 'aktif';
                      }
                    ?>
                    <div class="btn-group">
                      <button type="button" class="<?php echo $class; ?>"><?php echo $tema->status_tema ?></button>
                      <button type="button" class="<?php echo $class; ?>" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><?php echo $action; ?></a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php
                  $no++;
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->


<!-- MODAL FORM TAMBAH KATEGORI -->
<div class="modal fade" id="modal_kategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/Produk/insert_kategori') ?>" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">form tambah kategori</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama kategori</label>
          <input type="text" class="form-control" name="nama_kategori" placeholder="nama kategori" required="">
        </div>
        <div class="form-group">
          <label>Gambar/icon kategori</label>
          <input type="file" class="" name="gambar_kategori" placeholder="gambar kategori" required="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL FORM TAMBAH TEMA -->
<div class="modal fade" id="modal_tema">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/Produk/insert_tema') ?>" method="GET">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">form tambah tema</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama tema</label>
          <input type="text" class="form-control" name="nama_tema" placeholder="nama tema" required="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL FORM TAMBAH SUBKATEGORI -->
<div class="modal fade" id="modal_subkategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/Produk/insert_subkategori') ?>" method="GET">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">form tambah subkategori</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama subkategori</label>
          <input type="text" class="form-control" name="nama_subkategori" placeholder="nama subkategori" required="">
        </div>
        <div class="form-group">
          <label>Parent kategori</label>
          <?php
            $style = 'class="form-control"';
            foreach ($dd_kategori as $row) {
                $options[$row->id_kategori] = $row->nama_kategori;
            }
            echo form_dropdown('id_kategori', $options, '',$style);

          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>