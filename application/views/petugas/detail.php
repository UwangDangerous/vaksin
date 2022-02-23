<?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
<?php endif ; ?>

<?php $verify_berkas = false ; ?>

<div class="card p-3">
    <div class="row">
        <div class="col-md-6">
            <table cellpadding=2 cellspacing=2>
                <tr>
                    <th class='align-top'>Nama Sampel / Produk</th>
                    <td class='align-top'>:</td>
                    <td><?= $batch['namaSample']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jenis Vaksin</th>
                    <td class='align-top'>:</td>
                    <td><?= $batch['jenisSample']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Lama Pengerjaan</th>
                    <td class='align-top'>:</td>
                    <td><?= $batch['waktuPengujian']; ?> hari</td>
                </tr>
                <tr>
                    <th class='align-top'>Nama Perusahaan</th>
                    <td class='align-top'>:</td> 
                    <?php if($batch['idJenisManufacture'] == 2) : ?>
                        <td><?= $batch['namaImportir']; ?> <br> ( Importir <?= $batch['namaEU']; ?> ) </td>
                    <?php else : ?>
                        <td> <?= $batch['namaEU']; ?> </td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th class='align-top'>Jenis Dokumen</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['namaJenisDokumen']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table cellpadding=2 cellspacing=2>
                <tr>
                    <th class='align-top'>Nomor Betch</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['noBatch']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jumlah Produksi</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['vial']; ?> ( <?= $batch['wadah']; ?> )</td>
                </tr>
                <tr>
                    <th class='align-top'>Dosis</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['dosis']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Data Dukung</th>
                    <td class='align-top'>:</td> 
                    <td>
                        <div class="dropdown show dropleft" id="berkas">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toogle='tooltip' title='Tampilkan Data Dukung'>
                                <i class="fa fa-eye"></i>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <?php $dataDukung = $this->Petugas_model->getJenisDataDukung($batch['idJenisManufacture']); ?>
                                <?php foreach ($dataDukung as $dd) : ?>
                                    <?php $isiDataDukung = $this->Petugas_model->setDataDukung($batch['idBatch'], $dd['idJenisDataDukung']); ?>
                                    <?php if($isiDataDukung) : ?>
                                        <a class="dropdown-item" href="<?= base_url(); ?>assets/file-upload/data-dukung/<?= $isiDataDukung['fileDataDukung'];?>" data-toogle='tooltip' title='Tampilkan'><?= $dd['namaJenisDataDukung']; ?></a>
                                    <?php else : ?>
                                        <span class="dropdown-item"><?= $dd['namaJenisDataDukung']; ?>
                                            <i class="text-danger"> ( null ) </i>
                                        </span>
                                    <?php endif ; ?>
                                <?php endforeach ; ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class='align-top'>Verifikasi Berkas</th>
                    <td class='align-top'>:</td>
                    <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($batch['idBatch']); ?>
                    <td>
                        <?php if($verifikasi_berkas) : ?>
                            <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                                <a href="" class="btn btn-success" data-toggle="tooltip" title='Tampilkan Biling Pembayaran'><i class="fa fa-check"></i></a> 
                                <?php $verify_berkas = true ; ?>
                            <?php else : ?>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" title='Menunggu Melengkapi Berkas'><i class="fa fa-times"></i></a>
                            <?php endif ; ?>
                        <?php else : ?>
                            <a href="#" class="btn btn-warning" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle='tooltip' title='verifikasi'>Verifikasi</a>
                        <?php endif ; ?>
                    </td>
                </tr>
                <tr>
                    <th class='align-top'>Verifikasi Pembayaran</th>
                    <td class='align-top'>:</td>
                    <td>
                        <?php if($verify_berkas == true) : ?>
                                <?php $verifikasi_pembayaran = $this->Petugas_model->getVerifikasiPembayaran($batch['idBatch']); ?>
                                <?php if($verifikasi_pembayaran) : ?>
                                    <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 1) : ?>
                                        <a href="#" class="btn btn-success" data-toggle="tooltip" title='Tampilkan Bukti Pembayaran'><i class="fa fa-check"></i></a>
                                    <?php else : ?>
                                        <a href="#" class="btn btn-warning" data-toggle='modal' data-target='#veri-pembayaran' data-toggle="tooltip" title='Verifikasi Pembayaran'>verifikasi</a>
                                    <?php endif ; ?>
                                <?php else : ?>
                                    <i class="text-danger">Belum Melakukan Pembayaran</i>
                                <?php endif ; ?>
                        <?php else : ?>
                            <i class="text-danger">Berkas Belum Lengkap</i>
                        <?php endif ; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


    <!-- kumpulan modal -->
            <!-- Modal verifikasi -->
            <div class="modal fade" id="verifikasi-berkas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Verifikasi Berkas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url(); ?>petugas/tambahVerifikasiBerkas/<?= $batch['idSurat'] ;?>/<?= $batch['idSample'] ;?>/<?= $batch['idBatch'] ;?>" method="post" enctype="multipart/form-data" >
                            <div class="modal-body">
                                <table cellpadding=5 cellspacing=5>
                                    <tr>
                                        <th class='align-top'>Data Dukung</th>
                                        <td class='align-top'>:</td>
                                        <td>
                                            <div id="isi-berkas"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='align-top'></th>
                                        <td class='align-top'>:</td>
                                        <td>
                                            <button type='button' id="verifikasi-terima" class='btn btn-success'>
                                                <i class="fa fa-check"></i>
                                            </button>

                                            <button type='button' id="verifikasi-tolak" class='btn btn-danger'>
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div id="veteto"></div>
                                            <!-- <div id="veto"></div> -->
                                        </td>
                                    </tr>
                                    
                                    
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Pembayaran -->
            <div class="modal fade" id="veri-pembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Verifikasi Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php if($verifikasi_pembayaran) : ?>
                            <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 0) : ?>
                                <form action="<?= base_url(); ?>petugas/tambahVerifikasiBerkas/<?= $batch['idSurat'] ;?>/<?= $batch['idSample'] ;?>/<?= $batch['idBatch'] ;?>" method="post" enctype="multipart/form-data" >
                                    <div class="modal-body">
                                        <table cellpadding=5 cellspacing=5>
                                            <tr>
                                                <th class='align-top'>Bukti Pembayaran</th>
                                                <td class='align-top'>:</td>
                                                <td>
                                                    <?= $veri; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class='align-top'></th>
                                                <td class='align-top'>:</td>
                                                <td>
                                                    <button type='button' id="verifikasi-terima" class='btn btn-success'>
                                                        <i class="fa fa-check"></i>
                                                    </button>

                                                    <button type='button' id="verifikasi-tolak" class='btn btn-danger'>
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                </td>
                                            </tr>
                                            
                                            
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            <?php endif ; ?>
                        <?php endif ; ?>
                    </div>
                </div>
            </div>
    <!-- kumpulan modal -->

    <!-- js tambahan berkas -->
        <script>
            $(document).ready(function(){
                $("#isi-berkas").html($("#berkas").html()) ;

                $('#verifikasi-terima').click(function(){
                    $('#veteto').html(`
                        <label for="file-very">Biling</label>
                        <input type="file" class="form-control" id="file-very" name="berkas">
                        <input type="hidden" name="status-very" value='1'>
                        <input type="hidden" name="namaFileTambahan-very" value='<?= $batch['noBatch'] ?>'>
                    `) ;
                }) ;

                $('#verifikasi-tolak').click(function(){
                    $('#veteto').html(`
                        <label for="keterangan-very">Keterangan</label>
                        <textarea class='form-control' name="keterangan-very" id="keteragan-very" cols="80" rows="5"></textarea>
                        <input type="hidden" name="status-very" value='2'>
                    `) ;
                }) ;
            });
        </script>
    <!-- js tambahan berkas -->





<br>

<div class="card p-3">

</div>