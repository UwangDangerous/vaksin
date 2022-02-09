<?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
<?php endif ; ?>

<div class="card p-3">
    <h4>Sample <?= $sample['namaSample']; ?> ( <?= $sample['jenisSample']; ?> )</h4>
    <div class="row p-3">
        <div class="col-md-6">
            <table cellpadding=2>
                <tr>
                    <th>Pengirim</th>
                    <td>:</td> 
                    <td><?= $sample['namaEU']; ?></td>
                </tr>

                <tr>
                    <th>Alamat Pengirim</th>
                    <td>:</td> 
                    <td><?= $sample['alamat']; ?></td>
                </tr>

                <tr>
                    <th>Keterangan</th>
                    <td>:</td> 
                    <td>
                        <?= $sample['namaSurat']; ?> <a href="<?= base_url(); ?>assets/file-upload/surat/<?= $sample['fileSurat']; ?>" target='blank' class="badge badge-secondary" data-toggle='tooltip' title='Lihat Surat'> <i class="fa fa-eye"></i> </a>
                    </td>
                </tr>

                <tr>
                    <th>Nama Perusahaan</th>
                    <td>:</td> 
                    <?php if($sample['idJenisManufacture'] == 2) : ?>
                        <td><?= $sample['namaImportir']; ?> <br> ( Importir <?= $sample['namaEU']; ?> ) </td>
                    <?php else : ?>
                        <td> <?= $sample['namaEU']; ?> </td>
                    <?php endif ; ?>
                </tr>

                <tr>
                    <th>Alamat Perusahaan</th>
                    <td>:</td> 
                    <?php if($sample['idJenisManufacture'] == 2) : ?>
                        <td><?= $sample['alamatImportir']; ?></td>
                    <?php else : ?>
                        <td> <?= $sample['alamat']; ?> </td>
                    <?php endif ; ?>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>:</td> 
                    <td><?= $sample['email']; ?></td>
                </tr>

                <tr>
                    <th>Dokumen</th>
                    <td>:</td> 
                    <td><?= $sample['namaJenisDokumen']; ?> ( <?= $sample['namaProses']; ?> ) </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table cellpadding=2>
                 
                <tr>
                    <th>Tanggal Surat</th>
                    <td>:</td> 
                    <td> <?= $this->_Date->formatTanggal( $sample['tgl_kirim_surat'] ); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pengiriman Sample</th>
                    <td>:</td> 
                    <td> <?= $this->_Date->formatTanggal( $sample['tgl_pengiriman'] ); ?></td>
                </tr>

                <tr>
                    <th>Bukti Bayar</th>
                    <td>:</td> 
                    <td>
                        <?php if($bukti = $this->Petugas_model->getBuktiBayar($id)) : ?>
                            <?php if($bukti['status_verifikasi_bayar'] == 1) : ?>
                                <?= $this->_Date->formatTanggal($bukti['tgl_verifikasi_bayar']); ?> <?= $bukti['jam_verifikasi_bayar']; ?>
                                <a href="<?= base_url(); ?>assets/file-upload/bukti-bayar/<?= $bukti['fileBuktiBayar']; ?>" target='blank' class="badge badge-secondary" data-toggle='tooltip' title='Lihat Bukti Bayar'> <i class="fa fa-eye"></i> </a>
                            <?php else : ?>
                                <?= $this->_Date->formatTanggal($bukti['tgl_bayar']); ?> <?= $bukti['jam_bayar']; ?>
                                <a href="<?= base_url(); ?>assets/file-upload/bukti-bayar/<?= $bukti['fileBuktiBayar']; ?>" target='blank' class="badge badge-secondary" data-toggle='tooltip' title='Lihat Bukti Bayar'> <i class="fa fa-eye"></i> </a>
                            <?php endif ; ?>
                        <?php else : ?>
                            <i class="text-danger">Tidak Tersedia</i>
                        <?php endif ; ?>
                        
                    </td>
                </tr>

                <tr>
                    <th>No Marketing Authorization (MA) </th>
                    <td>:</td> 
                    <td><?= $sample['noMA']; ?></td>
                </tr>

                <tr>
                    <th>Jumlah Batch </th>
                    <td>:</td> 
                    <td>
                        <?php $batch = $this->Petugas_model->getBatch($id); ?>
                        <?= count($batch); ?> 
                        <a href="#" class="badge badge-secondary" data-toggle='modal' data-target='#modalBatch' data-toggle='tooltip' title='tampilkan rincian batch'>
                            <i class="fa fa-eye"></i>
                        </a>
                        <!-- modal batch -->
                        <div class="modal fade" id="modalBatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Batch</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Nomer Batch</th>
                                                        <th>Dosis</th>
                                                        <th>Jumlah <?= $sample['wadah']; ?></th>
                                                        <th>Data Dukung</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($batch as $bat) : ?>
                                                        <tr>
                                                            <td><?= $bat['noBatch']; ?></td>
                                                            <td><?= $bat['dosis']; ?></td>
                                                            <td><?= number_format($bat['vial'], 0, ',', ','); ?></td>
                                                            <td>
                                                                <a class="badge badge-primary" data-toggle="collapse" href="#data_dukung<?= $bat['idBatch']; ?>" role="button" aria-expanded="false">
                                                                    Data Dukung
                                                                </a>
                                                                <div class="collapse" id="data_dukung<?= $bat['idBatch']; ?>">
                                                                        <ul class="list-group">
                                                                            <?php $dataDukung_batch = $this->Petugas_model->getDataDukungBatch($bat['idBatch']); ?>
                                                                            <?php foreach ($dataDukung_batch as $ddb) : ?>
                                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                    <?= $ddb['namaJenisDataDukung']; ?>
                                                                                    <a href='<?= base_url();?>assets/file-upload/data-dukung/<?= $ddb['fileDataDukung']; ?>' class="badge badge-primary" data-toogle='tooltip' title='Tampilkan Data Dukung' target='blank'> 
                                                                                        <i class="fa fa-eye"></i> 
                                                                                    </a>
                                                                                </li>
                                                                            <?php endforeach ; ?>
                                                                        </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal batch -->
                    </td>
                </tr>
                
            </table>
        </div>
    </div>
