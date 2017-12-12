<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <h3 class="panel-title">Kado untuk</h3>
    </div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked category-menu">
            <li>
            	<a href="<?php echo base_url('all-products') ?>">All products</a>
                <?php
			    foreach ($tema as $tema) {
			    ?>
			    <a href="<?php echo base_url('kado-untuk/'.strtolower(str_replace(' ', '-', $tema->nama_tema))) ?>"><?php echo $tema->nama_tema ?></a>
			    
			    <?php
			    }
			    ?>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default sidebar-menu">

    <div class="panel-heading">
        <h3 class="panel-title">Filter by kategori</h3>
    </div>

    <div class="panel-body">
		<form id="checkbox_kat" method="get" action="<?php echo base_url('filter-by/kategori') ?>">
			<div class="form-group">
			 	<?php
              		foreach ($kategori as $kategori) {
            	?>
            	<div class="checkbox">
                <label><input type="checkbox" name="nama_kategori[]" onchange="btn_rules_kategori()" id="checkbox_kategori" value="<?php echo str_replace(' ', '-', $kategori->nama_kategori); ?>"><i></i><?php echo $kategori->nama_kategori ?></label>
                </div>
                <?php
                  }
                ?>
			</div>
			<script>
            function btn_rules_kategori()
             {
               $("#btn_disable_kategori").hide();
               $("#btn_ready_kategori").show();
             }
          	</script>
			<br>
			<div>
	            <button type="submit" id="btn_disable_kategori" disabled="">terapkan filter</button>
	            <button type="submit" id="btn_ready_kategori"  hidden="" >terapkan filter</button>
	        </div>
			</form>
    </div>
</div>
