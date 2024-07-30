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
                <h3 class="m-0 font-weight-bold" style="text-align: center;"><u>LAPORAN DATA PENGEMBALIAN BARANG </u></h3>
            </div>
            <table class="table table-bordered" border="1" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Nama Barang</th>
                        <th>Kategori Barang</th>
                        <th>Lokasi</th>
                        <th>Jumlah</th>
                        <th>Tanggal Terima</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($pengembalian as $x) { ?>
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
                            <td><?= date('d-m-Y', strtotime($x->tanggal_pengembalian)); ?></td>
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
                                <?php if ($x->status_pengembalian == 'Diterima') { ?>
                                    <?= date('d-m-Y', strtotime($x->tanggal_diterima)); ?>
                                <?php } else { ?>
                                    -
                                <?php } ?>
                            </td>
                            <td>
                                <?= $x->status_pengembalian ?>
                            </td>

                        </tr>
                    <?php } ?>
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