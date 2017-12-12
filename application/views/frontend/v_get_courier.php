<script src="<?php echo base_url('templates/frontend/js/jquery-1.11.0.min.js') ?>"></script>

<script>
    function tampil_data(act){
          // var w = $('#origin').val();
          var x = $('#kota').val();
          var y = $('#berat').val();
          var z = $('#courier').val();

          $.ajax({
              url: "<?php echo base_url(); ?>/Member/get_cost",
              type: "GET",
              data : {kota: x, berat: y, courier: z},
              success: function (ajaxData){
                  //$('#tombol_export').show();
                  //$('#hasilReport').show();
                  $("#hasil").html(ajaxData);
              }
          });
      };
</script>