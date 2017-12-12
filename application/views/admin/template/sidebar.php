<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin youthproject</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="<?php echo base_url('admin/Dashboard') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('admin/Produk') ?>">
          <i class="fa fa-th"></i> <span>Produk</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('admin/order/list') ?>">
          <i class="fa fa-cart-plus"></i> <span>Order</span>
          <span class="pull-right-container">
            <?php
                $count_order  =$this->Order_model->count_new_order();
                if ($count_order>0) {
            ?>
            <small class="label pull-right bg-green">
            <?php
                  echo $count_order;
                }
            ?>
            </small>
          </span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('admin/konfirmasi-pembayaran/list') ?>">
          <i class="fa fa-money"></i> <span>Konf. pembayaran</span>
          <span class="pull-right-container">
            <?php
                $count_konfirmasi  =$this->Konf_pembayaran_model->count_konfirmasi_pembayaran();
                if ($count_konfirmasi>0) {
            ?>
                  <small class="label pull-right bg-green">
            <?php
                  echo $count_konfirmasi;
                }
            ?>
          </small>
          </span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('admin/Packaging') ?>">
          <i class="fa fa-gift"></i> <span>Packaging</span>
        </a>
      </li>
      
      
  </section>
  <!-- /.sidebar -->
</aside>