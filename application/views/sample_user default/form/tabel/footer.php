<?php if($footer) : ?>
    <table cellpadding=2>
        <?php if(!empty($this->session->flashdata('pesan_isi_footer_'.$idTbl) )) : ?>
        
            <div class="alert alert-<?=  $this->session->flashdata('warna_isi_footer_'.$idTbl) ; ?> alert-dismissible fade show" role="alert">
                <?=  $this->session->flashdata('pesan_isi_footer_'.$idTbl); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
        <?php endif ; ?>
        <?php foreach ($footer as $h) : ?>

            <?php $idFooter = $h['id_tbl_footer']; ?>
            <tr>
                <td><?= $h['nama_tbl_footer']; ?></td>
                <td>:</td>
                <td>
                    <?php if($isiFooter = $this->User_Sample_model->cekIsiDataFooter($idFooter, $idSample)) : ?>

                        <form method="post" id='ubah_isi_footer<?= $idFooter;?>'>
                            <div class="input-group ">
                                <input type="text" class="form-control" name='namaFooter' value='<?= $isiFooter['isi_footer'];?>'>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="submit" data-toggle='tooltip' title='Ubah Data'> <i class="fa fa-edit"></i> </button>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="button" id='hapus_footer_<?= $idFooter;?>' data-toggle='tooltip' title='Hapus Data'> <i class="fa fa-trash"></i> </button>
                                </div>
                            </div>
                        </form>    

                        <script>
                            $('#hapus_footer_<?= $idFooter; ?>').click(function(e) {
                                if(confirm("hapus data?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>sample_/hapus_tbl_footer/<?= $idTbl.'/'.$id.'/'.$idSample.'/'.$isiFooter['id_isi_tbl_footer']; ?>',
                                        type: 'post',
                                        data: $(this).serialize(),             
                                        success: function(data) {               
                                            $('#footer<?= $idTbl; ?>').html(data) ;      
                                        }
                                    });
                                }else{
                                    return false;
                                }
                            }) ; 

                            $('#ubah_isi_footer<?= $idFooter;?>').submit(function(e) {
                                if(confirm("ubah data?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>sample_/ubah_tbl_footer/<?= $idTbl.'/'.$id.'/'.$idSample.'/'.$isiFooter['id_isi_tbl_footer']; ?>',
                                        type: 'post',
                                        data: $(this).serialize(),             
                                        success: function(data) {               
                                            $('#footer<?= $idTbl; ?>').html(data) ;      
                                        }
                                    });
                                }else{
                                    return false;
                                }
                            }) ; 
                        </script>
                    <?php else : ?>
                        <form method="post" id='tambah_isi_footer<?= $idFooter;?>'>
                            <div class="input-group ">
                                <input type="hidden" name='idFooter' value="<?= $idFooter;?>" >
                                <input type="text" class="form-control" name='namaFooter'>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit" data-toggle='tooltip' title='Simpan Data'> <i class="fa fa-save"></i> </button>
                                    </div>
                            </div>
                        </form>
                    <?php endif ; ?>
                </td>
            </tr>
            <!-- tambah isi footer -->
                <script>
                    $("#tambah_isi_footer<?= $idFooter;?>").submit(function(e){
                        e.preventDefault();
                        $.ajax({
                            url: '<?= base_url(); ?>sample_/tambah_tbl_footer/<?= $idTbl.'/'.$id.'/'.$idSample ;?>',
                            type: 'post',
                            data: $(this).serialize(),             
                            success: function(data) {               
                                document.getElementById("tambah_isi_footer<?= $idFooter;?>").reset();
                                $('#footer<?= $idTbl; ?>').html(data) ;      
                            }
                        });
                    });
                </script>
            <!-- tambah isi footer -->
        <?php endforeach ; ?>
    </table>
<?php endif ; ?>