<section class="container py-4">
    <form action="" method="post">
        <div class="card w-100">
            <div class="card-header">
                <h3 class="card-title">Diagnosa</h3>
            </div>
            <div class="card-body" id="diagnosa-container">
                <div class="row justify-content-between align-items-end diagnosa-row">
                    <div class="col-3">
                        <div class="form-group">
                            <label class="form-label">Jenis Diagnosa</label>
                            <select name="jenis_diagnosa[]" class="form-control">
                                <option value="utama">UTAMA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label class="form-label">Kode ICD</label>
                            <select required name="diagnosa[]" class="form-control diagnosa-select">
                                <option>Pilih Kode Icd Dan Diagnosa</option>
                                <?php foreach ($diagnosas as $item) : ?>
                                    <option value="<?= $item['id']; ?>"> <?= $item['kode_diagnosa']; ?> - <?= $item['diagnosa']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label class="form-label">Diagnosa</label>
                            <input name="diagnosa_value[]" readonly class="form-control diagnosa-value">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary add-diagnosa-btn">Tambah Baru</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <h3 class="card-title">Tindakan</h3>
            </div>
            <div class="card-body" id="tindakan-container">
                <div class="row justify-content-between align-items-end tindakan-row">
                    <div class="col-3">
                        <div class="form-group">
                            <label class="form-label">Kode Tindakan</label>
                            <select required name="tindakan[]" class="form-control tindakan-select">
                                <option>Pilih Kode tindakan dan tindakan</option>
                                <?php foreach ($tindakans as $item) : ?>
                                    <option value="<?= $item['id']; ?>"> <?= $item['kode_tindakan']; ?> - <?= $item['tindakan']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label class="form-label">Tindakan</label>
                            <input name="tindakan[]" class="form-control tindakan-value" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary add-tindakan-btn">Tambah Baru</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary" type="submit">Next</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const diagnosaContainer = document.getElementById('diagnosa-container');
            const tindakanContainer = document.getElementById('tindakan-container');

            function addEventListenersForDiagnosa() {
                const diagnosaSelects = document.querySelectorAll('.diagnosa-select');
                const diagnosaValues = document.querySelectorAll('.diagnosa-value');
                diagnosaSelects.forEach((select, index) => {
                    select.addEventListener('change', function() {
                        const selectedOption = select.options[select.selectedIndex];
                        diagnosaValues[index].value = selectedOption.text.split(' - ')[1];
                    });
                });
            }

            function addEventListenersForTindakan() {
                const tindakanSelects = document.querySelectorAll('.tindakan-select');
                const tindakanValues = document.querySelectorAll('.tindakan-value');
                tindakanSelects.forEach((select, index) => {
                    select.addEventListener('change', function() {
                        const selectedOption = select.options[select.selectedIndex];
                        tindakanValues[index].value = selectedOption.text.split(' - ')[1];
                    });
                });
            }

            document.querySelector('.add-diagnosa-btn').addEventListener('click', function() {
                const newDiagnosaRow = document.querySelector('.diagnosa-row').cloneNode(true);
                newDiagnosaRow.querySelector('select').value = '';
                newDiagnosaRow.querySelector('.diagnosa-value').value = '';
                diagnosaContainer.appendChild(newDiagnosaRow);
                addEventListenersForDiagnosa();
            });

            document.querySelector('.add-tindakan-btn').addEventListener('click', function() {
                const newTindakanRow = document.querySelector('.tindakan-row').cloneNode(true);
                newTindakanRow.querySelector('select').value = '';
                newTindakanRow.querySelector('.tindakan-value').value = '';
                tindakanContainer.appendChild(newTindakanRow);
                addEventListenersForTindakan();
            });

            addEventListenersForDiagnosa();
            addEventListenersForTindakan();
        });
    </script>

</section>