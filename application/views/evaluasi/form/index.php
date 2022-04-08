<div class="card p-3">
    <div class="row">
        <div class="col-md-6">
            <div id="check">
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            
            <!-- <a href='<?//= base_url(); ?>cetak/form_evaluasi/<?//= $id; ?>/<?//= $idSample; ?>' class="btn btn-primary" data-toggle='tooltip' title='print hasil evaluasi' target='blank'><i class="fa fa-print"></i></a> -->

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
        $("#general_informasi").load("<?= base_url(); ?>evaluasi/general_informasi/<?= $id; ?>/<?= $idBatch;?>") ;

        $("#tabel").load("<?= base_url(); ?>evaluasi/tabel/<?= $id; ?>/<?= $idBatch;?>") ;
    });

</script>
