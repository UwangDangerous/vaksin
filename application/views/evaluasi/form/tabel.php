<div id="tabel">
    <?php if($tabelProses) : ?>
                    
        <br><br>
        
        <!-- <h2>Summary Protocol</h2> <br> -->
        <?php foreach ($tabelProses as $row) : ?>
            <div class="card p-2 mb-4">
                <?php $idTbl = $row['id_tbl_proses'] ; ?> 
                <h5><?= $row['nama_tbl_proses']; ?></h5> 
    
                <div id="header<?= $idTbl; ?>"> <!-- oke header id -->  </div>
    
                <div id="kolom<?= $idTbl; ?>"></div>
    
                <div id="footer<?= $idTbl; ?>"></div>
                
                <script>
                    $(document).ready(function(){
                        $("#header<?= $idTbl; ?>").load("<?= base_url(); ?>evaluasi/header/<?= $idTbl; ?>/<?= $id; ?>/<?= $idBatch;?>") ;
    
                        // dinote
                
                    });
                </script>
            </div>
        <?php endforeach ; ?>
    
    <?php endif; ?>
</div>
