<section>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Login Internal User</h3>
                            </div>
                            <div class="card-body">
                            <?php if(!empty($this->session->flashdata('login') )) : ?>
                       
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?=  $this->session->flashdata('login'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                
                            <?php endif ; ?> 
                            
                            <br>

                                <form action="" method='post'>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Username</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Username" name='username'/>

                                        <small id="usernameHelp" class="form-text text-danger"><?= form_error('username'); ?></small>
                                    </div> <br>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Kata Sandi</label>
                                        <input class="form-control py-4" id="inputPassword" type="password" placeholder="Kata Sandi" name='password'/>

                                        <small id="emailHelp" class="form-text text-danger"><?= form_error('password'); ?></small>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-end mt-4 mb-0">
                                        <button class="btn btn-primary" type='submit'>Login</button>
                                    </div>
                                </form>
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

