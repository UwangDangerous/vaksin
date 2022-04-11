<?php if(!empty($this->session->flashdata('pesan_check') )) : ?>
        
    <div class="alert alert-<?=  $this->session->flashdata('warna_check') ; ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan_check'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?>


<?php if($check) : ?>
    <form id='ubah-no-ceklis' method="post">
        <input type="hidden" name='id' value='<?= $check['id_hasil_evaluasi'];?>'>
<?php else : ?>
    <form id='simpan-no-ceklis' method="post">
<?php endif ; ?>
    <div class="input-group ">
        <input type="text" class="form-control" placeholder="No Ceklis ( F/BIO/xxxx )" value='<?= $check['nomer_ceklis'];?>' name='nomer_ceklis'>
        
        <?php if($check) : ?>
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit"  data-toggle='tooltip' title='Simpan Nomer Ceklis'><i class="fa fa-edit"></i></button>
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-primary" id='print' type="button" data-toggle='tooltip' title='print hasil evaluasi' target='blank'><i class="fa fa-print"></i></button>
            </div>
        <?php else : ?>
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit" data-toggle='tooltip' title='Ubah Nomer Ceklis'><i class="fa fa-save"></i></button>
            </div>
        <?php endif ; ?>
    </div>
</form>


<script>
    $(document).ready(function(){
        $("#print").click(function(){
            window.open('<?= base_url(); ?>cetak/form_evaluasi/<?= $id; ?>/<?= $idBatch; ?>', '_blank');
        });
    
        $("#simpan-no-ceklis").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>evaluasi/simpanNoCeklis/<?= $id; ?>/<?= $idBatch ; ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#check').html(data) ;      
                }
            });
        });

        $("#ubah-no-ceklis").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>evaluasi/ubahNoCeklis/<?= $id; ?>/<?= $idBatch ; ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#check').html(data) ;      
                }
            });
        });
    })
</script>