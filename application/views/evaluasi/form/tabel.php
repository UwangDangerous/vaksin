<div id="tabel">
    <?php if($tabelProses) : ?>
        <br><br>
        
        <!-- <h2>Summary Protocol</h2> <br> -->
        <?php foreach ($tabelProses as $row) : ?>
            <div class="card p-2 mb-4">
                <?php $idTbl = $row['id_tbl_proses'] ; ?> 
                <div class="row">
                    <div class="col-10">
                        <h5><?= $row['nama_tbl_proses']; ?></h5> 
                    </div>
                    <div class="col-2">
                        <a href="" data-toggle='tooltip' title='Refresh' class="btn btn-info" id='refresh_<?= $idTbl;?>'><i class="fa fa-sync"></i></a>
                    </div>
                </div>
    
                <div id="header<?= $idTbl; ?>"> <!-- oke header id -->  </div>
    
                <div id="kolom<?= $idTbl; ?>"></div>
    
                <div id="footer<?= $idTbl; ?>"></div>
                
                <script>
                    // $(document).ready(function(){
                        $("#header<?= $idTbl; ?>").load("<?= base_url(); ?>evaluasi/header/<?= $idTbl; ?>/<?= $id; ?>/<?= $idBatch;?>") ;
    
                        $("#kolom<?= $idTbl; ?>").load("<?= base_url(); ?>evaluasi/kolom/<?= $idTbl; ?>/<?= $id; ?>/<?= $idBatch;?>") ;

                        // dinote
                        $("#footer<?= $idTbl; ?>").load("<?= base_url(); ?>evaluasi/footer/<?= $idTbl; ?>/<?= $id; ?>/<?= $idBatch;?>") ;
                
                        $("#refresh_<?= $idTbl;?>").click(function(){
                            $("#tabel").load("<?= base_url(); ?>evaluasi/tabel/<?= $id; ?>/<?= $idBatch;?>") ;
                        });
                    // });
                </script>
            </div>
        <?php endforeach ; ?>
    
    <?php endif; ?>
</div>
