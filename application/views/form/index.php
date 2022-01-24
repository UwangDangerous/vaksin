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
                General Informasi
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
                                            <?php 
                                                if($gi['tugasGI'] == 1) : 
                                                    $tugas = 'Evaluasi' ;
                                                else : 
                                                    $tugas = 'Pemohon' ;
                                                endif ; 
                                            ?>
                                            
                                            
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
                                <li class='list-group-item d-flex justify-content-between align-items-center'>
                                    Tambah Tabel
                                    <a href="#tabel" class="badge badge-primary" data-toggle='modal' data-target='#modalTabel' data-toggle='tooltip' title='Tambah Tabel'><fa class="fa fa-plus"></fa> </a>
                                </li>
                                <?php foreach ($tabel as $tbl) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $tbl['nama_tbl_proses']; ?>

                                        <a href="#tabel" class="badge badge-success" data-toggle='tooltip' title='Tampilkan Tabel'><fa class="fa fa-eye"></fa> </a>
                                            
                                    </li>
                                    
                                    <script>
                                        $(document).ready(function() {

                                        });
                                    </script>
                                <?php endforeach ; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div id="tabel">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tabel form -->