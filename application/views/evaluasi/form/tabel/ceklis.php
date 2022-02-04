<?php if($ceklis) : ?>
    <input type="checkbox" class="form-check-input" checked> <br><br><br><br>
    <button class="btn btn-outline-danger" id="hapus_ceklis_<?= $hash_isi_kolom; ?>" data-toogle='tooltip' title='Not Checked'><i class="fa fa-times"></i></button>
<?php else : ?>
    <input type="checkbox" class="form-check-input"> <br><br><br><br>
    <button class="btn btn-outline-primary" id="tambah_ceklis_<?= $hash_isi_kolom; ?>" data-toogle='tooltip' title='Checked'><i class="fa fa-check"></i></button>
<?php endif ; ?>

<script>
    $('#hapus_ceklis_<?= $hash_isi_kolom; ?>').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?= base_url(); ?>evaluasi/hapus_ceklis/<?= $hash_isi_kolom.'/'.$idSample ; ?>',
            type: 'post',
            data: $(this).serialize(),             
            success: function(data) {               
                $('#ceklis_<?= $hash_isi_kolom;?>_<?= $idSample; ?>').html(data) ;      
            }
        });
    }) ;

    $('#tambah_ceklis_<?= $hash_isi_kolom; ?>').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?= base_url(); ?>evaluasi/tambah_ceklis/<?= $hash_isi_kolom.'/'.$idSample ; ?>',
            type: 'post',
            data: $(this).serialize(),             
            success: function(data) {               
                $('#ceklis_<?= $hash_isi_kolom;?>_<?= $idSample; ?>').html(data) ;      
            }
        });
    }) ;
</script>