<style type="text/css">
  body{
        background-color: #E8E9EC;
      }

  .dropzone {
      margin-top: 10px;
      border: 2px dashed #0087F7;
    }
</style>
<div class="row">
<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Form upload gambar produk</h3>
    </div>
    <div class="dropzone">
      <div class="dz-message">
       <h3 align="center">Klik atau Drop gambar disini</h3>
       <h5 align="center">(Ukuran gambar harus kurang dari 1 MB)</h5>
      </div>
      <input type="hidden" name="id_produk" id="id_produk" value="<?php  echo $id_produk; ?>">
    </div>  
    <br>
  </div>
</div>

<form action="<?php echo base_url('admin/Produk/add_packaging_product/'.$id_produk)?>" method="post">
<div class="col-md-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Tambahkan kemasan produk</h3>
    </div>
    <div class="box-body">
      <input type="hidden" name="id_produk" id="id_produk" value="<?php  echo $id_produk; ?>">
      <?php  
        foreach ($packaging as $packaging) 
        {
      ?>
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img style="width: 100%; display: block;" src="<?php echo base_url('uploads/images/packaging/'.$packaging->gambar_packaging) ?>" alt="<?php echo $packaging->nama_packaging ?>" />
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Nama</b> <a class="pull-right"><?php echo $packaging->nama_packaging; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Harga </b> <a class="pull-right"><?php echo number_format($packaging->harga_packaging); ?></a>
                </li>
              </ul>

              <input type="checkbox" name="id_packaging[]" value="<?php echo $packaging->id_packaging ?>"> Pilih kemasan
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> tambahkan customize</button>
</form>

<script type="text/javascript">

Dropzone.autoDiscover = false;
id_produk = document.getElementById("id_produk").value;
var foto= new Dropzone(".dropzone",{
url: "<?php echo base_url();?>admin/Produk/proses_upload/"+id_produk+"",
maxFilesize: 1,
method:"post",
acceptedFiles:"image/*",
paramName:"userfile",
dictInvalidFileType:"Type file ini tidak dizinkan",
addRemoveLinks:true,
});


//Event ketika Memulai mengupload
foto.on("sending",function(a,b,c){
  a.token=Math.random();
  c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
});


//Event ketika foto dihapus
foto.on("removedfile",function(a){
  var token=a.token;
  $.ajax({
    method:"post",
    data:{token:token},
    url:"<?php echo base_url('admin/Produk/remove_gambar') ?>",
    cache:false,
    dataType: 'json',
    success: function(){
      console.log("Foto terhapus");
    },
    error: function(){
      console.log("Error");

    }
  });
});



</script>
