<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">Data pegawai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container ml-1">
                    <a href="<?= base_url('admin/tambah_pegawai') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                    <hr>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama pegawai</th>
                            <th>Jabatan</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($data as $x) { ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $x->nama_pegawai; ?></td>
                                <td><?= $x->jabatan; ?></td>
                                <td align="center">
                                    <a href="<?= base_url('admin/hapus_pegawai/') . $x->id_pegawai; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    <!-- <a href="<?= base_url('admin/edit_pegawai/') . $x->id_pegawai; ?>" class="btn btn-primary"><i class="fas fa-pen"></i></a> -->
                                    <button class="btn btn-primary" btn-sm data-toggle="modal" data-target="#editModal<?= $x->id_pegawai ?>">
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
    <div class="modal fade" id="editModal<?= $x->id_pegawai ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data pegawai</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/proses_edit_pegawai/' . $x->id_pegawai)  ?>" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            <!-- ... Your existing HTML code ... -->
                            <tr>
                                <td width=20%>Nama pegawai</td>
                                <td><input type="text" name="nama_pegawai" class="form-control" required placeholder="Masukkan Nama pegawai" value="<?= $x->nama_pegawai ?>"></td>
                            </tr>
                            <tr>
                                <td width=20%>Jabatan</td>
                                <td><input type="text" name="jabatan" class="form-control" required placeholder="Masukkan Jabatan" value="<?= $x->jabatan ?>"></td>
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