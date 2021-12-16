<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <form action="" method='post' > <!-- enctype="multipart/form-data" class='myform' --> 
        <input type="hidden" name='id' value="<?= $id; ?>"> 
        <!-- nama sempel --> 
        <div class="form-group">
            <label for="nama">Nama Sampel / Produk</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama Sampel / Produk" name='nama' value="<?= set_value('nama'); ?>" >
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama'); ?></small>
        </div>

        <div class="row">
            <div class="col-md-6">

                <!-- jenis sampel -->
                <div class="form-group">
                    <label for="js">Jenis Sampel</label>
                    <select class="form-control" id='js'  name='js'>
                        <option value=''>-pilih-</option>
                        <?php foreach ($jenisSample as $js) : ?>
                            <option value="<?= $js['idJenisSample']; ?>"> <?= $js['jenisSample']; ?> </option>
                        <?php endforeach ; ?>
                    </select>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('js'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- jenis dokumen -->
                <div class="form-group">
                    <label for="jd">Jenis Dokumen</label>
                    <select class="form-control" id='jd'  name='jd'>
                        <option value=''>-pilih-</option>
                        <?php foreach ($jenisDokumen as $jd) : ?>
                            <option value="<?= $jd['idJenisDokumen']; ?>"> <?= $jd['namaJenisDokumen']; ?> </option>
                        <?php endforeach ; ?>
                    </select>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('jd'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- nama perusahaan -->
                <div class="form-group">
                    <label for="namaManufacture">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="namaManufacture" placeholder="Nama Perusahaan" name='namaManufacture' value="<?= set_value('namaManufacture'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('namaManufacture'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- jenis perusahaan -->
                <div class="form-group">
                    <label for="jm">Perusahaan</label>
                    <select class="form-control" id='jm'  name='jm'>
                        <option value=''>-pilih-</option>
                        <?php foreach ($jenisManufacture as $jm) : ?>
                            <option value="<?= $jm['idJenisManufacture']; ?>"> <?= $jm['namaJenisManufacture']; ?> </option>
                        <?php endforeach ; ?>
                    </select>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('jd'); ?></small>
                </div>

            </div>

            <div class="col-md-12">

                <!-- alamat perusahaan -->
                <div class="form-group">
                    <label for="alamatManufacture">Alamat Perusahaan</label>
                    <textarea name="alamatManufacture" id="alamatManufacture" cols="30" rows="5" class="form-control" placeholder='Alamat Perusahaan'></textarea>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('alamatManufacture'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- no ma -->
                <div class="form-group">
                    <label for="noMA">Nomer MA</label>
                    <input type="text" class="form-control" id="noMA" placeholder="Nomer MA (Marketing Authorization)" name='noMA' value="<?= set_value('noMA'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('noMA'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- no batch -->
                <div class="form-group">
                    <label for="batch">No Batch</label>
                    <input type="text" class="form-control" id="batch" placeholder="No Batch" name='batch' value="<?= set_value('batch'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('batch'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- penyimpanan -->
                <div class="form-group">
                    <label for="penyimpanan">Suhu Penyimpanan</label>
                    <input type="text" class="form-control" id="penyimpanan" placeholder="Suhu Penyimpanan (contoh : 4 C)" name='penyimpanan' value="<?= set_value('penyimpanan'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('penyimpanan'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- masa berlaku -->
                <div class="form-group">
                    <label for="expiry">Masa Berlaku</label>
                    <input type="date" class="form-control" id="expiry" placeholder="Masa Berlaku" name='expiry' value="<?= set_value('expiry'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('expiry'); ?></small>
                </div>

            </div>

            <!-- tanggal penerimaan -->
            <div class="col-md-6">

                <div class="form-group">
                    <label for="tanggal">Tanggal Pengiriman Sample</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Pengiriman" name='tanggal' value="<?= set_value('tanggal'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                </div>

            </div>
        </div>

        <br><br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>