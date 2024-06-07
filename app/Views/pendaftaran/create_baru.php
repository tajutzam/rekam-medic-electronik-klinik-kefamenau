<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2 class="">Tambah Data Pasien dan Pendaftaran</h2>
            </div>
        </div>
    </div>
    <form action="/pendaftaran/create" method="post">

        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger">
                <?= session('error') ?>
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

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="nomor_ktp">Nomor KTP</label>
                    <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" required>
                </div>
                <div class="form-group">
                    <label for="no_bpjs">Nomor BPJS</label>
                    <input type="text" class="form-control" id="no_bpjs" name="no_bpjs" required>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="form-group">
                    <label for="usia">Usia</label>
                    <input type="number" class="form-control" id="usia" name="usia" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>

            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                </div>
                <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" required>
                </div>
                <div class="form-group">
                    <label for="desa">Desa</label>
                    <input type="text" class="form-control" id="desa" name="desa" required>
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                </div>
                <div class="form-group">
                    <label for="nomor_hp">Nomor HP</label>
                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
                </div>
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select name="agama" required class="form-control" id="">
                        <option value="">Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen (Protestan)">Kristen (Protestan)</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Penghayat">Penghayat</option>
                        <option value="Lain-Lain">Lain-Lain</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_gol_darah">Golongan Darah</label>
                    <select name="gol_dar" required class="form-control" id="">
                        <option value="">Pilih Gol Darah</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="riwayat_alergi">Riwayat Alergi</label>
                    <textarea class="form-control" id="riwayat_alergi" name="riwayat_alergi" rows="3" required></textarea>
                </div>

            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="wali_pasien">Wali Pasien</label>
                    <input type="text" class="form-control" id="wali_pasien" name="wali_pasien" required>
                </div>
                <div class="form-group">
                    <label for="no_hp_wali">Nomor HP Wali</label>
                    <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" required>
                </div>
                <div class="form-group">
                    <label for="riwayat_penyakit">Riwayat Penyakit</label>
                    <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="kabupaten">Kabupaten</label>
                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                </div>
                <div class="form-group">
                    <label for="nama_ibu">Nama Ibu</label>
                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                </div>
                <div class="form-group">
                    <label for="riwayat_penyakit_keluarga">Riwayat Penyakit Keluarga</label>
                    <textarea class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" rows="3" required></textarea>
                </div>
            </div>
        </div>
        <h2>Data Pendaftaran</h2>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="nama_klinik">Nama Klinik</label>
                    <input type="text" class="form-control" id="nama_klinik" name="nama_klinik" required>
                </div>
                <div class="form-group">
                    <label for="dokter">Dokter</label>
                    <input type="text" class="form-control" id="dokter" name="dokter" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                    <input type="date" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran" required>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="jenis_pendaftaran">Jenis Pasien</label>
                    <select class="form-control" id="jenis_pendaftaran" name="jenis_pasien" required>
                        <option value="Umum">UMUM</option>
                        <option value="BPJS">BPJS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keluhan">Keluhan</label>
                    <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <select class="form-control" id="metode_pembayaran" name="cara_bayar" required>
                        <option value="Tunai">Tunai</option>
                        <option value="Debit">Non Tunai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan_tambahan">Catatan Tambahan</label>
                    <textarea class="form-control" id="catatan_tambahan" name="catatan_tambahan" rows="3"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>