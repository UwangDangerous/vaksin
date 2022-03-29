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
<?php $verify_bayar = false ; ?>
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
                <!-- data dukung -->
                <?php if($batch['idJenisManufacture'] == 1 or $batch['idJenisManufacture'] == 2) : ?>
                    <tr>
                        <th class='align-top'>Data Dukung</th>
                        <td class='align-top'>:</td> 
                        <td>
                            <div class="dropdown show dropleft">
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
                <?php endif ; ?>
                
                <!-- verifikasi -->
                
                    <?php if($batch['idJenisManufacture'] == 1) : ?>

                        <!-- ================================================================ -->
                        <!-- domestik hanya untuk evaluasi dokumen (Verifikasi Berkas dan pengujian) -->
                            <!-- label pelulusan -->
                                <tr> <!-- verifikasi berkas mau ga mau copas kebawah -->
                                    <th class='align-top'>Verifikasi Berkas</th>
                                        <td class='align-top'>:</td>
                                        <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($batch['idBatch']); ?>
                                        <td>
                                            <?php if($verifikasi_berkas) : ?>
                                                <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                                                    <?php $verify_berkas = true ; ?> 
                                                    <a href="#" class="btn btn-success" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle="tooltip" title='Berkas Di Terima' target='blank'><i class="fa fa-check"></i></a> 
                                                <?php else : ?>
                                                    <?php $verify_berkas = false ; ?> 
                                                    <a href="#" class="btn btn-danger" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle="tooltip" title='Menunggu Melengkapi Berkas, Klik Untuk Verifikasi Ulang'><i class="fa fa-times"></i></a>
                                                <?php endif ; ?>
                                            <?php else : ?>
                                                <?php $verify_berkas = false ; ?> 
                                                <a href="#" class="btn btn-warning" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle='tooltip' title='verifikasi berkas'>Verifikasi</a>
                                            <?php endif ; ?>
                                        </td>
                                    </th>
                                </tr> 
                            <!-- label pelulusan -->

                            <?php if($batch['idJenisDokumen'] == 3) : ?>
                                <!-- non label pengujian -->
                                    <tr>
                                        <th>Verifikasi Sampel</th>
                                        <td>:</td>
                                        <td>
                                            <?php $verifikasi_sample = $this->Petugas_model->getVerifikasiSample($batch['idBatch']) ; ?>
                                            <?php if($verifikasi_sample) : ?>
                                                <?php if($verifikasi_sample['status_verifikasi_sample'] == 1) : ?>
                                                    <?php $verify_sample = true ; ?>
                                                    <a href="" class="btn btn-success" data-toggle='modal' data-target='#verifikasi-sample' data-toggle='tooltip' title='Sampel Sesuai'><i class="fa fa-check"></i></a>
                                                <?php else : ?>
                                                    <?php $verify_sample = false ; ?>
                                                    <a href="" class="btn btn-danger" data-toggle='modal' data-target='#verifikasi-sample' data-toggle='tooltip' title='verifikasi sampel ulang'><i class="fa fa-times"></i></a>
                                                <?php endif ; ?>
                                            <?php else : ?>
                                                <?php $verify_sample = false ; ?>
                                                <a href="" class="btn btn-warning" data-toggle='modal' data-target='#verifikasi-sample' data-toggle='tooltip' title='verifikasi sampel'>Verifikasi</a>
                                            <?php endif ; ?>
                                        </td>
                                    </tr>
                                <!-- non label pengujian -->
                            <?php endif ; ?>
                        <!-- ================================================================ -->

                    <?php elseif($batch['idJenisManufacture'] == 2) : ?>

                        <!-- ================================================================ -->
                        <!-- impor hanya untuk evaluasi dokumen (Verifikasi Berkas) -->
                            <tr> <!-- verifikasi berkas mau ga mau copas kebawah -->
                                <th class='align-top'>Verifikasi Berkas</th>
                                    <td class='align-top'>:</td>
                                    <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($batch['idBatch']); ?>
                                    <td>
                                        <?php if($verifikasi_berkas) : ?>
                                            <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                                                <a href="#" class="btn btn-success" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle="tooltip" title='Berkas Di Terima' target='blank'><i class="fa fa-check"></i></a> 
                                                <?php $verify_berkas = true ; ?>
                                            <?php else : ?>
                                                <?php $verify_berkas = false ; ?> 
                                                <a href="#" class="btn btn-danger" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle="tooltip" title='Menunggu Melengkapi Berkas, Klik Untuk Verifikasi Ulang'><i class="fa fa-times"></i></a>
                                            <?php endif ; ?>
                                        <?php else : ?>
                                            <?php $verify_berkas = false ; ?> 
                                            <a href="#" class="btn btn-warning" data-toggle='modal' data-target="#verifikasi-berkas" data-toggle='tooltip' title='verifikasi berkas'>Verifikasi</a>
                                        <?php endif ; ?>
                                    </td>
                                </th>
                            </tr> 
                        <!-- ================================================================ -->
                        
                    <?php else : ?>
                        <!-- ================================================================ -->
                        <!-- selain domestik dan import -->
                        <tr>
                            <th>Verifikasi Sampel</th>
                            <td>:</td>
                            <td>
                                <?php $verifikasi_sample = $this->Petugas_model->getVerifikasiSample($batch['idBatch']) ; ?>
                                <?php if($verifikasi_sample) : ?>
                                    <?php if($verifikasi_sample['status_verifikasi_sample'] == 1) : ?>
                                        <?php $verify_sample = true ; ?>
                                        <a href="" class="btn btn-success" data-toggle='modal' data-target='#verifikasi-sample' data-toggle='tooltip' title='Sampel Sesuai'><i class="fa fa-check"></i></a>
                                    <?php else : ?>
                                        <?php $verify_sample = false ; ?>
                                        <a href="" class="btn btn-danger" data-toggle='modal' data-target='#verifikasi-sample' data-toggle='tooltip' title='verifikasi sampel ulang'><i class="fa fa-times"></i></a>
                                    <?php endif ; ?>
                                <?php else : ?>
                                    <?php $verify_sample = false ; ?>
                                    <a href="" class="btn btn-warning" data-toggle='modal' data-target='#verifikasi-sample' data-toggle='tooltip' title='verifikasi sampel'>Verifikasi</a>
                                <?php endif ; ?>
                            </td>
                        </tr>
                        <!-- ================================================================ -->
                    <?php endif ; ?>
                
                <!-- verifikasi -->

                <!-- pembayaran -->
                <?php if($batch['idJenisManufacture'] == 1) : ?> <!-- domestik -->
                    <?php if($batch['idJenisDokumen'] == 2) : ?> <!-- label -->
                        <?php if($verify_berkas == true) : ?>
                            <?php $verify_bayar = true ; ?>
                        <?php else : ?>
                            <?php $verify_bayar = false ; ?>
                        <?php endif ; ?>
                    <?php elseif($batch['idJenisDokumen'] == 3) : ?> <!-- non label -->
                        <?php if($verify_berkas == true AND $verify_sample == true) : ?>
                            <?php $verify_bayar = true ; ?>
                        <?php else : ?>
                            <?php $verify_bayar = false; ?>
                        <?php endif ; ?>
                    <?php else : ?>
                        <?php $verify_bayar = false ; ?>
                    <?php endif ; ?>
                <?php elseif($batch['idJenisManufacture'] == 2) : ?> <!-- impor -->
                    <?php if($verify_berkas == true) : ?>
                        <?php $verify_bayar = true ; ?>
                    <?php else : ?>
                        <?php $verify_bayar = false ; ?>
                    <?php endif ; ?>
                <?php else : ?> <!-- sealin domestik dan impor -->
                    <?php if($verify_sample == true) : ?>
                        <?php $verify_bayar = true ; ?>
                    <?php else : ?>
                        <?php $verify_bayar = false ; ?>
                    <?php endif ; ?>
                <?php endif ; ?>

                <tr>
                    <th>Verifikasi Pembayaran</th>
                    <td>:</td>
                    <?php if($verify_bayar == true) : ?>
                            <td>
                                <?php $verifikasi_pembayaran = $this->Petugas_model->getVerifikasiPembayaran($batch['idBatch']) ; ?>
                                <?php if($verifikasi_pembayaran) : ?>
                                    <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 0) : ?>
                                        <a href="#" class="btn btn-primary" data-toggle='modal' data-target='#verifikasi-pembayaran' data-toggle='tooltip' title='Verifikasi Pembayaran'><i class="fa fa-eye"></i></a>
                                    <?php elseif($verifikasi_pembayaran['status_verifikasi_bayar'] == 1) : ?>
                                        <a href="#" class="btn btn-success" data-toggle='modal' data-target='#verifikasi-pembayaran' data-toggle='tooltip' title='Pembayaran Sesuai' ><i class="fa fa-check"></i></a>
                                    <?php elseif($verifikasi_pembayaran['status_verifikasi_bayar'] == 2) : ?>
                                        <a href="#" class="btn btn-danger" data-toggle='modal' data-target='#verifikasi-pembayaran' data-toggle='tooltip' title='Pembayaran Tidak Sesuai'><i class="fa fa-times"></i></a>
                                    <?php else : ?>
                                        <a href="#" class="btn btn-warning" data-toggle='modal' data-target='#verifikasi-pembayaran' data-toggle='tooltip' title='Menunggu Pembayaran'><i class="fa fa-eye"></i></a>
                                    <?php endif ; ?>
                                <?php else : ?>
                                    <a href="#" class="btn btn-primary" data-toggle='modal' data-target='#upload-pembayaran' data-toggle='tooltip' title='Upload Biling Pembayaran'>
                                        <i class="fa fa-upload"></i>
                                    </a>
                                <?php endif ; ?>
                            </td>
                    <?php else : ?>
                        <td><i class="text-warning">Menunggu Verifikasi</i></td>
                    <?php endif ; ?>
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
                                    <!-- data dukung -->
                                    <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($batch['idBatch']) ; ?>
                                    <?php if($verifikasi_berkas) : ?>
                                        <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                                            <?php $verify_berkas = true ; ?>
                                            <tr>
                                                <th>Status</th>
                                                <td>:</td>
                                                <td><span class="text-success">Diterima</span></td>
                                            </tr>
                                        <?php else : ?>
                                            <?php $verify_berkas = false ; ?>
                                            <tr>
                                                <th>Status</th>
                                                <td>:</td>
                                                <td><span class="text-danger">Verifikasi Ulang</span></td>
                                            </tr>
                                        <?php endif ; ?>
                                        <tr>
                                            <th>Tanggal Verifikasi</th>
                                            <td>:</td>
                                            <td>
                                                <?= $this->_Date->formatTanggal( $verifikasi_berkas['tglVB'] ); ?>
                                                ( <?=  $verifikasi_berkas['jamVB'] ; ?> )
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <?php $verify_berkas = false ; ?>
                                    <?php endif ; ?>
                                    <tr>
                                        <th class='align-top'>Data Dukung</th>
                                        <td class='align-top'>:</td>
                                        <td>
                                            <?php if($dataDukung) : ?>
                                                <ul class="list-group">
                                                    <?php foreach ($dataDukung as $dd) : ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <?= $dd['namaJenisDataDukung']; ?>
                                                            <?php $isiDataDukung = $this->Petugas_model->setDataDukung($batch['idBatch'], $dd['idJenisDataDukung']); ?>
                                                            <?php if($isiDataDukung) : ?>
                                                                <a href='/file-upload/data-dukung/<?= $isiDataDukung['fileDataDukung'];?>' class="badge badge-primary" data-toggle='tooltip' title='Tampilkan <?= $dd['namaJenisDataDukung']; ?>'><i class="fa fa-eye"></i></a>
                                                            <?php else : ?>
                                                                <span><i class="text-danger">kosong</i></span>
                                                            <?php endif ; ?>
                                                        </li>
                                                    <?php endforeach ; ?>
                                                </ul>
                                            <?php endif ; ?>
                                        </td>
                                    </tr>
                                    <?php if($verify_berkas != true) : ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button type='submit' id='verifikasi-terima' class='btn btn-success' data-toggle='tooltip' title='data dukung sesuai'> 
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button type='button' id="verifikasi-tolak" class='btn btn-danger' data-toggle='tooltip' title='data dukung tidak sesuai'>
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <div id="veteto"></div>
                                            </td>
                                        </tr>
                                    <?php endif ; ?>
                                    
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- Modal verifikasi -->

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
                                <?php $verifikasi_sample = $this->Petugas_model->getVerifikasiSample($batch['idBatch']) ; ?>
                                <?php if($verifikasi_sample) : ?>
                                    <?php if($verifikasi_sample['status_verifikasi_sample'] != 1) : ?>
                                        
                                    <?php else : ?>
                                        <tr>
                                            <th>Status</th>
                                            <td>:</td>
                                            <td><span class="text-success">Sampel Sesuai</span></td>
                                        </tr>
                                    <?php endif ; ?>
                                    <tr>
                                        <th>Jumlah Sampel Saat Tiba</th>
                                        <td>:</td>
                                        <td><?= $verifikasi_sample['jumlah_sample']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Suhu Sampel Saat Tiba</th>
                                        <td>:</td>
                                        <td><?= $verifikasi_sample['suhu_sample']; ?>  &deg; <?= $verifikasi_sample['satuan_suhu']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Verifikasi</th>
                                        <td>:</td>
                                        <td><?= $this->_Date->formatTanggal( $verifikasi_sample['tgl_verifikasi_sample'] ); ?>  &deg; ( <?= $verifikasi_sample['jam_verifikasi_sample']; ?> )</td>
                                    </tr>
                                <?php endif ; ?>
                                <tr>
                                    <th class='align-top'>Jumlah Sampel Yang Dikirim </th>
                                    <th class='align-top'>: </th>
                                    <td class='align-top'>
                                        <?= $batch['pengiriman']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class='align-top'>Kemasan </th>
                                    <th class='align-top'>: </th>
                                    <td class='align-top'>
                                        <i><?= $batch['ingJenisKemasan']; ?></i> / <?= $batch['namaJenisKemasan']; ?>
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

        <!-- Modal Verifikasi Sampel -->

        <!-- Modal upload pembayaran -->
            
        <!-- Modal upload pembayaran -->
        <!-- Button trigger modal -->
            <div class="modal fade" id="upload-pembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Biling Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url() ;?>petugas/uploadBiling/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <label for="berkas-biling">Upload Biling</label>
                                <input type="file" class="form-control" name='berkas-biling' id='berkas-biling'>
                                <i class="text-danger">*file pdf,png,jpg,jpeg</i>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- Modal Pembayaran -->
            <div class="modal fade" id="verifikasi-pembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Verifikasi Pembayaran
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php $verifikasi_pembayaran = $this->Petugas_model->getVerifikasiPembayaran($batch['idBatch']) ; ?>
                        <?php if($verifikasi_pembayaran) : ?>
                        <form action="<?= base_url(); ?>petugas/tambahVerifikasiPembayaran/<?= $batch['idSurat'] ;?>/<?= $batch['idSample'] ;?>/<?= $batch['idBatch'] ;?>/<?= $verifikasi_pembayaran['idBuktiBayar']; ?>/2" method="post" enctype="multipart/form-data" id='verifikasi-pembayaran-id'>
                            <div class="modal-body">
                                    <table>
                                        <tr>
                                            <th>Kode Biling</th>
                                            <td>:</td>
                                            <td><a href="<?= base_url(); ?>assets/file-upload/biling/file-biling/<?= $verifikasi_pembayaran['kode_biling'];?>" class="btn btn-secondary" data-toggle='tooltip' title='Tampilkan Kode Biling' target='blank'><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                        <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] != 3) : ?>
                                            <tr>
                                                <th>Bukti Bayar</th>
                                                <td>:</td>
                                                <td><a href="<?= base_url(); ?>assets/file-upload/biling/bukti-bayar/<?= $verifikasi_pembayaran['fileBuktiBayar'];?>" class="btn btn-info" data-toggle='tooltip' title='Tampilkan Bukti Bayar' target='blank'><i class="fa fa-eye"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pembayaran</th>
                                                <td>:</td>
                                                <td><?= $this->_Date->formatTanggal($verifikasi_pembayaran['tgl_bayar']) ; ?> ( <?= $verifikasi_pembayaran['jam_bayar']; ?> ) </td>
                                            </tr>
                                        <?php endif ; ?>

                                        <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 0) : ?>
                                            <tr>
                                                <th>Verifikasi</th>
                                                <td>:</td>
                                                <td>
                                                    <a href="<?= base_url();?>petugas/tambahVerifikasiPembayaran/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>/<?= $verifikasi_pembayaran['idBuktiBayar'];?>/1" class="btn btn-success" data-toggle='tooltip' title='Pembayaran Sesuai' onclick='return confirm("Pembayaran Sudah Sesuai?");'><i class="fa fa-check"></i></a>
                                                    <a href="#" id='pembayaran-tolak' class="btn btn-danger" data-toggle='tooltip' title='pembayaran tidak sesuai'><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td>
                                                    <div id="pembayaran-tolak-tampil"></div>
                                                </td>
                                            </tr>
                                            <script> 
                                                $(document).ready(function (){
                                                    $("#pembayaran-tolak").click(function(){
                                                        $("#pembayaran-tolak-tampil").html(`
                                                            <div class="row">
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
                                                                    <label for='keterangan-pembayaran-tolak'>Keterangan</label>
                                                                    <textarea name="keterangan-pembayaran-tolak" id="keterangan-pembayaran-tolak" cols="30" rows="5" class='form-control'></textarea>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button type='submit' class='btn btn-primary'> Konfirmasi </button>
                                                                </div>
                                                            </div>
                                                        `) ;
                                                    }) ;
                                                });
                                            </script>
                                        <?php elseif($verifikasi_pembayaran['status_verifikasi_bayar'] == 1) : ?>
                                            <tr>
                                                <th>Status</th>
                                                <td>:</td>
                                                <td><span class="text-success">Pembayaran Sesuai</span></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Verifikasi</th>
                                                <td>:</td>
                                                <td>
                                                    <?= $this->_Date->formatTanggal($verifikasi_pembayaran['tgl_verifikasi_pembayaran']) ; ?> ( <?= $verifikasi_pembayaran['jam_verifikasi_bayar']; ?> )
                                                </td>
                                            </tr>
                                        <?php elseif($verifikasi_pembayaran['status_verifikasi_bayar'] == 2) : ?>
                                            <tr>
                                                <th>Status</th>
                                                <td>:</td>
                                                <td><i class="text-danger">Pembayaran Tidak Sesuai - Menunggu Konfirmasi Ulang</i></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Verifikasi</th>
                                                <td>:</td>
                                                <td>
                                                    <?= $this->_Date->formatTanggal($verifikasi_pembayaran['tgl_verifikasi_pembayaran']) ; ?> ( <?= $verifikasi_pembayaran['jam_verifikasi_bayar']; ?>)
                                                </td>
                                            </tr>
                                        <?php elseif($verifikasi_pembayaran['status_verifikasi_bayar'] == 3) : ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="<?= base_url(); ?>petugas/hapusBuktiBayar/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>/<?= $verifikasi_pembayaran['idBuktiBayar'];?>" class="btn btn-danger" data-toggle='tooltip' title='Hapus Kode Biling' onclick='return confirm("hapus kode biling?");'><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endif ; ?>
                                    </table>
                                </div>
                            </form>
                        <?php endif ; ?>
                    </div>
                </div>
            </div>
        <!-- Modal Pembayaran -->
    <!-- kumpulan modal -->

    <!-- js tambahan berkas -->
        <script>
            $(document).ready(function(){
                // verifikasi berkas
                
                    $('#verifikasi-terima').click(function(){
                        $('#veteto').html(`
                            <input type="hidden" name="status-very" value='1'>
                        `) ;
                    }) ;

                    $('#verifikasi-tolak').click(function(){
                        $('#veteto').html(`
                            <br>
                            <span class='text-danger'>
                                Berkas Ditolak
                            </span> 
                            <label for="keterangan-very">Keterangan</label>
                            <div class='row'>
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
                            </div>
                            <textarea class='form-control' name="keterangan-very" id="keteragan-very" cols="80" rows="5"></textarea>
                            <input type="hidden" name="status-very" value='2'> <br>
                            <button type='submit' class='btn btn-danger'>Berkas Salah</button>
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
                <h4>Petugas</h4> <br>
                <table cellpadding=2 cellspacing=2>
                    <tr>
                        <?php if($batch['idJenisManufacture'] == 1) : ?>

                            <?php if($batch['idJenisDokumen'] == 2) : ?>
                                <?php $evaluator = true ; ?>
                                <?php $pengujian = false ; ?>
                            <?php elseif($batch['idJenisDokumen'] == 3) : ?>
                                <?php $evaluator = true ; ?>
                                <?php $pengujian = true ; ?>
                            <?php else : ?>
                                <?php $evaluator = false ; ?>
                                <?php $pengujian = false ; ?>
                            <?php endif ; ?>

                        <?php elseif($batch['idJenisManufacture'] == 2) : ?>

                            <?php $evaluator = false ; ?>
                            <?php $pengujian = true ; ?>

                        <?php else : ?>

                            <?php $evaluator = false ; ?>
                            <?php $pengujian = true ; ?>

                        <?php endif ; ?>

                        <?php for($i = 3; $i <= 5 ; $i++ ):?>
                            <tr>
                                <?php if($i == 3) : ?>
                                    <?php $petugas = "Verifikator" ?>
                                    <?php $aktif = true ?>
                                <?php elseif($i == 4) : ?>
                                    <?php $petugas = "Evaluator" ?>
                                    <?php if($evaluator == true) : ?>
                                        <?php $aktif = true ?>
                                    <?php else : ?>
                                        <?php $aktif = false ?>
                                    <?php endif ; ?>
                                <?php else : ?>
                                    <?php $petugas = "Pengujian" ?>
                                    <?php if($pengujian == true) : ?>
                                        <?php $aktif = true ?>
                                    <?php else : ?>
                                        <?php $aktif = false ?>
                                    <?php endif ; ?>
                                <?php endif ; ?>
                                
                                <?php if($aktif == true) : ?>
                                    
                                    <th class='align-top'><?= $petugas; ?></th>
                                    <th class='align-top'>:</th>
                                    <td class='align-top'>
                                        <?php 
                                            $this->db->where('idBatch', $batch['idBatch']) ;
                                            $this->db->where('petugas.idTugas', $i) ;
                                            $this->db->join('inuser', 'inuser.idIU = petugas.idIU') ;
                                            $petugas_pengerjaan = $this->db->get('petugas')->row_array() ;

                                            if($i != 3){
                                                $this->db->where("idLevel = $i OR idLevel = 3");
                                            }else{
                                                $this->db->where('idLevel', $i);
                                            }
                                            // $this->db->where('idBatch', $batch['idBatch']) ;
                                            $inuser = $this->db->get('inuser')->result_array() ;
                                        ?>
                                        <?php if($petugas_pengerjaan) : ?>
                                            <form action="<?= base_url();?>petugas/ubahPetugas/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>/<?= $i;?>/<?= $petugas_pengerjaan['idPetugas'];?>" method="post">
                                                <div class="input-group mb-3">
                                                    <input type="hidden" name='idPetugas' value='<?= $petugas_pengerjaan['idPetugas'];?>'>
                                                    <select name="petugas<?= $i; ?>" class='form-control' style='width:400px'>
                                                        <option value="-">-pilih-</option>
                                                        <?php foreach ($inuser as $iu) : ?>
                                                            <?php if($iu['idIU'] == $petugas_pengerjaan['idIU']) : ?>
                                                                <option selected value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                            <?php endif ; ?>
                                                        <?php endforeach ; ?>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success" type="submit" id="button-addon2" data-toggle='tooltip' title='Ubah Data Petugas <?= $petugas; ?>'><i class="fa fa-edit"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php else : ?>
                                            <form action="<?= base_url();?>petugas/tambahPetugas/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>/<?= $i; ?>" method="post">
                                                <div class="input-group mb-3">
                                                    <select name="petugas<?= $i; ?>" class='form-control' style='width:400px'>
                                                        <option value="-">-pilih-</option>
                                                        <?php foreach ($inuser as $iu) : ?>
                                                            <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                        <?php endforeach ; ?>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary" type="submit" id="button-addon2" data-toggle='tooltip' title='Simpan Data Petugas <?= $petugas; ?>'><i class="fa fa-save"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif ; ?>
                                    </td>
                                <?php endif ; ?>
                            </tr>
                        <?php endfor ; ?>
                </table>
            </div>
        </div>
    </div>
<!-- petugas evaluasi dan verifikasi -->

<div class="row mt-4">
    <div class="col-md-6">
        <!-- riwayat pekerjaan -->
        <div class="card p-2" >
            <div id="riwayat"></div>
        </div>
        <!-- riwayat pekerjaan -->
    </div>
    
    <div class="col-md-6">
        <!-- respon tanggapan -->
        <div class="card p-2">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium facere doloremque dolores sint nulla qui! Expedita consequuntur inventore obcaecati fugit, hic, iste nesciunt commodi excepturi quidem sequi consectetur vel atque!
        </div>
        <!-- respon tanggapan -->
    </div>
</div>



<script>
    $(document).ready(function(){
        $("#riwayat").load("<?= base_url();?>home/riwayat/<?= $batch['idBatch'];?>") ;
    });
</script>