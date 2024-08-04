<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid mt-5">
            <h2>Anamnesa</h2>
            <p><?= $pasien['nomor_rm']; ?> <?= $pasien['nama_lengkap']; ?></p>
            <form method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tinggi Badan <span style="color: red;">harus di isi*</span></label>
                            <div class="input-group mb-2">
                                <input class="form-control" type="number" id="tinggi_badan" name="tinggi_badan">
                                <div class="input-group-append">
                                    <span class="input-group-text">CM</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Berat badan <span style="color: red;">harus di isi*</span></label>
                            <div class="input-group mb-2">
                                <input class="form-control" type="number" id="berat_badan" name="berat_badan">
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status_gizi">Status Gizi:</label>
                            <input class="form-control" readonly type="text" id="status_gizi" name="status_gizi">
                        </div>
                        <div class="form-group mb-2">
                            <label for="Sistole">Sistole <span style="color: red;">harus di isi*</span></label>
                            <div class="input-group mb-2">
                                <input class="form-control" type="number" id="Sistole" name="Sistole">
                                <div class="input-group-append">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="Diastole">Diastole <span style="color: red;">harus di isi*</span></label>
                            <div class="input-group mb-2">
                                <input class="form-control" type="number" id="Diastole" name="Diastole">
                                <div class="input-group-append">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="gap: 20px;">
                            <div class="form-group" style="width: 80%;">
                                <label>Obats:</label>
                                <select class="form-control select2 py-2" name="obat_selected[]" style="width: 100%; height: 20px;" multiple>
                                    <?php foreach ($obats as $item) : ?>
                                        <option value="<?= $item['id']; ?>"> <?= $item['kode_obat']; ?> - <?= $item['nama_obat']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <a href="<?= base_url('/obat'); ?>" target="_blank" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-plus text-white">Tambah Obat Baru</i>
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="denyut_jantung">Denyut Jantung <span style="color: red;">harus di isi*</span></label>
                            <input class="form-control" type="number" id="denyut_jantung" name="denyut_jantung">
                        </div>
                        <div class="form-group mb-2">
                            <label for="respirate_rate">Respirate Rate <span style="color: red;">harus di isi*</span></label>
                            <input class="form-control" type="number" id="respirate_rate" name="respirate_rate">
                        </div>
                        <div class="form-group mb-2">
                            <label for="Ket">Keterangan:</label>
                            <textarea class="form-control" readonly id="Ket" name="Ket"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="spo2">SpO2 <span style="color: red;">harus di isi*</span></label>
                            <input class="form-control" type="number" id="spo2" name="spo2">
                        </div>
                        <div class="form-group mb-2">
                            <label>Alergi Obat:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alergi_obat" id="alergi_obat_yes" value="1">
                                <label class="form-check-label" for="alergi_obat_yes">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alergi_obat" id="alergi_obat_no" value="0">
                                <label class="form-check-label" for="alergi_obat_no">Tidak</label>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="Anamnesa">Asesmen<span style="color: red;">harus di isi*</span></label>
                            <textarea class="form-control" type="text" id="Anamnesa" name="Anamnesa"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <button class="btn btn-primary" type="submit">Next</button>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    // Ketika nilai tinggi badan atau berat badan berubah
                    $('#tinggi_badan, #berat_badan').on('input', function() {
                        // Ambil nilai tinggi badan dan berat badan dari input
                        var tinggiBadan = $('#tinggi_badan').val();
                        var beratBadan = $('#berat_badan').val();

                        var bmi = (beratBadan / tinggiBadan);
                        var statusGizi;
                        if (bmi < 18.5) {
                            statusGizi = 'Berat badan kurang';
                        } else if (bmi >= 18.5 && bmi <= 24.9) {
                            statusGizi = 'Normal';
                        } else if (bmi >= 25 && bmi <= 29.9) {
                            statusGizi = 'Berlebihan';
                        } else {
                            statusGizi = 'Obesitas';
                        }

                        $('#status_gizi').val(statusGizi);
                    });


                    $('#Sistole, #Diastole').on('input', function() {
                        // Ambil nilai sistole dan diastole dari input
                        var sistole = $('#Sistole').val();
                        var diastole = $('#Diastole').val();

                        // Hitung nilai rata-rata
                        var rataRata = (parseInt(sistole) + parseInt(diastole)) / 2;

                        // Tentukan keterangan berdasarkan nilai rata-rata
                        var keterangan;
                        if (rataRata < 80) {
                            keterangan = 'Hypotensi';
                        } else if (rataRata >= 80 && rataRata <= 120) {
                            keterangan = 'Normal';
                        } else if (rataRata > 120 && rataRata <= 139) {
                            keterangan = 'Prehipertensi';
                        } else if (rataRata >= 140 && rataRata <= 159) {
                            keterangan = 'Hipertensi tingkat 1';
                        } else if (rataRata >= 160 && rataRata <= 179) {
                            keterangan = 'Hipertensi tingkat 2';
                        } else {
                            keterangan = 'Krisis Hipertensi';
                        }

                        // Tampilkan keterangan pada input Ket
                        $('#Ket').val(keterangan);
                    });

                });
            </script>




        </div>
    </div>
</div>