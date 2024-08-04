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
                            <p>Jumlah Rekam Medis</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-book"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Section for Rekam Medis -->
            <section class="content">
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="">Rekam Medic Elektronik</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No Rm</th>
                                                <th>Nama Pasien</th>
                                                <th>Usia</th>
                                                <th>Alamat</th>
                                                <th>Jenis Pasien</th>
                                                <th>L/P</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pasiens as $item) : ?>
                                                <tr>
                                                    <td><?= $item['nomor_rm']; ?></td>
                                                    <td><?= $item['nama_lengkap']; ?></td>
                                                    <td><?= $item['usia']; ?></td>
                                                    <td><?= $item['alamat']; ?></td>
                                                    <td><?= $item['jenis_pasien']; ?></td>
                                                    <td><?= $item['jenis_kelamin'] == 'Laki-laki' ? 'L' : 'P' ?></td>
                                                    <td>
                                                        <a href="<?= base_url('/rekam-medis/pelayanan/' . $item['nomor_rm']); ?>" class="badge bg-warning text-decoration-none">Pelayanan</a>
                                                        <a href="<?= base_url('/rekam-medis/cetak-kib/' . $item['nomor_rm']); ?>" target="_blank" class="badge bg-success text-decoration-none">Cetak KIB</a>
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
        </div>
    </section>
</div>