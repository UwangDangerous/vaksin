<div class="card p-4">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
                                    
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <form action="" method='post' enctype="multipart/form-data" class='myform'>
        <div class="form-group">
            <label for="berkas">Upload File</label>
            <input type="file" class="form-control" id="berkas" name='berkas' >
            <b>*tipe file pdf,jpg,jpeg,png</b>
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('berkas'); ?></small>
        </div>
        <div class="form-group">
            <label for="nama">Nama Surat / Keterangan</label>
            <textarea name="nama" id="nama" cols="30" rows="10" class="form-control" placeholder="Nama Surat / Keterangan"></textarea>
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama'); ?></small>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal">Tanggal Pengiriman</label>
                <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Pengiriman" name='tanggal' value="<?= set_value('tanggal'); ?>" >
                <small id="usernameHelp" class="form-text text-danger"><?= form_error('tanggal'); ?></small>
            </div>
        </div>

        <br><br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>