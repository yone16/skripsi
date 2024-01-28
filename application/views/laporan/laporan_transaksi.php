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
                        <div class="col-12">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between">
                                    <h4 class="my-auto font-weight-bold text-primary">Laporan Data Transaksi</h4>
                                </div>
                                <div class="card-body">
                                    <form name="form_filter_transaksi" action="<?php echo base_url() . 'transaksi/laporan_filter' ?>" method="post" class="w-50 user needs-validation mx-3 mb-4" novalidate>
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label class="control-label text-primary">From</label>
                                                <input type="date" class="form-control" name="dari" value="<?php echo set_value('dari') ?>" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label class="control-label text-primary">To</label>
                                                <input type="date" class="form-control" name="sampai" value="<?php echo set_value('sampai') ?>" required>
                                            </div>
                                            <div class="form-group col-lg-4 mt-1">
                                                <label class="control-label text-primary"></label>
                                                <button type="submit" class="form-control btn btn-primary btn-user">Cari</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="d-flex m-3">
                                        <!-- <a target="blank" href="<?php echo base_url() . 'transaksi/print/' . set_value('dari') . '/' . set_value('sampai') ?>" class="btn btn-warning shadow-sm"><i class="fas fa-print fa-sm text-white-500"></i> Print</a> -->
                                        <!-- <a target="blank" href="<?php echo base_url() . 'transaksi/cetak_pdf/' . set_value('dari') . '/' . set_value('sampai') ?>" class="btn btn-danger shadow-sm mx-2"><i class="fas fa-file fa-sm text-white-500"></i> Print PDF</a> -->
                                    </div>

                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-primary">
                                                    <th>#</th>
                                                    <th>ID Transaksi</th>
                                                    <th>Pelanggan</th>
                                                    <th>Karyawan</th>
                                                    <th>Berat</th>
                                                    <th>Total</th>
                                                    <th>Order</th>
                                                    <th>Selesai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data_transaksi as $transaksi) {
                                                ?>
                                                    <tr>
                                                        <th><?php echo $no++ ?></th>
                                                        <td><?php echo $transaksi->transaksi_id ?></td>
                                                        <td>
                                                            <span class="row px-3 text-primary text-xs"><?php echo $transaksi->pelanggan_id ?></span>
                                                            <span class="row px-3"><?php echo $transaksi->nama_pelanggan ?></span>
                                                        </td>
                                                        <td>
                                                            <span class="row px-3 text-primary text-xs"><?php echo $transaksi->karyawan_id ?></span>
                                                            <span class="row px-3"><?php echo $transaksi->nama_karyawan ?></span>
                                                        </td>
                                                        <td><?php echo ($transaksi->jenis_layanan === 'kiloan') ? '<span class="badge bg-warning">' . $transaksi->berat . ' Kg</span>' : '<span class="badge bg-primary">Satuan</span>' ?></td>
                                                        <td>Rp.<?php echo number_format($transaksi->total, 0, ',', '.') ?></td>
                                                        <td><?php echo $transaksi->tgl_order ?></td>
                                                        <td><?php if ($transaksi->tgl_selesai == '0000-00-00') {
                                                                echo '-';
                                                            } else {
                                                                echo $transaksi->tgl_selesai;
                                                            } ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- DataTales Example -->

                    </div>
                </div>
                <div class="row">
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="col-12">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between">
                                    <h6 class="my-auto font-weight-bold text-primary">Total Omset Pertanggal dari : <span class="badge bg-warning"><?php echo set_value('dari') ?></span> - sampai : <span class="badge bg-warning"><?php echo set_value('sampai') ?></span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <h4 class="my-auto font-weight-bold">Rp. <?= number_format($omset[0]->total_omset,0,',','.') ?></h4>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- DataTales Example -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
<!-- End of Main Content -->