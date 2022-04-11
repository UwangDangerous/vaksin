<div id="header<?= $idTbl; ?>">
    <script src="<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <?php if($header) : ?>
        <table cellpadding=5 cellspacing=5>
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
                    <td class='align-top'><?= $h['nama_tbl_header']; ?></td>
                    <td class='align-top'>:</td>
                    <!-- alihkan td per kondisi -->
                        <?php if($isiHeader = $this->Evaluasi_model->cekIsiDataHeader($idHeader, $idBatch)) : ?>
                            
                            <td class='align-top'>
                                <?= $isiHeader['isi_header'];?>
                            </td>
                            <td class='align-top'>
                                <form method="post" id='ubah_isi_header<?= $idHeader;?>'>
                                    <div class="input-group ">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle='modal' data-target='#tampilkan-ubah-header-<?= $idHeader; ?> ' data-toggle='tooltip' title='Tampilkan Pengetikan'> <i class="fa fa-keyboard"></i> </button>
                                                <button class="btn btn-outline-success" type="submit" data-toggle='tooltip' title='Ubah Data'> <i class="fa fa-edit"></i> </button>
                                                <button class="btn btn-outline-danger" type="button" id='hapus_header_<?= $idHeader;?>' data-toggle='tooltip' title='Hapus Data'> <i class="fa fa-trash"></i> </button>
                                            </div>
                                    </div>

                                    <!-- modal tampilkan data -->
                                    <div class="modal fade" id="tampilkan-ubah-header-<?= $idHeader; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <textarea name="namaHeader" id="id_tbl_header_ubah-<?= $idHeader;?>" cols="30" rows="10"><?= $isiHeader['isi_header'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                            </td>
                            <script>
                                tinymce.init({
                                    selector: '#id_tbl_header_ubah-<?= $idHeader;?>' ,
                                    plugins: "lists,charmap,preview ",
                                    toolbar: 'numlist bullist bold italic underline superscript subscript align charmap preview'
                                });
                            </script>
                            

                            <script>
                                $('#hapus_header_<?= $idHeader; ?>').click(function(e) {
                                    if(confirm("hapus data?")){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>evaluasi/hapus_tbl_header/<?= $idTbl.'/'.$id.'/'.$idBatch.'/'.$isiHeader['id_isi_tbl_header']; ?>',
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
                                            url: '<?= base_url(); ?>evaluasi/ubah_tbl_header/<?= $idTbl.'/'.$id.'/'.$idBatch.'/'.$isiHeader['id_isi_tbl_header']; ?>',
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
                            <td class='align-top'>
                                <form method="post" id='tambah_isi_header<?= $idHeader;?>'>
                                    <div class="input-group ">
                                        <input type="hidden" name='idHeader' value="<?= $idHeader;?>" >
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" data-toggle='modal' data-target='#tampilkan-tambah-header-<?= $idHeader; ?> ' data-toggle='tooltip' title='Tampilkan Pengetikan'> <i class="fa fa-keyboard"></i> </button>
                                            <button class="btn btn-outline-primary" type="submit" data-toggle='tooltip' title='Simpan Data'> <i class="fa fa-save"></i> </button>
                                        </div>
                                    </div>

                                    <!-- modal tampilkan data -->
                                    <div class="modal fade" id="tampilkan-tambah-header-<?= $idHeader; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <textarea name="namaHeader" id="id_tbl_header-<?= $idHeader;?>" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <!-- <script>
                                tinymce.init({
                                    selector: '#id_tbl_header-<?//= $idHeader;?>' ,
                                    plugins: "lists,charmap,preview ",
                                    toolbar: 'numlist bullist bold italic underline superscript subscript align charmap preview'
                                });
                            </script> -->
                        <?php endif ; ?>
                    <!-- alihkan td per kondisi -->
                </tr>
                <!-- tambah isi header -->
                    <script>
                        $("#tambah_isi_header<?= $idHeader;?>").submit(function(e){
                            e.preventDefault();
                            $.ajax({
                                url: '<?= base_url(); ?>evaluasi/tambah_tbl_header/<?= $idTbl.'/'.$id.'/'.$idBatch ;?>',
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
</div>