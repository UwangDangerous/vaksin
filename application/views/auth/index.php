<section>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Login</h3>
                            </div>
                            <div class="card-body">
                                <?php if(!empty($this->session->flashdata('login') )) : ?>
                                    
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?=  $this->session->flashdata('login'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    
                                <?php endif ; ?> 
                                
                                <?php if(!empty($this->session->flashdata('pesan') )) : ?>
                                    
                                    <div class="alert alert-<?= $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
                                        <?=  $this->session->flashdata('pesan'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    
                                <?php endif ; ?> 

                                <form action="" method='post'>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Username / Email</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Alamat Email / Username" name='email' autofocus/>

                                        <small id="emailHelp" class="form-text text-danger"><?= form_error('email'); ?></small>
                                    </div> <br>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Kata Sandi</label>
                                        <input class="form-control py-4" id="inputPassword" type="password" placeholder="Kata Sandi" name='password'/>

                                        <small id="emailHelp" class="form-text text-danger"><?= form_error('password'); ?></small>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.html">Forgot Password?</a>
                                        <button class="btn btn-primary" type='submit'>Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="<?= base_url(); ?>auth/register">Need an account? Sign up!</a></div>
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

