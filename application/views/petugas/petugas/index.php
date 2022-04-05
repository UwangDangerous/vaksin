<div id="petugas">
    <div class="card p-3">
        <h3>Petugas</h3>

        <div class="row">
            <div class="col-md">
                <div class="card p-2 mb-2">
                    <h5>Verifikator</h5>
                    <?php $verifikator = $this->_Petugas_model->getDataPetugas(3); ?>
                    <?php $petugas_verifikator = $this->_Petugas_model->getPetugasVerifikator($id, 1) ?>
                    <?php if($petugas_verifikator) : ?>
                        <!-- ubah -->
                        <form action="" method="post" id="ubah-verifikator">
                            <div class="input-group mb-3">
                                <select name="idIU" class='form-control' style='width:400px'>
                                    <?php foreach ($verifikator as $ver) : ?> 
                                        <?php if($petugas_verifikator['idIU']) : ?>
                                            <option selected value="<?= $ver['idIU']; ?>"><?= $ver['namaIU']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $ver['idIU']; ?>"><?= $ver['namaIU']; ?></option>
                                        <?php endif ; ?>
                                    <?php endforeach ; ?>
                                </select>
                                <input type="hidden" name='id' value='<?= $petugas_verifikator['idPetugas'];?>'>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="submit" id="button-addon2" data-toggle='tooltip' title='Ubah Petugas Verifikator'><i class="fa fa-edit"></i></button>
                                </div>
                            </div>
                        </form>

                    <?php else : ?>
                        <!-- simpan -->
                        <form action="" method="post" id="simpan-verifikator">
                            <div class="input-group mb-3">
                                <select name="idIU" class='form-control' style='width:400px'>
                                    <?php foreach ($verifikator as $ver) : ?>
                                        <option value="<?= $ver['idIU']; ?>"><?= $ver['namaIU']; ?></option>
                                    <?php endforeach ; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2" data-toggle='tooltip' title='Simpan Petugas Verifikator'><i class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </form>
                    
                    <?php endif ; ?>

                    <?php if($this->session->flashdata('pesan_Verifikator')) : ?>
                        <i class="text-<?= $this->session->flashdata("warna_Verifikator"); ?>"> <?= $this->session->flashdata('pesan_Verifikator'); ?> </i>
                    <?php endif ; ?>
                </div>

            </div>

        

            <?php if($idJenisManufacture == 1) : ?>
                <!-- pelulusan  -->
                <div class="col-md">
                    <div id="evaluator"></div>
                </div>

                <?php if($idJenisDokumen == 3) : ?>
                    <!-- pengujian -->
                    <div class="col-md-12">
                        <div id="pengujian"></div>
                    </div>
                <?php endif ; ?>
                
            <?php elseif($idJenisManufacture > 2) : ?>
                <!-- pengujian -->
                <div class="col-md">
                    <div id="pengujian"></div>
                </div>
            <?php else : ?>
                <!-- pelulusan -->
                <div class="col-md">
                    <div id="evaluator"></div>
                </div>
            <?php endif ; ?>

        </div>
    </div>
</div>

<script>
    $("#simpan-verifikator").submit(function(e){
        if(confirm("Simpan Petugas Verifikator ?")){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>_petugas/simpanPetugas/<?= $id ;?>/<?= $idJenisManufacture; ?>/<?= $idJenisDokumen; ?>/1',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#petugas').html(data) ;      
                }
            });
        }else{
            return false;
        }
    });

    $("#ubah-verifikator").submit(function(e){
        if(confirm("Ubah Petugas Verifikator ?")){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>_petugas/ubahPetugas/<?= $id ;?>/<?= $idJenisManufacture; ?>/<?= $idJenisDokumen; ?>/1',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#petugas').html(data) ;      
                }
            });
        }else{
            return false;
        }
    });

    $("#evaluator").load("<?= base_url();?>_petugas/evaluator/<?= $id; ?>/<?= $idJenisManufacture; ?>/<?= $idJenisDokumen; ?>") ;

    $("#pengujian").load("<?= base_url();?>_petugas/pengujian/<?= $id; ?>") ;
</script>