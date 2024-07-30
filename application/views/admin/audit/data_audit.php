<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Audit Inventory</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <a href="<?= base_url('admin/tambah_audit') ?>" class="btn btn-primary"> <i class="fas fa-plus"></i> Tambah Audit</a>
                    <a href="<?= base_url('admin/cetak_audit') . '?' . http_build_query($_GET) ?>" class="btn btn-success"> <i class="fas fa-print"></i> Cetak Data</a>
                    <hr>
                    <form method="GET" action="<?= base_url('admin/data_audit') ?>" class="custom-form">
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
                            <th>Tanggal Audit</th>
                            <th>Nama Auditor</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok Sistem</th>
                            <th>Stok Aktual</th>
                            <th>Selisih Stok</th>
                            <th>Harga</th>
                            <th>Hasil Audit</th>
                            <th>Catatan Audit</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($audit as $x) {
                            // Apply filters
                            $isFiltered = true;
                            if (isset($_GET['kategori']) && !empty($_GET['kategori']) && $_GET['kategori'] != $x->id_kategori) {
                                $isFiltered = false;
                            }
                            if (isset($_GET['tanggalmulai']) && !empty($_GET['tanggalmulai'])) {
                                $tanggal_mulai = date('Y-m-d', strtotime($_GET['tanggalmulai']));
                                if (date('Y-m-d', strtotime($x->tanggal_audit)) < $tanggal_mulai) {
                                    $isFiltered = false;
                                }
                            }
                            if (isset($_GET['tanggalakhir']) && !empty($_GET['tanggalakhir'])) {
                                $tanggal_akhir = date('Y-m-d', strtotime($_GET['tanggalakhir']));
                                if (date('Y-m-d', strtotime($x->tanggal_audit)) > $tanggal_akhir) {
                                    $isFiltered = false;
                                }
                            }
                            if ($isFiltered) {
                        ?>
                                <tr>
                                    <td><?= $nomor++; ?></td>

                                    <td><?= date('d-m-Y', strtotime($x->tanggal_audit)); ?></td>
                                    <td>
                                        <?php
                                        $namapegawai = '';
                                        foreach ($pegawai as $pegawaiItem) {
                                            if ($pegawaiItem->id_pegawai == $x->id_pegawai) {
                                                $namapegawai = $pegawaiItem->nama_pegawai;
                                                break;
                                            }
                                        }
                                        echo $namapegawai;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $namaBarang = '';
                                        foreach ($barang as $barangItem) {
                                            if ($barangItem->id_barang == $x->id_barang) {
                                                $namaBarang = $barangItem->nama_barang;
                                                break;
                                            }
                                        }
                                        echo $namaBarang;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $namaKategori = '';
                                        foreach ($kategori as $kategoriItem) {
                                            if ($kategoriItem->id_kategori == $x->id_kategori) {
                                                $namaKategori = $kategoriItem->kategori;
                                                break;
                                            }
                                        }
                                        echo $namaKategori;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $namaBarang = '';
                                        foreach ($barang as $barangItem) {
                                            if ($barangItem->id_barang == $x->id_barang) {
                                                $namaBarang = $barangItem->stok;
                                                break;
                                            }
                                        }
                                        echo $namaBarang;
                                        ?>
                                    </td>
                                    <td><?= $x->stok_aktual ?></td>
                                    <td><?= $x->selisih_stok ?></td>
                                    <td><?= "Rp. " . number_format($x->harga_per_unit, 0, ',', '.'); ?></td>
                                    <td><?= $x->hasil_audit ?></td>
                                    <td><?= $x->catatan_audit ?></td>
                                    <td align="center">
                                        <?php if (!empty($x->bukti)) : ?>
                                            <?php $ext = pathinfo($x->bukti, PATHINFO_EXTENSION); ?>
                                            <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                                                <img src="<?= base_url('uploads/' . $x->bukti) ?>" alt="Bukti" style="max-width: 150px; max-height: 100px;">
                                            <?php else : ?>
                                                <i class="fas fa-file-<?= $ext == 'pdf' ? 'pdf' : 'alt' ?>"></i>
                                                <span><?= $x->bukti ?></span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            Tidak ada bukti
                                        <?php endif; ?>
                                    </td>
                                    <td align="center">
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <?php if (!empty($x->bukti)) : ?>
                                                <a href="<?= base_url('admin/download_bukti/' . $x->bukti) ?>" class="btn btn-info btn-sm" title="Download Bukti">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="<?= base_url('admin/hapus_audit/') . $x->id_audit; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $x->id_audit ?>" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </div>
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

<?php foreach ($audit as $x) : ?>
    <div class="modal fade" id="editModal<?= $x->id_audit ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Audit Inventory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/proses_edit_audit/' . $x->id_audit) ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="tanggal_audit<?= $x->id_audit ?>">Tanggal Audit</label>
                            <input type="date" id="tanggal_audit<?= $x->id_audit ?>" name="tanggal_audit" class="form-control" required placeholder="Tanggal Audit" value="<?= $x->tanggal_audit ?>">
                        </div>
                        <div class="form-group">
                            <label for="id_pegawai<?= $x->id_audit ?>">Nama Auditor</label>
                            <select id="id_pegawai<?= $x->id_audit ?>" name="id_pegawai" class="form-control">
                                <option value="">-- Pilih pegawai --</option>
                                <?php foreach ($pegawai as $value) : ?>
                                    <option value="<?= $value->id_pegawai ?>" <?= ($value->id_pegawai == $x->id_pegawai) ? 'selected' : '' ?>>
                                        <?= $value->nama_pegawai ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_barang<?= $x->id_audit ?>">Nama Barang</label>
                            <select id="id_barang<?= $x->id_audit ?>" name="id_barang" class="form-control" onchange="updateStok(<?= $x->id_audit ?>)">
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang as $value) : ?>
                                    <option value="<?= $value->id_barang ?>" <?= ($value->id_barang == $x->id_barang) ? 'selected' : '' ?> data-stok="<?= $value->stok ?>">
                                        <?= $value->id_barang ?> - <?= $value->nama_barang ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori<?= $x->id_audit ?>">Kategori</label>
                            <select id="id_kategori<?= $x->id_audit ?>" name="id_kategori" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $value) : ?>
                                    <option value="<?= $value->id_kategori ?>" <?= ($value->id_kategori == $x->id_kategori) ? 'selected' : '' ?>>
                                        <?= $value->kategori ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stok_sistem<?= $x->id_audit ?>">Stok Sistem</label>
                            <input type="text" id="editStok<?= $x->id_audit ?>" name="stok_sistem" class="form-control mt-2" readonly value="<?= $x->stok_sistem ?>">
                        </div>
                        <div class="form-group">
                            <label for="stok_aktual<?= $x->id_audit ?>">Stok Aktual</label>
                            <input type="text" id="stok_aktual<?= $x->id_audit ?>" name="stok_aktual" class="form-control" required placeholder="Stok Aktual" value="<?= $x->stok_aktual ?>" oninput="updateSelisih(<?= $x->id_audit ?>)">
                        </div>
                        <div class="form-group">
                            <label for="selisih_stok<?= $x->id_audit ?>">Selisih Stok</label>
                            <input type="text" id="selisih_stok<?= $x->id_audit ?>" name="selisih_stok" class="form-control mt-2" readonly value="<?= $x->selisih_stok ?>">
                        </div>
                        <div class="form-group">
                            <label for="harga_per_unit<?= $x->id_audit ?>">Harga Per Unit</label>
                            <input type="text" id="harga_per_unit<?= $x->id_audit ?>" name="harga_per_unit" class="form-control" required placeholder="Harga Per Unit" value="<?= $x->harga_per_unit ?>">
                        </div>
                        <div class="form-group">
                            <label for="hasil_audit<?= $x->id_audit ?>">Hasil Audit</label>
                            <select id="hasil_audit<?= $x->id_audit ?>" name="hasil_audit" class="form-control">
                                <option value="Sesuai" <?= ($x->hasil_audit == 'Sesuai') ? 'selected' : '' ?>>Sesuai</option>
                                <option value="Tidak Sesuai" <?= ($x->hasil_audit == 'Tidak Sesuai') ? 'selected' : '' ?>>Tidak Sesuai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catatan_audit<?= $x->id_audit ?>">Catatan Audit</label>
                            <textarea id="catatan_audit<?= $x->id_audit ?>" name="catatan_audit" class="form-control" required placeholder="Catatan Audit"><?= $x->catatan_audit ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="bukti<?= $x->id_audit ?>">Bukti</label>
                            <?php if (!empty($x->bukti)) : ?>
                                <?php
                                $file_extension = pathinfo($x->bukti, PATHINFO_EXTENSION);
                                if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                                    <img src="<?= base_url('uploads/' . $x->bukti) ?>" class="img-fluid" alt="Bukti">
                                <?php elseif ($file_extension === 'pdf') : ?>
                                    <iframe src="<?= base_url('uploads/' . $x->bukti) ?>" width="100%" height="500px"></iframe>
                                <?php elseif (in_array($file_extension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])) : ?>
                                    <a href="<?= base_url('admin/download_bukti/' . $x->bukti) ?>" class="btn btn-info btn-sm" target="_blank">
                                        <i class="fas fa-file-alt"></i> Lihat Bukti
                                    </a>
                                <?php else : ?>
                                    <a href="<?= base_url('admin/download_bukti/' . $x->bukti) ?>" class="btn btn-info btn-sm" target="_blank">
                                        <i class="fas fa-download"></i> Lihat Bukti
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                Tidak ada bukti
                            <?php endif; ?>
                            <input type="file" id="bukti<?= $x->id_audit ?>" name="bukti" class="form-control mt-2">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    function updateStok(id) {
        const selectBarang = document.getElementById(`id_barang${id}`);
        const stokInput = document.getElementById(`editStok${id}`);
        const selectedOption = selectBarang.options[selectBarang.selectedIndex];
        const stok = selectedOption.getAttribute('data-stok');
        stokInput.value = stok;
        updateSelisih(id); // Update selisih stok saat stok sistem diubah
    }

    function updateSelisih(id) {
        const stokSistem = parseFloat(document.getElementById(`editStok${id}`).value) || 0;
        const stokAktual = parseFloat(document.getElementById(`stok_aktual${id}`).value) || 0;
        const selisihStok = stokAktual - stokSistem;
        document.getElementById(`selisih_stok${id}`).value = selisihStok;
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($audit as $x) : ?>
            updateStok(<?= $x->id_audit ?>);
        <?php endforeach; ?>
    });
</script>