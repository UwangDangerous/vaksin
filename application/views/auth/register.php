<section>
<div id="layoutAuthentication">
<div id="layoutAuthentication_content">
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Registrasi Akun Baru</h3>
                        </div>
                        <div class="card-body">
                            <form method='post'>
                                <div class="form-group">
                                    <label class="small mb-1" for="nama">Nama Perusahaan</label>
                                    <input class="form-control py-4" id="nama" type="text" name='nama' placeholder="Nama Perusahaan" value='<?= set_value('nama'); ?>'/>
                                    <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label class="small mb-1" for="email">Email</label> 
                                    <input class="form-control py-4" id="email" type="email" name='email' placeholder="Alamat Email" value='<?= set_value('email'); ?>' />
                                    <small class="form-text text-danger"><?= form_error('email'); ?></small>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label class="small mb-1" for="alamat">Alamat Perusahaan</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder='Alamat Perusahaan'><?= set_value('alamat'); ?></textarea>
                                    <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="password1">Kata Sandi</label>
                                            <input class="form-control py-4" id="password1" name='password1' type="password" placeholder="Kata Sandi Minimal 8 Karakter" />
                                            <small class="form-text text-danger"><?= form_error('password1'); ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="password2">Konfirmasi Kata Sandi</label>
                                            <input class="form-control py-4" id="password2" name='password2' type="password" placeholder="Konfirmasi Kata Sandi" />
                                            <small class="form-text text-danger"><?= form_error('password2'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" >Buat Akun</button></div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <div class="small"><a href="<?= base_url() ; ?>auth">Sudah Memiliki Akun? login</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
<br><br><br><br>
</section>