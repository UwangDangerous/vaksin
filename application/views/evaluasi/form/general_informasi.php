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
    <table cellpadding=2>
        <?php foreach ($general_informasi as $gi) : ?>
            <tr class='<?= $warna_gi ; ?>' >
                <td><?= $gi['namaGI']; ?></td> 
                <td>:</td>
                <td>
                    <?php $gi_used = $this->Evaluasi_model->getData_GI_Use($gi['idGI']) ; ?>
                    <?php 
                        $this->db->where('id_gi_used', $gi_used) ;
                        $this->db->where('idSample', $idSample) ;
                        $isi_gi_used = $this->db->get('isi_tbl_gi')->row_array() ;
                    ?>

                    <?php if($isi_gi_used) : ?> <!-- cek isi -->
                        
                        <!-- ubah -->
                        <form method="post" id='ubah_form_isi_gi<?= $isi_gi_used['id_isi_gi']; ?>'>
                            <div class="input-group">

                                <input type="hidden" name='id_isi_gi' value='<?= $isi_gi_used['id_isi_gi']; ?>'>
                                <input type="text" class="form-control" name='isi_gi' value='<?= $isi_gi_used['isi_gi']; ?>'>

                                <div class="input-group-append" id="button-addon4">
                                    <button class="btn btn-outline-success" type="submit" data-toggle='tooltip' title='Ubah Data General Informasi'> <i class="fa fa-edit"></i> </button>

                                    <!-- hapus -->
                                    <button class="btn btn-outline-danger" type="button" id='hapus_gi<?= $isi_gi_used['id_isi_gi']; ?>' data-toggle='tooltip' title='Hapus General Informasi' > <i class="fa fa-trash"></i> </button>

                                </div>
                            </div>
                        </form>

                        <script>
                            $("#hapus_gi<?= $isi_gi_used['id_isi_gi']; ?>").click(function(e){
                                if(confirm("hapus data?")){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>evaluasi/hapus_gi/<?= $id; ?>/<?= $idSample; ?>/<?= $isi_gi_used['id_isi_gi']; ?>',
                                            type: 'post',
                                            data: $(this).serialize(),             
                                            success: function(data) {               
                                                //   $('#tampil').load('tampil.php'); 
                                                $('#general_informasi').html(data) ;      
                                            }
                                        });
                                }else{
                                    return false;
                                }
                            }); 

                            $("#ubah_form_isi_gi<?= $isi_gi_used['id_isi_gi']; ?>").submit(function(e){
                                if(confirm("hapus data?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>evaluasi/ubah_gi/<?= $id; ?>/<?= $idSample; ?>',
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
                        <form method="post" id='tambah_form_isi_gi<?= $gi['idGI'] ; ?>'>
                            <div class="input-group">
                            <input type="hidden" value='<?= $gi_used; ?>' name='id_isi_gi'>
                                <input type="text" class="form-control" name='isi_gi'>
                                <div class="input-group-append" id="button-addon4">
                                    <button class="btn btn-outline-primary" type="submit" data-toggle='tooltip' title='Simpan General Informasi'> <i class="fa fa-save"></i> </button>
                                </div>
                            </div>
                        </form>

                    <?php endif ; ?>
                </td>
            </tr>
            <script>
                $("#tambah_form_isi_gi<?= $gi['idGI'] ; ?>").submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: '<?= base_url(); ?>evaluasi/tambah_gi/<?= $id; ?>/<?= $idSample; ?>',
                        type: 'post',
                        data: $(this).serialize(),             
                        success: function(data) {               
                            document.getElementById("tambah_form_isi_gi<?= $gi['idGI'] ; ?>").reset();
                            //   $('#tampil').load('tampil.php'); 
                            $('#general_informasi').html(data) ;      
                        }
                    });
                });
            </script>
        <?php endforeach ; ?>
    </table>
<?php endif ; ?>