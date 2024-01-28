<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<div class='alert alert-danger text-center'>Login failed! Incorrect username and password.</div>";
    } else if ($_GET['pesan'] == "logout") {
        echo "<div class='alert alert-danger text-center'>You have logged out.</div>";
    } else if ($_GET['pesan'] == "belumlogin") {
        echo "<div class='alert alert-succes text-centers'>Please login first.</div>";
    } else if ($_GET['pesan'] == "gagal_register") {
        echo "<div class='alert alert-danger text-center'>Pastikan Data Password Cocok.</div>";
    }
}
?>

<body>
    <div class="container-xxl mt-5">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="col-lg-4 mx-auto">
                    <!-- Register -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center">
                                <!-- Logo Code -->
                            </div>
                            <!-- /Logo -->
                            <h4 class="mb-2 mt-3 text-center">Register Account 📝</h4>
                            <p class="mb-4 text-center">Isi Kolom Untuk Membuat Akun Baru</p>

                            <!-- Registration Form -->
                            <form class="mb-3" action="<?php echo base_url() ?>welcome/regis" method="POST">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" required />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" required />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm_password" required />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Daftar</button>
                                </div>
                            </form>
                            <!-- /Registration Form -->

                            <p class="text-center">Sudah Memiliki Akun? <a href="<?php echo base_url() ?>">Masuk Disini</a></p>
                        </div>
                    </div>
                    <!-- /Register -->
                </div>
            </div>
        </div>
    </div>
</body>