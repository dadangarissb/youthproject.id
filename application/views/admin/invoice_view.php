
<style type="text/css">
    
    @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
.page { width: 100%; height: 100%; }

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #DC143C;
    color: white;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


</style>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>invoice</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body class="page">
    <header class="clearfix">
      <!-- <div id="logo">
        <img src="<?php echo base_url('assets/images/logo_youth.JPG') ?>">
      </div> -->
      <div id="company">
        <h2 class="name">Youthproject.id</h2>
        <div>Jl. Ir Sutami 36 A. White & Wood cafe</div>
        <div>0856-9731-5491</div>
        <div><a href="">youthproject.office@gmail.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $nama_order ?></h2>
          <div class="address"><?php echo $no_hp ?> | <a><?php echo $email_order ?></a></div>
          <div class="address">Metode pengambilan : <?php echo $metode_pengambilan ?></div>
          <div class="address"><?php echo $alamat_order ?></div>
          <!-- <div class="address"><?php echo $provinsi.", ".$kabupaten.", ".$kecamatan; ?></div> -->
        </div>
        <div id="invoice">
            <h2 class="name" style="margin-top: -8px; ">KODE TRANSAKSI</h2>
          <h2 class="name" style="margin-top: -16px; margin-bottom: 6px; color:#DC143C"><?php echo $id_data_order ?></h2>
          <div class="date">Tanggal pemesanan: <?php echo $tanggal_order ?></div>
          <!-- <div class="date">Due Date: 30/06/2014</div> -->
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="3px">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="" style="text-align: center;">Nama Produk</th>
            <th class="unit" style="text-align: center;">Jumlah pesan</th>
            <th class="unit" style="text-align: center;">Harga satuan</th>
            <th class="unit" style="text-align: center;">Harga packaging</th>
            <th class="unit" style="text-align: center;">Berat produk</th>
            <th class="qty" style="text-align: center;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $start = 0;
            $subtotal=0;
            foreach ($detail_order as $produk) {
          ?>
          <tr>
            <td class="no"><?php echo ++$start ?></td>
            <td class="desc"><?php echo $produk->nama_produk ?></td>
            <td class="unit" style="text-align: center;"><?php echo $produk->jumlah_order ?></td>
            <td class="qty" style="text-align: right;"><?php echo "Rp. ".$produk->harga_produk ?></td>
            <td class="qty" style="text-align: right;"><?php echo "Rp. ".$produk->harga_packaging ?></td>
            <td class="qty" style="text-align: right;"><?php echo $produk->berat_produk." gram" ?></td>
            <td class="total" style="text-align: right;"><?php echo "Rp. ".$produk->subtotal ?></td>
          </tr>
          <?php
            $subtotal=$subtotal+$produk->subtotal;
            }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" style="text-align: right;">TOTAL</td>
            <td colspan="2" style="text-align: right;"><?php echo "Rp. ".$subtotal; ?></td>
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">BERAT TOTAL</td>
            <td colspan="1" style="text-align: right;"><?php echo $berat_total." gram"; ?></td>
           
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">ONGKIR (ONGKIR x BERAT TOTAL)</td>
            <td colspan="2" style="text-align: right;"><?php echo "Rp. ".$total_ongkir; ?></td>
          </tr>
          
          <tr>
            <td colspan="5" style="text-align: right;">GRAND TOTAL</td>
            <td colspan="2" style="text-align: right;"><?php echo "Rp. ".$grand_total; ?></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Silahkan bawa invoice ini untuk pengambilan barang (jika metode pengambilan barang langsung ke toko kami).</div>
      </div>
    </main>
    <footer>
      <!-- Invoice was created on a computer and is valid without the signature and seal. -->
    </footer>
  </body>
</html>