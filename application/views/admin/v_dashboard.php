<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>150</h3>
        <p>New Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $count_jenis_produk ?></sup></h3>
        <p>Jenis produk</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="<?php echo base_url('admin/Produk') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo $count_member; ?></h3>
        <p>Member aktif</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3>65</h3>
        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>


<div class="col-md-5">
  <div class="box box-solid">
    <div class="box-header with-border">
      <div class="col-md-6">
        <h3 class="box-title">Home Carousel</h3>
      </div>
      <div class="col-md-6" style="text-align: right;">
        <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal_slider"><i class="fa fa-plus"></i> Tambah gambar</a> 
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php 
          $row=1;
          foreach ($slider as $slider) 
          {
            if ($row==1) 
            {
              $item='item active';
            }
            else{
              $item='item';
            }
          ?>
          <div class="<?php echo $item; ?>">
            <img src="<?php echo base_url('uploads/images/slider/'.$slider->gambar_slider) ?>">
          </div>
          
          <?php 
          $row++;
          }
          ?>
          <!-- <div class="carousel-caption">
              <?php echo $count; ?>
          </div> -->
          <!-- <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
        </ol> -->
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="fa fa-angle-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="fa fa-angle-right"></span>
        </a>
      </div>
       <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama slide</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $start = 0;
          foreach ($data_slider as $slider) 
          {
          ?>
          <tr>
            <td><?php echo ++$start ?></td>
            <td><?php echo $slider->nama_slider ?></td>
            <td>
                <div class="btn-group">
                  <button data-toggle="dropdown" 
                  <?php
                      if ($slider->status_slider=='aktif'){
                  ?>
                      class="btn btn-success dropdown-toggle btn-sm"
                  <?php
                      }
                      else{
                  ?> 
                      class="btn btn-danger dropdown-toggle btn-sm"
                  <?php
                  }
                  ?>
                      type="button" aria-expanded="false"><?php echo $slider->status_slider ?> <span class="caret"></span>
                  </button>
                  <!-- untuk pilihan pada dropddownnya  -->
                  <ul role="menu" class="dropdown-menu">
                  <?php 
                      if($slider->status_slider=='aktif'){
                  ?> 
                    <li><a href="<?php echo base_url('admin/Dashboard/slider_status/'.$slider->id_slider."/nonaktif") ?>">Non aktif</a>
                    </li>
                  <?php 
                      }
                      else {
                  ?>
                     <li><a href="<?php echo base_url('admin/Dashboard/slider_status/'.$slider->id_slider."/aktif") ?>">aktif</a>
                    </li>
                  <?php
                      }
                  ?>
                  </ul>
                </div>
            </td>
            <td style="text-align:center">
              <div class="btn-group">
                <a href="<?php echo base_url('admin/Dashboard/delete_slider/'.$slider->id_slider)?>" class="btn btn-social-icon "><i class="fa fa-trash-o"></i></a>
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
</div>


<!-- Modal -->
<div id="modal_slider" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambahkan gambar slider</h4>
      </div>
      <div class="modal-body">
      <!--  <h5>Some text in the modal.</h5> -->
      <?php 
        if ($this->session->userdata('message_danger')) 
        {
      ?>
        
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->userdata('message_danger') ?>
        </div>
      <?php
        }
      ?>
        <form action="<?php echo base_url('admin/Dashboard/add_slider_action'); ?>" enctype="multipart/form-data" method="post" >
        <input type="file" name="gambar_slider" placeholder="" required="">
        <br>
        <label>Nama Slider</label>
        <input type="text" class="form-control" name="nama_slider" placeholder="" required="">
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Tambahkan</button>
      </div>
      </form>
    </div>
  </div>
</div>



<style type="text/css"> 
/* Modal Header */
.modal-header {
padding: 6px 16px;
background-color: green;
color: white;
}

/* Modal Footer */
.modal-footer {
padding: 2px 16px;
background-color: #FFF;
color: white;
}
</style>      