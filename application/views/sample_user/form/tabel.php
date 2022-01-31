<?php if($tabelProses) : ?>
                
    <br><br>
    
    <h2>Summary Protocol</h2> <br>
    <?php foreach ($tabelProses as $row) : ?>
        <div class="card p-2 mb-2">
            <?php $idTbl = $row['id_tbl_proses'] ; ?> 
            <h5><?= $row['nama_tbl_proses']; ?></h5> 

            <div id="header<?= $idTbl; ?>"> <!-- oke header id -->  </div>

            <br>

            <div id="footer<?= $idTbl; ?>"></div>
            
            <script>
                $(document).ready(function(){
                    $("#header<?= $idTbl; ?>").load("<?= base_url(); ?>sample_/header/<?= $idTbl; ?>/<?= $id; ?>/<?= $idSample;?>") ;

                    $("#footer<?= $idTbl; ?>").load("<?= base_url(); ?>sample_/footer/<?= $idTbl; ?>/<?= $id; ?>/<?= $idSample;?>") ;
            
                });
            </script>
        </div>
    <?php endforeach ; ?>

<?php endif; ?>
