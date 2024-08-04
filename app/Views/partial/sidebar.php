<?php $role = session('role'); ?>

<aside class="main-sidebar">
    <!-- Sidebar -->
    <nav class="mt-2">
        <a href="/dashboard" class="brand-link">
            <div class="justify-content-center d-flex">
                <img src="/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 flex justify-content-center" style="opacity: 100%">
            </div>
            <br>
            <div class="text-center">
                <span class="brand-text font-weight-light text-white">KLINIK</span>
                <br>
                <span class="brand-text font-weight-light text-white">JENDRAL KEFAMENANU</span>
            </div>
        </a>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <?php if ($role == 'admin' || $role == 'petugas' || $role == 'kepala-klinik') : ?>
                    <!-- TRUE -->
                    <a href="/dashboard" class="nav-link text-white">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                <?php else : ?>
                    <!-- FALSE -->
                <?php endif ?>

                <?php if ($role == 'admin' || $role == 'petugas' || $role == 'kepala-klinik') : ?>
                    <!-- TRUE -->
                    <a href="/laporan" class="nav-link text-white">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Data Laporan</p>
                    </a>
                <?php endif ?>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy text-white"></i>
                    <p class="text-white">
                        Data master
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <?php if ($role == 'admin' || $role == 'petugas') : ?>
                            <!-- TRUE -->
                            <a href="/pasien" class="nav-link text-white">
                                <i class="nav-icon fas fa-user-injured"></i>
                                <p>Data Pasien</p>
                            </a>
                        <?php endif ?>
                    </li>
                    <?php if ($role == 'admin') : ?>
                        <!-- TRUE -->
                        <li class="nav-item">
                            <a href="/dokter" class="nav-link text-white">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>Data Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user" class="nav-link text-white">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Data User</p>
                            </a>
                        <?php else : ?>
                            <!-- FALSE -->
                        <?php endif ?>
                        <?php if ($role == 'admin' || $role == 'dokter' || $role == 'dokter') : ?>
                        <li class="nav-item">
                            <a href="/diagnosa" class="nav-link text-white">
                                <i class="nav-icon fas fa-stethoscope"></i>
                                <p>Data Diagnosa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tindakan" class="nav-link text-white">
                                <i class="nav-icon fas fa-procedures"></i>
                                <p>Data Tindakan</p>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($role == 'admin' || $role == 'farmasi') : ?>
                        <!-- TRUE -->
                        <li>
                            <a href="/apotik" class="nav-link text-white">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Data Apotik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/obat" class="nav-link text-white">
                                <i class="nav-icon fas fa-pills"></i>
                                <p>Data Obat</p>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-ambulance text-white"></i>
                    <p class="text-white">
                        Transaksi
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <?php if ($role == 'admin' || $role == 'dokter') : ?>
                            <!-- TRUE -->
                            <a href="/rekam-medis" class="nav-link text-white">
                                <i class="nav-icon fas fa-file-medical"></i>
                                <p>Data Rekam Medis</p>
                            </a>
                        <?php endif ?>
                    </li>
                    <?php if ($role == 'admin' || $role == 'petugas') : ?>
                        <li class="nav-item">
                            <a href="/pendaftaran   " class="nav-link text-white">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Pendaftaran Pasien</p>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </li>
            <li class="nav-item">
                <a href="/logout" class="nav-link text-danger">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar -->
</aside>