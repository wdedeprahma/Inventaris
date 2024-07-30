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
                                                Tambah Barang Keluar
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <?= validation_errors() ?>
                                                        <form action="<?= base_url('admin/proses_tambahbarang_keluar')  ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <tr>
                                                                    <td width=20%>Tanggal keluar</td>
                                                                    <td><input type="Date" name="tanggal_keluar" class="form-control" required placeholder="tanggal keluar"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Barang</td>
                                                                    <td><select name="id_barang" class="form-control">
                                                                            <option value="">-- Nama Barang --</option>
                                                                            <?php foreach ($data as $key => $value) { ?>
                                                                                <option value="<?= $value->id_barang ?>"><?= $value->id_barang ?> - <?= $value->nama_barang ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kategori</td>
                                                                    <td><select name="id_kategori" class="form-control">
                                                                            <option value="">-- Kategori --</option>
                                                                            <?php foreach ($kategori as $key => $value) { ?>
                                                                                <option value="<?= $value->id_kategori ?>"><?= $value->kategori ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>Jumlah keluar</td>
                                                                    <td><input type="text" name="jumlahk" class="form-control" required placeholder="Jumlah keluar"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Penanggung Jawab</td>
                                                                    <td><select name="id_pegawai" class="form-control">
                                                                            <option value="">-- Nama pegawai --</option>
                                                                            <?php foreach ($pegawai as $key => $value) { ?>
                                                                                <option value="<?= $value->id_pegawai ?>"><?= $value->nama_pegawai ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>


                                                                <tr>
                                                                    <td width=20%>Keterangan</td>
                                                                    <td><input type="text" name="keterangan" class="form-control" required placeholder="Keterangan"></td>
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