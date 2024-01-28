<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">halaman</span> Transaksi</h4>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Data Kiloan</h4>
                        <p class="card-description">
                            Basic form elements
                        </p>
                        <form name="form_add_transaksi" action="<?php echo base_url() . 'transaksi/add' ?>" method="post" class="user needs-validation mx-3 mb-4">
                            <div class="form-group">
                                <label class="control-label text-primary">Customer</label>
                                <select class="form-control js-example-basic-single" name="pelanggan_id" required>
                                    <option value="">--Please Select--</option>
                                    <?php
                                    foreach ($data_pelanggan as $pelanggan) {
                                    ?>
                                        <option value="<?php echo $pelanggan->pelanggan_id ?>">
                                            <?php echo $pelanggan->pelanggan_id . ' ' . $pelanggan->nama_pelanggan ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Choose a customer identity!
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label class="control-label text-primary">Employee</label>
                                <select class="form-control js-example-basic-single" name="karyawan_id" required>
                                    <option value="">--Please Select--</option>
                                    <?php
                                    foreach ($data_karyawan as $karyawan) {
                                        if ($karyawan->aktif == 1) {
                                    ?>
                                            <option value="<?php echo $karyawan->karyawan_id ?>">
                                                <?php echo $karyawan->karyawan_id . ' ' . $karyawan->nama_karyawan ?>
                                            </option>
                                    <?php }
                                    } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Choose employee identity!
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label class="control-label text-primary">Tipe</label>
                                <select class="form-control js-example-basic-single" name="tipe" required>
                                    <option value="kiloan">Kiloan</option>
                                    <option value="satuan">Satuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Choose employee identity!
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label class="control-label text-primary">Jenis Layanan</label>
                                <select class="form-control js-example-basic-single" name="jenislayanan" required>
                                    <option value="">--Please Select--</option>
                                    <?php
                                    foreach ($layanan as $layanan) {
                                        $lay = $layanan->harga == 1 ? $layanan->jenis . ' ' . '(Tidak Dikenakan Biaya tambahan)' : $layanan->jenis . ' ' . $layanan->harga . '(X)'
                                    ?>
                                        <option value="<?php echo $layanan->id_layanan ?>">
                                            <?php echo $lay ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Choose employee identity!
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label class="control-label text-primary">Layanan Order</label>
                                <select class="form-control js-example-basic-single" name="tipecuci" required>
                                    <option value="">--Please Select--</option>
                                    <?php
                                    foreach ($order as $order) {
                                    ?>
                                        <option value="<?php echo $order->id_kilo ?>">
                                            <?php echo $order->jenis . ' (Rp.' . number_format($order->harga, 0, ',', '.') . ')' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Choose employee identity!
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary">Qty</label>
                                <input type="number" class="form-control" placeholder='Laundry Weight' name="berat" required>
                                <div class="invalid-feedback">
                                    Fillup Laundry Weight!
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary">Diskon</label>
                                <input type="number" class="form-control" placeholder='Laundry Diskon' name="diskon" min="0" max="100" step="any" required>
                                <div class="invalid-feedback">
                                    Fillup Laundry Weight!
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary">Order Date</label>
                                <input type="date" class="form-control" placeholder='Laundry Order Date' name="tgl_order" required>
                                <div class="invalid-feedback">
                                    Fill in the date of the laundry order!
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary">Finished Date</label>
                                <input type="date" class="form-control" placeholder='Finished Date' name="tgl_selesai">
                            </div>
                            <a href="<?= base_url('transaksi') ?>" class="btn btn-light">Cancel</a>
                            <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>