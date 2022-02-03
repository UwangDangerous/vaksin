<?php if($header) : ?>
    <table cellpadding=2>
        <?php if(!empty($this->session->flashdata('pesan_isi_header_'.$idTbl) )) : ?>
        
            <div class="alert alert-<?=  $this->session->flashdata('warna_isi_header_'.$idTbl) ; ?> alert-dismissible fade show" role="alert">
                <?=  $this->session->flashdata('pesan_isi_header_'.$idTbl); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
        <?php endif ; ?>
        <?php foreach ($header as $h) : ?>

            <?php $idHeader = $h['id_tbl_header']; ?>
            <tr>
                <td><?= $h['nama_tbl_header']; ?></td>
                <td>:</td>
                <td>
                    <?php if($isiHeader = $this->Evaluasi_model->cekIsiDataHeader($idHeader, $idSample)) : ?>
                        <form method="post" id='ubah_isi_header<?= $idHeader;?>'>
                            <div class="input-group ">
                                <input type="text" class="form-control" name='namaHeader' value='<?= $isiHeader['isi_header'];?>'>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" type="submit" data-toggle='tooltip' title='Ubah Data'> <i class="fa fa-edit"></i> </button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" type="button" id='hapus_header_<?= $idHeader;?>' data-toggle='tooltip' title='Hapus Data'> <i class="fa fa-trash"></i> </button>
                                    </div>
                            </div>
                        </form>    

                        <script>
                            $('#hapus_header_<?= $idHeader; ?>').click(function(e) {
                                if(confirm("hapus data?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>evaluasi/hapus_tbl_header/<?= $idTbl.'/'.$id.'/'.$idSample.'/'.$isiHeader['id_isi_tbl_header']; ?>',
                                        type: 'post',
                                        data: $(this).serialize(),             
                                        success: function(data) {               
                                            $('#header<?= $idTbl; ?>').html(data) ;      
                                        }
                                    });
                                }else{
                                    return false;
                                }
                            }) ; 

                            $('#ubah_isi_header<?= $idHeader;?>').submit(function(e) {
                                if(confirm("ubah data?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>evaluasi/ubah_tbl_header/<?= $idTbl.'/'.$id.'/'.$idSample.'/'.$isiHeader['id_isi_tbl_header']; ?>',
                                        type: 'post',
                                        data: $(this).serialize(),             
                                        success: function(data) {               
                                            $('#header<?= $idTbl; ?>').html(data) ;      
                                        }
                                    });
                                }else{
                                    return false;
                                }
                            }) ; 
                        </script>
                    <?php else : ?>
                        <form method="post" id='tambah_isi_header<?= $idHeader;?>'>
                            <div class="input-group ">
                                <input type="hidden" name='idHeader' value="<?= $idHeader;?>" >
                                <input type="text" class="form-control" name='namaHeader'>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit" data-toggle='tooltip' title='Simpan Data'> <i class="fa fa-save"></i> </button>
                                    </div>
                            </div>
                        </form>
                    <?php endif ; ?>
                </td>
            </tr>
            <!-- tambah isi header -->
                <script>
                    $("#tambah_isi_header<?= $idHeader;?>").submit(function(e){
                        e.preventDefault();
                        $.ajax({
                            url: '<?= base_url(); ?>evaluasi/tambah_tbl_header/<?= $idTbl.'/'.$id.'/'.$idSample ;?>',
                            type: 'post',
                            data: $(this).serialize(),             
                            success: function(data) {               
                                document.getElementById("tambah_isi_header<?= $idHeader;?>").reset();
                                $('#header<?= $idTbl; ?>').html(data) ;      
                            }
                        });
                    });
                </script>
            <!-- tambah isi header -->
        <?php endforeach ; ?>
    </table>
<?php endif ; ?>