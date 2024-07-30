<body class="bg-gradient-success">
    <div class="mbr-slider slide carousel" data-keyboard="false" data-ride="carousel" data-interval="2000" data-pause="true">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <!-- Page Heading -->
                                        <div class="card">
                                            <div class="card-header">
                                                Tambah Persediaan Barang
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <?= validation_errors() ?>
                                                        <form action="<?= base_url('admin/proses_tambahstokbarang') ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>Nama Barang</td>
                                                                    <td>
                                                                        <select name="id_barang" id="id_barang" class="form-control" required>
                                                                            <option value="">-- Nama Barang --</option>
                                                                            <?php foreach ($data as $key => $value) { ?>
                                                                                <option value="<?= $value->id_barang ?>" data-stok="<?= $value->stok ?>"><?= $value->id_barang ?> - <?= $value->nama_barang ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kategori</td>
                                                                    <td>
                                                                        <select name="id_kategori" class="form-control" required>
                                                                            <option value="">-- Pilih Kategori --</option>
                                                                            <?php foreach ($kategori as $key => $value) { ?>
                                                                                <option value="<?= $value->id_kategori ?>"><?= $value->kategori ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="20%">Satuan</td>
                                                                    <td><input type="text" name="satuan" class="form-control" required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stok</td>
                                                                    <td><input type="text" name="id_stok" id="id_stok" class="form-control" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="20%">Harga</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Rp.</span>
                                                                            </div>
                                                                            <input type="text" name="hargaunit" class="form-control" required placeholder="Harga">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="20%">Tanggal Update</td>
                                                                    <td><input type="date" name="tanggalupdate" class="form-control" required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <button class="btn btn-success" type="submit">Simpan</button>
                                                                        <a class="btn btn-secondary" href="<?= base_url('admin/data_stokbarang') ?>">Kembali</a>
                                                                    </td>
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
    <script>
        // JavaScript untuk mengubah stok berdasarkan pilihan barang
        document.getElementById('id_barang').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var stok = selectedOption.getAttribute('data-stok');
            document.getElementById('id_stok').value = stok;
        });
    </script>
</body>