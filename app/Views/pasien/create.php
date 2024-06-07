<div class="container mt-5">
    <h2>Tambah Data Pasien</h2>
    <form action="/pasien/store" method="post">
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
                    <input type="text" class="form-control" id="agama" name="agama" required>
                </div>
                <div class="form-group">
                    <label for="gol_dar">Golongan Darah</label>
                    <input type="text" class="form-control" id="gol_dar" name="gol_dar" required>
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>