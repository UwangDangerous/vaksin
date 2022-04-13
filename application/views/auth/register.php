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
                            <form method='post' class='myForm'>
                                <h4><label>Data Perusahaan</label></h4> <br>

                                <div class="form-group">
                                    <label class="mb-2" for="nama">Nama Perusahaan <i class="text-danger">*</i></label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select name="namaDepan" class='form-control'>
                                                <option value='PT'>PT</option>
                                                <option value='CV'>CV</option>
                                                <option value='UD'>UD</option>
                                                <option value='PJ'>PJ</option>
                                                <option value='FA'>FA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control py-2" id="nama" type="text" name='nama' placeholder="Nama Perusahaan" value='<?= set_value('nama'); ?>'/>
                                            <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-md-6">
                                        <label class="mb-2" for="npwp">NPWP <i class="text-danger">*</i></label> 
                                        <input class="form-control py-2" id="npwp" type="text" name='npwp' placeholder="NPWP" value='<?= set_value('npwp'); ?>' />
                                        <small class="form-text text-danger"><?= form_error('npwp'); ?></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="mb-2" for="alamat">Alamat <i class="text-danger">*</i></label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder='Alamat Perusahaan'><?= set_value('alamat'); ?></textarea>
                                    <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prop">Provinsi <i class="text-danger">*</i></label>
                                            <select class="form-control mb-2" id="prop" name='prop'>
                                                <option value=''>-pilih-</option>
                                                <?php foreach ($propinsi as $prop) : ?>
                                                    <?php if($prop['idProp'] == set_value('prop')) : ?>
                                                        <option selected value="<?= $prop['idProp']; ?>"> <?= $prop['namaProp']; ?> </option>
                                                    <?php else : ?>
                                                        <option value="<?= $prop['idProp']; ?>"> <?= $prop['namaProp']; ?> </option>
                                                    <?php endif ; ?>
                                                <?php endforeach ; ?>
                                            </select>
                                            <small class="form-text text-danger"><?= form_error('prop'); ?></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kota">Kabupaten / Kota <i class="text-danger">*</i></label>
                                            <select class="form-control mb-2" id="kota" name='kota'>
                                                <option value=''>-pilih-</option>
                                                <?php foreach ($kota as $k) : ?>
                                                    <?php if($k['idKota'] == set_value('kota')) : ?>
                                                        <option selected id="kota" class="<?= $k['idProp'] ; ?>" value="<?= $k['idKota'] ; ?>"><?= $k['namaKota']; ?></option>
                                                    <?php else : ?>
                                                        <option id="kota" class="<?= $k['idProp'] ; ?>" value="<?= $k['idKota'] ; ?>"><?= $k['namaKota']; ?></option>
                                                    <?php endif ; ?>
                                                <?php endforeach ; ?>
                                            </select>
                                            <small class="form-text text-danger"><?= form_error('kota'); ?></small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan <i class="text-danger">*</i></label>
                                            <select class="form-control mb-2" id="kecamatan" name='kecamatan'>
                                                <option value=''>-pilih-</option>
                                                <?php foreach ($kecamatan as $kec) : ?>
                                                    <?php// if($kec['idKec'] == set_value('kecamatan')) : ?>
                                                        <!-- <option selected id='kecamatan' class="<?//= $kec['idKota'];?>" value="<?//= $kec['idKec'];?>"><?//= $kec['namaKec'];?></option> -->
                                                    <?php// else : ?>
                                                        <option id='kecamatan' class="<?= $kec['idKota'];?>" value="<?= $kec['idKec'];?>"><?= $kec['namaKec'];?></option>
                                                    <?php// endif ; ?>
                                                <?php endforeach ; ?>
                                            </select>
                                            <small class="form-text text-danger"><?= form_error('kecamatan'); ?></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pos">Kode Pos <i class="text-danger">*</i></label>
                                            <input type='number' class="form-control py-2" id="pos" type="text" name='pos' placeholder="Kode Pos" value='<?= set_value('pos'); ?>'/>
                                            <small class="form-text text-danger"><?= form_error('pos'); ?></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telp">Telepon <i class="text-danger">*</i></label>
                                            <input type='number' class="form-control py-2" id="telp" type="text" name='telp' placeholder="Nomor Telepon" value='<?= set_value('telp'); ?>'/>
                                            <small class="form-text text-danger"><?= form_error('telp'); ?></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input type='number' class="form-control py-2" id="fax" type="text" name='fax' placeholder="Nomor Fax" />
                                        </div>
                                    </div>
                                </div>
                                
                                <br>

                                <h4>Penanggung Jawab Akun</h4>

                                <div class="form-group">
                                    <label class="mb-2" for="pj">Nama<i class="text-danger">*</i></label>
                                    <input class="form-control py-2" id="pj" type="text" name='pj' placeholder="Nama Penanggung Jawab akun" value='<?= set_value('pj'); ?>'/>
                                    <small class="form-text text-danger"><?= form_error('pj'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label class="mb-2" for="noPj">Telepon<i class="text-danger">*</i></label>
                                    <input class="form-control py-2" id="noPj" type="text" name='noPj' placeholder="Nomor Telepon Penanggung Jawab" value='<?= set_value('noPj'); ?>'/>
                                    <small class="form-text text-danger"><?= form_error('noPj'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label class="mb-2" for="jabatan">Jabatan Di Perusahaan<i class="text-danger">*</i></label>
                                    <input class="form-control py-2" id="jabatan" type="text" name='jabatan' placeholder="Jabatan" value='<?= set_value('jabatan'); ?>'/>
                                    <small class="form-text text-danger"><?= form_error('jabatan'); ?></small>
                                </div>
                                <br>

                                <h4>Akun</h4>

                                <div class="form-group">
                                    <label class="mb-2" for="email">Email <i class="text-danger">*</i></label> 
                                    <input class="form-control py-2" id="email" type="email" name='email' placeholder="Alamat Email" value='<?= set_value('email'); ?>' />
                                    <small class="form-text text-danger"><?= form_error('email'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label class="mb-2" for="username">Username <i class="text-danger">*</i></label> 
                                    <input class="form-control py-2" id="username" type="username" name='username' placeholder="Username" value='<?= set_value('username'); ?>' />
                                    <small class="form-text text-danger"><?= form_error('username'); ?></small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-2" for="password1">Kata Sandi <i class="text-danger">*</i></label>
                                            <input class="form-control py-2" id="password1" name='password1' type="password" placeholder="Kata Sandi Minimal 8 Karakter" />
                                            <small class="form-text text-danger"><?= form_error('password1'); ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-2" for="password2">Konfirmasi Kata Sandi <i class="text-danger">*</i></label>
                                            <input class="form-control py-2" id="password2" name='password2' type="password" placeholder="Konfirmasi Kata Sandi" />
                                            <small class="form-text text-danger"><?= form_error('password2'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" >Buat Akun</button></div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            Sudah Memiliki Akun? <a href="<?= base_url() ; ?>auth"> login </a>
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