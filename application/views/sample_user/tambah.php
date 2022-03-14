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


            <!-- jenis perusahaan -->
            <div class="form-group">
                <label for="jm">Jenis Sampel</label>
                <select class="form-control" id='jm'  name='jm'>
                    <option value=''>-pilih-</option>
                    <?php foreach ($jenisManufacture as $jm) : ?>
                        <?php if(form_error('jm') == $jm['idJenisManufacture'] ) : ?>
                            <option selected id='jm' value="<?= $jm['idJenisManufacture']; ?>"> <?= $jm['namaJenisManufacture']; ?> </option>
                        <?php else : ?>
                            <option id='jm' value="<?= $jm['idJenisManufacture']; ?>"> <?= $jm['namaJenisManufacture']; ?> </option>
                        <?php endif ; ?>
                    <?php endforeach ; ?>
                </select>
                <small id="usernameHelp" class="form-text text-danger"><?= form_error('jm'); ?></small>
            </div>


            <!-- jenis sampel -->
            <div class="form-group">
                <!-- <label for="js"></label> -->
                <select class="form-control" id='js'  name='js'>
                    <!-- <option value=''>-pilih-</option> -->
                    <?php foreach ($jenisSample as $js) : ?>
                        <option id='js' class='<?= $js['idJenisManufacture']; ?>' value="<?= $js['idJenisSample']; ?>"> <?= $js['jenisSample']; ?> </option>
                    <?php endforeach ; ?>
                </select>
                <small id="usernameHelp" class="form-text text-danger"><?= form_error('js'); ?></small>
            </div>


        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>