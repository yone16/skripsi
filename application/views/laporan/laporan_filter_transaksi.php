<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">halaman</span> Laporan Transaksi</h4>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between">
                                <h4 class="my-auto font-weight-bold text-primary">Laporan Data Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <form name="form_filter_karyawan" action="<?php echo base_url() . 'transaksi/laporan_filter' ?>" method="post" class="w-50 user needs-validation mx-3 mb-4" novalidate>
                                    <div class="form-group">
                                        <label class="control-label text-primary">Dari</label>
                                        <input type="date" class="form-control" name="dari" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label text-primary">ke</label>
                                        <input type="date" class="form-control" name="sampai" required>
                                    </div>
                                    <button type="submit" class="flex-fill btn btn-primary btn-user px-4 mt-3">Search</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
<!-- End of Main Content -->