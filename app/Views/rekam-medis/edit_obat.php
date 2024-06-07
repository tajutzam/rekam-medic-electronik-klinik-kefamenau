<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row container">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <h3>Data Obat</h3>
                    <button class="btn btn-primary btn-tambah">Tambah Obat</button>
                    <a href="<?= base_url('/rekam-medis/pelayanan/') . $pasien['nomor_rm'] . '/create'; ?>" class="btn btn-success">Next</a>
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
                                                <th>Obat</th>
                                                <th>Dosis</th>
                                                <th>Satuan</th>
                                                <th>Tarif</th>
                                                <th>Total Jumlah</th>
                                                <th>Catatan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($obats as $item) : ?>
                                                <tr>
                                                    <td><?= $item['nama_obat']; ?></td>
                                                    <td><?= $item['dosis']; ?></td>
                                                    <td><?= $item['satuan']; ?></td>
                                                    <td><?= $item['harga']; ?></td>
                                                    <td><?= $item['total']; ?></td>
                                                    <td>
                                                        <?php if ($item['catatan'] == '') : ?>
                                                            <!-- TRUE -->
                                                            Tidak ada catatan
                                                        <?php else : ?>
                                                            <!-- FALSE -->
                                                            <?= $item['catatan']; ?>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success btn-edit" data-toggle="modal" data-target="#editDiagnosa" data-id="<?= $item['id_detail']; ?>" data-kode="<?= $item['kode_obat']; ?>" data-dosis="<?= $item['dosis']; ?>" data-satuan="<?= $item['satuan']; ?>" data-nama="<?= $item['nama_obat']; ?>" data-harga="<?= $item['harga']; ?>" data-catatan="<?= $item['catatan']; ?>" data-total="<?= $item['total']; ?>" data-jumlah="<?= $item['jumlah']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <a class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

            <!-- Tambah Obat Modal -->
            <div class="modal fade" id="tambahDiagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="<?= base_url('/obat/create'); ?>">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="kode_obat">KODE OBAT</label>
                                    <input type="text" class="form-control" name="kode_obat" id="kode_obat">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="dosis">DOSIS</label>
                                    <input type="text" class="form-control" name="dosis" id="dosis">
                                </div>

                                <div class="mb-3">
                                    <label class="form-check-label" for="satuan">SATUAN</label>
                                    <input type="text" class="form-control" name="satuan" id="satuan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="nama_obat">NAMA</label>
                                    <input type="text" class="form-control" name="nama_obat" id="nama_obat">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="harga">HARGA OBAT</label>
                                    <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="catatan">CATATAN</label>
                                    <input type="text" class="form-control" name="catatan" id="catatan">
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

            <!-- Edit Obat Modal -->
            <div class="modal fade" id="editDiagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?= base_url('/obat/detail/update'); ?>" method="post">
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
                                    <label class="form-check-label" for="kode_obat">KODE OBAT</label>
                                    <input type="text" class="form-control" name="kode_obat" id="kode_obat" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="dosis">DOSIS</label>
                                    <input type="text" class="form-control" name="dosis" id="dosis" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check-label" for="satuan">SATUAN</label>
                                    <input type="text" class="form-control" name="satuan" id="satuan" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="nama_obat">NAMA</label>
                                    <input type="text" class="form-control" name="nama_obat" id="nama_obat" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="harga">HARGA OBAT</label>
                                    <input type="number" class="form-control" name="harga" id="harga_edit" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="catatan">CATATAN</label>
                                    <input type="text" class="form-control" name="catatan" id="catatan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="jumlah">jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" id="jumlah_edit" oninput="changeTotal()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="jumlah">total</label>
                                    <input type="text" class="form-control" name="total" id="total_edit" readonly>
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
    $(document).on("click", ".btn-tambah", function() {
        $('#tambahDiagnosa').modal('show');
    });

    $(document).on("click", ".btn-edit", function() {
        var id = $(this).data('id');
        var kode_obat = $(this).data('kode');
        var dosis = $(this).data('dosis');
        var satuan = $(this).data('satuan');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        var catatan = $(this).data('catatan');
        var total = $(this).data('total');
        var jumlah = $(this).data('jumlah');


        $("#editDiagnosa #kode_obat").val(kode_obat);
        $("#editDiagnosa #dosis").val(dosis);
        $("#editDiagnosa #satuan").val(satuan);
        $("#editDiagnosa #nama_obat").val(nama);
        $("#editDiagnosa #harga_edit").val(harga);
        $("#editDiagnosa #catatan").val(catatan);
        $("#editDiagnosa #id").val(id);
        $("#editDiagnosa #total_edit").val(total);
        $("#editDiagnosa #jumlah_edit").val(jumlah);
        $('#editDiagnosa').modal('show');
    });

    function changeTotal() {
        const harga = document.getElementById('harga_edit').value;
        const jumlah = document.getElementById('jumlah_edit').value;
        let total = harga * jumlah;
        $("#editDiagnosa #total_edit").val(total);
    }
</script>