<body class="bg-gradient-success">
    <div class="mbr-slider slide carousel" data-keyboard="false" data-ride="carousel" data-interval="2000" data-pause="true">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card o-hidden border-0 shadow-lg my-5 ">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <!-- Page Heading -->
                                        <div class="card">
                                            <div class="card-header">
                                                Edit Data Supplier
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <?= validation_errors() ?>
                                                        <form action="<?= base_url('admin/proses_edit_supplier/' . $data->id_supplier)  ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <tr>
                                                                    <td width=20%>Nama Supplier</td>
                                                                    <td><input type="text" name="nama_supplier" class="form-control" required placeholder="Nama Supplier" value="<?= $data->nama_supplier ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>Alamat</td>
                                                                    <td><input type="textarea" name="alamat" class="form-control" required placeholder="Alamat" value="<?= $data->alamat ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>No Telpon</td>
                                                                    <td><input type="text" name="no_telp" class="form-control" required placeholder="No Telpon" value="<?= $data->no_telp ?>"></td>
                                                                </tr>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn-success">Simpan</button>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>
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
</body>