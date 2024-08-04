<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= sizeof($diagnosas) ?></h3>

                            <p>Jumlah Diagnosa</p>
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

                                    <button data-target="#tambahDiagnosa" data-toggle='modal' class="btn btn-primary">Tambah Diagnosa</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID Diagnosa</th>
                                                <th>KODE ICD</th>
                                                <th>Diagnosa</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($diagnosas as $item) : ?>
                                                <tr>
                                                    <td><?= $item['id']; ?></td>
                                                    <td><?= $item['kode_diagnosa']; ?></td>
                                                    <td><?= $item['diagnosa']; ?></td>
                                                    <td>
                                                        <button data-target="#editDiagnosa" data-toggle='modal' class="btn btn-warning btn-edit" data-id="<?= $item['id']; ?>" data-kode_icd="<?= $item['kode_diagnosa']; ?>" data-diagnosa="<?= $item['diagnosa']; ?>">Edit</button>
                                                        <a href="<?= base_url('/diagnosa/delete/' . $item['id']); ?>" onclick="return confirm('apakah kamu yakin ingin menghapus data ini')" class="btn btn-danger">Hapus</a>
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
                        <input type="hidden" name="_method" value="post">
                        <input type="text" id="id_user" name="id" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Diagnosa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Kode ICD</label>
                                    <input type="text" class="form-control" name="kode_icd" id="nama_lengkap">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">DIAGNOSA</label>
                                    <input type="text" class="form-control" name="diagnosa" id="username">
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
                    <form action="<?= base_url('/diagnosa/update'); ?>" method="post">
                        <input type="hidden" name="_method" value="put">
                        <input type="text" id="id" name="id" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Diagnosa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Kode ICD</label>
                                    <input type="text" class="form-control" name="kode_icd" id="kode_icd">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">DIAGNOSA</label>
                                    <input type="text" class="form-control" name="diagnosa" id="diagnosa">
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
        var kode_icd = $(this).data('kode_icd');
        var diagnos = $(this).data('diagnosa');
        $("#kode_icd").val(kode_icd)
        $("#diagnosa").val(diagnos)
        $("#id").val(id)
    });
</script>
<!-- /.content-wrapper -->