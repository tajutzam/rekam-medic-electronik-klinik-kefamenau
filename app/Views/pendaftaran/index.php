<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= sizeof($pendaftaran); ?></h3>
                            <p>Jumlah Pendaftaran</p>
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
                                    <h3>Data Pendaftaran</h3>
                                    <a href="/pendaftaran/create" class="btn btn-primary">Tambah Pendaftaran Baru</a>
                                    <!-- <button class="btn btn-success" data-toggle="modal" data-target="#qrScannerModal">SCAN KIB</button> -->
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
                                <div class="card-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Daftar</th>
                                                <th>No Rm</th>
                                                <th>No Ktp</th>
                                                <th>Nama Pasien</th>
                                                <th>Jenis Pasien</th>
                                                <th>Cara bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pendaftaran as $pasien) : ?>
                                                <tr>
                                                    <td><?= $pasien['created_at']; ?></td>
                                                    <td><?= $pasien['nomor_rm'] ?></td>
                                                    <td><?= $pasien['nomor_ktp'] ?></td>
                                                    <td><?= $pasien['nama_lengkap'] ?></td>
                                                    <td><?= $pasien['jenis_pasien'] ?></td>
                                                    <td><?= $pasien['cara_bayar'] ?></td>
                                                    <td>
                                                        <a href="/pasien/edit/<?= $pasien['id'] ?>"><i class="fas fa-edit text-blue" title="edit"></i></a>
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


    <!-- Modal for QR Code Scanner -->
    <div class="modal fade" id="qrScannerModal" tabindex="-1" role="dialog" aria-labelledby="qrScannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrScannerModalLabel">Scan QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="reader" width="600px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            var html5QrCode;

            var baseUrl = "<?= base_url() ?>";


            $('#qrScannerModal').on('shown.bs.modal', function() {
                const html5QrCode = new Html5Qrcode("reader");
                html5QrCode.start({
                            facingMode: "environment"
                        }, // camera parameters
                        {
                            fps: 20, // Optional, frame per seconds for qr code scanning
                            qrbox: {
                                width: 250,
                                height: 250
                            } // Optional, if you want bounded box UI
                        },
                        qrCodeMessage => {
                            window.location.href = baseUrl + "/rekam-medis/pelayanan/" + qrCodeMessage;
                            // You can redirect or process the scanned code here
                            $('#qrScannerModal').modal('hide');
                            html5QrCode.stop().then((ignore) => {}).catch((err) => {
                                console.log(err);
                            });
                        },
                        errorMessage => {
                            // parse error, ignore it.
                            console.log(`QR Code no longer in front of camera.`);
                        })
                    .catch(err => {
                        // Start failed, handle it.
                        console.log(`Unable to start scanning, error: ${err}`);
                    });
            });

            $('#qrScannerModal').on('hidden.bs.modal', function() {
                const html5QrCode = new Html5Qrcode("reader");
                html5QrCode.stop().then((ignore) => {
                    // QR Code scanning is stopped.
                    console.log('QR Code scanning stopped.');
                }).catch((err) => {
                    // Stop failed, handle it.
                    console.log(`Unable to stop scanning, error: ${err}`);
                });
            });
        });
    </script>

</div>