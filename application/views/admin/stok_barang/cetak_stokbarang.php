<div class="container-fluid">
    <!-- Page Heading -->
    <table>
        <tr align="left">
            <th rowspan="2"><img src="<?= base_url('assets/kopsurat.png') ?>" width="100%">
            </th>
        </tr>
    </table>
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold" style="text-align: center;"><u>LAPORAN DATA PERSEDIAN BARANG</u></h3>
            </div>
            <table class="table table-bordered" border="1" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Total Stok</th>
                        <th>Harga</th>
                        <th>Tanggal Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($stokbarang as $x) {
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
                            <td><?= $x->hargaunit; ?></td>
                            <td><?= date('d-m-Y', strtotime($x->tanggalupdate)); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
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
        window.print()
    </script>
</div>