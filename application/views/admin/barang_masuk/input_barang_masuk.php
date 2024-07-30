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
                                                Tambah Barang Masuk
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <?= validation_errors() ?>
                                                        <form action="<?= base_url('admin/proses_tambahbarang_masuk') ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <tr>
                                                                    <td width="20%">Tanggal Masuk</td>
                                                                    <td><input type="date" name="tanggal_masuk" class="form-control" required placeholder="Tanggal Masuk"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Penanggung Jawab</td>
                                                                    <td><select name="id_pegawai" class="form-control" required>
                                                                            <option value="">-- Nama Pegawai --</option>
                                                                            <?php foreach ($pegawai as $key => $value) { ?>
                                                                                <option value="<?= $value->id_pegawai ?>"><?= $value->nama_pegawai ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Supplier</td>
                                                                    <td><select name="id_supplier" class="form-control" required>
                                                                            <option value="">-- Supplier --</option>
                                                                            <?php foreach ($supplier as $key => $value) { ?>
                                                                                <option value="<?= $value->id_supplier ?>"><?= $value->nama_supplier ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <!-- Dynamic Items Section -->
                                                            <div id="dynamic-items-section">
                                                                <table class="table" id="dynamic-items">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nama Barang</th>
                                                                            <th>Kategori</th>
                                                                            <th>Jumlah Masuk</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><select name="items[0][id_barang]" class="form-control" required>
                                                                                    <option value="">-- Nama Barang --</option>
                                                                                    <?php foreach ($data as $key => $value) { ?>
                                                                                        <option value="<?= $value->id_barang ?>"><?= $value->id_barang ?> - <?= $value->nama_barang ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </td>
                                                                            <td><select name="items[0][id_kategori]" class="form-control" required>
                                                                                    <option value="">-- Kategori --</option>
                                                                                    <?php foreach ($kategori as $key => $value) { ?>
                                                                                        <option value="<?= $value->id_kategori ?>"><?= $value->kategori ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="items[0][jumlahm]" class="form-control" required placeholder="Jumlah Masuk"></td>
                                                                            <td><button type="button" class="btn btn-danger" onclick="removeItem(this)">Hapus</button></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <button type="button" class="btn btn-primary" onclick="addItem()">Tambah Barang</button>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
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
        let itemCount = 1;

        function addItem() {
            const itemSection = document.querySelector('#dynamic-items tbody');
            const newItem = document.createElement('tr');
            newItem.innerHTML = `
                <td><select name="items[${itemCount}][id_barang]" class="form-control" required>
                        <option value="">-- Nama Barang --</option>
                        <?php foreach ($data as $key => $value) { ?>
                            <option value="<?= $value->id_barang ?>"><?= $value->id_barang ?> - <?= $value->nama_barang ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><select name="items[${itemCount}][id_kategori]" class="form-control" required>
                        <option value="">-- Kategori --</option>
                        <?php foreach ($kategori as $key => $value) { ?>
                            <option value="<?= $value->id_kategori ?>"><?= $value->kategori ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="text" name="items[${itemCount}][jumlahm]" class="form-control" required placeholder="Jumlah Masuk"></td>
                <td><button type="button" class="btn btn-danger" onclick="removeItem(this)">Hapus</button></td>
            `;
            itemSection.appendChild(newItem);
            itemCount++;
        }

        function removeItem(button) {
            const row = button.closest('tr');
            row.remove();
        }
    </script>
</body>