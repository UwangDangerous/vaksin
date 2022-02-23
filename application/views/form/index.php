<div class="card p-3 mb-3">
    <h3>
        <table cellpadding='4'>
            <tr>
                <td>Vaksin</td>
                <td>:</td>
                <td><?= $jenisSample['jenisSample']; ?></td>
            </tr>
            <tr>
                <td>Lama Pengerjaan</td>
                <td>:</td>
                <td><?= $jenisSample['waktuPengujian']; ?></td>
            </tr>
            <tr>
                <td>Tampilkan Form</td>
                <td>:</td>
                <td>
                    <a href="<?= base_url(); ?>form/form/<?= $jenisSample['idJenisSample'];?>" target='blank' class="badge badge-secondary"><i class="fa fa-file"></i></a>
                </td>
            </tr>
        </table>
    </h3>
</div>
<?php $this->session->unset_userdata(['pesan_gi', 'warna_gi']); ?>

<!-- general informasi -->
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#form_gi">
                General Information
                </button>
            </h5>
        </div>
        <div id="form_gi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="myscroll">
                            <ul class="list-group">
                                <?php foreach ($general_informasi as $gi) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $gi['namaGI']; ?>
                                        <div id="gi_off_btn_<?= $gi['idGI']; ?>">
                                            <a type='button' href='#gi-used' id='off_gi_<?= $gi['idGI']; ?>' class="badge badge-danger" data-toggle='tooltip' title='Hapus General Informasi' onclick="return confirm('Yakin?')"> <i class="fas fa-minus"></i> </a>
                                        </div>

                                        <div id="gi_add_btn_<?= $gi['idGI']; ?>">
                                            <a type='button' href='#gi-used' id='add_gi_<?= $gi['idGI']; ?>' class="badge badge-primary" data-toggle='tooltip' title='Tambah General Informasi'> <i class="fa fa-plus"></i> </a>
                                        </div>
                                    </li>
                                    
                                    <script>
                                        <?php $tombol = $this->Form_model->cekTbl_gi_used($gi['idGI'], $jenisSample['idJenisSample']) ; ?>
                                        <?php if($tombol) : ?>
                                            let gi_aktif<?= $gi['idGI'] ;?> = true ; //non aktif
                                        <?php else : ?>
                                            let gi_aktif<?= $gi['idGI'] ;?> = false ;
                                        <?php endif ; ?>

                                        $(document).ready(function() {
                                            $('#gi-used').load("<?= base_url() ;?>/form/gi_used/<?= $jenisSample['idJenisSample']; ?>") ;

                                            if(gi_aktif<?= $gi['idGI'] ;?> == true) { // non aktif
                                                $('#gi_add_btn_<?= $gi['idGI']; ?>').hide() ; 
                                                $('#gi_off_btn_<?= $gi['idGI']; ?>').show() ;

                                                //gi_aktif<?//= $gi['idGI'] ;?> = false ;
                                            }else{ 
                                                $('#gi_off_btn_<?= $gi['idGI']; ?>').hide() ;
                                                $('#gi_add_btn_<?= $gi['idGI']; ?>').show() ;

                                                // gi_aktif<?//= $gi['idGI'] ;?> = true ;
                                            }

                                            $("#off_gi_<?= $gi['idGI'];?>").click(function(){
                                                $('#gi_off_btn_<?= $gi['idGI']; ?>').hide() ;
                                                $('#gi_add_btn_<?= $gi['idGI']; ?>').show() ;
                                                $('#gi-used').load("<?= base_url() ;?>/form/off_gi_used/<?= $jenisSample['idJenisSample'].'/'.$gi['idGI']; ?>") ;
                                            }) ;

                                            $("#add_gi_<?= $gi['idGI'];?>").click(function(){
                                                $('#gi_off_btn_<?= $gi['idGI']; ?>').show() ;
                                                $('#gi_add_btn_<?= $gi['idGI']; ?>').hide() ;
                                                $('#gi-used').load("<?= base_url() ;?>/form/add_gi_used/<?= $jenisSample['idJenisSample'].'/'.$gi['idGI']; ?>") ;
                                            }) ;
                                        });

                                    </script>
                                <?php endforeach ; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div id="gi-used">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- general informasi -->

<!-- tabel form -->
    <div class="accordion mt-3" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#tabel">
                    Tabel
                    </button>
                </h5>
            </div>
            <div id="tabel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="myscroll">
                                <ul class="list-group">
                                    <div id="listTabel"></div> <!-- ajax -->
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div id="tampilTabel"> <!-- ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- tabel form -->

<!-- Modal -->
<div class="modal fade" id="modalTabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tabel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id='tambahTabel'>

                <div class="modal-body">
                    <label for="namaTabel">Nama Tabel</label>
                    <input type="text" name="namaTabel" id="namaTabel" class='form-control'> 
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#listTabel").load('<?= base_url(); ?>form/listTabel/<?= $idJenisSample ; ?>') ;

        $("#tambahTabel").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>form/tambahTabel/<?= $idJenisSample ; ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    document.getElementById("tambahTabel").reset();
                    //   $('#tampil').load('tampil.php'); 
                    $('#listTabel').html(data) ;      
                }
            });
        });
    }) ;
</script>