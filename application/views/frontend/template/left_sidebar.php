<div class="rsidebar span_1_of_left">
  <section  class="sky-form">
   	<div class="product_right">
		<h3 class="m_2">Kado untuk ?</h3>
		<div class="w_nav1">
    		<ul>
			    <li><a href="<?php echo base_url('all-products') ?>">All Products</a></li>
			    <?php
			    foreach ($tema as $tema) {
			    ?>
			    <li><a href="<?php echo base_url('kado-untuk/'.strtolower(str_replace(' ', '-', $tema->nama_tema))) ?>"><?php echo $tema->nama_tema ?></a>
			    </li>
			    <?php
			    }
			    ?>
    		</ul>   
		</div>
    </div>
     			
    <section  class="sky-form">
		<h4>Filter by kategori</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
				<form id="checkbox_kat" method="get" action="<?php echo base_url('filter-by/kategori') ?>">
				 	<?php
                  		foreach ($kategori as $kategori) {
                	?>
	                <label class="checkbox"><input type="checkbox" name="nama_kategori[]" onchange="btn_rules_kategori()" id="checkbox_kategori" value="<?php echo str_replace(' ', '-', $kategori->nama_kategori); ?>"><i></i><?php echo $kategori->nama_kategori ?></label>
	                  
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
			</div>
			<br>
			<div>
	            <!-- <input type="submit" id="button"  name="submitButton" value="Terapkan filter" class="button1"> -->
	            <button type="submit" id="btn_disable_kategori" disabled="">terapkan filter</button>
	            <button type="submit" id="btn_ready_kategori" hidden="" >terapkan filter</button>
	        </div>
				 </form>
   </section>
   <br>
   <section  class="sky-form">
		<h4>Filter by subkategori</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
				<form id="checkbox_kat" method="get" action="<?php echo base_url('filter-by/subkategori') ?>">
				 	<?php
                  		foreach ($subkategori as $subkategori) {
                	?>
	                <label class="checkbox"><input type="checkbox" name="nama_subkategori[]" onchange="btn_rules_subkategori()" id="" value="<?php echo $subkategori->nama_subkategori; ?>"><i></i><?php echo $subkategori->nama_subkategori ?></label>
	                  
	                <?php
	                  }
	                ?>

	                <script>
		            function btn_rules_subkategori()
		             {
		               $("#btn_disable_subkategori").hide();
		               $("#btn_ready_subkategori").show();
		             }
		          	</script>
				</div>
			</div>
			<br>
			<div>
	            <!-- <input type="submit" id="button"  name="submitButton" value="Terapkan filter" class="button1"> -->
	            <button type="submit" id="btn_disable_subkategori" disabled="">terapkan filter</button>
	            <button type="submit" id="btn_ready_subkategori" hidden="" >terapkan filter</button>
	        </div>
				 </form>
   </section>
   <!-- <section  class="sky-form">
		<h4>Heel Height</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Flat (20)</label>
				</div>
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Under 1in(5)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>1in - 1 3/4 in(5)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>2in - 2 3/4 in(3)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>3in - 3 3/4 in(2)</label>
				</div>
			</div>
   </section>
   <section  class="sky-form">
		<h4>Price</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>$50.00 and Under (30)</label>
				</div>
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$100.00 and Under (30)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$200.00 and Under (30)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$300.00 and Under (30)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$400.00 and Under (30)</label>
				</div>
			</div>
   </section>
   <section  class="sky-form">
		<h4>Colors</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Red</label>
				</div>
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Green</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Black</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Yellow</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Orange</label>
				</div>
			</div>
   </section> -->
</div>