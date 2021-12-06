<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 
    <!-- <div class="row"> -->
        <h3><?= $sample['namaSample']; ?></h3> 
        
        
        <div class="row">
            <div class="col-md-3"><h6> Tanggal Terima Sample </h6></div>
            <div class="col-md-9">: <?= $sample['tgl_terima_sample']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-3"><h6> Vial </h6></div>
            <?php $vial = explode(',',$sample['vial']); ?>
            <div class="col-md-9">: <?= $sample['vial'].' ('.count($vial).')' ; ?></div>
        </div>
    
        <!-- form -->
        <br>
        <form action="" method='post' enctype="multipart/form-data" class='myform'>
            <input type="hidden" name='idSample' value="<?= $sample['idSample'] ; ?>">
            <input type="hidden" name='jmlVial' value="<?= count($vial); ?>"> 
            <input type="hidden" name='namaSample' value="<?= $sample['namaSample']; ?>"> 
            <!-- Batch No --> 
            <div class="form-group">
                <label for="batch"><h6> Batch No </h6></label>
                <input type="text" class="form-control" id="batch" placeholder="Batch No" name='batch' value="<?= set_value('batch'); ?>" >
                <small id="usernameHelp" class="form-text text-danger"><?= form_error('batch'); ?></small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><h6> Vial yang diterima </h6></label> <br>
                        <div class="form-check">
                            <div class="row">
                            <?php 
                                $i = 0 ;
                                for($i; $i<count($vial); $i++) :
                            ?>
                                <div class="col-md-6">
                                    <input class="form-check-input" type="checkbox" id="vial<?= $i; ?>" name="vial<?= $i; ?>" value="<?= $vial[$i]; ?>">
                                    <label class="form-check-label" for="vial<?= $i; ?>">
                                        <?= $vial[$i]; ?>
                                    </label> <br>
                                </div>
                            <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="doses"><h6> Doses </h6></label>
                        <input type="text" class="form-control" id="doses" placeholder="Doses No" name='doses' value="<?= set_value('doses'); ?>" >
                        <small id="usernameHelp" class="form-text text-danger"><?= form_error('doses'); ?></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- tanggal penerimaan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal"><h6> Expiry Date </h6></label>
                        <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Pengiriman" name='tanggal' value="<?= set_value('tanggal'); ?>" >
                        <small id="usernameHelp" class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                    </div>
                </div>

                <!-- ceklis -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="berkas"><h6> Upload Ceklis </h6> </label>
                        <input type="file" class="form-control" id="berkas" name='berkas' >
                        <b>*tipe file pdf</b>
                    </div>
                </div>
            </div>

            <br><br>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
</div>