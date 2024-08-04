<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row container">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <h3>Data Apotik</h3>
                </div>
                <!-- ./col -->
            </div>
            <section class="content mt-4">
                <div class="container-fluid">
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

                                </div>
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Pelayanan</th>
                                                <th>Nomor Rm</th>
                                                <th>Nama Pasien</th>
                                                <th>Usia</th>
                                                <th>Alamat</th>
                                                <th>Jenis pasien</th>
                                                <th>L/P</th>
                                                <th>RM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pelayanan as $item) : ?>
                                                <tr>
                                                    <td><?= $item['tgl_pelayanan']; ?></td>
                                                    <td><?= $item['nomor_rm']; ?></td>
                                                    <td><?= $item['nama_lengkap']; ?></td>
                                                    <td><?= $item['usia']; ?></td>
                                                    <td><?= $item['alamat']; ?></td>
                                                    <td><?= $item['jenis_pasien']; ?></td>
                                                    <td>
                                                        <?php if ($item['jenis_kelamin'] == 'Laki-laki') : ?>
                                                            <!-- TRUE -->
                                                            L
                                                        <?php else : ?>
                                                            <!-- FALSE -->
                                                            P
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        </a>
                                                        <?php if (isset($item['signature'])) : ?>
                                                            <!-- TRUE -->
                                                            <a target="_blank" href="/rekam-medis/pelayanan/export/pdf/<?= $item['id']; ?>" class="btn btn-sm btn-success" title="Resume Medis">
                                                                <i class="fas fa-file-export"></i>
                                                            </a>
                                                        <?php else : ?>
                                                            <!-- FALSE -->
                                                        <?php endif ?>
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
    </section>
</div>

<script>
    var baseUrl = "<?= base_url() ?>"
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
    $(document).ready(function() {
        // Event listener untuk klik pada tombol "View"
        $(document).on("click", ".btn-view", function() {
            var id = $(this).data('id');
            fetch(baseUrl + "/api/rekam-medis/pelayanan/detail/" + id) // Menggunakan id yang diterima
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Memanggil response.json()
                })
                .then((data) => {
                    document.getElementById('tindakan_ids').textContent = data.data.tindakan_ids ?? 'tidak ada tindakan';
                    document.getElementById('obat_ids').textContent = data.data.obat_ids ?? 'tidak ada obat';
                    document.getElementById('diagnosa_ids').textContent = data.data.diagnosa_ids ?? 'tidak ada diagnosa';
                    document.getElementById('anamnesa').textContent = "Anamnesa : " + data.data.anamnesa ?? 'tidak ada anamnesa'
                })
                .catch((error) => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        });
    });
</script>
<!-- /.content-wrapper -->