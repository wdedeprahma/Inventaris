<body class="bg-gradient-success">
    <div class="mbr-slider slide carousel" data-keyboard="false" data-ride="carousel" data-interval="2000" data-pause="true">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg">
                    <div class="card o-hidden border-0 shadow-lg my-5 ">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <!-- Page Heading -->
                                        <div class="card">
                                            <div class="card-header">
                                                Tambah Data pegawai
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <?= validation_errors() ?>
                                                        <form action="<?= base_url('admin/proses_tambah_pegawai')  ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <tr>
                                                                    <td width=20%>Nama pegawai</td>
                                                                    <td><input type="text" name="nama_pegawai" class="form-control" required placeholder="Nama pegawai"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>Jabatan</td>
                                                                    <td><input type="text" name="jabatan" class="form-control" required placeholder="Jabatan"></td>
                                                                </tr>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn-success">Simpan</button>
                                                                    </td>
                                                                    <!-- <td>
                                                                        <button class="btn btn-success" href="<?= base_url('admin/data_kategori') ?>">Kembali</button>
                                                                    </td> -->
                                                                </tr>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>