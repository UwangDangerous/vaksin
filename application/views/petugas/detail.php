<?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?= $this->session->flashdata('warna') ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
<?php endif ; ?>

<?php $verify_berkas = false ; ?>
<?php $verify_sample = false ; ?>
<?php $pesan_verifikasi = '' ; ?>

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
                    <th class='align-top'>Nama Perusahaan</th>
                    <td class='align-top'>:</td> 
                    <?php if($batch['idJenisManufacture'] == 2) : ?>
                        <td><?= $batch['namaImportir']; ?> <br> ( Importir <?= $batch['namaEU']; ?> ) </td>
                    <?php else : ?>
                        <td> <?= $batch['namaEU']; ?> </td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th class='align-top'>Nomor Betch</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['noBatch']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jumlah Produksi</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['vial']; ?> ( <?= $batch['namaJenisKemasan']; ?> )</td>
                </tr>
                <tr>
                    <th class='align-top'>Dosis</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['dosis']; ?></td>
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
                                        <a class="dropdown-item" href="<?= base_url(); ?>assets/file-upload/data-dukung/<?= $isiDataDukung['fileDataDukung'];?>" data-toogle='tooltip' title='Tampilkan' target='blank'><?= $dd['namaJenisDataDukung']; ?></a>
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
                                <a href="<?= base_url(); ?>assets/file-upload/biling/file-biling/<?= $verifikasi_berkas['kode_biling'] ;?>" class="btn btn-success" data-toggle="tooltip" title='Tampilkan Biling Pembayaran' target='blank'><i class="fa fa-check"></i></a> 
                                <?php $verify_berkas = true ; ?>
                            <?php else : ?>
                                <a href="#" class="btn btn-danger" data-toggle="tooltip" title='Menunggu Melengkapi Berkas'><i class="fa fa-times"></i></a>
                            <?php endif ; ?>
                        <?php else : ?>
                            <a href="#" class="btn btn-warning" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle='tooltip' title='verifikasi berkas'>Verifikasi</a>
                        <?php endif ; ?>
                    </td>
                </tr>
                <?php $verifikasi_sample = $this->Petugas_model->getVerifikasiSample($batch['idBatch']) ; ?>
                <?php if($batch['idJenisDokumen'] == 3) : ?>
                    <tr>
                        <th class="align-top">Verifikasi Sampel</th>
                        <th class="align-top">:</th>
                        <td class="align-top">
                            <?php if($verifikasi_sample) : ?>
                                <a href="" class="btn btn-success" data-toggle='tooltip' title='sampel diterima dan sesuai'><i class="fa fa-check"></i></a>
                                <?php $verify_sample = true ; ?>
                            <?php else : ?>
                                <a href="" class="btn btn-warning" data-toggle='modal' data-target='#verifikasi-sample' data-toggle='tooltip' title='Verifikasi Sampel'>Verifikasi</a>
                                <?php $verify_sample = false ; ?>
                            <?php endif ; ?>
                        </td>
                    </tr>
                <?php endif ; ?>
                <tr>
                    <th class='align-top'>Verifikasi Pembayaran</th>
                    <td class='align-top'>:</td>
                    <td>
                        <?php if($verify_berkas == true) : ?>
                                
                        <?php else : ?>
                            <i class="text-danger">Berkas Belum Lengkap</i>
                        <?php endif ; ?>

                        <?php if($verify_berkas == true && $verifikasi_sample) : ?>
                            <?php $verifikasi_pembayaran = $this->Petugas_model->getVerifikasiPembayaran($batch['idBatch']); ?>
                            <?php if($verifikasi_pembayaran) : ?>
                                <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 1) : ?>
                                    <a href="<?= base_url();?>/assets/file-upload/biling/bukti-bayar/<?= $verifikasi_pembayaran['fileBuktiBayar']; ?>" class="btn btn-success" data-toggle="tooltip" title='Tampilkan Bukti Pembayaran'><i class="fa fa-check"></i></a>
                                <?php elseif($verifikasi_pembayaran['status_verifikasi_bayar'] == 2) : ?>
                                    <i class="text-danger">ditolak</i>
                                    <a href="#" class="btn btn-warning" data-toggle='modal' data-target='#veri-pembayaran' data-toggle="tooltip" title='Verifikasi Pembayaran'>verifikasi ulang</a>
                                <?php else : ?>
                                    <a href="#" class="btn btn-warning" data-toggle='modal' data-target='#veri-pembayaran' data-toggle="tooltip" title='Verifikasi Pembayaran'>verifikasi</a>
                                <?php endif ; ?>
                            <?php else : ?>
                                <i class="text-danger">Belum Melakukan Pembayaran</i>
                            <?php endif ; ?>
                        <?php elseif($verify_berkas == true) : ?>
                            <i class="text-danger">Sampel Belum Di Periksa</i>
                        <?php elseif($verify_sample == true) : ?>
                            <i class="text-danger">Berkas Belum Lengkap</i>
                        <?php else : ?>
                            <i class="text-danger">Berkas Belum Lengkap & Sampel Belum Di Periksa</i>
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
                                            <button type='button' id="verifikasi-terima" class='btn btn-success' data-toggle='tooltip' title='data dukung sesuai'> 
                                                <i class="fa fa-check"></i>
                                            </button>

                                            <button type='button' id="verifikasi-tolak" class='btn btn-danger' data-toggle='tooltip' title='data dukung tidak sesuai'>
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='align-top'></td>
                                        <td class='align-top'></td>
                                        <td class='align-top'>
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

        <!-- Modal Verifikasi Sampel -->
            <div class="modal fade" id="verifikasi-sample" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Kelengkapan Sampel Pengujian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table>
                                <tr>
                                    <th class='align-top'>Jumlah Sampel Yang Dikirim </th>
                                    <th class='align-top'>: </th>
                                    <td class='align-top'>
                                        <?= $batch['pengiriman']; ?> <?= $batch['kemasan']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class='align-top'>Suhu Sebelum Pengiriman</th>
                                    <th class='align-top'>: </th>
                                    <td class='align-top'>
                                        <?= $batch['suhu']; ?>	&deg;<?= $batch['satuan']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class='align-top'>Tanggal Kadaluarsa</th>
                                    <th class='align-top'>: </th>
                                    <td class='align-top'>
                                        <?= $this->_Date->formatTanggal( $batch['tgl_kadaluarsa'] ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class='align-top'>Verifikasi</th>
                                    <th class='align-top'>: </th>
                                    <td class='align-top'>
                                        <a href="#" class="btn btn-success" data-toggle='tooltip' title='sampel sesuai' id='sample-terima'><i class="fa fa-check"></i></a>
                                        <a href="#" class="btn btn-danger" data-toggle='tooltip' title='sampel tidak sesuai' id='sample-tolak'><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            </table>

                            <div id="sample-input"></div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div> -->
                    </div>
                </div>
            </div>

        <!-- Modal Pembayaran -->
            <div class="modal fade" id="veri-pembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <?php if($verifikasi_pembayaran) : ?>
                            <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 0 || $verifikasi_pembayaran['status_verifikasi_bayar']) : ?>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 0 ) : ?>
                                            Verifikasi Pembayaran
                                        <?php elseif($verifikasi_pembayaran['status_verifikasi_bayar'] == 2 ) : ?>
                                            Verifikasi Pembayaran Ulang
                                        <?php endif ; ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url(); ?>petugas/tambahVerifikasiPembayaran/<?= $batch['idSurat'] ;?>/<?= $batch['idSample'] ;?>/<?= $batch['idBatch'] ;?>" method="post" enctype="multipart/form-data" id='verifikasi-pembayaran-id'>
                                    <div class="modal-body">
                                        <table cellpadding=5 cellspacing=5>
                                            <tr>
                                                <th class='align-top'>Bukti Pembayaran</th>
                                                <th class='align-top'>:</th>
                                                <td>
                                                    <a href="<?= base_url();?>/assets/file-upload/biling/bukti-bayar/<?= $verifikasi_pembayaran['fileBuktiBayar']; ?> " data-toggle='tooltip' title='Tampilkan Bukti Bayar' class="btn btn-secondary" target='blank'><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class='align-top'></th>
                                                <th class='align-top'>:</th>
                                                <td>
                                                    <input type="hidden" value='<?= $verifikasi_pembayaran['idBuktiBayar'] ; ?>' name='id_very'>
                                                    <button type='button' id="veri-pembayaran-terima" class='btn btn-success'>
                                                        <i class="fa fa-check"></i>
                                                    </button>

                                                    <button type='button' id="veri-pembayaran-tolak" class='btn btn-danger'>
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <div id="vepe"></div>
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
                // verifikasi berkas
                
                    $("#isi-berkas").html($("#berkas").html()) ;

                    $('#verifikasi-terima').click(function(){
                        $('#veteto').html(`
                            <span class='text-success'>
                                Berkas Diterima
                            </span>
                            <label for="file-very">Kirim Biling</label>
                            <input type="file" class="form-control" id="file-very" name="berkas">
                            <input type="hidden" name="status-very" value='1'>
                            <input type="hidden" name="namaFileTambahan-very" value='<?= $batch['noBatch'] ?>'>
                        `) ;
                    }) ;

                    $('#verifikasi-tolak').click(function(){
                        $('#veteto').html(`
                            <span class='text-danger'>
                                Berkas Ditolak
                            </span> 
                            <label for="keterangan-very">Keterangan</label>
                            <textarea class='form-control' name="keterangan-very" id="keteragan-very" cols="80" rows="5"></textarea>
                            <input type="hidden" name="status-very" value='2'>
                        `) ;
                    }) ;

                // verifikasi berkas

                // verifikasi pembayaran

                    $('#veri-pembayaran-tolak').click(function(){
                        $('#vepe').html(`
                            <span class='text-danger'>
                                Pembayaran Ditolak
                            </span> 
                            <label for="keterangan-very">Keterangan</label>
                            <textarea class='form-control' name="keterangan-very" id="keteragan-very" cols="80" rows="5"></textarea>
                            <input type="hidden" name="status-very" value='2'>
                        `) ;
                    }) ;

                    $('#veri-pembayaran-terima').click(function(){
                        $('#vepe').html(`
                            <input type="hidden" name="status-very" value='1'>
                            <input type="hidden" name="keterangan-very" value='Diterima'>
                            <span class='text-success'>
                                Pembayaran Diterima
                            </span>
                        `) ;
                    }) ;

                // verifikasi pembayaran

                // verifikasi sampel

                    $("#sample-terima").click(function(){
                        $("#sample-input").html(`
                            <br>
                            <i class='text-success'> Sampel Sesuai </i>
                            <form action="<?= base_url() ?>petugas/tambahVerifikasiSample/<?= $batch['idSurat'] ;?>/<?= $batch['idSample'] ;?>/<?= $batch['idBatch'] ;?>" method="post">
                                <div class="card p-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="suhu_sample">Suhu Saat Sampel Diterima</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <input type="number" class="form-control" id="suhu_sample" name='suhu_sample' placeholder="Suhu Sample Saat Diterima">
                                                </div>
                                                <select class="custom-select" name='satuan_suhu'>
                                                    <?php foreach ($satuan as $s) : ?>
                                                        <option value="<?= $s; ?>">&deg;<?= $s; ?></option>
                                                    <?php endforeach ; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jumlah_sample">Jumlah Sampel Diterima</label>
                                            <input type="number" class="form-control" id="jumlah_sample" name='jumlah_sample' placeholder="Suhu Sample Saat Diterima">
                                        </div>
                                    </div>
                                </div>
                                
                                <br>
                                <button type='submit' class='btn btn-primary'>Simpan</button>
                            </form>
                        `) ;
                    });
                    $("#sample-tolak").click(function(){
                        $("#sample-input").html(`
                            <br>
                            <i class='text-danger'> Sampel Tidak Sesuai </i>
                            <form action="<?= base_url() ?>petugas/tambahVerifikasiSampleSalah/<?= $batch['idSurat'] ;?>/<?= $batch['idSample'] ;?>/<?= $batch['idBatch'] ;?>" method="post" enctype="multipart/form-data">
                                <div class="card p-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="suhu_sample">Suhu Saat Sampel Diterima</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <input type="number" class="form-control" id="suhu_sample" name='suhu_sample' placeholder="Suhu Sample Saat Diterima">
                                                </div>
                                                <select class="custom-select" name='satuan_suhu'>
                                                    <?php foreach ($satuan as $s) : ?>
                                                        <option value="<?= $s; ?>">&deg;<?= $s; ?></option>
                                                    <?php endforeach ; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jumlah_sample">Jumlah Sampel Diterima</label>
                                            <input type="number" class="form-control" id="jumlah_sample" name='jumlah_sample' placeholder="Suhu Sample Saat Diterima">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tipe_pesan">Tipe Pesan</label>
                                            <select name="tipe_pesan" id="tipe_pesan" class='form-control'>
                                                <option value="1">Pesan Saja</option>
                                                <option value="2">Menunggu Respon Tanggapan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="file_pengirim">Kirim File Jika Diperlukan</label>
                                            <input type='file' class='form-control' name='file_pengirim' >
                                            <i class='text-danger'>pdf,jpg,png</i>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="pesan_pengirim">Pesan</label>
                                            <textarea name="pesan_pengirim" id="pesan_pengirim" cols="30" rows="5" class='form-control'></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <br>
                                <button type='submit' class='btn btn-primary'>Simpan</button>
                            </form>
                        `) ;
                    });

                // verifikasi sampel
            });
        </script>
    <!-- js tambahan berkas -->

