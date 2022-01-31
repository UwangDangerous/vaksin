<div class="card p-3">
    <?php 
    
        // $coba = [] ;

        // $coba[] = 'mantap' ;
        // $coba[] = 1 ;
        // $coba[] = 2 ;
        // $coba[] = 3 ;

        // var_dump($coba) ;
    
    ?>
    <div class="row">
        <div class="col">

            <div id="general_informasi">
                <!-- _ general informasi-> -->
            </div>
            
            
            <div id="tabel">
                <!-- _tabel header -> tabel -> footer -->
            </div>
        </div>
    </div>
    
</div>


<script>
    $(document).ready(function(){
        $("#general_informasi").load("<?= base_url(); ?>sample_/general_informasi/<?= $id; ?>/<?= $idSample;?>") ;

        $("#tabel").load("<?= base_url(); ?>sample_/tabel/<?= $id; ?>/<?= $idSample;?>") ;
    });
</script>