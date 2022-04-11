<?php if($kolom) : ?>
    <div class="table-responsive pt-2">
        <!-- Button trigger modal -->
        <button type="button" data-toggle="modal" data-target="#modalTambah<?= $idTbl; ?>"  class="btn btn-outline-primary mb-2" data-toogle='tooltip' title='Simpan'>
            <i class="fa fa-save"></i>
        </button> 
        
        <div id="isi_kolom_query<?= $idTbl; ?>"> </div>

        <?php $jmlKolom = count($kolom) ; ?>
        <?php $idKolom = [] ; ?>
        <?php foreach ($kolom as $k) : ?>
            <?php $idKolom[] = $k['id_kolom'].'|'.$k['nama_kolom'] ?>
        <?php endforeach ; ?>
    </div>

    
    <?php 
    
        $this->db->where('id_tbl_proses', $idTbl) ;
        $nama = $this->db->get('tbl_proses')->row_array()['nama_tbl_proses'] ;
    
    ?>

    
    <!-- Modal -->
    <div class="modal fade" id="modalTambah<?= $idTbl; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> <?= $nama; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method='post' id='simpanIsiKolom_<?= $idTbl;?>'>
                    <div class="modal-body">
                        <?php $ArrayIDK = '' ; ?>
                        <?php foreach ($idKolom as $idk) : ?>
                            <td>
                                <?php $idk = explode('|', $idk) ; ?>
                                <label for="isi_kolom<?= $idk[0];?>"><?= $idk[1]; ?></label>
                                <textarea class="form-control" rows="5" id='isi_kolom<?= $idk[0];?>' name='isi_kolom_<?= $idk[0] ?>'></textarea>

                                <?php $ArrayIDK .= $idk[0].',' ; ?>
                            </td>
                        <?php endforeach ; ?>
                        <input type="hidden" name='ArrayIDK' value='<?= rtrim($ArrayIDK,','); ?>'>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            $("#isi_kolom_query<?= $idTbl; ?>").load("<?= base_url(); ?>evaluasi/isi_kolom/<?= $idTbl; ?>/<?= $id; ?>/<?= $idBatch;?>") ;
            
            $("#simpanIsiKolom_<?= $idTbl;?>").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: '<?= base_url(); ?>evaluasi/tambahIsiKolom/<?= $idTbl.'/'.$id.'/'.$idBatch ;?>',
                    type: 'post',
                    data: $(this).serialize(),             
                    success: function(data) {               
                        document.getElementById("simpanIsiKolom_<?= $idTbl;?>").reset();
                        $('#isi_kolom_query<?= $idTbl; ?>').html(data) ;      
                    }
                });
            });
        });

    </script>
<?php endif ; ?>