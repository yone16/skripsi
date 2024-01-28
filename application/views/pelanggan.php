<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">halaman</span> Pelanggan</h4>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h4 class="my-auto font-weight-bold text-primary">Data Pelanggan</h4>
                    <a href="#" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addPelanggan"><i class="fas fa-plus fa-sm text-white-500"></i> Add Customers</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-primary">
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Kontak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                $kode = '';
                                $n_pelanggan = count($data_pelanggan);
                                $kode = 'P-' . time().'-'.rand(10,100);
                                foreach ($data_pelanggan as $pelanggan) {
                                ?>
                                    <tr>
                                        <th><?php echo $no++ ?></th>
                                        <td><?php echo $pelanggan->pelanggan_id ?></td>
                                        <td><?php echo $pelanggan->nama_pelanggan ?></td>
                                        <td><?php echo $pelanggan->alamat ?></td>
                                        <td><?php echo $pelanggan->no_hp ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPelanggan<?php echo $pelanggan->pelanggan_id ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="<?php echo base_url() . 'pelanggan/delete/' . $pelanggan->pelanggan_id ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data pelanggan ini?')"><i class="bx bx-trash me-1"></i> Delete</a>
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
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Modal for adding new data -->
    <div class="modal fade" id="addPelanggan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddPelanggan" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddPelangganLabel">Customer Data Input</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url() . 'pelanggan/add' ?>" method="post" class="user needs-validation mx-3 mb-4">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label text-primary">ID</label>
                            <input type="text" class="form-control" placeholder="Customer ID" autofocus name="pelanggan_id" required readonly value="<?php echo $kode ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label text-primary">Customer's Name</label>
                            <input type="text" class="form-control" title="Fill in the customer's name with letters" placeholder='Customers Name' name="nama_pelanggan" pattern="[A-Za-z ]{1,50}" required>
                            <div class="invalid-feedback">
                                Fill in the customer's name with letters! (max. 50 letters)
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Gender</label>
                            <select class="form-control" name="jeniskelamin" pattern="[A-Za-z]{1,10}" required>
                                <option value="">--Please Select--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div class="invalid-feedback">
                                Choose the gender of the customer!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Address</label>
                            <input type="text" class="form-control" placeholder='Address' name="alamat" required>
                            <div class="invalid-feedback">
                                Enter the customer's address!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-primary">Mobile No.</label>
                            <input type="tel" class="form-control" placeholder='Customer Mobile Number' name="no_hp" pattern="[0-9]{11,15}" required>
                            <div class="invalid-feedback">
                                Fill in No. Customer phone!
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
    foreach ($data_pelanggan as $pelanggan) {
    ?>
        <div class="modal fade" id="editPelanggan<?php echo $pelanggan->pelanggan_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditPelanggan" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditPelangganLabel">Change Customer Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name="form_edit_mahasiswa" action="<?php echo base_url() . 'pelanggan/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label text-primary">ID</label>
                                <input type="text" class="form-control" placeholder="Customer ID" autofocus name="pelanggan_id" value="<?php echo $pelanggan->pelanggan_id ?>" readonly>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label class="control-label text-primary">Customer's Name</label>
                                <input type="text" class="form-control" title="Fill in the customer's name with letters" placeholder='Customers Name' name="nama_pelanggan" pattern="[A-Za-z ]{1,50}" value="<?php echo $pelanggan->nama_pelanggan ?>" required>
                                <div class="invalid-feedback">
                                    Fill in the customer's name with letters! (max. 50 letters)
                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label class="control-label text-primary">Gender</label>
                                <select class="form-control" name="jeniskelamin" pattern="[A-Za-z]{1,10}" required>
                                    <option value="">--Please Select--</option>
                                    <option value="Male" <?php if ($pelanggan->jeniskelamin === 'Male') {
                                                                echo "selected";
                                                            } ?>>Male</option>
                                    <option value="Female" <?php if ($pelanggan->jeniskelamin === 'Female') {
                                                                echo "selected";
                                                            } ?>>Female</option>
                                </select>
                                <div class="invalid-feedback">
                                    Choose the gender of the customer!
                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label class="control-label text-primary">Address</label>
                                <input type="text" class="form-control" placeholder='Address' name="alamat" value="<?php echo $pelanggan->alamat ?>" required>
                                <div class="invalid-feedback">
                                    Enter the customer's address!
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary">Mobile No.</label>
                                <input type="tel" class="form-control" placeholder='Mobile No.' name="no_hp" pattern="[0-9]{11,15}" value="<?php echo $pelanggan->no_hp ?>" required>
                                <div class="invalid-feedback">
                                    Fill in No. Customer phone!
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
    }
    ?>