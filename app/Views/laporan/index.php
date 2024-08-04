<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="content-wrapper">
    <div class="mx-2">
        <div class="" style="justify-content: space-evenly; display:flex;padding-top: 20px;">
            <div>
                <h4>Export Laporan Kunjungan Pasien</h4>
                <form action="/laporan/cetak" method="post">
                    <div class="from-group">
                        <label for="">Bulan</label>
                        <input type="month" name="month" required class="form-control">
                        <button class="btn btn-primary my-3">Cetak</button>
                    </div>
                </form>
            </div>
            <div>
                <h4>Export 10 penyakit terpopuler</h4>
                <form action="/laporan/cetak/diagnosa" method="post">
                    <div class="from-group">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="">Dari tanggal</label>
                                <input type="date" name="start_date" required class="form-control">
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="">Sampai Tanggal</label>
                                <input type="date" name="end_date" required class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-primary my-3">Cetak</button>
                    </div>
                </form>
            </div>
            <div>
                <h4>Export 10 tindakan terpopuler</h4>
                <form action="/laporan/cetak/tindakan" method="post">
                    <div class="from-group">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="">Dari tanggal</label>
                                <input type="date" name="start_date" required class="form-control">
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="">Sampai Tanggal</label>
                                <input type="date" name="end_date" required class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-primary my-3">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container mt-4" style="display:flex; flex-wrap: wrap;">
            <div>
                <h4>Diagnosa Terpopuler</h4>
                <div class="container-fluid d-flex justify-content-center">
                    <div style="width: 600px;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div>
                <h4>Tindakan Terpopuler</h4>
                <div class="container-fluid d-flex justify-content-center">
                    <div style="width: 600px;">
                        <canvas id="tindakanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var ctxTindakan = document.getElementById('tindakanChart').getContext('2d');

    var labels = <?= $labels_diagnosa ?>;
    var data = <?= $data_diagnosa ?>;

    var labelsTindakan = <?= $labels_tindakan ?>;
    var dataTindakan = <?= $data_tindakan ?>;

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function generateRandomColors(count) {
        var colors = [];
        for (var i = 0; i < count; i++) {
            colors.push(getRandomColor());
        }
        return colors;
    }

    var backgroundColors = generateRandomColors(labels.length);
    var borderColors = backgroundColors.map(color => color);

    var backgroundColorsTindakan = generateRandomColors(labelsTindakan.length);
    var borderColorsTindakan = backgroundColorsTindakan.map(color => color);

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Diagnosa Populer',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
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

    var myChartTindakan = new Chart(ctxTindakan, {
        type: 'bar',
        data: {
            labels: labelsTindakan,
            datasets: [{
                label: 'Total Tindakan Populer',
                data: dataTindakan,
                backgroundColor: backgroundColorsTindakan,
                borderColor: borderColorsTindakan,
                borderWidth: 1
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