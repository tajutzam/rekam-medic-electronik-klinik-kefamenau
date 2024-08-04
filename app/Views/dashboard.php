<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content-wrapper">
    <section class="content">

        <div class="container-fluid">
            <h4>Selamat datang <?= session('username'); ?></h4>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $user; ?></h3>

                            <p>Jumlah Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $pasien; ?></h3>

                            <p>Rekam Medis</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $pasien; ?></h3>

                            <p>Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $diagnosa ?></h3>
                            <p>Diagnosa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="d-flex justify-content-center">
                    <div style="width: 90%; height: 50%;" class="card">
                        <div class="card-body row">
                            <form method="post" class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="">Dari tanggal</label>
                                        <input class="form-control" type="date" name="start_date" required>
                                        <label for="">Sampai tanggal</label>
                                        <input class="form-control" type="date" name="end_date" required>
                                        <button type="submit" class="btn btn-primary mt-3">Cetak</button>
                                    </div>
                                </div>
                            </form>
                            <form method="post" action="/dashboard/filter" class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="">Dari tanggal</label>
                                        <input class="form-control" type="date" name="start_date" required>
                                        <label for="">Sampai tanggal</label>
                                        <input class="form-control" type="date" name="end_date" required>
                                        <button type="submit" class="btn btn-success mt-3">Terapkan Filter</button>
                                        <a href="/dashboard" class="btn btn-danger mt-3">Reset</a>
                                    </div>
                                </div>
                            </form>
                            <canvas id="pendaftaranChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
    </section>
</div>

<script>
    var ctxPendaftaran = document.getElementById('pendaftaranChart').getContext('2d');


    var pendaftaranLabels = <?= $pendaftaranLabels ?>;
    var pendaftaranData = <?= $pendaftaranData ?>;

    var pendaftaranChart = new Chart(ctxPendaftaran, {
        type: 'line',
        data: {
            labels: pendaftaranLabels,
            datasets: [{
                label: 'Jumlah Kunjungan Pasien Setiap Bulan Nya',
                data: pendaftaranData,
                backgroundColor: 'red',
                borderColor: 'red',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<!-- /.content-wrapper -->