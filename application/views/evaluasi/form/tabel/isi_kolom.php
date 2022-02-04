<div id="isi_kolom_query<?= $idTbl; ?>">
    <?php if(!empty($this->session->flashdata('pesan_kolom'.$idTbl) )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna_kolom'.$idTbl) ; ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan_kolom'.$idTbl); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?>

    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th class='align-middle'>No</th>

                <?php $jmlKolom = count($kolom) ; ?>
                <?php $idKolom = [] ; ?>
                <?php foreach ($kolom as $k) : ?>
                    <th class='align-middle'><?= $k['nama_kolom']; ?></th>
                    <?php $idKolom[] = $k['id_kolom'].'|'.$k['nama_kolom'] ?>
                <?php endforeach ; ?>

                <th class='align-middle'>Hapus</th>
                <th class='align-middle'>Pass / Available</th>
            </tr>
        </thead>
        <?php 
            $loop = 0 ; 
            $loop2 = 0 ;
            $klm = [] ;
            $isi_kolom_array = $this->Evaluasi_model->getDataFor_Isi_kolom_array($idTbl, $idSample); 
            foreach ($isi_kolom_array as $ika) : 
                    $klm[] = $ika['id_isi_tbl_kolom'].'|'.$ika['isi_kolom'] ;
            endforeach ; 
            $kolomBagi = count($isi_kolom_array) / $jmlKolom;
            $isi_kolom_fix = [] ;
            for($i=0; $i < $kolomBagi; $i++){
                for($j=0; $j < $jmlKolom; $j++){
                    $isi_kolom_fix[$i][$j]=$klm[$loop];
                    $loop++;
                }
            }
        ?>
        <tbody>
            <?php $no_kolom = 1 ; ?>
            <?php if($isi_kolom_fix == null) : ?>
                <tr><td colspan='<?= $jmlKolom+3; ?>'> <i class="text-danger">Kosong</i> </td></tr>
            <?php else : ?>   
                <?php foreach ($isi_kolom_fix as $row2) : ?>
                    <tr>
                        <?php $id_isi_kolom = '' ; ?>
                        <?php $hash_isi_kolom = '' ; ?>
                        <?php $jml_isi_kolom = 0 ; ?>
                        <td><?= $no_kolom++; ?></td>
                        <?php foreach ($row2 as $row3) : ?>
                            <?php $row3 = explode('|',$row3) ; ?>
                            <?php $id_isi_kolom .= $row3[0].'|' ; ?>
                            <?php $jml_isi_kolom += $row3[0] ; ?>
                            <td class='text-left'>
                                <form method="post" id='ubahData_isi_kolom<?= $row3[0]; ?>'>
                                    <textarea name="text_isi_kolom_<?= $row3[0]; ?>" cols="30" rows="3" class='form-control'><?= $row3[1]; ?></textarea>
                                    <div class='text-right'>
                                        <button type="submit" class="btn btn-outline-success mt-2" data-toogle='tooltip' title='Ubah Data'><i class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                            
        
                                <script>
                                    $("#ubahData_isi_kolom<?= $row3[0]; ?>").submit(function(e){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>evaluasi/ubahIsiKolom/<?= $idTbl.'/'.$id.'/'.$idSample.'/'.$row3[0] ;?>',
                                            type: 'post',
                                            data: $(this).serialize(),             
                                            success: function(data) {               
                                                document.getElementById("ubahData_isi_kolom<?= $row3[0]; ?>").reset();
                                                $('#isi_kolom_query<?= $idTbl; ?>').html(data) ;
                                            }
                                        });
                                    });
                                </script>
                            </td>
                            

                        <?php endforeach ; ?>
                        <td>
                            <?php $hash_isi_kolom = substr( md5($jml_isi_kolom), 1, 5);  ?>
                            <a href='' id="hapus_isi_kolom_<?= $hash_isi_kolom; ?>" class="btn btn-outline-danger" data-toogle='tooltip' title='Hapus'><i class="fa fa-trash"></i></a>
                        </td>

                        <script>
                            $('#hapus_isi_kolom_<?= $hash_isi_kolom; ?>').click(function(e) {
                                if(confirm("hapus data?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>evaluasi/hapusIsiKolom/<?= $idTbl.'/'.$id.'/'.$idSample.'/'.rtrim($id_isi_kolom,'|'); ?>',
                                        type: 'post',
                                        data: $(this).serialize(),             
                                        success: function(data) {               
                                            $('#isi_kolom_query<?= $idTbl; ?>').html(data) ;      
                                        }
                                    });
                                }else{
                                    return false;
                                }
                            }) ;
                        </script>

                        <td>
                            <div id='ceklis_<?= $hash_isi_kolom;?>_<?= $idSample; ?>'>
                            </div>

                            <script>
                                $("#ceklis_<?= $hash_isi_kolom;?>_<?= $idSample; ?>").load("<?= base_url(); ?>evaluasi/ceklis/<?= $hash_isi_kolom; ?>/<?= $idSample; ?>")
                            </script>
                        </td>
                    </tr>

                <?php endforeach ; ?>

            <?php endif ; ?>

        </tbody>
    </table>
</div>

