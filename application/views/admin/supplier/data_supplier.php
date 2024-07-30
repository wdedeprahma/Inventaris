<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">Data Supplier</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container ml-1">
                    <a href="<?= base_url('admin/tambah_supplier') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                    <hr>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No Telpon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($data as $x) { ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $x->nama_supplier; ?></td>
                                <td><?= $x->alamat; ?></td>
                                <td><?= $x->no_telp; ?></td>
                                <td align="center">
                                    <a href="<?= base_url('admin/hapus_supplier/') . $x->id_supplier; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    <!-- <a href="<?= base_url('admin/edit_supplier/') . $x->id_supplier; ?>" class="btn btn-primary"><i class="fas fa-pen"></i></a> -->
                                    <button class="btn btn-primary" btn-sm data-toggle="modal" data-target="#editModal<?= $x->id_supplier ?>">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php foreach ($data as $x) : ?>
    <div class="modal fade" id="editModal<?= $x->id_supplier ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Supplier</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/proses_edit_supplier/' . $x->id_supplier)  ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <!-- ... Your existing HTML code ... -->
                                                                <tr>
                                                                    <td width=20%>Nama Supplier</td>
                                                                    <td><input type="text" name="nama_supplier" class="form-control" required placeholder="Masukkan Nama Barang" value="<?= $x->nama_supplier ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <!-- <td>Kategori</td>
                                                                    <td>
                                                                        <select name="id_kategori" class="form-control">
                                                                            <option value="">-- Pilih Kategori --</option>
                                                                            <?php foreach ($kategori as $key => $value) { ?>
                                                                                <option value="<?= $value->id_kategori ?>" <?= ($value->id_kategori == $x->id_kategori) ? 'selected' : '' ?>>
                                                                                    <?= $value->kategori ?>
                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td> -->
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>Alamat</td>
                                                                    <td><input type="text" name="alamat" class="form-control" required placeholder="Masukkan Nama Kategori" value="<?= $x->alamat ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>No Telpon</td>
                                                                    <td><input type="text" name="no_telp" class="form-control" required placeholder="Masukkan Nama Kategori" value="<?= $x->no_telp ?>"></td>
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