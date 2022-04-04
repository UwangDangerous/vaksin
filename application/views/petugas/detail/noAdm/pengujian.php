<div id="no_urut_pengujian">
    <button class="btn btn-outline-info" data-toggle='tooltip' title='Refresh' id="refresh_pengujian"><i class="fa fa-sync"></i></button> <br> <br>

    <?php if($idJenisManufacture > 2) : ?>
        <?php $adm = "PBAL" ; ?>
    <?php else : ?>
        <?php $adm = "BL-P" ; ?>
    <?php endif ; ?>

    <?php $no = 0 ; ?>
    <?php $no_urut = $this->NoAdm_model->getNoUrutPengujian($adm, date('Y')) ; ?>
    <?php foreach ($no_urut as $nu) : ?>
        <?php $no = $nu['PnoAdm'] ; ?>
    <?php endforeach ; ?>


    <?php foreach ($pengujian as $p) : ?>

        <?php $no_adm_pengujian = $this->NoAdm_model->getNoAdmPengujian($p['idJP_used']) ;  ?>
        <?php if($no_adm_pengujian) : ?>

            <?php $no_pengujian = $no_adm_pengujian['PnoAdm'].'/'.$no_adm_pengujian['PkodeAdm'].'/'.$no_adm_pengujian['PkodeBulan'].'/'.$no_adm_pengujian['Ptahun'] ?>
            
            <div class="input-group input-group-sm mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm"> <?= $p['namaJenisPengujian']; ?> </span>
                </div>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value='<?= $no_pengujian; ?>' disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-danger btn-sm" id="hapus_no_urut_pengujian<?= $p['idJP_used'];?>"><i class="fa fa-trash" data-toggle='tooltip' title='Hapus Nomor Admin'></i></button>
                </div>
            </div>

            <script>
                $("#hapus_no_urut_pengujian<?= $p['idJP_used'];?>").click(function(e){
                    if(confirm("Hapus Nomor Admin Pengujian?")){
                        e.preventDefault();
                        $.ajax({
                            url: '<?= base_url(); ?>_NoAdm/hapus_no_urut_pengujian/<?= $no_adm_pengujian['PidAdm']; ?>/<?= $id; ?>/<?= $idJenisManufacture;?>',
                            type: 'post',
                            data: $(this).serialize(),             
                            success: function(data) {               
                                $('#no_urut_pengujian').html(data) ;      
                            }
                        });
                    }else{
                        return false ;
                    }
                }) ;
            </script>

        <?php else : ?>

            <?php $no = $no + 1 ; ?>
            <?php $bln = $this->_Date->formatRomawi(date("m")) ; ?>
            <?php $thn = date("Y") ; ?>
            <?php $value = $no.'/'.$adm.'/'.$bln.'/'.$thn; ?>

            <form action="" method='post' id="simpan_<?= $p['idJP_used'];?>">
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <input type="hidden" name='PnoAdm' value='<?= $no; ?>'>
                        <input type="hidden" name='PkodeAdm' value='<?= $adm; ?>'>
                        <input type="hidden" name='PkodeBulan' value='<?= $bln; ?>'>
                        <input type="hidden" name='Ptahun' value='<?= $thn; ?>'>
                        <span class="input-group-text" id="inputGroup-sizing-sm"> <?= $p['namaJenisPengujian']; ?> </span>
                    </div>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value='<?= $value; ?>'>
                    <div class="input-group-append">
                        <button type='submit' class="btn btn-outline-primary btn-sm"><i class="fa fa-save" data-toggle='tooltip' title='Simpan Nomor Urut'></i></button>
                    </div>
                </div>
            </form>

            <script>
                $("#simpan_<?= $p['idJP_used'];?>").submit(function(e){
                    if(confirm("Simpan Nomor Admin Pengujian")){
                        e.preventDefault();
                        $.ajax({
                            url: '<?= base_url(); ?>_NoAdm/simpan_no_urut_pengujian/<?= $p['idJP_used']; ?>/<?= $id; ?>/<?= $idJenisManufacture;?>',
                            type: 'post',
                            data: $(this).serialize(),             
                            success: function(data) {               
                                $('#no_urut_pengujian').html(data) ;      
                            }
                        });
                    }else{
                        return false ;
                    }
                });
            </script>

        <?php endif ; ?>
    <?php endforeach ; ?>

    <?php if($this->session->flashdata("pesan_no_pengujian")) : ?>
        <i class="text-<?= $this->session->flashdata('warna_no_pengujian'); ?>"> <?= $this->session->flashdata('pesan_no_pengujian'); ?> </i>
    <?php endif ; ?>
</div>

<script>
    $("#refresh_pengujian").click(function(){
        $("#no_urut_pengujian").load("<?= base_url() ; ?>_NoAdm/no_adm_pengujian/<?= $id;?>/<?= $idJenisManufacture;?>")
    });
</script>