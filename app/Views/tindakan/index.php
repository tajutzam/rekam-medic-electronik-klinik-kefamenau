<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= sizeof($tindakans) ?></h3>

                            <p>Jumlah Tindakan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <section class="content">
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <?php if (session()->has('success')) : ?>
                                        <div class="alert alert-success">
                                            <?= session('success') ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Contoh penanganan pesan kesalahan -->
                                    <?php if (session()->has('errors')) : ?>
                                        <div class="alert alert-danger">
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?= $error ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <button data-target="#tambahDiagnosa" data-toggle='modal' class="btn btn-primary">Tambah tindakan</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Tindakan</th>
                                                <th>Tindakan</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tindakans as $item) : ?>
                                                <tr>
                                                    <td><?= $item['kode_tindakan']; ?></td>
                                                    <td><?= $item['tindakan']; ?></td>
                                                    <td>
                                                        <button data-target="#editDiagnosa" data-toggle='modal' class="btn btn-warning btn-edit" data-id="<?= $item['id']; ?>" data-kode="<?= $item['kode_tindakan']; ?>" data-tindakan="<?= $item['tindakan']; ?>" data-tarif="<?= $item['tarif']; ?>">Edit</button>
                                                        <a href="<?= base_url('/tindakan/delete/' . $item['id']); ?>" onclick="return confirm('apakah kamu yakin ingin menghapus data ini')" class="btn btn-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>

            <div class="modal fade" id="tambahDiagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post">
                        <input type="text" id="id" name="id" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah tindakan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">KODE Tindakan</label>
                                    <input type="text" class="form-control" name="kode_tindakan" id="tindakan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Tindakan</label>
                                    <input type="text" class="form-control" name="tindakan" id="dosis">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="editDiagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?= base_url('/tindakan/update'); ?>" method="post">
                        <input type="text" id="id_edit" name="id" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit tindakan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">KODE Tindakan</label>
                                    <input type="text" class="form-control" name="kode_tindakan" id="kode_tindakan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Tindakan</label>
                                    <input type="text" class="form-control" name="tindakan" id="tindakan_edit">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
</div>

<script>
    $(document).on("click", ".btn-edit", function() {
        var id = $(this).data('id');
        var kode_tindakan = $(this).data('kode');
        var tindakan = $(this).data('tindakan');
        var tarif = $(this).data('tarif');
        console.log(tindakan)

        $('#id_edit').val(id);
        $('#kode_tindakan').val(kode_tindakan);
        $('#tindakan_edit').val(tindakan);

    });
</script>
<!-- /.content-wrapper -->