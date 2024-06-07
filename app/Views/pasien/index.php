<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= sizeof($pasiens); ?></h3>
                            <p>Jumlah Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <a href="/pendaftaran/create" class="btn btn-primary">Pendaftaran pasien baru</a>
                                </div>
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
                                <!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No Rm</th>
                                                <th>Nama Pasien</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Usia</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pasiens as $pasien) : ?>
                                                <tr>
                                                    <td><?= $pasien['nomor_rm'] ?></td>
                                                    <td><?= $pasien['nama_lengkap'] ?></td>
                                                    <td><?= $pasien['jenis_kelamin'] ?></td>
                                                    <td><?= $pasien['usia'] ?></td>
                                                    <td><?= $pasien['alamat'] ?></td>
                                                    <td>
                                                        <a href="/pasien/edit/<?= $pasien['id'] ?>"><i class="fas fa-edit text-blue" title="edit"></i></a>
                                                        <!-- <a href="/pasien/detail/<?= $pasien['id'] ?>"><i class="fas fa-eye text-warning" title="detail"></i></a> -->
                                                        <a href="/pasien/print/<?= $pasien['id'] ?>"><i class="fas fa-print text-success" title="cetak-kib"></i></a>
                                                        <a href="/pasien/delete/<?= $pasien['id'] ?>" onclick="return confirm('Apakah Anda yakin?')"><i class="fas fa-trash-alt text-red" title="delete"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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
    </section>
</div>

<script>

</script>
<!-- /.content-wrapper -->