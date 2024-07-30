<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Argon Dashboard 2 by Creative Tim
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Argon CSS -->
    <link id="pagestyle" href="<?= base_url('assets') ?>/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Selamat Datang</h4>
                                    <p class="mb-0">Silahkan Masuk dengan menggunakan Nama Pengguna dan Kata Sandi</p>
                                    <?php if ($this->session->flashdata('error')) : ?>
                                        <p class="text-danger"><?php echo $this->session->flashdata('error'); ?></p>
                                    <?php endif; ?>
                                    <?php echo validation_errors('<p class="text-danger">', '</p>'); ?>
                                </div>
                                <div class="card-body">
                                    <form class="user" action="<?= base_url('auth/auth') ?>" method="POST">
                                        <div class="mb-3">
                                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Nama Pengguna" aria-label="Username">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Kata Sandi" aria-label="Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('http://localhost/inventaris/assets/login.jpeg'); background-size: cover;">
                                <span class="mask bg-gradient-dark opacity-8"></span>
                                <img src="<?= base_url('assets/bglogin.png') ?>" class="position-relative" alt="" style="width: 155px; height: 140px; margin-left: 276px;">
                                <h4 class="mt-4 text-white font-weight-bolder position-relative">"Sistem Informasi Inventaris Dan Audit"</h4>
                                <p class="text-white position-relative">Madrasah Tsanawiyah Negri 1 Katingan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Core JS Files -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>