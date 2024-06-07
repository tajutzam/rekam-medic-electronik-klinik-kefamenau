<section class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary text-center">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>KLINIK JENDRAL KEFAMENANU</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan login dengan memasukan username dan pasword</p>
                <?php if (session()->getFlashdata('error')) : ?>
                    <p style="color: red;"><?php echo session()->getFlashdata('error'); ?></p>
                <?php endif; ?>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Userame">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</section>