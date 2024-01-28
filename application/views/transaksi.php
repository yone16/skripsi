<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">halaman</span> Transaksi</h4>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h4 class="my-auto font-weight-bold text-primary">Transaksi Data Per-Kiloan</h4>
                    <a href="<?= base_url('transaksi/tambahKiloan') ?>" class="btn btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-500"></i> Buat Transaksi</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-primary">
                                    <th>#</th>
                                    <th>ID Transaksi</th>
                                    <th>Pelanggan</th>
                                    <th>Karyawan</th>
                                    <th>Berat</th>
                                    <th>Jenis</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Order</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                    <th>Print</th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_transaksi as $transaksi) {

                                    if ($transaksi->status == 'menunggu') {
                                        $sts = 'danger';
                                        $persen = '25';
                                        $txt = 'Menunggu dikerjakan';
                                    } else if ($transaksi->status == 'dikerjakan') {
                                        $sts = 'warning';
                                        $persen = '50';
                                        $txt = 'Sedang dikerjakan';
                                    } else if ($transaksi->status == 'selesai') {
                                        $sts = 'primary';
                                        $persen = '75';
                                        $txt = 'Selesai Dikerjakan';
                                    } else if ($transaksi->status == 'diantar') {
                                        $sts = 'info';
                                        $persen = '90';
                                        $txt = 'Sedang diantar';
                                    } else if ($transaksi->status == 'sampai') {
                                        $sts = 'success';
                                        $persen = '100';
                                        $txt = 'Sudah diterima';
                                    }

                                    if ($transaksi->jenis_layanan == 'satuan') {
                                        $yey = 'transaksi/print2/';
                                    } else {
                                        $yey = 'transaksi/print/';
                                    }
                                ?>
                                    <tr>
                                        <th><?php echo $no++ ?></th>
                                        <td>
                                            <?php if ($transaksi->tgl_selesai == '0000-00-00') { ?>
                                                <span class="badge badge-danger">Not Finished Yet</span><br>
                                            <?php }
                                            echo $transaksi->transaksi_id;
                                            ?>
                                        </td>
                                        <td>
                                            <!-- <span class="row px-3 text-primary text-xs"><?php echo $transaksi->pelanggan_id ?></span> -->
                                            <span class="row px-3"><?php echo $transaksi->nama_pelanggan ?></span>
                                        </td>
                                        <td>
                                            <!-- <span class="row px-3 text-primary text-xs"><?php echo $transaksi->karyawan_id ?></span> -->
                                            <span class="row px-3"><?php echo $transaksi->nama_karyawan ?></span>
                                        </td>
                                        <td><?php echo ($transaksi->jenis_layanan == 'kiloan') ? $transaksi->berat . ' Kg' : $transaksi->berat . ' Item' ?></td>
                                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#showDetail<?php echo $transaksi->transaksi_id ?>"><span class="badge <?= ($transaksi->jenis_layanan === 'kiloan') ? 'bg-primary text-white' : 'bg-danger text-white' ?>"><?php echo $transaksi->jenis_layanan ?></span></a></td>
                                        <td><span class="badge bg-success"><?php echo number_format($transaksi->diskon, 0, '.', ',') ?>%</span></td>
                                        <td>Rp. <?php echo number_format($transaksi->total, 0, '.', ',') ?></td>
                                        <td><?php echo $transaksi->tgl_order ?></td>
                                        <td><?php if ($transaksi->tgl_selesai == '0000-00-00') {
                                                echo '-';
                                            } else {
                                                echo $transaksi->tgl_selesai;
                                            } ?></td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#statusKiloan<?php echo $transaksi->transaksi_id ?>" class="btn btn-<?= $sts; ?> text-white"><?php echo $txt; ?>
                                            </a>
                                            <div class="progress mt-2">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-<?= $sts; ?>" role="progressbar" aria-valuenow="<?= $persen; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persen; ?>%"><?= $persen; ?>%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-info text-white" href="<?php echo base_url() . $yey . $transaksi->transaksi_id ?>" target="__blank"><i class="bx bx-printer me-1"></i></a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTransaksi<?php echo $transaksi->transaksi_id ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="<?php echo base_url() . 'transaksi/delete/' . $transaksi->transaksi_id ?>" onclick="return confirm(`Apakah anda yakin ingin menghapus data transaksi ini?`)"><i class="bx bx-trash me-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal for adding new data -->

<div class="modal fade" id="addTransaksiKiloan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddTransaksi" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddTransaksiLabel">Input Transaction Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="form_add_transaksi" action="<?php echo base_url() . 'transaksi/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="tttt" value="kiloan">
                        <label class="control-label text-primary">Customer</label>
                        <select class="form-control" name="pelanggan_id" required>
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

                    <div class="form-group">
                        <label class="control-label text-primary">Employee</label>
                        <select class="form-control" name="karyawan_id" required>
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

                    <div class="form-group">
                        <label class="control-label text-primary">Jenis Layanan</label>
                        <select class="form-control" name="jenislayanan" required>
                            <option value="">--Please Select--</option>
                            <option value="0">Reguler</option>
                            <option value="1">Express</option>
                        </select>
                        <div class="invalid-feedback">
                            Choose employee identity!
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label text-primary">Layanan Order</label>
                        <select class="form-control" name="tipecuci" required>
                            <option value="">--Please Select--</option>
                            <option value="5000">Cuci</option>
                            <option value="7000">Cuci & Gosok</option>
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
                </div>
                <div class="modal-footer d-flex">
                    <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addTransaksiSatuan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddTransaksi" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddTransaksiLabel">Input Transaction Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="form_add_transaksi" action="<?php echo base_url() . 'transaksi/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="tttt" value="satuan">
                        <label class="control-label text-primary">Customer</label>
                        <select class="form-control" name="pelanggan_id" required>
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

                    <div class="form-group">
                        <label class="control-label text-primary">Employee</label>
                        <select class="form-control" name="karyawan_id" required>
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

                    <div class="form-group">
                        <label class="control-label text-primary">Item</label>
                        <select class="form-control" name="item" required>
                            <option value="">--Please Select--</option>
                            <option value="15000">Stelan Dinas</option>
                            <option value="20000">Bed Cover</option>
                        </select>
                        <div class="invalid-feedback">
                            Choose employee identity!
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
                </div>
                <div class="modal-footer d-flex">
                    <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for editing existing data -->

<?php
$no = 1;
foreach ($data_transaksi as $transaksi) {
?>
    <div class="modal fade" id="statusKiloan<?php echo $transaksi->transaksi_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransaksi" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransaksiLabel">Status Transaction Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_matakuliah" action="<?php echo base_url('transaksi/status') ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                    <div class="modal-body">
                        <div class="form-group d-none">
                            <label class="control-label text-primary">ID Transactions</label>
                            <input type="text" class="form-control" name="transaksi_id" value="<?php echo $transaksi->transaksi_id ?>" required readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">--Please Select--</option>
                                <option value="menunggu" <?php if ($transaksi->status === 'menunggu') {
                                                                echo "selected";
                                                            } ?>>Menunggu dikerjakan</option>
                                <option value="dikerjakan" <?php if ($transaksi->status === 'dikerjakan') {
                                                                echo "selected";
                                                            } ?>>Sedang Dikerjakan</option>
                                <option value="selesai" <?php if ($transaksi->status === 'selesai') {
                                                            echo "selected";
                                                        } ?>>Selesai Dikerjakan</option>
                                <option value="diantar" <?php if ($transaksi->status === 'selesai') {
                                                            echo "selected";
                                                        } ?>>Sedang diantar</option>
                                <option value="sampai" <?php if ($transaksi->status === 'sampai') {
                                                            echo "selected";
                                                        } ?>>Sudah diterima</option>
                            </select>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $no++;
}
?>

<?php
$no = 1;
foreach ($data_transaksi2 as $transaksi) {
?>
    <div class="modal fade" id="statusSatuan<?php echo $transaksi->transaksi_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransaksi" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransaksiLabel">Status Transaction Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_matakuliah" action="<?php echo base_url('transaksi/status') ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                    <div class="modal-body">
                        <div class="form-group d-none">
                            <label class="control-label text-primary">ID Transactions</label>
                            <input type="text" class="form-control" name="transaksi_id" value="<?php echo $transaksi->transaksi_id ?>" required readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">--Please Select--</option>
                                <option value="menunggu" <?php if ($transaksi->status === 'menunggu') {
                                                                echo "selected";
                                                            } ?>>Menunggu dikerjakan</option>
                                <option value="dikerjakan" <?php if ($transaksi->status === 'dikerjakan') {
                                                                echo "selected";
                                                            } ?>>Sedang Dikerjakan</option>
                                <option value="selesai" <?php if ($transaksi->status === 'selesai') {
                                                            echo "selected";
                                                        } ?>>Selesai Dikerjakan</option>
                                <option value="diantar" <?php if ($transaksi->status === 'selesai') {
                                                            echo "selected";
                                                        } ?>>Sedang diantar</option>
                                <option value="sampai" <?php if ($transaksi->status === 'sampai') {
                                                            echo "selected";
                                                        } ?>>Sudah diterima</option>
                            </select>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $no++;
}
?>

<?php
$no = 1;
foreach ($data_transaksi as $transaksi) {
?>
    <div class="modal fade" id="editTransaksi<?php echo $transaksi->transaksi_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransaksi" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransaksiLabel">Edit Transaction Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_matakuliah" action="<?php echo base_url('transaksi/edit') ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                    <div class="modal-body">
                        <input type="hidden" name="status" value="<?php echo $transaksi->status; ?>">
                        <div class="form-group d-none">
                            <label class="control-label text-primary">ID Transactions</label>
                            <input type="text" class="form-control" name="transaksi_id" value="<?php echo $transaksi->transaksi_id ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-primary">Customer</label>
                            <select class="form-control" name="pelanggan_id" required>
                                <option value="">--Please Select--</option>
                                <?php
                                foreach ($data_pelanggan as $pelanggan) {
                                ?>
                                    <option value="<?php echo $pelanggan->pelanggan_id ?>" <?php if ($pelanggan->pelanggan_id === $transaksi->pelanggan_id) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                        <?php echo $pelanggan->pelanggan_id . ' ' . $pelanggan->nama_pelanggan ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Choose a customer identity!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Employee</label>
                            <select class="form-control" name="karyawan_id" required>
                                <option value="">--Please Select--</option>
                                <?php
                                foreach ($data_karyawan as $karyawan) {
                                    if ($karyawan->aktif == 1) {
                                ?>
                                        <option value="<?php echo $karyawan->karyawan_id ?>" <?php if ($karyawan->karyawan_id === $transaksi->karyawan_id) {
                                                                                                    echo "selected";
                                                                                                } ?>>
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
                                <option value="kiloan" <?php echo ($transaksi->jenis_layanan == 'kiloan') ? 'selected="selected"' : '' ?>>Kiloan</option>
                                <option value="satuan" <?php echo ($transaksi->jenis_layanan == 'satuan') ? 'selected="selected"' : '' ?>>Satuan</option>
                            </select>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Jenis Layanan</label>
                            <select class="form-control" name="jenislayanan" required>
                                <option value="">--Please Select--</option>
                                <?php
                                foreach ($datalayanan as $layanan) {
                                ?>
                                    <option value="<?php echo $layanan->id_layanan ?>" <?php if ($layanan->id_layanan === $transaksi->layanan_order) {
                                                                                            echo "selected";
                                                                                        } ?>>
                                        <?php echo $layanan->jenis . ' (' . $layanan->harga . 'X)' ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Layanan Order</label>
                            <select class="form-control" name="tipecuci" required>
                                <option value="">--Please Select--</option>
                                <?php
                                foreach ($dataorder as $order) {
                                ?>
                                    <option value="<?php echo $order->id_kilo ?>" <?php if ($order->id_kilo === $transaksi->layanan_kiloan) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                        <?php echo $order->jenis . ' ' . $order->harga ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Qty</label>
                            <input type="number" class="form-control" placeholder='Laundry Weight' name="berat" value="<?php echo $transaksi->berat ?>" required>
                            <div class="invalid-feedback">
                                Fillup Laundry Weight!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Order Date</label>
                            <input type="date" class="form-control" placeholder='Laundry Order Date' name="tgl_order" value="<?php echo $transaksi->tgl_order ?>" required>
                            <div class="invalid-feedback">
                                Fill in the date of the laundry order!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Finished Date</label>
                            <input type="date" class="form-control" placeholder='Finished Date' name="tgl_selesai" value="<?php echo $transaksi->tgl_selesai ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $no++;
}
?>


<?php
$no = 1;
foreach ($data_transaksi2 as $transaksi) {
?>
    <div class="modal fade" id="editTransaksiS<?php echo $transaksi->transaksi_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransaksi" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransaksiLabel">Edit Transaction Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_matakuliah" action="<?php echo base_url('transaksi/edit2') ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                    <div class="modal-body">
                        <div class="form-group d-none">
                            <label class="control-label text-primary">ID Transactions</label>
                            <input type="text" class="form-control" name="transaksi_id" value="<?php echo $transaksi->transaksi_id ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="tttt" value="satuan">
                            <label class="control-label text-primary">Customer</label>
                            <select class="form-control" name="pelanggan_id" required>
                                <option value="">--Please Select--</option>
                                <?php
                                foreach ($data_pelanggan as $pelanggan) {
                                ?>
                                    <option value="<?php echo $pelanggan->pelanggan_id ?>" <?php if ($pelanggan->pelanggan_id === $transaksi->pelanggan_id) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                        <?php echo $pelanggan->pelanggan_id . ' ' . $pelanggan->nama_pelanggan ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Choose a customer identity!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Employee</label>
                            <select class="form-control" name="karyawan_id" required>
                                <option value="">--Please Select--</option>
                                <?php
                                foreach ($data_karyawan as $karyawan) {
                                    if ($karyawan->aktif == 1) {
                                ?>
                                        <option value="<?php echo $karyawan->karyawan_id ?>" <?php if ($karyawan->karyawan_id === $transaksi->karyawan_id) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                            <?php echo $karyawan->karyawan_id . ' ' . $karyawan->nama_karyawan ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Item</label>
                            <select class="form-control" name="satuan" required>
                                <option value="">--Please Select--</option>
                                <?php
                                foreach ($datasatuan as $order) {
                                ?>
                                    <option value="<?php echo $order->id_satuan ?>" <?php if ($order->id_satuan === $transaksi->item_satuan) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                        <?php echo $order->jenis . ' (Rp.' . number_format($order->harga, 0, ',', '.') . ')' ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Order Date</label>
                            <input type="date" class="form-control" placeholder='Laundry Order Date' name="tgl_order" value="<?php echo $transaksi->tgl_order ?>" required>
                            <div class="invalid-feedback">
                                Fill in the date of the laundry order!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Finished Date</label>
                            <input type="date" class="form-control" placeholder='Finished Date' name="tgl_selesai" value="<?php echo $transaksi->tgl_selesai ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $no++;
}
?>

<?php
$no = 1;
foreach ($data_transaksi as $transaksi) {
?>
    <div class="modal fade" id="showDetail<?php echo $transaksi->transaksi_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransaksi" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransaksiLabel">Edit Transaction Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_matakuliah" action="<?php echo base_url('transaksi/edit') ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                    <div class="modal-body">
                        <div class="form-group d-none">
                            <label class="control-label text-primary">ID Transactions</label>
                            <input type="text" class="form-control" name="transaksi_id" value="<?php echo $transaksi->transaksi_id ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-primary">Tipe Order</label>
                            <input type="text" class="form-control text-primary" value="<?php echo $transaksi->jeniskg ?> (Rp.<?php echo number_format($transaksi->hargakg, 0, ',', '.') ?>)" readonly>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-primary">Tipe Layanan</label>
                            <input type="text" class="form-control text-primary" value="<?php echo $transaksi->jenislyn ?> (<?php echo $transaksi->hargalyn ?>X)" readonly>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $no++;
}
?>
<?php
$no = 1;
foreach ($data_transaksi2 as $transaksi) {
?>
    <div class="modal fade" id="showDetailS<?php echo $transaksi->transaksi_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransaksi" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransaksiLabel">Edit Transaction Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_matakuliah" action="<?php echo base_url('transaksi/edit') ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                    <div class="modal-body">
                        <div class="form-group d-none">
                            <label class="control-label text-primary">ID Transactions</label>
                            <input type="text" class="form-control" name="transaksi_id" value="<?php echo $transaksi->transaksi_id ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-primary">Tipe Order</label>
                            <input type="text" class="form-control text-primary" value="<?php echo $transaksi->jeniskg ?> (Rp.<?php echo number_format($transaksi->hargakg, 0, ',', '.') ?>)" readonly>
                            <div class="invalid-feedback">
                                Choose employee identity!
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $no++;
}
?>