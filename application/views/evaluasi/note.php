<script>
        $(document).ready(function(){
            $("#general_informasi").load("<?= base_url(); ?>evaluasi/general_informasi/<?= $id; ?>/<?= $idSample;?>") ;

            $("#tabel").load("<?= base_url(); ?>evaluasi/tabel/<?= $id; ?>/<?= $idSample;?>") ;
        
            $("#check").load("<?= base_url(); ?>evaluasi/check/<?= $id; ?>/<?= $idSample;?>") ;
            
        });

    </script>



<!-- ============================================== -->

<script>
    $("#kolom<?= $idTbl; ?>").load("<?= base_url(); ?>evaluasi/kolom/<?= $idTbl; ?>/<?= $id; ?>/<?= $idBatch;?>") ;
                        
                        $("#footer<?= $idTbl; ?>").load("<?= base_url(); ?>evaluasi/footer/<?= $idTbl; ?>/<?= $id; ?>/<?= $idBatch;?>") ;
</script>