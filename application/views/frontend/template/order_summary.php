<div class="col-md-3">
            <div class="box" id="order-summary">
                <div class="box-header">
                    <h3>Order summary</h3>
                </div>
                <p class="text-muted">Ringkasan belanja anda adalah sebagai berikut</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Order subtotal</td>
                                <th>Rp. <?php echo number_format($total_harga,0,",","."); ?></th>
                            </tr>
                            <tr>
                                <td>Harga Packaging</td>
                                <th>Rp. <?php echo number_format($harga_packaging,0,",","."); ?></th>
                            </tr>
                            <tr>
                                <td>Berat total</td>
                                <th><?php echo number_format($berat_total,0,",",".")." gram"; ?></th>
                            </tr>
                            <tr>
                                <td>Ongkir</td>
                                <th><?php echo "Rp. " ?></th>
                            </tr>
                            <tr>
                                <td>Diskon</td>
                                <th><?php echo "Rp. " ?></th>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <th>Rp. <?php echo number_format($total_no_ongkir,0,",","."); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="box">
                <div class="box-header">
                    <h4>Coupon code</h4>
                </div>
                <p class="text-muted">Jika kamu mempunyai kode kupon, silahkan masukan disini</p>
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </form>
            </div>

        </div>
        <!-- /.col-md-3 -->