  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">hai <?= $namauser ?>, Welcome 🎉</h5>
                  <p class="mb-4">
                    Total Transaksi hari ini adalah <span class="fw-bold"><?= $n_transaksi ?> transaksi</span>
                  </p>

                  <a href="<?= base_url('transaksi'); ?>" class="btn btn-sm btn-outline-primary">Lihat Transaksi</a>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img src="<?= base_url() ?>assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-lg-12 col-md-12 order-1">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="<?= base_url() ?>assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Total Pendapatan Hari Ini</span>
                  <h3 class="card-title mb-2"><?= $total_pendapatan === null ? 'Rp.0' : 'Rp.'.number_format($total_pendapatan,0,',','.') ?></h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="<?= base_url() ?>assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Total Pendapatan Minggu Ini</span>
                  <h3 class="card-title mb-2"><?= $total_minggu === null ? 'Rp.0' : 'Rp.'.number_format($total_minggu,0,',','.') ?></h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="<?= base_url() ?>assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Total Pendapatan Bulan Ini</span>
                  <h3 class="card-title mb-2"><?= $total_bulan === null ? 'Rp.0' : 'Rp.'.number_format($total_bulan,0,',','.') ?></h3>
                </div>
              </div>
            </div>
          </div>
        </div> -->

      </div>

    </div>