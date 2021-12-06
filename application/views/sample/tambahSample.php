<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <form action="" method='post' enctype="multipart/form-data" class='myform'>
        <input type="hidden" name='id' value="<?= $id; ?>"> 
        <!-- nama sempel --> 
        <div class="form-group">
            <label for="nama">Nama Sampel</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama Sampel" name='nama' value="<?= set_value('nama'); ?>" >
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama'); ?></small>
        </div>

        <!-- jenis sampel -->
        <div class="form-group">
            <label for="js">Jenis Sampel</label>
            <select class="form-control" id='js'  name='js'>
                <option value=''>-pilih-</option>
                <?php foreach ($jenisSample as $js) : ?>
                    <option value="<?= $js['idJS']; ?>"> <?= $js['namaJS']; ?> </option>
                <?php endforeach ; ?>
            </select>
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('js'); ?></small>
        </div>

        <!-- vial -->
        <div class="form-group">
            <label for="vial">Vial</label>
            <textarea name="vial" id="vial" cols="30" rows="10" class="form-control" placeholder="Vial"><?= set_value('vial'); ?></textarea>
            <b>*penulisan xxx1, xxxx2</b>
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('vial'); ?></small>
        </div>

        <div class="row">
            <!-- tanggal penerimaan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggal">Tanggal Pengiriman</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Pengiriman" name='tanggal' value="<?= set_value('tanggal'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                </div>
            </div>

            <!-- ceklis -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="berkas">Upload Ceklis</label>
                    <input type="file" class="form-control" id="berkas" name='berkas' >
                    <b>*tipe file pdf,zip</b>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('berkas'); ?></small>
                </div>
            </div>
        </div>

        <br><br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>