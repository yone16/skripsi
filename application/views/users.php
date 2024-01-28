<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">halaman</span> user</h4>

        <!-- Basic Layout & Basic with Icons -->

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h4 class="my-auto font-weight-bold text-primary">Data Users</h4>
                    <!-- <a href="#" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addKaryawan"><i class="fas fa-plus fa-sm text-white-500"></i> Tambah Karyawan</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-primary">
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                $kode = 'K-' . rand() . time();
                                foreach ($data_user as $users) {
                                ?>
                                    <tr>
                                        <th><?php echo $no++ ?></th>
                                        <td><?php echo $users->user_id ?></td>
                                        <td><?php echo $users->namauser ?></td>
                                        <td><?php echo $users->username . ' ' ?></td>
                                        <td><?php echo $users->level . ' ' ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $users->user_id ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <?php if ($users->user_id != 'U001') { ?>
                                                        <a class="dropdown-item" href="<?php echo base_url() . 'users/delete/' . $users->user_id ?>" onclick="return confirm(`Apakah anda yakin ingin menghapus data User ini?`)"><i class="bx bx-trash me-1"></i> Delete</a>
                                                    <?php } ?>
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

<!-- Modal for adding new data -->
<div class="modal fade" id="addKaryawan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddKaryawan" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddKaryawanLabel">Input Employee data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="form_add_mahasiswa" action="<?php echo base_url() . 'karyawan/add' ?>" method="post" class="user needs-validation mx-3 mb-4">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label text-primary">ID</label>
                        <input type="text" class="form-control" placeholder="ID Employee" autofocus name="karyawan_id" required readonly value="<?php echo $kode ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label text-primary">Nama Karyawan</label>
                        <input type="text" class="form-control" title="Fill in the Employee Name with Letters" placeholder='Employee Name' name="nama_karyawan" pattern="[A-Za-z ]{1,50}" required>
                        <div class="invalid-feedback">
                            Mohon isi kolom Nama Karyawan! (max. 50 letters)
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label text-primary">Gender</label>
                        <select class="form-control" name="jeniskelamin" pattern="[A-Za-z]{1,10}" required>
                            <option value="">--Pilih--</option>
                            <option value="Male">Pria</option>
                            <option value="Female">Wanita</option>
                        </select>
                        <div class="invalid-feedback">
                            Pilih Gender Karyawan
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label text-primary">Alamat</label>
                        <input type="text" class="form-control" placeholder='Employee Address' name="alamat" required>
                        <div class="invalid-feedback">
                            Mohon isi kolom alamat!
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label text-primary">No.Handphone</label>
                        <input type="tel" class="form-control" placeholder='Employee Mobile Number' name="no_hp" pattern="[0-9]{11,20}" required>
                        <div class="invalid-feedback">
                            Mohon isi kolom No.Handphone!
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for editing existing data -->
<?php
foreach ($data_user as $users) {
?>
    <div class="modal fade" id="editUser<?php echo $users->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditKaryawan" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditKaryawanLabel">Edit Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_edit_mahasiswa" action="<?php echo base_url() . 'users/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label text-primary">ID</label>
                            <input type="text" class="form-control" placeholder="Emp ID" autofocus name="id_user" value="<?php echo $users->user_id ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Nama User</label>
                            <input type="text" class="form-control" title="Fill in the Employee Name with Letters" placeholder='Ubah nama user' name="namauser" pattern="[A-Za-z ]{1,50}" value="<?php echo $users->namauser ?>" required>
                            <div class="invalid-feedback">
                                Fill in the name of the employee with letters! (max. 50 letters)
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Username</label>
                            <input type="text" class="form-control" title="Fill in the Employee Name with Letters" placeholder='Ubah username' name="username" pattern="[A-Za-z ]{1,50}" value="<?php echo $users->username ?>" required>
                            <div class="invalid-feedback">
                                Fill in the name of the employee with letters! (max. 50 letters)
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Password</label>
                            <input type="text" class="form-control" title="Fill in the Employee Name with Letters" placeholder='Ubah Password' name="password">
                            <span>isi password jika ingin menganti, jika tidak kosongkan kolom!</span>
                        </div>

                    </div>
                    <div class="modal-footer d-flex">
                        <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>