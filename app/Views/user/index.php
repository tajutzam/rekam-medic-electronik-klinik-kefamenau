<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= sizeof($users) ?></h3>
                            <p>Jumlah User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
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

                                <div class="card-header">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal">Tambah User</button>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alaamat</th>
                                                <th>jabatan</th>
                                                <th>username</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $user) : ?>
                                                <tr>
                                                    <td><?= $user['id']; ?></td>
                                                    <td><?= $user['nama_lengkap']; ?></td>
                                                    <td><?= $user['tanggal_lahir']; ?></td>
                                                    <td><?= $user['jenis_kelamin']; ?></td>
                                                    <td><?= $user['alamat']; ?></td>
                                                    <td><?= $user['role']; ?></td>
                                                    <td><?= $user['username']; ?></td>
                                                    <td>
                                                        <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal" data-id="<?= $user['id'] ?>" data-nama="<?= $user['nama_lengkap'] ?>" data-tanggal_lahir="<?= $user['tanggal_lahir'] ?>" data-jenis_kelamin="<?= $user['jenis_kelamin'] ?>" data-alamat="<?= $user['alamat'] ?>" data-jabatan="<?= $user['jabatan'] ?>" data-username="<?= $user['username'] ?> " data-role="<?= $user['role'] ?>">Edit</button>

                                                        <a href="<?= base_url('/user/delete/' . $user['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alaamat</th>
                                                <th>jabatan</th>
                                                <th>username</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
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


            <!-- Modal -->
            <div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">nama lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Jenis Kelamin</label>
                                    <select type="text" class="form-control" name="jenis_kelamin">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Alamat</label>
                                    <input type="text" class="form-control" name="alamat">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Username</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Role</label>
                                    <select name="role" id="" class="form-control">
                                        <option value="admin">ADMIN</option>
                                        <option value="petugas">PETUGAS</option>
                                        <option value="kepala-klinik">KEPALA KLINIK</option>
                                        <option value="farmasi">FARMASI</option>
                                        <option value="dokter">DOKTER</option>
                                    </select>
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

            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?= base_url('/user/update') ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="text" id="id_user" name="id" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-check-label" for="">nama lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Username</label>
                                    <input type="text" class="form-control" name="username" id="username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Jenis Kelamin</label>
                                    <select type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" id="jabatan">
                                </div>

                                <div class="mb-3">
                                    <label class="form-check-label" for="">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label" for="">Role</label>
                                    <select name="role" class="form-control" required id="role">
                                        <option value="admin">ADMIN</option>
                                        <option value="petugas">PETUGAS</option>
                                        <option value="kepala-klinik">KEPALA KLINIK</option>
                                        <option value="farmasi">FARMASI</option>
                                        <option value="dokter">DOKTER</option>
                                    </select>
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
    $(document).on("click", ".btn-edit", function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var tanggal_lahir = $(this).data('tanggal_lahir');
        var jenis_kelamin = $(this).data('jenis_kelamin');
        var alamat = $(this).data('alamat');
        var jabatan = $(this).data('jabatan');
        var username = $(this).data('username');
        var role = $(this).data('role');
        $("#updateModal #id_user").val(id);
        $("#updateModal #nama_lengkap").val(nama);
        $("#updateModal #tanggal_lahir").val(tanggal_lahir);
        $("#updateModal #jenis_kelamin").val(jenis_kelamin);
        $("#updateModal #alamat").val(alamat);
        $("#updateModal #jabatan").val(jabatan);
        $("#updateModal #username").val(username);
        $("#updateModal #role").val(role);
    });
</script>

<!-- /.content-wrapper -->