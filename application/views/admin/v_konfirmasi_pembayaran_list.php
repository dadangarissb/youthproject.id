<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?php if($aktif=='tab_belum') {echo 'active';} ?>"><a href="#tab_1" data-toggle="tab">Proses konfirmasi</a></li>
        <li class="<?php if($aktif=='tab_sudah') {echo 'active';} ?>"><a href="#tab_2" data-toggle="tab">Selesai konfirmasi [ <?php echo count($konf_bayar_selesai) ?> ]</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?php if($aktif=='tab_belum') {echo 'tab-pane active';} else {echo "tab-pane";} ?>" id="tab_1">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data konfirmasi pembayaran</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Transaksi</th>
                  <th>Tanggal pembayaran</th>
                  <th>Status Pembayaran</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($konf_bayar as $konfirmasi) {
                ?>
                <tr>
                  <td>1</td>
                  <td><?php echo $konfirmasi->id_data_order; ?></td>
                  <td><?php echo $konfirmasi->tanggal_pembayaran; ?></td>
                  <td>
                  <?php 
                  if ($konfirmasi->status_konfirmasi=='belum bayar') {
                  ?>
                       <div class="label bg-red"><?php echo $konfirmasi->status_konfirmasi ?></div>
                  <?php
                  }
                  elseif ($konfirmasi->status_konfirmasi=='menunggu konfirmasi') {
                  ?>
                       <div class="label bg-blue"><?php echo $konfirmasi->status_konfirmasi ?></div>
                  <?php
                  }
                  elseif ($konfirmasi->status_konfirmasi=='sudah bayar') {
                  ?>
                       <div class="label bg-green"><?php echo $konfirmasi->status_konfirmasi ?></div>
                  <?php
                  }
                  ?>
                  </td>
                  <td style="text-align:center">
                      <div class="btn-group">
                        <?php 
                        echo anchor(site_url('admin/konfirmasi-pembayaran/read/'.$konfirmasi->id_konfirmasi),'Lihat detail','class="btn btn-primary btn-sm btn-flat" '); 
                        ?>
                      </div>
                  </td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="<?php if($aktif=='tab_sudah') {echo 'tab-pane active';} else {echo "tab-pane";} ?>" id="tab_2">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data pembayaran terkonfirmasi</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Transaksi</th>
                  <th>Tanggal pembayaran</th>
                  <th>Status Pembayaran</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($konf_bayar_selesai as $konfirmasi) {
                ?>
                <tr>
                  <td>1</td>
                  <td><?php echo $konfirmasi->id_data_order; ?></td>
                  <td><?php echo $konfirmasi->tanggal_pembayaran; ?></td>
                  <td>
                  <?php 
                  if ($konfirmasi->status_konfirmasi=='belum bayar') {
                  ?>
                       <div class="label bg-red"><?php echo $konfirmasi->status_konfirmasi ?></div>
                  <?php
                  }
                  elseif ($konfirmasi->status_konfirmasi=='menunggu konfirmasi') {
                  ?>
                       <div class="label bg-blue"><?php echo $konfirmasi->status_konfirmasi ?></div>
                  <?php
                  }
                  elseif ($konfirmasi->status_konfirmasi=='sudah bayar') {
                  ?>
                       <div class="label bg-green"><?php echo $konfirmasi->status_konfirmasi ?></div>
                  <?php
                  }
                  ?>
                  </td>
                  <td style="text-align:center">
                      <div class="btn-group">
                        <?php 
                        echo anchor(site_url('admin/konfirmasi-pembayaran/read/'.$konfirmasi->id_konfirmasi),'Lihat detail','class="btn btn-primary btn-sm btn-flat" '); 
                        ?>
                      </div>
                  </td>
                </tr>
                <?php
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
              <h3 class="box-title">Data Produk</h3>
              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_subkategori"><i class="fa fa-plus"></i> Tambah subkategori</button>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode</th>
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
                  <td><?php echo $subkategori->kode_subkategori; ?></td>
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
              <h3 class="box-title">Data Produk</h3>
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
