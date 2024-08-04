<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= sizeof($obats) ?></h3>
                            <p>Jumlah Obat</p>
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

                                    <button data-target="#tambahDiagnosa" data-toggle='modal' class="btn btn-primary">Tambah Obat</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Obat</th>
                                                <th>Dosis</th>
                                                <th>Satuan</th>
                                                <th>Nama</th>
                                                <th>Harga Obat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($obats as $item) : ?>
                                                <tr>
                                                    <td><?= $item['kode_obat']; ?></td>

                                                    <td><?= $item['dosis']; ?></td>
                                                    <td><?= $item['satuan']; ?></td>
                                                    <td><?= $item['nama_obat']; ?></td>
                                                    <td>Rp.<?= $item['harga']; ?></td>
                                                    <td>
                                                        <button data-target="#editDiagnosa" data-toggle='modal' class="btn btn-warning btn-edit" data-id="<?= $item['id']; ?>" data-dosis="<?= $item['dosis']; ?>" _method data-kode="<?= $item['kode_obat']; ?>" data-satuan="<?= $item['satuan']; ?>" data-harga="<?= $item['harga']; ?>" data-nama="<?= $item['nama_obat']; ?>">Edit</button>
                                                        <a href="<?= base_url('/obat/delete/' . $item['id']); ?>" onclick="return confirm('apakah kamu yakin ingin menghapus data ini')" class="btn btn-danger">Hapus</a>
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
                        <input type="hidden" name="_method" value="put">
                        <input type="text" id="id_user" name="id" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">KODE OBAT</label>
                                    <input type="text" class="form-control" name="kode_obat" id="nama_lengkap">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">DOSIS</label>
                                    <input type="text" class="form-control" name="dosis" id="username">
                                </div>

                                <div class="mb-3">
                                    <label class="form-check-label" for="">SATUAN</label>
                                    <input type="text" class="form-control" name="satuan" id="username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">NAMA</label>
                                    <input type="text" class="form-control" name="nama_obat" id="username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">HARGA OBAT</label>
                                    <input type="number" class="form-control" name="harga" id="username">
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
                    <form action="<?= base_url('/obat/update'); ?>" method="post">
                        <input type="text" id="id" name="id" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Obat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">KODE OBAT</label>
                                    <input type="text" class="form-control" name="kode_obat" id="kode_obat">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">DOSIS</label>
                                    <input type="text" class="form-control" name="dosis" id="dosis">
                                </div>

                                <div class="mb-3">
                                    <label class="form-check-label" for="">SATUAN</label>
                                    <input type="text" class="form-control" name="satuan" id="satuan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">NAMA</label>
                                    <input type="text" class="form-control" name="nama_obat" id="nama">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">HARGA OBAT</label>
                                    <input type="number" class="form-control" name="harga" id="harga">
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
        var kode_obat = $(this).data('kode');
        var dosis = $(this).data('dosis');
        var satuan = $(this).data('satuan');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');

        $("#kode_obat").val(kode_obat)
        $("#dosis").val(dosis)
        $("#nama").val(nama)
        $("#harga").val(harga)
        $("#satuan").val(harga)
        $("#id").val(id)
    });
</script>
<!-- /.content-wrapper -->