<br>






<!-- petugas evaluasi dan verifikasi -->
    <div class="card p-3">
        <div class="row">
            <div class="col">
                <h4>Petugas Evalausi Dan Verifikasi</h4>   
                <table cellpadding=2 cellspacing=2>
                    <tr>
                        <!-- evaluator -->
                            <th class='align-top'>Evaluator</th>
                            <th class='align-top'>:</th>
                            <td class='align-top'>
                                <?php 
                                    $this->db->where('idBatch', $batch['idBatch']) ;
                                    $this->db->where('petugas.idLevel', 3) ;
                                    $this->db->join('inuser', 'inuser.idIU = petugas.idIU') ;
                                    $petugas_evaluator = $this->db->get('petugas')->row_array() ;

                                    $this->db->where('idLevel = 3 OR idLevel = 4' );
                                    $inuser = $this->db->get('inuser')->result_array() ;
                                ?>
                                <?php if($petugas_evaluator) : ?>
                                    <form action="<?= base_url();?>petugas/ubahPetugasEvaluator/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>" method="post">
                                        <div class="input-group mb-3">
                                            <input type="hidden" name='idEvaluator' value='<?= $petugas_evaluator['idPetugas'];?>'>
                                            <select name="evaluator" class='form-control' style='width:400px'>
                                                <option value="-">-pilih-</option>
                                                <?php foreach ($inuser as $iu) : ?>
                                                    <?php if($iu['idIU'] == $petugas_evaluator['idIU']) : ?>
                                                        <option selected value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                    <?php endif ; ?>
                                                <?php endforeach ; ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success" type="submit" id="button-addon2" data-toggle='tooltip' title='Ubah Data Petugas Evaluator'><i class="fa fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                <?php else : ?>
                                    <form action="<?= base_url();?>petugas/tambahPetugasEvaluator/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>" method="post">
                                        <div class="input-group mb-3">
                                            <select name="evaluator" class='form-control' style='width:400px'>
                                                <option value="-">-pilih-</option>
                                                <?php foreach ($inuser as $iu) : ?>
                                                    <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" data-toggle='tooltip' title='Simpan Data Petugas Verifikator'><i class="fa fa-save"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif ; ?>
                            </td>
                        <!-- evaluator -->
                    </tr>
                    <tr>
                        <!-- verifikator -->
                            <th class='align-top'>Verifikator</th>
                            <th class='align-top'>:</th>
                            <td class='align-top'>
                                <?php 
                                    $this->db->where('idBatch', $batch['idBatch']) ;
                                    $this->db->where('petugas.idLevel', 4) ;
                                    $this->db->join('inuser', 'inuser.idIU = petugas.idIU') ;
                                    $petugas_verifikator = $this->db->get('petugas')->row_array() ;

                                    $this->db->where('idLevel', 4 );
                                    $inuser = $this->db->get('inuser')->result_array() ;
                                ?>
                                <?php if($petugas_verifikator) : ?>
                                    <form action="<?= base_url();?>petugas/ubahPetugasVerifikator/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>" method="post">
                                        <div class="input-group mb-3">
                                            <input type="hidden" name='idVerifikator' value='<?= $petugas_verifikator['idPetugas'];?>'>
                                            <select name="verifikator" class='form-control' style='width:400px'>
                                                <option value="-">-pilih-</option>
                                                <?php foreach ($inuser as $iu) : ?>
                                                    <?php if($iu['idIU'] == $petugas_verifikator['idIU']) : ?>
                                                        <option selected value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                    <?php endif ; ?>
                                                <?php endforeach ; ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success" type="submit" id="button-addon2" data-toggle='tooltip' title='Ubah Data Petugas Verifikator'><i class="fa fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                <?php else : ?>
                                    <form action="<?= base_url();?>petugas/tambahPetugasVerifikator/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>" method="post">
                                        <div class="input-group mb-3">
                                            <select name="verifikator" class='form-control' style='width:400px'>
                                                <option value="-">-pilih-</option>
                                                <?php foreach ($inuser as $iu) : ?>
                                                    <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" data-toggle='tooltip' title='Simpan Data Petugas Verifikator'><i class="fa fa-save"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif ; ?>
                            </td>
                        <!-- verifikator -->
                    </tr>
                </table>
            </div>
        </div>
    </div>
<!-- petugas evaluasi dan verifikasi -->