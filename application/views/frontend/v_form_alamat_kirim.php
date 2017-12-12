
<select class="form-control" name="provinsi_tujuan" id="provinsi_tujuan">
    <option value="" selected="" disabled="">Pilih Provinsi</option>
    <?php
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
          
          $data = json_decode($response, true);
          //echo json_encode($k['rajaongkir']['results']);

          
          for ($i=0; $i < count($data['rajaongkir']['results']); $i++){
          
            echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
          }

        }
    ?>
</select>
<br>
<select class="form-control" name="kota" id="kota">
    <option value="" selected="" disabled="">Pilih Kota</option>
</select>
<br>

<!-- <select class="form-control" name="courier" onchange="tampil_data('data')" id="courier" required="">
    <option value="">Pilih Kurir</option>
    <option value="jne">JNE</option>
    <option value="pos">POS</option>
    <option value="tiki">TIKI</option>
</select> -->
<br>
<div id="hasil">

</div>
<!-- <button type="button" onclick="tampil_data('data')" class="btn btn-info">Cek Ongkir</button> -->

                                
<script src="<?php echo base_url('templates/frontend/js/jquery-1.11.0.min.js') ?>"></script>

<script>
$(document).ready(function(){

    $("#provinsi_tujuan").click(function(){
        $.post("<?php echo base_url(); ?>/Member/get_kota/"+$('#provinsi_tujuan').val(),
          function(obj){
            $('#kota').html(obj);
        });
            
    });

    $("#kota").click(function(){
        $.post("<?php echo base_url(); ?>/Member/get_courier",
          function(obj){
            $('#courier').html(obj);
        });
            
    });


    /*
    $("#cari").click(function(){
        $.post("<?php echo base_url(); ?>index.php/rajaongkir/getCost/"+$('#origin').val()+'&dest='+$('#destination').val()+'&berat='+$('#berat').val()+'&courier='+$('#courier').val(),function(obj){
            $('#hasil').html(obj);
        });
    });

    */
    
});
</script>
