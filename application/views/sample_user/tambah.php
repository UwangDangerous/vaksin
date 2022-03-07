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

                <!-- jenis perusahaan -->
                <div class="form-group">
                    <label for="jm">Jenis Perusahaan</label>
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

            </div>

            <div class="col-md-6">

                <!-- jenis sampel -->
                <div class="form-group">
                    <label for="js">Jenis Sampel</label>
                    <select class="form-control" id='js'  name='js'>
                        <option value=''>-pilih-</option>
                        <?php foreach ($jenisSample as $js) : ?>
                            <option id='js' class='<?= $js['idJenisManufacture']; ?>' value="<?= $js['idJenisSample']; ?>"> <?= $js['jenisSample']; ?> </option>
                        <?php endforeach ; ?>
                    </select>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('js'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- no ma -->
                <div class="form-group">
                    <label for="exp">Tanggal Kadaluarsa</label>
                    <input type="date" class="form-control" id="exp" placeholder="Nomer MA (Marketing Authorization)" name='exp' value="<?= set_value('exp'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('exp'); ?></small>
                </div>

            </div>

            <div class="col-md-6">
                <div id="ski">
                </div>
            </div>

        </div>

        <br><br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    $(document).ready(function(){
        // $("#ski").hide() ;
        $("#jm").change(function(){
            if($("#jm").val() == 2){
                $("#ski").html(`
                    <div class="form-group">
                        <label for="ski">Nomor SKI</label>
                        <input type="text" class="form-control" id="ski" placeholder="Nomor SKI" name='ski' value="<?= set_value('ski'); ?>" >
                        <small id="usernameHelp" class="form-text text-danger"><?= form_error('ski'); ?></small>
                    </div>
                `) ;
            }else{
                $("#ski").html('') ;
            }
        });
    });
</script>