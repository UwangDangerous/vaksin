<div id="evaluator"></div>
    <div class="card p-2 mb-2">
        <h5>Evaluator</h5>
        <?php $petugas_evaluator = $this->_Petugas_model->getPetugasVerifikator($id, 2) ?>
        <?php if($petugas_evaluator) : ?>
            <form action="" method='post' id="ubah-evaluator">
                <div class="input-group mb-3">
                    <select name="idIU" class='form-control' style='width:400px'>
                        <?php foreach ($evaluator as $eva) : ?>
                            <?php if($eva['idIU'] == $petugas_evaluator['idIU']) : ?>
                                <option selected value="<?= $eva['idIU']; ?>"><?= $eva['namaIU']; ?></option>
                            <?php else : ?>
                                <option value="<?= $eva['idIU']; ?>"><?= $eva['namaIU']; ?></option>
                            <?php endif ; ?>
                        <?php endforeach ; ?>
                    </select>
                    <input type="hidden" name='idPetugas' value='<?= $petugas_evaluator['idPetugas'];?>'>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit" id="button-addon2" data-toggle='tooltip' title='Ubah Petugas Evaluator'><i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </form>
        <?php else : ?>
            <form action="" method='post' id="simpan-evaluator">
                <div class="input-group mb-3">
                    <select name="idIU" class='form-control' style='width:400px'>
                        <?php foreach ($evaluator as $eva) : ?>
                            <option value="<?= $eva['idIU']; ?>"><?= $eva['namaIU']; ?></option>
                        <?php endforeach ; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2" data-toggle='tooltip' title='Simpan Petugas Evaluator'><i class="fa fa-save"></i></button>
                    </div>
                </div>
            </form>
        <?php endif ; ?>

        <?php if($this->session->flashdata('pesan_Evaluator')) : ?>
            <i class="text-<?= $this->session->flashdata("warna_Evaluator"); ?>"> <?= $this->session->flashdata('pesan_Evaluator'); ?> </i>
        <?php endif ; ?>
    </div>
</div>

<script>
    $("#simpan-evaluator").submit(function(e){
        if(confirm("Simpan Petugas Evaluator ?")){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>_petugas/simpanPetugas/<?= $id ;?>/<?= $idJenisManufacture; ?>/<?= $idJenisDokumen; ?>/2',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#evaluator').html(data) ;      
                }
            });
        }else{
            return false;
        }
    });

    $("#ubah-evaluator").submit(function(e){
        if(confirm("Ubah Petugas Evaluator ?")){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>_petugas/ubahPetugas/<?= $id ;?>/<?= $idJenisManufacture; ?>/<?= $idJenisDokumen; ?>/2',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#evaluator').html(data) ;      
                }
            });
        }else{
            return false;
        }
    });
</script>