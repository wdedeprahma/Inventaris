<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">Data Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <a href="<?= base_url('admin/tambah_barang_masuk') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                    <a href="<?= base_url('admin/cetak_barang_masuk') . '?' . http_build_query($_GET) ?>" class="btn btn-success "> <i class="fas fa-print"></i> Cetak Data</a>
                    <hr>
                    <form method="GET" action="<?= base_url('admin/data_barang_masuk') ?>" class="custom-form">
                        <div class="row">
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
                            <div class="col-md-2 mb-0">
                                <label for="filterTanggalMulai">Tanggal Mulai</label>
                                <input type="date" name="tanggalmulai" id="filterTanggalMulai" class="form-control" value="<?= isset($_GET['tanggalmulai']) ? $_GET['tanggalmulai'] : '' ?>">
                            </div>
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
                            <th>Tanggal Masuk</th>
                            <th>Nama Barang</th>
                            <th>Kategori Barang</th>
                            <th>Jumlah Masuk</th>
                            <th>Penanggung Jawab</th>
                            <th>Supplier</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($barang_masuk as $x) {
                            // Apply filters
                            $isFiltered = true;
                            if (isset($_GET['kategori']) && !empty($_GET['kategori']) && $_GET['kategori'] != $x->id_kategori) {
                                $isFiltered = false;
                            }
                            if (isset($_GET['tanggalmulai']) && !empty($_GET['tanggalmulai'])) {
                                $tanggal_mulai = date('Y-m-d', strtotime($_GET['tanggalmulai']));
                                if (date('Y-m-d', strtotime($x->tanggal_masuk)) < $tanggal_mulai) {
                                    $isFiltered = false;
                                }
                            }
                            if (isset($_GET['tanggalakhir']) && !empty($_GET['tanggalakhir'])) {
                                $tanggal_akhir = date('Y-m-d', strtotime($_GET['tanggalakhir']));
                                if (date('Y-m-d', strtotime($x->tanggal_masuk)) > $tanggal_akhir) {
                                    $isFiltered = false;
                                }
                            }
                            if ($isFiltered) {
                        ?>
                                <tr>
                                    <td><?= $nomor++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($x->tanggal_masuk)); ?></td>
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
                                    <td><?= $x->jumlahm ?></td>
                                    <td>
                                        <?php
                                        $buktiName = '';
                                        foreach ($pegawai as $pegawaiItem) {
                                            if ($pegawaiItem->id_pegawai == $x->id_pegawai) {
                                                $buktiName = $pegawaiItem->nama_pegawai;
                                                break;
                                            }
                                        }
                                        echo $buktiName;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $buktiName = '';
                                        foreach ($supplier as $supplierItem) {
                                            if ($supplierItem->id_supplier == $x->id_supplier) {
                                                $buktiName = $supplierItem->nama_supplier;
                                                break;
                                            }
                                        }
                                        echo $buktiName;
                                        ?>
                                    </td>

                                    <td align="center">
                                        <a href="<?= base_url('admin/hapus_barang_masuk/') . $x->id_bmasuk; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        <button class="btn btn-primary" btn-sm" data-toggle="modal" data-target="#editModal<?= $x->id_bmasuk ?>">
                                            <i class="fas fa-pen"></i>
                                        </button>
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
<?php foreach ($barang_masuk as $x) : ?>
    <div class="modal fade" id="editModal<?= $x->id_bmasuk ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Barang Masuk</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/proses_editbarang_masuk/' . $x->id_bmasuk)  ?>" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            <!-- ... Your existing HTML code ... -->
                            <tr>
                                <td width=20%>Tanggal Masuk</td>
                                <td><input type="date" name="tanggal_masuk" class="form-control" required placeholder="Tanggal Masuk" value="<?= $x->tanggal_masuk ?>"></td>
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
                                <td>Penanggung Jawab</td>
                                <td>
                                    <select name="id_pegawai" class="form-control">
                                        <option value="">-- Pilih Pegawai --</option>
                                        <?php foreach ($pegawai as $key => $value) { ?>
                                            <option value="<?= $value->id_pegawai ?>" <?= ($value->id_pegawai == $x->id_pegawai) ? 'selected' : '' ?>>
                                                <?= $value->nama_pegawai ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width=20%>Jumlah Masuk</td>
                                <td><input type="text" name="jumlahm" class="form-control" required placeholder="Jumlah Masuk" value="<?= $x->jumlahm ?>"></td>
                            </tr>
                            <tr>
                                <td>Supplier</td>
                                <td>
                                    <select name="id_supplier" class="form-control">
                                        <option value="">-- Pilih Supplier--</option>
                                        <?php foreach ($supplier as $key => $value) { ?>
                                            <option value="<?= $value->id_supplier ?>" <?= ($value->id_supplier == $x->id_supplier) ? 'selected' : '' ?>>
                                                <?= $value->nama_supplier ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- ... Your existing HTML code ... -->
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
<?php endforeach; ?>