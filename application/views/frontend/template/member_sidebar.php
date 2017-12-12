<ul class="nav nav-pills nav-stacked">
    <li class="<?php if($active_tab=='my_profile') {echo 'active'; } ?>">
        <a href="<?php echo base_url('member/my-profile/'.$id_member) ?>"><i class="fa fa-user"></i> My account</a>
    </li>
    <li class="<?php if($active_tab=='my_order') {echo 'active'; } ?>">
        <a href="<?php echo base_url('member/my-order/'.$id_member) ?>"><i class="fa fa-list"></i> My orders</a>
    </li>
    <!-- <li class="<?php echo $active_tab ?>">
        <a href="customer-wishlist.html"><i class="fa fa-heart"></i> My wishlist</a>
    </li> -->
    
    <li class="">
        <a href="index.html"><i class="fa fa-sign-out"></i> Logout</a>
    </li>
</ul>