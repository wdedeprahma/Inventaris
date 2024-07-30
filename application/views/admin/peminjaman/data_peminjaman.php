<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">Data Peminjaman Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <a href="<?= base_url('admin/tambah_peminjaman') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                    <a href="<?= base_url('admin/cetak_peminjaman') . '?' . http_build_query($_GET) ?>" class="btn btn-success"> <i class="fas fa-print"></i> Cetak Data</a>
                    <hr>
                    <form method="GET" action="<?= base_url('admin/data_peminjaman') ?>" class="custom-form">
                        <div class="row">
                            <!-- Filter Kategori -->
                            <div class="col-md-2 mb-0">
                                <label for="filterKategori">Kategori</label>
                                <select name="kategori" id="filterKategori" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $value) { ?>
                                        <option value="<?= $value->id_kategori ?>" <?= isset($_GET['kategori']) && $_GET['kategori'] == $value->id_kategori ? 'selected' : '' ?>>
                                            <?= $value->kategori ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- Filter Tanggal Mulai -->
                            <div class="col-md-2 mb-0">
                                <label for="filterTanggalMulai">Tanggal Mulai</label>
                                <input type="date" name="tanggalmulai" id="filterTanggalMulai" class="form-control" value="<?= isset($_GET['tanggalmulai']) ? $_GET['tanggalmulai'] : '' ?>">
                            </div>
                            <!-- Filter Tanggal Akhir -->
                            <div class="col-md-2 mb-0">
                                <label for="filterTanggalAkhir">Tanggal Akhir</label>
                                <input type="date" name="tanggalakhir" id="filterTanggalAkhir" class="form-control" value="<?= isset($_GET['tanggalakhir']) ? $_GET['tanggalakhir'] : '' ?>">
                            </div>
                            <div class="col-md-1 mb-0 align-self-end">
                                <label style="visibility: hidden;">Label kosong</label>
                                <button type="submit" class="btn btn-primary mb-4 ml-2">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Nama Barang</th>
                            <th>Kategori Barang</th>
                            <th>Lokasi</th>
                            <th>Jumlah</th>
                            <th>Tujuan</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($peminjaman as $x) {
                            // Apply filters
                            $isFiltered = true;
                            if (isset($_GET['kategori']) && !empty($_GET['kategori']) && $_GET['kategori'] != $x->id_kategori) {
                                $isFiltered = false;
                            }
                            if (isset($_GET['tanggalmulai']) && !empty($_GET['tanggalmulai'])) {
                                $tanggal_mulai = date('Y-m-d', strtotime($_GET['tanggalmulai']));
                                if (date('Y-m-d', strtotime($x->tanggal_peminjaman)) < $tanggal_mulai) {
                                    $isFiltered = false;
                                }
                            }
                            if (isset($_GET['tanggalakhir']) && !empty($_GET['tanggalakhir'])) {
                                $tanggal_akhir = date('Y-m-d', strtotime($_GET['tanggalakhir']));
                                if (date('Y-m-d', strtotime($x->tanggal_peminjaman)) > $tanggal_akhir) {
                                    $isFiltered = false;
                                }
                            }
                            if ($isFiltered) {
                        ?>
                                <tr>
                                    <td><?= $nomor++; ?></td>
                                    <td>
                                        <?php
                                        $pegawaiName = '';
                                        foreach ($pegawai as $pegawaiItem) {
                                            if ($pegawaiItem->id_pegawai == $x->id_pegawai) {
                                                $pegawaiName = $pegawaiItem->nama_pegawai;
                                                break;
                                            }
                                        }
                                        echo $pegawaiName;
                                        ?>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($x->tanggal_peminjaman)); ?></td>
                                    <td>
                                        <?php
                                        $buktiName = '';
                                        foreach ($barang as $barangItem) {
                                            if ($barangItem->id_barang == $x->id_barang) {
                                                $buktiName = $barangItem->nama_barang;
                                                break;
                                            }
                                        }
                                        echo $buktiName;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $kategoriName = '';
                                        foreach ($kategori as $kategoriItem) {
                                            if ($kategoriItem->id_kategori == $x->id_kategori) {
                                                $kategoriName = $kategoriItem->kategori;
                                                break;
                                            }
                                        }
                                        echo $kategoriName;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $lokasiName = '';
                                        foreach ($lokasi as $lokasiItem) {
                                            if ($lokasiItem->id_lokasi == $x->id_lokasi) {
                                                $lokasiName = $lokasiItem->lokasi;
                                                break;
                                            }
                                        }
                                        echo $lokasiName;
                                        ?>
                                    </td>
                                    <td>
                                        <?= $x->jumlah ?>
                                    </td>
                                    <td>
                                        <?= $x->tujuan ?>
                                    </td>
                                    <td>
                                        <?= $x->tanggal_pengembalian ?>
                                    </td>

                                    <td>
                                        <?= $x->status_peminjaman ?>
                                    </td>
                                    <td align="center">
                                        <a href="<?= base_url('admin/hapus_peminjaman/') . $x->id_peminjaman; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        <?php if ($x->status_peminjaman == 'Menunggu Persetujuan') { ?>
                                            <a href="<?= base_url('admin/setujui_peminjaman/') . $x->id_peminjaman; ?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                                            <a href="<?= base_url('admin/tolak_peminjaman/') . $x->id_peminjaman; ?>" class="btn btn-warning"><i class="fas fa-times"></i></a>
                                        <?php } else { ?>
                                            <button class="btn btn-primary" btn-sm" data-toggle="modal" data-target="#editModal<?= $x->id_peminjaman ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        <?php } ?>
                                    </td>

                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php foreach ($peminjaman as $x) : ?>
    <div class="modal fade" id="editModal<?= $x->id_peminjaman ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/proses_editpeminjaman/' . $x->id_peminjaman)  ?>" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            <!-- ... Your existing HTML code ... -->
                            <tr>
                                <td>Nama Pegawai</td>
                                <td>
                                    <select name="id_pegawai" class="form-control">
                                        <option value="">-- Pilih Nama Pegawai --</option>
                                        <?php foreach ($pegawai as $key => $value) { ?>
                                            <option value="<?= $value->id_pegawai ?>" <?= ($value->id_pegawai == $x->id_pegawai) ? 'selected' : '' ?>>
                                                <?= $value->nama_pegawai ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width=20%>Tanggal peminjaman</td>
                                <td><input type="date" name="tanggal_peminjaman" class="form-control" required placeholder="Tanggal peminjaman" value="<?= $x->tanggal_peminjaman ?>"></td>
                            </tr>
                            <tr>
                                <td>Nama Barang</td>
                                <td>
                                    <select name="id_barang" class="form-control">
                                        <option value="">-- Pilih Barang --</option>
                                        <?php foreach ($barang as $key => $value) { ?>
                                            <option value="<?= $value->id_barang ?>" <?= ($value->id_barang == $x->id_barang) ? 'selected' : '' ?>>
                                                <?= $value->id_barang ?> - <?= $value->nama_barang ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>
                                    <select name="id_kategori" class="form-control">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategori as $key => $value) { ?>
                                            <option value="<?= $value->id_kategori ?>" <?= ($value->id_kategori == $x->id_kategori) ? 'selected' : '' ?>>
                                                <?= $value->kategori ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Lokasi</td>
                                <td>
                                    <select name="id_lokasi" class="form-control">
                                        <option value="">-- Pilih Lokasi --</option>
                                        <?php foreach ($lokasi as $key => $value) { ?>
                                            <option value="<?= $value->id_lokasi ?>" <?= ($value->id_lokasi == $x->id_lokasi) ? 'selected' : '' ?>>
                                                <?= $value->lokasi ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width=20%>Jumlah</td>
                                <td><input type="number" name="jumlah" class="form-control" required placeholder="Jumlah" value="<?= $x->jumlah ?>"></td>
                            </tr>
                            <tr>
                                <td width=20%>Tujuan</td>
                                <td><input type="text" name="tujuan" class="form-control" required placeholder="Tujuan" value="<?= $x->tujuan ?>"></td>
                            </tr>
                            <tr>
                                <td width=20%>Tanggal Pengembalian</td>
                                <td><input type="date" name="tanggal_pengembalian" class="form-control" required placeholder="Tanggal Pengembalian" value="<?= $x->tanggal_pengembalian ?>"></td>
                            </tr>

                            <tr>
                                <td>Status Peminjaman</td>
                                <td>
                                    <select name="status_peminjaman" class="form-control">
                                        <option value="Menunggu Persetujuan" <?= ($x->status_peminjaman == 'Menunggu Persetujuan') ? 'selected' : '' ?>>Menunggu Persetujuan</option>
                                        <option value="Disetujui" <?= ($x->status_peminjaman == 'Disetujui') ? 'selected' : '' ?>>Disetujui</option>
                                        <option value="Ditolak" <?= ($x->status_peminjaman == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>