<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        youthproject | deliver your happiness
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="keywords" content="kado wisuda, kado ulang tahun, kado pernikahan, souvenir pernikahan, kado anniversary, kenang-kenangan seminar, wisuda mahasiswa, kado unik, kado custom, kado murah, kado bagus, kado cepat jadi, talenan lukis, centong lukis, WPAP, vector, popart, mug lukis, notebook custom, notebook, kado vector, paper quiling" />

    <meta name="description" content="Kami menyediakan kado untuk momen spesial anda. Kado yang kami jual merupakan kado unik yang berbeda dari kado pada umumnya." />

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="<?php echo base_url('templates/frontend/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('templates/frontend/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('templates/frontend/css/animate.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('templates/frontend/css/owl.carousel.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('templates/frontend/css/owl.theme.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('templates/frontend/font-awesome-4.7.0/css/font-awesome.css') ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url('templates/frontend/plugins/datepicker/datepicker3.css') ?>">
    <!-- theme stylesheet -->
    <link href="<?php echo base_url('templates/frontend/css/style.default.css') ?>" rel="stylesheet" id="theme-stylesheet">
    <!-- your stylesheet with modifications -->
    <link href="<?php echo base_url('templates/frontend/css/custom.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url('templates/frontend/js/respond.min.js') ?>"></script>
    <link rel="shortcut icon" href="<?php echo base_url('templates/frontend/favicon.png') ?>">
</head>

