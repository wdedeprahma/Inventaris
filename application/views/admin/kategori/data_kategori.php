 <div class="container-fluid py-4">
     <div class="row">
         <div class="col-12">
             <div class="card mb-4">
                 <div class="card-header pb-0">
                     <h6 class="m-0 font-weight-bold">Data kategori</h6>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <div class="container ml-1">
                             <a href="<?= base_url('admin/tambah_kategori') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                             <hr>
                         </div>
                         <div class="card-body px-0 pt-0 pb-2">
                             <div class="table-responsive p-0">
                                 <table class="table align-items-center mb-0" id="dataTable" width="100%" cellspacing="0">
                                     <thead>
                                         <tr>
                                             <th>No</th>
                                             <th>kategori</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            $nomor = 1;
                                            foreach ($data as $x) { ?>
                                             <tr>
                                                 <td><?= $nomor++; ?></td>
                                                 <td><?= $x->kategori; ?></td>
                                                 <td align="center">
                                                     <a href="<?= base_url('admin/hapus_kategori/') . $x->id_kategori; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-circle btn-danger"><i class="fas fa-trash"></i></a>
                                                     <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $x->id_kategori ?>">
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
             </div>
         </div>
     </div>
     <?php foreach ($data as $x) : ?>
         <div class="modal fade" id="editModal<?= $x->id_kategori ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $x->id_kategori ?>" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="editModalLabel<?= $x->id_kategori ?>">Edit kategori</h5>
                         <button type="button" class="close bg-danger p-2" style="border: none; border-radius: 5px;" data-bs-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true" class="text-white">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form action="<?= base_url('admin/proses_edit_kategori/' . $x->id_kategori) ?>" method="POST" enctype="multipart/form-data">
                             <table class="table">
                                 <tr>
                                     <td width="20%">kategori</td>
                                     <td><input type="text" name="kategori" class="form-control" required placeholder="Masukkan Nama kategori" value="<?= $x->kategori ?>"></td>
                                 </tr>
                                 <tr>
                                     <td>
                                         <button class="btn btn-success">Simpan</button>
                                     </td>
                                 </tr>
                             </table>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     <?php endforeach; ?>