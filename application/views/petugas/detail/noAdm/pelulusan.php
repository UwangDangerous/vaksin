<div id="no_urut_pelulusan">
    <?php $no = 0 ; ?>

    <?php $kdBulan = $this->_Date->formatRomawi(date("m")) ; ?>
    <?php $thn = date("Y") ; ?>
    <?php $noUrut = $this->NoAdm_model->getNoUrut("BL-E", $thn) ;?>
    <?php foreach ($noUrut as $no) : ?>
        <?php $no = $no['noAdm'] ; ?>
    <?php endforeach ; ?>

    <?php $no = $no + 1 ; ?>

    <?php $no_urut = $this->NoAdm_model->getNoUrutUsed($id) ; ?>
    <?php if($no_urut) : ?>

        <?php
             $noAdm = $no_urut['noAdm'].'/'.$no_urut['kodeAdm'].'/'.$no_urut['kodeBulan'].'/'.$no_urut['tahun'] ;
        ?>

        <div class="input-group mb-3">
            <input type="text" class="form-control" value='<?= $noAdm ;?>' disabled>
            <div class="input-group-append">
                <button class="btn btn-outline-danger" type="button" data-toggle='tooltip' title='Ambil No. Urut Ulang' id='hapus_no_urut_pelulusan'><i class="fa fa-trash"></i></button>
            </div>
        </div>

        <script>
            $("#hapus_no_urut_pelulusan").click(function(e){
                
                if(confirm("Hapus dan Ulangi Ambil No. Urut Admin?")) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?= base_url(); ?>_NoAdm/hapus_no_urut_pelulusan/<?= $id; ?>/<?= $no_urut['idAdm'];?>',
                        type: 'post',
                        data: $(this).serialize(),             
                        success: function(data) {               
                            $('#no_urut_pelulusan').html(data) ;      
                        }
                    })
                }else{
                    return false ;
                }

            }) ;
        </script>

    <?php else : ?>
        
        <form action="" method='post' id="simpan-noPelulusan">
            <div class="input-group">
                <input type="text" class="form-control" name="noAdm" value="<?= $no ; ?>">
                <input type="text" class="form-control" name="kodeAdm" value="BL-E">
                <input type="text" class="form-control" name="kodeBulan" value='<?= $kdBulan ;?>'>
                <input type="text" class="form-control" name="tahun" value="<?= $thn; ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-info" type="button" id='refresh-noPelulusan' data-toggle='tooltip' title='Refresh'> <i class="fa fa-sync"></i> </button>
                    <button class="btn btn-outline-primary" type="submit"  data-toggle='tooltip' title='Simpan Nomer A'> <i class="fa fa-save"></i> </button>
                </div>
            </div>
        </form>

    <?php endif ; ?>
    
    <?php if($this->session->flashdata("pesan_no_pelulusan")) : ?>
        <i class="text-<?= $this->session->flashdata('warna_no_pelulusan'); ?>"> <?= $this->session->flashdata('pesan_no_pelulusan'); ?> </i>
    <?php endif ; ?>
</div>

<script>
    $("#refresh-noPelulusan").click(function(){
        $("#no_urut_pelulusan").load("<?= base_url(); ?>_NoAdm/no_adm_pelulusan/<?= $id; ?>") ;
    });

    $("#simpan-noPelulusan").submit(function(e){
        if(confirm("Simpan No Admin?")) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>_NoAdm/simpan_no_urut_pelulusan/<?= $id ;?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#no_urut_pelulusan').html(data) ;      
                }
            })
        }else{
            return false ;
        }
    });
</script>