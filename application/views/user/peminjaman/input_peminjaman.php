<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-header">
                    <h5>Form Peminjaman Barang</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/proses_tambahpeminjaman') ?>" method="POST">
                        <div class="form-group">
                            <label for="id_pegawai">Nama Pegawai</label>
                            <select name="id_pegawai" class="form-control" required>
                                <option value="">-- Pilih Nama Pegawai --</option>
                                <?php foreach ($pegawai as $value) { ?>
                                    <option value="<?= $value->id_pegawai ?>">
                                        <?= $value->nama_pegawai ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="id_barang">Nama Barang</label>
                            <select name="id_barang" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang as $value) { ?>
                                    <option value="<?= $value->id_barang ?>">
                                        <?= $value->nama_barang ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $value) { ?>
                                    <option value="<?= $value->id_kategori ?>">
                                        <?= $value->kategori ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_lokasi">Lokasi</label>
                            <select name="id_lokasi" class="form-control" required>
                                <option value="">-- Pilih Lokasi --</option>
                                <?php foreach ($lokasi as $value) { ?>
                                    <option value="<?= $value->id_lokasi ?>">
                                        <?= $value->lokasi ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" name="tujuan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" name="tanggal_pengembalian" class="form-control" required>
                        </div>

                        <input type="hidden" name="status_peminjaman" value="Menunggu Persetujuan">
                        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>