<div class="card p-3">
    <form action="<?= base_url(); ?>evaluasi/ceklis" method='post'>

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
        


        <script>
            $(document).ready(function(){
                $("#general_informasi").load("<?= base_url(); ?>evaluasi/general_informasi/<?= $id; ?>/<?= $idSample;?>") ;

                $("#tabel").load("<?= base_url(); ?>evaluasi/tabel/<?= $id; ?>/<?= $idSample;?>") ;
            });
        </script>

        <div class="text-right">
            <button class="btn btn-primary">Selesai</button>
        </div>
    </form>
</div>