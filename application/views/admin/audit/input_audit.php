<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Tambah Audit Inventory</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/proses_tambah_audit') ?>" method="POST" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td width=20%>Tanggal Audit</td>
                        <td><input type="date" name="tanggal_audit" class="form-control" required placeholder="Tanggal Audit"></td>
                    </tr>
                    <tr>
                        <td>Nama Auditor</td>
                        <td>
                            <select name="id_pegawai" class="form-control" required>
                                <option value="">-- Pilih pegawai --</option>
                                <?php foreach ($pegawai as $key => $value) { ?>
                                    <option value="<?= $value->id_pegawai ?>">
                                        <?= $value->id_pegawai ?> - <?= $value->nama_pegawai ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td>
                            <select name="id_barang" id="id_barang" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang as $key => $value) { ?>
                                    <option value="<?= $value->id_barang ?>" data-stok="<?= $value->stok ?>">
                                        <?= $value->id_barang ?> - <?= $value->nama_barang ?>
                                    </option>
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
                                    <option value="<?= $value->id_kategori ?>">
                                        <?= $value->kategori ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Stok Sistem</td>
                        <td><input type="text" name="stok_sistem" id="stok_sistem" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td width=20%>Stok Aktual</td>
                        <td><input type="text" name="stok_aktual" class="form-control" required placeholder="Stok Aktual"></td>
                    </tr>
                    <tr>
                        <td width=20%>Harga Per Unit</td>
                        <td><input type="text" name="harga_per_unit" class="form-control" required placeholder="Harga Per Unit"></td>
                    </tr>
                    <tr>
                        <td>Hasil Audit</td>
                        <td>
                            <select name="hasil_audit" class="form-control" required>
                                <option value="Sesuai">Sesuai</option>
                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width=20%>Catatan Audit</td>
                        <td><textarea name="catatan_audit" class="form-control" required placeholder="Catatan Audit"></textarea></td>
                    </tr>
                    <tr>
                        <td width=20%>Bukti</td>
                        <td><input type="file" name="bukti" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-success">Simpan</button>
                            <a href="<?= base_url('admin/data_audit') ?>" class="btn btn-secondary">Batal</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript untuk mengubah stok berdasarkan pilihan barang
    document.getElementById('id_barang').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var stok = selectedOption.getAttribute('data-stok');
        document.getElementById('stok_sistem').value = stok;
    });
</script>