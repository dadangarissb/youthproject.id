<?php 
    if($modal_form=='aktif')
    { 
?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#modal_form_packaging").modal('show');
        });
    </script>                      
<?php 
} 
?>

<div class="row">
  <div class="col-md-12">
    <?php 
      if ($this->session->userdata('message_success')) 
      {
    ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->userdata('message_success') ?>
        </div>
    <?php
       }
    ?>
    <div class="col-md-12 text-left" style="margin-bottom: 10px;">
        <button type="button" id="btnjoss" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal_form_packaging">[+] Tambah kemasan</button>
    </div>
      
    <?php
    foreach ($packaging as $packaging) 
    {
    ?>
        <div class="col-md-3">
            <div class="box box-default">
                <div class="box-body box-profile">
                    <img style="width: 100%; display: block;" src="<?php echo base_url('uploads/images/packaging/'.$packaging->gambar_packaging) ?>" alt="<?php echo $packaging->nama_packaging ?>" />
                    <br>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <?php echo $packaging->nama_packaging; ?>
                        </li>
                        <li class="list-group-item">
                        <?php echo "Rp. ".number_format($packaging->harga_packaging); ?>
                        </li>
                        <li class="list-group-item">
                        <div class="btn-group">
                            <button data-toggle="dropdown" 
                                <?php
                                    if ($packaging->status_packaging=='aktif')
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
                                    type="button" aria-expanded="false"><?php echo $packaging->status_packaging ?> 
                                    <span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu">
                            <?php 
                                if($packaging->status_packaging=='aktif'){
                            ?> 
                              <li><a href="<?php echo base_url('admin/Packaging/status_packaging/'.$packaging->id_packaging.'/nonaktif') ?>">Non aktif</a>
                              </li>
                            <?php 
                                }
                                else {
                            ?>
                                <li><a href="<?php echo base_url('admin/Packaging/status_packaging/'.$packaging->id_packaging.'/aktif') ?>">aktif</a>
                              </li>
                            <?php
                                }
                            ?>
                            </ul>
                        </div>    
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <!--end row-->


<!-- MODAL FORM KEMASAN -->
<!-- <div id="modalSuccess"> -->
<div class="modal fade" id="modal_form_packaging" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: green; color: white;">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Form tambah kemasan</h4>
            </div>
            <div class="modal-body">
              <!-- <h4>Text in a modal</h4> -->
              <div class="row">
              <form action="<?php echo base_url('admin/Packaging/create_action'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="varchar">Nama kemasan <?php echo form_error('nama_packaging') ?></label>
                    <input type="text" class="form-control" name="nama_packaging"  placeholder="Nama kemasan" required="">
                </div>
                <div class="form-group">
                    <label for="double">Harga kemasan <?php echo form_error('harga_packaging') ?></label>
                    <input type="text" class="form-control" name="harga_packaging" placeholder="Harga kemasan"  required="">
                </div>
                <div class="form-group">
                    <label for="varchar">Gambar kemasan <?php echo form_error('gambar_packaging') ?></label>
                    <input type="file" name="gambar_packaging" required="">
                    <br>
                </div>
            </div>
     
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-flat">Submit</button> 
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
</div>