<body>
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <!-- <div class="col-md-6 offer">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a>
            </div> -->
            <div class="col-md-12" >
                <ul class="menu">
                    <?php 
                        $sess_member    =$this->session->userdata('sess_member');
                        $id_member      =$sess_member['id_member']; 

                        if ($sess_member) 
                        {
                    ?>
                    <li><a href="<?php echo base_url('Login/logout'); ?>">Log out</a>
                    </li>
                    </li>
                    <li><a href="<?php echo base_url('member/my-order/'.$id_member); ?>">Konfirmasi pembayaran</a>
                    </li>
                    <?php 
                        }
                        else
                        {
                    ?>
                    <!-- <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li> -->
                    <li><a href="<?php echo base_url('member/login') ?>" >Login</a>
                    </li>
                    <li><a href="<?php echo base_url('member/register'); ?>">Register</a>
                    </li>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#konf_pembayaran_no_login">Konfirmasi pembayaran</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                    <?php 
                        $sess_member    =$this->session->userdata('sess_member');
                        $id_member      =$sess_member['id_member']; 

                        if($this->session->userdata('error_login'))
                        {
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <?php echo $this->session->userdata('error_login') ?>
                        </div>
                    <?php
                        }
                    ?>
                        <form name="frm" action="<?php echo base_url('member/login-action') ?>" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email-modal" placeholder="email" required="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="password-modal" placeholder="password" required="">
                            </div>

                            <p class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Belum punya akun?</p>
                        <p class="text-center text-muted"><a href="register.html"></a>Segera buat akunmu untuk mendapatkan tawaran spesial, diskon dan promo dari kami.</p>
                        <div align="center">
                        <a href="<?php echo base_url('member/register') ?>" class="btn btn-primary" style="color: white;">Daftar sebagai member baru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAL UNTUK LOGIN DETAIL PRODUK -->
        <div class="modal fade" id="login-modal-detail-produk" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                    <?php 
                        $sess_member    =$this->session->userdata('sess_member');
                        $id_member      =$sess_member['id_member']; 

                        if($this->session->userdata('error_login'))
                        {
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <?php echo $this->session->userdata('error_login') ?>
                        </div>
                    <?php
                        }
                        else if(!$sess_member)
                        { 
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <span class="text-danger">Maaf, anda harus login terlebih dahulu sebelum membeli produk!</span>
                        </div>
                    <?php
                        }
                    ?>
                        <form name="frm" action="<?php echo base_url('member/login-action') ?>" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email-modal" placeholder="email" required="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="password-modal" placeholder="password" required="">
                            </div>

                            <p class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Belum punya akun?</p>
                        <p class="text-center text-muted"><a href="register.html"></a>Segera buat akunmu untuk mendapatkan tawaran spesial, diskon dan promo dari kami.</p>
                        <div align="center">
                        <a href="<?php echo base_url('member/register') ?>" class="btn btn-primary" style="color: white;">Daftar sebagai member baru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODA KONFIRMASI PEMBAYARAN TANPA LOGIN-->
        <div class="modal fade" id="konf_pembayaran_no_login" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Konfirmasi pembayaran</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <span class="text-danger">Agar lebih mudah dalam konfirmasi pembayaran, sebaiknya anda login terlebih dahulu. Tetapi anda juga juga dapat melakukan konfirmasi tanpa login, dengan menginputkan kode transaksi / invoice pada form dibawah ini, kemudian pilih konfirmasi tanpa login.</span>
                        </div>
                        <form name="frm" action="<?php echo base_url('order/konfirmasi-tanpa-login') ?>" method="get">
                            <div class="form-group">
                                <input type="text" name="id_data_order" class="form-control" id="id_data_order" placeholder="Kode transaksi" required="">
                            </div>
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Konfirmasi tanpa login</button>
                            </p>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL KONFIRMASI PEMBAYARAN TANPA LOGIN-->
    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="<?php echo base_url('') ?>" data-animate-hover="bounce">
                    <img src="<?php echo base_url('templates/frontend/img/logo.png') ?>" alt="Obaju logo" class="hidden-xs">
                    <img src="<?php echo base_url('templates/frontend/img/logo-small.png') ?>" alt="Obaju logo" class="visible-xs"><span class="sr-only"> youthproject</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    
                    <?php
                        if($sess_member)
                        { 
                    ?>
                    <a href="<?php echo base_url('member/my-profile/'.$sess_member['id_member']) ?>" class="btn btn-default navbar-toggle">
                        <span class="sr-only">Toggle user</span>
                        <i class="fa fa-user-o"></i>
                    </a>
                    <?php
                        }
                    ?>
                    <a class="btn btn-default navbar-toggle" href="<?php echo base_url('member/my-cart') ?>">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-sm"> <?php echo $count_my_cart ?></span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Kategori <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <?php 
                                            foreach ($menu_kategori as $kategori) 
                                            {
                                        ?>
                                        <div class="col-sm-2">
                                            <h5>
                                               <a href="<?php echo base_url('sort-by/kategori/'.str_replace(' ', '-', $kategori->nama_kategori)) ?>"> <?php echo $kategori->nama_kategori;?>
                                               </a>
                                            </h5>
                                            <ul>
                                                <?php
                                                    foreach ($menu_subkategori as $subkategori) 
                                                    {
                                                        if ($subkategori->id_kategori==$kategori->id_kategori) 
                                                        {
                                                ?>
                                                    <li><a href="<?php echo base_url('sort-by/subkategori/'.str_replace(' ', '-', $subkategori->nama_subkategori)) ?>"><?php echo $subkategori->nama_subkategori ?></a>
                                                    </li>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">
                <?php 
                    if ($sess_member) {
                ?>
                    <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <a href="<?php echo base_url('member/my-profile/'.$sess_member['id_member']) ?>" class="btn navbar-btn btn-primary">
                        <span class="sr-only">Toggle user</span>
                        <i class="fa fa-user-o"></i>
                    </a>
                </div>
                <?php 
                    }
                ?>
                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="<?php echo base_url('member/my-cart/'.$id_member) ?>" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"> <?php echo $count_my_cart ?></span></a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <!--SEARCH FORM-->
            <div class="collapse clearfix" id="search">
                <form action="<?php echo base_url('search') ?>" class="navbar-form" role="search" method="get">
                    <div class="input-group">
                        <input type="text" name="keywords" placeholder="Search.." class="form-control" >
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
            <!--END SEARCH FORM-->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->