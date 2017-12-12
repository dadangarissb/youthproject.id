       <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" >
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Pages</h4>

                        <ul>
                            <li><a href="">About us</a>
                            </li>
                            <li><a href="">Terms and conditions</a>
                            </li>
                            <li><a href="">FAQ</a>
                            </li>
                            <li><a href="">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="<?php echo base_url('member/register') ?>">Regiter</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Kategori</h4>
                        <ul>
                            <?php 
                                foreach ($kategori_footer as $kategori) 
                                {
                            ?>
                                <li><a href="<?php echo base_url('sort-by/kategori/'.str_replace(' ', '-', $kategori->nama_kategori)) ?>"><?php echo $kategori->nama_kategori ?></a></li>
                            <?php
                                }
                            ?>
                        </ul>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">
                        <h4>Alamat kami</h4>
                        <p><strong>Griya Campus Residence</strong>
                            <br>Surakarta
                        </p>
                        <hr class="hidden-md hidden-lg">
                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4>Dapatkan update !</h4>

                        <p class="text-muted">Dapatkan update tentang katalog produk terbaru kami, masukkan email anda.</p>

                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="email anda" disabled="">
                                <span class="input-group-btn" >
                                    <button class="btn btn-default" type="button" disabled="">Subscribe!</button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>
                        <h4>Ikuti sosial media kami</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2017 youthproject.id</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious</a> & <a href="https://fity.cz">Fity</a>
                         <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>





    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="<?php echo base_url('templates/frontend/js/jquery-1.11.0.min.js') ?>"></script>
    <script src="<?php echo base_url('templates/frontend/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('templates/frontend/js/jquery.cookie.js') ?>"></script>
    <script src="<?php echo base_url('templates/frontend/js/waypoints.min.js') ?>"></script>
    <script src="<?php echo base_url('templates/frontend/js/modernizr.js') ?>"></script>
    <script src="<?php echo base_url('templates/frontend/js/bootstrap-hover-dropdown.js') ?>"></script>
    <script src="<?php echo base_url('templates/frontend/js/owl.carousel.min.js') ?>"></script>
    <script src="<?php echo base_url('templates/frontend/js/front.js') ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('templates/frontend/plugins/datepicker/bootstrap-datepicker.js') ?>"></script>

</body>

</html>

<!-- <?php 
if($this->session->userdata('error_login')){ ?>
<script>
    $('#login-modal').modal('show');
</script>
<?php } ?> -->

<?php 
if($this->session->userdata('message_image_fail')){ ?>
<script type="text/javascript">
    $('#form_pemesanan').modal('show');
</script>
<?php } ?> 