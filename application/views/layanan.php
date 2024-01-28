<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Halaman</span> Item Satuan</h4>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h4 class="my-auto font-weight-bold text-primary">Harga Layanan</h4>
                    <a href="#" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addTransaksiKiloan"><i class="fas fa-plus fa-sm text-white-500"></i> Tambah Layanan Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-primary">
                                    <th>Jenis Layanan</th>
                                    <th>Kali Harga Layanan</th>
                                    <th class="actions">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_setting as $setting) {
                                ?>
                                    <tr>
                                        <td>
                                            <span class="row px-3"><?php echo ($setting->jenis) ?></span>
                                        </td>
                                        <td>
                                            <span class="row px-3">(<?php echo ($setting->harga == 1) ? 'Tidak dikenakan biaya' : $setting->harga . 'X' ?>)</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editSetting<?php echo $setting->id_layanan ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="<?php echo base_url() . 'setting/deleteLayanan/' . $setting->id_layanan ?>" onclick="return confirm('Apakah anda yakin ingin menghapus layanan ini?')"><i class="bx bx-trash me-1"></i> Delete</a>
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
<!-- End of Main Content -->

<div class="modal fade" id="addTransaksiKiloan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddTransaksi" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddTransaksiLabel">Input Transaction Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="form_add_transaksi" action="<?php echo base_url() . 'setting/tambahLayanan' ?>" method="post" class="user needs-validation mx-3 mb-4">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label text-primary">Jenis Layanan</label>
                        <input type="text" class="form-control" placeholder='jenis item' name="jenis" required>
                        <div class="invalid-feedback">
                            Masukan jenis layanan!
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-primary">Kali (x) per-harga</label>
                        <input type="number" min="1" class="form-control" placeholder='harga item' name="harga" required>
                        <div class="invalid-feedback">
                            Masukan kali-an per harga!
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

<!-- Modal for editing existing data -->
<?php
foreach ($data_setting as $setting) {
?>
    <div class="modal fade" id="editSetting<?php echo $setting->id_layanan ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransaksi" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransaksiLabel">Ubah Harga Per-kilo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_matakuliah" action="<?php echo base_url('setting/editLayanan') ?>" method="post" class="user needs-validation mx-3 mb-4">
                    <div class="modal-body">
                        <div class="form-group d-none">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $setting->id_layanan ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label text-primary">Jenis Layanan</label>
                            <input type="text" class="form-control" name="jenis" value="<?php echo $setting->jenis ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-primary">Kali-an Per harga</label>
                            <input type="number" min="1" class="form-control" name="harga" value="<?php echo $setting->harga ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="submit" class="flex-fill btn btn-success btn-user">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>