<div class="container-fluid">
    <!-- Page Heading -->
    <table>
        <tr align="left">
            <th rowspan="2"><img src="<?= base_url('assets/kopsurat.png') ?>" width="100%"></th>
        </tr>
    </table>
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold" style="text-align: center;"><u>LAPORAN DATA AUDIT INVENTORY</u></h3>
            </div>
            <table class="table table-bordered" border="1" id="dataTable" width="100%" cellspacing="0">
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
                                <td><?= number_format($x->harga_per_unit, 2, ',', '.') ?></td>
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
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <div style="margin-top: 20px;">
                <?php
                $bulan = array(
                    'Januari', 'Februari', 'Maret', 'April',
                    'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                );
                $tanggal = date('d');
                $bulan_index = date('n') - 1;
                $tahun = date('Y');
                ?>
                <p style="text-align: right;">Tumbang Samba, <?= $tanggal . ' ' . $bulan[$bulan_index] . ' ' . $tahun; ?> <br>
                    Madrasah Tsanawiyah Negri 1 Katingan
                </p>
                <br>
                <p style="text-align: right;"><b><u>DRA.ASMAWATI</u></b></p>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</div>