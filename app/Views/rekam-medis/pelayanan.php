<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row container">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <h3>Data Pelayanan</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td><?= $pasien['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <th>No Ktp</th>
                            <td><?= $pasien['nomor_ktp']; ?></td>
                        </tr>
                        <tr>
                            <th>Rekam Medis</th>
                            <td><?= $pasien['nomor_rm']; ?></td>
                        </tr>
                    </table>
                    <a href="<?= base_url('/rekam-medis/pelayanan/') . $pasien['nomor_rm'] . '/create'; ?>" class="btn btn-primary">Tambah Pelayanan</a>
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
                                                <th>Dokter</th>
                                                <th>Petugas</th>
                                                <th>Signature</th>
                                                <th>Riwayat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pelayanan as $item) : ?>
                                                <tr>
                                                    <td><?= $item['tgl_pelayanan']; ?></td>
                                                    <td><?= $item['nama_dokter']; ?></td>
                                                    <td><?= $item['nama_petugas']; ?></td>
                                                    <td>
                                                        <?php if (isset($item['signature'])) : ?>
                                                            <img src="data:image/png;base64,<?= base64_encode($item['signature']); ?>" alt="Signature" style="height: 100px;">
                                                        <?php else : ?>
                                                            <span>DOKTER BELUM MENGISI SIGNATURE</span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <!-- Tombol Mata (View) -->
                                                        <a href="#" class="btn btn-sm btn-info btn-view" data-toggle="modal" data-target="#viewModal" data-id="<?= $item['id']; ?>" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <!-- Tombol Edit -->
                                                        <a href="/rekam-medis/pelayanan/delete/<?=  $pasien['nomor_rm'] ;?>/<?= $item['id_assesmen'] ;?>" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <?php if (isset($item['signature'])) : ?>
                                                            <!-- TRUE -->
                                                            <a target="_blank" href="/rekam-medis/pelayanan/export/pdf/<?= $item['id_assesmen']; ?>" class="btn btn-sm btn-success" title="Resume Medis">
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


            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container mt-2">
                                <div class="row">
                                    <h2>Data Pasien</h2>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nomor_ktp">Nomor Rekam Medis</label>
                                            <input type="text" class="form-control" readonly id="nomor_rm" name="nomor_rm" value="<?= $pasien['nomor_rm'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_ktp">Nomor KTP</label>
                                            <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" value="<?= $pasien['nomor_ktp'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_bpjs">Nomor BPJS</label>
                                            <input type="text" class="form-control" id="no_bpjs" name="no_bpjs" value="<?= $pasien['no_bpjs'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $pasien['nama_lengkap'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $pasien['tempat_lahir'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $pasien['tanggal_lahir'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="usia">Usia</label>
                                            <input type="number" class="form-control" id="usia" name="usia" value="<?= $pasien['usia'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required readonly>
                                                <option value="Laki-laki" <?= $pasien['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                                <option value="Perempuan" <?= $pasien['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required readonly><?= $pasien['alamat'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_hp">Nomor HP</label>
                                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?= $pasien['nomor_hp'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" class="form-control" id="agama" name="agama" value="<?= $pasien['agama'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="gol_dar">Golongan Darah</label>
                                            <input type="text" class="form-control" id="gol_dar" name="gol_dar" value="<?= $pasien['gol_dar'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="riwayat_alergi">Riwayat Alergi</label>
                                            <textarea class="form-control" id="riwayat_alergi" name="riwayat_alergi" rows="3" required readonly><?= $pasien['riwayat_alergi'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $pasien['pekerjaan'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pendidikan">Pendidikan</label>
                                            <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?= $pasien['pendidikan'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="desa">Desa</label>
                                            <input type="text" class="form-control" id="desa" name="desa" value="<?= $pasien['desa'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= $pasien['kecamatan'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="kabupaten">Kabupaten</label>
                                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?= $pasien['kabupaten'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi</label>
                                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= $pasien['provinsi'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_ibu">Nama Ibu</label>
                                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $pasien['nama_ibu'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="wali_pasien">Wali Pasien</label>
                                            <input type="text" class="form-control" id="wali_pasien" name="wali_pasien" value="<?= $pasien['wali_pasien'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp_wali">Nomor HP Wali</label>
                                            <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" value="<?= $pasien['no_hp_wali'] ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="riwayat_penyakit">Riwayat Penyakit</label>
                                            <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" rows="3" required readonly><?= $pasien['riwayat_penyakit'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="riwayat_penyakit_keluarga">Riwayat Penyakit Keluarga</label>
                                            <textarea class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" rows="3" required readonly><?= $pasien['riwayat_penyakit_keluarga'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="detailData"></div>
                            </div>
                            <div class="container mt-2">
                                <div class="row">
                                    <h2>Tindakan</h2>
                                    <p id="tindakan_ids"></p>
                                </div>
                                <div id="detailData"></div>
                            </div>
                            <div class="container mt-2">
                                <div class="row">
                                    <h2>Diagnosa</h2>
                                    <p id="diagnosa_ids"></p>

                                </div>
                                <div id="detailData"></div>
                            </div>
                            <div class="container mt-2">
                                <div class="row">
                                    <h2>Obat</h2>
                                    <p id="obat_ids"></p>
                                </div>
                                <div id="detailData">
                                    <p id="anamnesa"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

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
                    <div class="modal-lg" role="document">
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