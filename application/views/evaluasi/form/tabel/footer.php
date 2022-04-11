<div id="footer<?= $idTbl; ?>">
    <script src="<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <hr>
    <?php if($footer) : ?>
        <table cellpadding=5 cellspacing=5>
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
                    <td class='align-top'><?= $h['nama_tbl_footer']; ?></td>
                    <td class='align-top'>:</td>
                    <!-- <td class='align-top'> -->
                    <!-- alihkan td ke dalamkondisi -->
                        <?php if($isiFooter = $this->Evaluasi_model->cekIsiDataFooter($idFooter, $idBatch)) : ?>
                            <td class='align-top'>
                                <?= $isiFooter['isi_footer'];?>
                            </td>
                            <td class='align-top'>
                                <form method="post" id='ubah_isi_footer<?= $idFooter;?>'>
                                    <div class="input-group ">
                                        <div class="input-group-append">

                                            <button class="btn btn-outline-secondary" type="button" data-toggle='modal' data-target='#tampilkan-ubah-footer-<?= $idFooter; ?> ' data-toggle='tooltip' title='Tampilkan Pengetikan'> <i class="fa fa-keyboard"></i> </button>
                                            <button class="btn btn-outline-success" type="submit" data-toggle='tooltip' title='Ubah Data'> <i class="fa fa-edit"></i> </button>
                                            <button class="btn btn-outline-danger" type="button" id='hapus_footer_<?= $idFooter;?>' data-toggle='tooltip' title='Hapus Data'> <i class="fa fa-trash"></i> </button>
                                        </div>
                                    </div>
                                    <!-- modal tampilkan data -->
                                    <div class="modal fade" id="tampilkan-ubah-footer-<?= $idFooter; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <textarea name="namaFooter" id="id_tbl_footer_ubah-<?= $idFooter;?>" cols="30" rows="10"><?= $isiFooter['isi_footer'];?></textarea>
                                                <script>
                                                    tinymce.init({
                                                        selector: '#id_tbl_footer_ubah-<?= $idFooter;?>' ,
                                                        plugins: "lists,charmap,preview ",
                                                        toolbar: 'numlist bullist bold italic underline superscript subscript align charmap preview'
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                            </td>

                            <script>
                                $('#hapus_footer_<?= $idFooter; ?>').click(function(e) {
                                    if(confirm("hapus data?")){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>evaluasi/hapus_tbl_footer/<?= $idTbl.'/'.$id.'/'.$idBatch.'/'.$isiFooter['id_isi_tbl_footer']; ?>',
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
                                            url: '<?= base_url(); ?>evaluasi/ubah_tbl_footer/<?= $idTbl.'/'.$id.'/'.$idBatch.'/'.$isiFooter['id_isi_tbl_footer']; ?>',
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
                            <td class='align-top'>
                                <form method="post" id='tambah_isi_footer<?= $idFooter;?>'>
                                    <div class="input-group ">
                                        <input type="hidden" name='idFooter' value="<?= $idFooter;?>" >
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" data-toggle='modal' data-target='#tampilkan-tambah-footer-<?= $idFooter; ?> ' data-toggle='tooltip' title='Tampilkan Pengetikan'> <i class="fa fa-keyboard"></i> </button>
                                            <button class="btn btn-outline-primary" type="submit" data-toggle='tooltip' title='Simpan Data'> <i class="fa fa-save"></i> </button>
                                        </div>
                                    </div>
                                    <!-- modal tampilkan data -->
                                    <div class="modal fade" id="tampilkan-tambah-footer-<?= $idFooter; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <textarea name="namaFooter" id="id_tbl_footer-<?= $idFooter;?>" cols="30" rows="10"></textarea>
                                                <!-- <script>
                                                    tinymce.init({
                                                        selector: '#id_tbl_footer-<?//= $idFooter;?>' ,
                                                        plugins: "lists,charmap,preview ",
                                                        toolbar: 'numlist bullist bold italic underline superscript subscript align charmap preview'
                                                    });
                                                </script> -->
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </td>
                        <?php endif ; ?>
                    <!-- alihkan td ke dalamkondisi -->
                </tr>
                <!-- tambah isi footer -->
                    <script>
                        $("#tambah_isi_footer<?= $idFooter;?>").submit(function(e){
                            e.preventDefault();
                            $.ajax({
                                url: '<?= base_url(); ?>evaluasi/tambah_tbl_footer/<?= $idTbl.'/'.$id.'/'.$idBatch ;?>',
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
</div>