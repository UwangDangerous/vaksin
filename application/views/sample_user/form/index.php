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
                <!-- di isi dari controller -->
            </div>
            
            
            <?php if($tabelProses) : ?>
                
                <br><br>
                
                <h2>Summary Protocol</h2> <br>
                <?php foreach ($tabelProses as $row) : ?>
                    <?php $idTbl = $row['id_tbl_proses'] ; ?> 
                    <h5><?= $row['nama_tbl_proses']; ?></h5> 

                    <?php $header = $this->User_Sample_model->getDataForTabelHeader($idTbl) ; ?>
                    <?php if($header) : ?>
                        <table cellpadding=2>
                            <?php foreach ($header as $h) : ?>
                                <tr>
                                    <td><?= $h['nama_tbl_header']; ?></td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class='form-control' style="width:400px;">
                                    </td>
                                </tr>
                            <?php endforeach ; ?>
                        </table>
                    <?php endif ; ?>
                    <br>

                    <?php $kolom = $this->User_Sample_model->getDataForTabelKolom($idTbl) ; ?>
                    <?php if($kolom) : ?>
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>

                                    <?php $jmlKolom = count($kolom) ; ?>
                                    <?php $idKolom = [] ; ?>
                                    <?php foreach ($kolom as $k) : ?>
                                        <th><?= $k['nama_kolom']; ?></th>
                                        <?php $idKolom[] = $k['id_kolom'] ?>
                                    <?php endforeach ; ?>

                                    <th>Pass / Not Pass</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                        <?php foreach ($idKolom as $idk) : ?>
                                            <td>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                            </td>
                                            <!-- <td><input type="text" class='form-control' value="<?//= $idk ; ?>"></td> -->
                                        <?php endforeach ; ?>
                                    <td>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input form-check-input-lg" id="exampleCheck1"> <!-- checked -->
                                        </div>
                                    </td>

                                </tr>
                            </thead>
                        </table> <br><br>
                    <?php endif ; ?>
                <?php endforeach ; ?>

            <?php endif; ?>
        </div>
    </div>
    
</div>


<script>
    $(document).ready(function(){
        $("#general_informasi").load("<?= base_url(); ?>sample_/general_informasi/<?= $id; ?>/<?= $idSample;?>") ;
    });
</script>