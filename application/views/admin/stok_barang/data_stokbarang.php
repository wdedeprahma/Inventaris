<body class="bg-gradient-success">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Data Persediaan Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="mb-3">
                        <div>
                            <a href="<?= base_url('admin/tambah_stokbarang') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                            <a href="<?= base_url('admin/cetak_stokbarang') . '?' . http_build_query($_GET) ?>" class="btn btn-success ml-2">
                                <i class="fas fa-print"></i> Cetak Data
                            </a>
                            <form method="GET" action="<?= base_url('admin/data_stokbarang') ?>" class="custom-form">
                                <div class="row">
                                    <div class="col-md-2 mb-0">
                                        <label for="filterKategori">Kategori</label>
                                        <select name="kategori" id="filterKategori" class="form-control">
                                            <option value="">-- Pilih Kategori --</option>
                                            <?php foreach ($barang as $value) { ?>
                                                <option value="<?= $value->id_barang ?>" <?= isset($_GET['kategori']) && $_GET['kategori'] == $value->id_kategori ? 'selected' : '' ?>>
                                                    <?= $value->stok ?>
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
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Total Stok</th>
                                <th>Harga</th>
                                <th>Tanggal Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            foreach ($stokbarang as $x) {
                                // Apply filters
                                $isFiltered = true;
                                if (isset($_GET['kategori']) && !empty($_GET['kategori']) && $_GET['kategori'] != $x->id_kategori) {
                                    $isFiltered = false;
                                }
                                if (isset($_GET['tanggalmulai']) && !empty($_GET['tanggalmulai'])) {
                                    $tanggal_mulai = date('Y-m-d', strtotime($_GET['tanggalmulai']));
                                    if (date('Y-m-d', strtotime($x->tanggalupdate)) < $tanggal_mulai) {
                                        $isFiltered = false;
                                    }
                                }
                                if (isset($_GET['tanggalakhir']) && !empty($_GET['tanggalakhir'])) {
                                    $tanggal_akhir = date('Y-m-d', strtotime($_GET['tanggalakhir']));
                                    if (date('Y-m-d', strtotime($x->tanggalupdate)) > $tanggal_akhir) {
                                        $isFiltered = false;
                                    }
                                }
                                if ($isFiltered) {
                            ?>
                                    <tr>
                                        <td><?= $nomor++; ?></td>
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
                                        <td><?= $x->satuan; ?></td>
                                        <td>
                                            <?php
                                            $buktiName = '';
                                            foreach ($barang as $barangItem) {
                                                if ($barangItem->id_barang == $x->id_barang) {
                                                    $buktiName = $barangItem->stok;
                                                    break;
                                                }
                                            }
                                            echo $buktiName;
                                            ?>
                                        </td>
                                        <td><?= "Rp. " . number_format($x->hargaunit, 0, ',', '.'); ?></td>
                                        <td><?= date('d-m-Y', strtotime($x->tanggalupdate)); ?></td>
                                        <td align="center">
                                            <a href="<?= base_url('admin/hapus_stokbarang/') . $x->id_stok; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $x->id_stok ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </td>
                                    </tr>
                            <?php
                                } // End if isFiltered
                            } // End foreach
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($stokbarang as $x) : ?>
        <div class="modal fade" id="editModal<?= $x->id_stok ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Stok Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('admin/proses_editstokbarang/' . $x->id_stok) ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="editBarang<?= $x->id_stok ?>">Nama Barang</label>
                                <select name="id_barang" id="editBarang<?= $x->id_stok ?>" class="form-control" onchange="updateStok(<?= $x->id_stok ?>)">
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach ($barang as $value) { ?>
                                        <option value="<?= $value->id_barang ?>" <?= ($value->id_barang == $x->id_barang) ? 'selected' : '' ?> data-stok="<?= $value->stok ?>">
                                            <?= $value->id_barang ?> - <?= $value->nama_barang ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editKategori<?= $x->id_stok ?>">Kategori</label>
                                <select name="id_kategori" id="editKategori<?= $x->id_stok ?>" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $value) { ?>
                                        <option value="<?= $value->id_kategori ?>" <?= ($value->id_kategori == $x->id_kategori) ? 'selected' : '' ?>>
                                            <?= $value->kategori ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editSatuan<?= $x->id_stok ?>">Satuan</label>
                                <input type="text" name="satuan" id="editSatuan<?= $x->id_stok ?>" class="form-control" required placeholder="Satuan" value="<?= $x->satuan ?>">
                            </div>
                            <div class="form-group">
                                <label for="editStok<?= $x->id_stok ?>">Stok</label>
                                <input type="text" id="editStok<?= $x->id_stok ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="editHargaUnit<?= $x->id_stok ?>">Harga </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" name="hargaunit" id="editHargaUnit<?= $x->id_stok ?>" class="form-control" required placeholder="Harga " value="<?= $x->hargaunit ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editTanggalUpdate<?= $x->id_stok ?>">Tanggal Update</label>
                                <input type="date" name="tanggalupdate" id="editTanggalUpdate<?= $x->id_stok ?>" class="form-control" required value="<?= $x->tanggalupdate ?>">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function updateStok(id) {
            const selectBarang = document.getElementById(`editBarang${id}`);
            const stokInput = document.getElementById(`editStok${id}`);
            const selectedOption = selectBarang.options[selectBarang.selectedIndex];
            const stok = selectedOption.getAttribute('data-stok');
            stokInput.value = stok;
        }

        // Initialize the stok values on page load
        <?php foreach ($stokbarang as $x) : ?>
            updateStok(<?= $x->id_stok ?>);
        <?php endforeach; ?>
    </script>