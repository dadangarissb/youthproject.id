<div class="row">
  <div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">form tambah produk</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
          <label for="heard">Subkategori </label>
          <?php
            foreach($dd_subkategori as $row)
              {
                $options1[$row->id_subkategori] = $row->nama_subkategori;
              }                              
              echo form_dropdown('id_subkategori', $options1, '', 'class="form-control"');
          ?>
        </div>
        <div class="form-group" id="nama_produk">
          <label for="varchar">Nama Produk <?php echo form_error('nama_produk') ?></label>
          <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" required="" />
        </div>
        <div class="form-group" id="nama_produk">
          <label for="varchar">Slug <?php echo form_error('slug') ?></label>
          <input type="text" class="form-control" name="slug" placeholder="slug" required="" />
        </div>
        <div class="form-group">
          <label for="varchar">Thumbnail <?php echo form_error('thumbnail') ?></label>
          <input type="file" name="thumbnail" required="">
        </div>
        <div class="form-group">
            <label for="varchar">Tema produk <?php echo form_error('tema_produk') ?></label>
            <br>
            <?php foreach ($tema as $tema) {
            ?>
            <input type="checkbox" name="nama_tema[]" value="<?php echo $tema->nama_tema?>"  > <?php echo $tema->nama_tema?>
            <br>
            <?php
            }
            ?>
        </div>
        <label>Deskripsi produk</label>
           <?php echo $this->ckeditor->editor('deskripsi_produk','');?>
          <br>
        <div class="form-group" id="berat_produk">
            <label for="varchar">Berat Produk (gram) <?php echo form_error('berat_produk') ?></label>
            <input type="text" class="form-control" name="berat_produk" placeholder="Berat Produk" required="" />
        </div>
        <div class="form-group" id="nama_produk">
            <label for="varchar">Harga Produk <?php echo form_error('harga_produk') ?></label>
            <input type="text" class="form-control" name="harga_produk" placeholder="Harga Produk" required="">
        </div>
        
        <div class="form-group">
          <label>Kata kunci pencarian</label>
          <textarea rows="4" name="keyword" class="form-control" required=""></textarea>
        </div>  
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-success">Submit</button> 
        <a href="<?php echo site_url('admin/produk') ?>" class="btn btn-default">Cancel</a>
      </div>
    </form>
</div>
</div>