</div>

<div class="card p-3 mt-3">
    <h3> Petugas dan Hasil Kerja </h3>
    <br>
    <div class="row">
        <div class="col">
            <table cellpadding=2 cellspacing=2>
                <tr>
                    <td>Evaluator</td>
                    <td>:</td>
                    <td>
                        <?php if($petugas_evaluasi = $this->Cetak_model->getPetugasEvaluasi($sample['idSample'])) : ?>
                            <?= $petugas_evaluasi['namaIU']; ?>
                        <?php endif ; ?>
                    </td>
                </tr>
                <tr>
                    <td>Verifikator</td>
                    <td>:</td>
                    <td>
                        <?php if($petugas_Verifikasi = $this->Cetak_model->getPetugasVerivikasi($sample['idSample'])) : ?>
                            <?= $petugas_Verifikasi['namaIU']; ?>
                        <?php endif ; ?>
                    </td>
                </tr>
                <tr>
                    <td valign='top'>Ceklis</td>
                    <td valign='top'>:</td>
                    <td>
                        <?php $serti = 0; ?>
                        <?php $hasil_evaluasi = $this->Cetak_model->getInfoCeklis($sample['idSample']); ?>
                        <?php if($hasil_evaluasi) : ?>
                            <a href="<?= base_url(); ?>cetak/form_evaluasi/<?= $sample['idJenisSample'];?>/<?= $sample['idSample'];?>" class="btn btn-primary" target='blank'>
                                <i class="fa fa-file"></i>
                            </a>
                            <?php $hasil_verifikasi = $this->Cetak_model->getHasilVerifikasi($hasil_evaluasi['id_hasil_evaluasi']); ?>
                            <?php $hasil_periksa = $this->Cetak_model->getHasilPeriksa($hasil_evaluasi['id_hasil_evaluasi']); ?>

                            <br>

                            <?php if($hasil_verifikasi) : ?>
                                Verifikasi, <?= $hasil_verifikasi['status_verifikasi']; ?> ( <?= $this->_Date->formatTanggal( $hasil_verifikasi['tanggal_verifikasi'] ); ?> )
                                <?php $serti++ ; ?>
                            <?php else : ?>
                                <i class="text-danger">Belum Di Verifikasi</i>
                            <?php endif ; ?>

                            <br>

                            <?php if($hasil_periksa) : ?>
                                Periksa, <?= $hasil_periksa['status_periksa']; ?> ( <?= $this->_Date->formatTanggal( $hasil_periksa['tanggal_periksa'] ); ?> )
                                <?php $serti++ ; ?>
                            <?php else : ?>
                                <i class="text-danger">Belum Di Periksa</i>
                            <?php endif ; ?>
                        <?php else : ?>
                            <i class="text-danger">Belum Di Evaluasi</i>
                        <?php endif ; ?>

                        <br>
                        <?php if($serti == 2) : ?>
                            <?php $cek_serti = $this->Cetak_model->cekSertifikat($hasil_evaluasi['id_hasil_evaluasi']); ?>
                            <?php if($cek_serti) : ?>
                                <form action="<?= base_url(); ?>petugas/ubahSertifikat/<?= $sample['idSurat'];?>/<?= $sample['idSample'];?>" method="post">
                            <?php else : ?>
                                <form action="<?= base_url(); ?>petugas/tambahSertifikat/<?= $sample['idSurat'];?>/<?= $sample['idSample'];?>" method="post">
                            <?php endif ; ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">No Sertifikat : </span>
                                    </div>
                                    <input style="width:300px;" type="text" class="form-control" placeholder=" PP.xx.xx.xxi.xx.xxx.xx.xx.xx.xx" value='<?= $cek_serti['noSertifikat'] ;?> '>

                                    <?php if($cek_serti) : ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success" type="submit"><i class="fa fa-edit"></i></button>
                                        </div>
                                    <?php else : ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="submit"><i class="fa fa-pen"></i></button>
                                        </div>
                                    <?php endif ; ?>



                                    <?php if($cek_serti != null) : ?>
                                        <?php if($sample['idJenisManufacture'] == 1) : ?>
                                            <div class="input-group-append">
                                                <a href='<?= base_url();?>cetak/sertifikat_domestik/<?= $sample['idSample'];?>/<?= $sample['idJenisSample'];?>' class="btn btn-outline-primary" target='blank' data-toggle='tooltip' title='Cetak Sertifikat Vaksin Domestik'><i class="fa fa-print"></i></a>
                                            </div>
                                        <?php else : ?>
                                            <div class="input-group-append">
                                                <a href='<?= base_url();?>cetak/sertifikat_import/<?= $sample['idSample'];?>' class="btn btn-outline-primary" target='blank' data-toggle='tooltip' title='Cetak Sertifikat Vaksin Import'><i class="fa fa-print"></i></a>
                                            </div>
                                        <?php endif ; ?>
                                    <?php endif ; ?>
                                </div>
                            </form>
                        <?php endif ; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card p-3 mt-3">
    <div class="d-flex justify-content-between">
        <h3>Riwayat Pengerjaan</h3>
        <a href="#" class="btn btn-primary" data-toggle='modal' data-target='#clockoff' data-toggle='tooltip' title='Kirim Pesan Data Kurang'><i class="fa fa-pen"></i></a>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mengirim Surat Pengajuan</td>
                    <td><?=  $this->_Date->formatTanggal( $sample['tgl_kirim_surat'] ); ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mengirim Sample</td>
                    <td><?=  $this->_Date->formatTanggal( $sample['tgl_pengiriman'] ); ?></td>
                </tr>

                <?php $no = 3 ?>

                <?php $riwayat = $this->Petugas_model->RiwayatPekerjaan($id);?>
                <?php foreach ($riwayat as $row) : ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $row['keteranganRiwayat']; ?></td>
                        <td><?= $this->_Date->formatTanggal( $row['tgl_riwayat'] ); ?></td>
                    </tr>
                <?php endforeach ; ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>










<!-- Modal -->
<div class="modal fade" id="clockoff" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <label for="keterangan"> Informasi Data Kurang </label> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url() ;?>petugas/inputDataKurang/<?= $id;?>">
        <div class="modal-body">
            <label for="judul">Judul Pesan</label>
            <input type="text" name="judul" id="judul" class='form-control'>

            <label for="keterangan">Isi Pesan</label>
            <div class="form-group">
                <textarea class="form-control" id="keterangan" name='keterangan' rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
    </div>
  </div>
</div>