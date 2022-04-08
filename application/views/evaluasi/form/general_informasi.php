<div id="general_informasi">

    <script src="<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>


    <?php if(!empty($this->session->flashdata('pesan_isi') )) : ?>
                
        <div class="alert alert-<?=  $this->session->flashdata('warna_isi'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan_isi'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?>



    <?php if($general_informasi) : ?>
        <h2>General Informasi</h2> <br>
        <table cellpadding=5 cellspacing=2>
            <?php foreach ($general_informasi as $gi) : ?>
                <tr class='<?= $warna_gi ; ?>' >
                    <td class='align-top'><?= $gi['namaGI']; ?></td> 
                    <td class='align-top'>:</td>
                    <!-- <td class='align-top'> -->
                        <?php $gi_used = $this->Evaluasi_model->getData_GI_Use($gi['idGI']) ; ?>
                        <?php 
                            $this->db->where('id_gi_used', $gi_used) ;
                            $this->db->where('idBatch', $idBatch) ;
                            $isi_gi_used = $this->db->get('isi_tbl_gi')->row_array() ;
                        ?>

                        <?php if($isi_gi_used) : ?> <!-- cek isi -->
                            <!-- ubah dan hapus-->
                                <td class='align-top'> <!-- td -->
                                    <?= $isi_gi_used['isi_gi']; ?>
                                </td>
                                <td class='align-top'> <!-- td -->
                                    <form method="post" id='ubah_form_isi_gi<?= $isi_gi_used['id_isi_gi']; ?>'>
                                        <div class="input-group">
                                            <input type="hidden" name='id_isi_gi' value='<?= $isi_gi_used['id_isi_gi']; ?>'>
                                    
                                            <div class="input-group-append" id="button-addon4">
                                                <!-- ketikan -->
                                                <button class="btn btn-outline-secondary" type='button' data-toggle='modal' data-target='#ubah-<?= $gi['idGI'] ; ?>' data-toggle='tooltip' title='Tampilkan Inputan Lengkap'> <i class="fa fa-keyboard"></i> </button>
                                                <!-- ubah -->
                                                <button class="btn btn-outline-success" type="submit" data-toggle='tooltip' title='Ubah Data General Informasi'> <i class="fa fa-edit"></i> </button>
                                                <!-- hapus -->
                                                <button class="btn btn-outline-danger" type="button" id='hapus_gi<?= $isi_gi_used['id_isi_gi']; ?>' data-toggle='tooltip' title='Hapus General Informasi' > <i class="fa fa-trash"></i> </button>

                                            </div>

                                            <!-- modal tampilkan data -->
                                            <div class="modal fade" id="ubah-<?= $gi['idGI'] ; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <textarea name="isi_gi" id="ubah-gi-<?= $gi['idGI'] ; ?>" cols="30" rows="10"><?= $isi_gi_used['isi_gi']; ?></textarea>
                                                        <script>
                                                            tinymce.init({
                                                                selector: '#ubah-gi-<?= $gi['idGI'] ; ?>' ,
                                                                plugins: "lists,charmap,preview ",
                                                                toolbar: 'numlist bullist bold italic underline superscript subscript align charmap preview'
                                                            });
                                                        </script>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            <!-- ubah dan hapus-->

                            <script>
                                $("#hapus_gi<?= $isi_gi_used['id_isi_gi']; ?>").click(function(e){
                                    if(confirm("hapus data?")){
                                            e.preventDefault();
                                            $.ajax({
                                                url: '<?= base_url(); ?>evaluasi/hapus_gi/<?= $id; ?>/<?= $idBatch; ?>/<?= $isi_gi_used['id_isi_gi']; ?>',
                                                type: 'post',
                                                data: $(this).serialize(),             
                                                success: function(data) {               
                                                    $('#general_informasi').html(data) ;      
                                                }
                                            });
                                    }else{
                                        return false;
                                    }
                                }); 

                                $("#ubah_form_isi_gi<?= $isi_gi_used['id_isi_gi']; ?>").submit(function(e){
                                    if(confirm("ubah data?")){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>evaluasi/ubah_gi/<?= $id; ?>/<?= $idBatch; ?>',
                                            type: 'post',
                                            data: $(this).serialize(),             
                                            success: function(data) {               
                                                document.getElementById("ubah_form_isi_gi<?= $isi_gi_used['id_isi_gi']; ?>").reset();
                                                //   $('#tampil').load('tampil.php'); 
                                                $('#general_informasi').html(data) ;      
                                            }
                                        });
                                    }else{
                                        return false ;
                                    }
                                });
                            </script>

                        <?php else : ?>

                            <!-- simpan -->
                            <td class="alig-center">
                                <form method="post" id='tambah_form_isi_gi<?= $gi['idGI'] ; ?>'>
                                    <div class="input-group">
                                    <input type="hidden" value='<?= $gi_used; ?>' name='id_isi_gi'>
                                        <div class="input-group-append" id="button-addon4">
                                            <button class="btn btn-outline-secondary" type='button' data-toggle='modal' data-target='#tambah-<?= $gi['idGI'] ; ?>' data-toggle='tooltip' title='Tampilkan Inputan Lengkap'> <i class="fa fa-keyboard"></i> </button>
                                            <button class="btn btn-outline-primary" type="submit" data-toggle='tooltip' title='Simpan General Informasi'> <i class="fa fa-save"></i> </button>
                                        </div>
                                    </div>
                                    <!-- modal tampilkan data -->
                                    <div class="modal fade" id="tambah-<?= $gi['idGI'] ; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <textarea name="isi_gi" id="tambahan-<?= $gi['idGI'] ; ?>" cols="30" rows="10"></textarea>
                                                <script>
                                                    tinymce.init({
                                                        selector: '#tambahan-<?= $gi['idGI'] ; ?>' ,
                                                        // plugins: 'lists',
                                                        plugins: "lists,charmap,preview ",
                                                        toolbar: 'numlist bullist bold italic underline superscript subscript align charmap preview'
                                                    });
                                                </script>
                                            </div>
    
                                        </div>
                                    </div>
                                </form>
                            </td>


                        <?php endif ; ?>
                    <!-- </td> -->
                </tr>
                <script>
                    $("#tambah_form_isi_gi<?= $gi['idGI'] ; ?>").submit(function(e){
                        e.preventDefault();
                        $.ajax({
                            url: '<?= base_url(); ?>evaluasi/tambah_gi/<?= $id; ?>/<?= $idBatch; ?>',
                            type: 'post',
                            data: $(this).serialize(),             
                            success: function(data) {               
                                document.getElementById("tambah_form_isi_gi<?= $gi['idGI'] ; ?>").reset();
                                $('#general_informasi').html(data) ;      
                            }
                        });
                    });
                </script>
            <?php endforeach ; ?>
        </table>
    <?php endif ; ?>
</div>