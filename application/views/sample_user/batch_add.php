<?php //var_dump($sample) ; ?>
<?php $status_very = false ; ?>
<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        <!-- <tr>
            <td colspan='3'> -->

                <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
                    <?=  $this->session->flashdata('pesan'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <!-- </td>
        </tr> -->
    <?php endif ; ?>
    <div class="row">
        <div class="col">
            <table cellpadding=3>
                <tr>
                    <th class='align-top'>Nama Sample</th>
                    <td class='align-top'>:</td>
                    <td class='align-top'><?= $sample['namaSample']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jenis Sample</th>
                    <td class='align-top'>:</td>
                    <td class='align-top'><?= $sample['jenisSample']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jenis Perusahaan</th>
                    <td class='align-top'>:</td>
                    <td class='align-top'><?= $sample['namaJenisManufacture']; ?></td>
                </tr>
                <!-- perusahaan -->
                    <?php if(!empty($this->session->flashdata('pesanImportir') )) : ?>
                        <!-- <tr>
                            <td colspan='3'> -->

                                <div class="alert alert-<?=  $this->session->flashdata('warnaImportir'); ?> alert-dismissible fade show" role="alert">
                                    <?=  $this->session->flashdata('pesanImportir'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            <!-- </td>
                        </tr> -->
                    <?php endif ; ?>

                    <?php if($sample['idJenisManufacture'] == 2) : ?>
                        <?php if($import =  $this->User_Sample_model->getImportir($sample['idSample']) ) : ?>
                            <tr>
                                <th class='align-top'>Perusahaan Pembuat Sample</th>
                                <td class='align-top'>:</td>
                                <td class='align-top'><?= $import['namaImportir']; ?></td>
                            </tr>
                            <tr>
                                <th class='align-top'>Alamat Perusahaan</th>
                                <td class='align-top'>:</td>
                                <td class='align-top'><?= $import['alamatImportir']; ?></td>
                            </tr>
                        <?php else : ?>
                            <form method="post" action="<?= base_url(); ?>sample_/tambahImportir/<?= $idSurat; ?>">
                                <input type="hidden" name='idSample' value='<?= $sample['idSample']; ?>'>
                                <tr>
                                    <th class='align-top'> <label for="namaImportir">Nama Perusahaan Pembuat Sample</label> </th>
                                    <td class='align-top'>  </td>
                                    <td class='align-top'> <input type="text" name="namaImportir" id="namaImportir" class='form-control'> </td>
                                </tr>
                                <tr >
                                    <th class='align-top'> <label for="namaImportir">Alamat Perusahaan</label> </th>
                                    <td class='align-top'> : </td>
                                    <td class='align-top'>
                                        <textarea name="alamatImportir" id="alamatImportir" cols="5" rows="5" class='form-control'></textarea>
                                        <br>
                                        <button type='submit' class="btn btn-primary">Simpan</button>
                                    </td>
                                </tr>

                            </form>
                        <?php endif ; ?>
                    <?php endif ; ?>
                <!-- perusahaan -->

                <!-- batch -->
                    <tr>
                        <th valign='top'>Batch</th>
                        <td>  </td>
                        <td>
                            <a href="" class="badge badge-primary" data-toggle='modal' data-target='#tambahbatch' data-toggle='tooltip' title='tambah batch'>
                                <i class="fa fa-plus"></i>
                            </a>

                            <br>
                            <?php if($batch) : ?>
                                <table cellpadding=2 class='table table-striped table-bordered text-center'>
                                    <thead>
                                        <tr>
                                            <th class='align-middle'>No</th>
                                            <th class='align-middle'>Aksi</th>
                                            <th class='align-middle'>Data Dukung</th>
                                            <th class='align-middle'>No Batch</th>
                                            <th class='align-middle'>Dosis</th>
                                            <th class='align-middle'>Jumlah Produksi</th>
                                            <th class='align-middle'>Status</th>
                                            <th class='align-middle'>Bukti Bayar</th>
                                            <th class='align-middle'>Lama Pengerjaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 ; ?>
                                        <?php foreach ($batch as $b) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td> <!-- no -->
                                                <td> <!-- aksi -->
                                                    <a href="#" class="badge badge-success" data-toggle='modal' data-target='#modalBatch<?= $b['idBatch'];?>'>
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td> <!-- Data Dukung -->
                                                    <div id="accordion">
                                                        <div class="card">
                                                            <div class="card-header" id="headingTwo">
                                                                <h5 class="mb-0">
                                                                    <?php $dataDukung = 0; ?>
                                                                    <?php $manufacture = $this->User_Sample_model->getJenisDataDukung($sample['idJenisManufacture']); ?>
                                                                    <?php foreach ($manufacture as $m) : ?>
                                                                        <?php $dataDukung += $this->User_Sample_model->getJumlahDataDukung($b['idBatch'], $m['idJenisDataDukung']); ?>
                                                                    <?php endforeach ; ?>
                                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#cls<?= $b['idBatch'];?>" aria-expanded="false" data-toggle='tooltip' title='Melengkapi <?= $dataDukung; ?> Dari <?= count($manufacture); ?> Dokumen'>
                                                                        <?= $dataDukung; ?> Dari <?= count($manufacture); ?>
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="cls<?= $b['idBatch'];?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                                <div class="card-body">
                                                                    <ul class="list-group text-left">
                                                                        <?php foreach ($manufacture as $m) : ?>
                                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                <?= $m['namaJenisDataDukung']; ?>
                                                                                <?php if($isiDock = $this->User_Sample_model->getInfoJumlahDoc($m['idJenisDataDukung'], $b['idBatch']) ) : ?>
                                                                                    <span href="" class="badge badge-success"><i class="fa fa-check"></i></span>
                                                                                <?php else : ?>
                                                                                    <a href='#' class="badge badge-primary" data-toggle='modal' data-target='#upload<?= $b['idBatch'] ;?><?= $m['idJenisDataDukung'] ;?>' data-toggle='tooltip' title='Upload <?= $m['namaJenisDataDukung']; ?>'> <i class="fa fa-upload"></i> </a>
                                                                                <?php endif ; ?>
                                                                            </li>

                                                                            <!-- modal upload -->
                                                                                <div class="modal fade" id="upload<?= $b['idBatch'] ;?><?= $m['idJenisDataDukung']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                  <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel"> Upload Data<?= $m['namaJenisDataDukung'];?> </h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <form method="post" class='myform' enctype="multipart/form-data" action="<?= base_url();?>sample_/uploadDataDukungBatch/<?= $sample['idSurat'];?>/<?= $sample['idSample'];?>">
                                                                                            <div class="modal-body">
                                                                                                <input type="hidden" name='idBatch' value='<?= $b['idBatch'];?>'>
                                                                                                <input type="hidden" name='idJenisDataDukung' value='<?= $m['idJenisDataDukung'];?>'>
                                                                                                <input type="hidden" name='namaJenisDataDukung' value='<?= $m['namaJenisDataDukung'];?>'>
                                                                                                <label for="berkas">Upload <?= $m['namaJenisDataDukung'] ?></label>
                                                                                                <input type="file" name="berkas" id="berkas" class='form-control'>
                                                                                                <b>*file pdf</b>
                                                                                            </div>

                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-primary">Upload</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                            <!-- modal upload -->
                                                                        <?php endforeach ; ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $b['noBatch']; ?></td> <!-- no batch -->
                                                <td><?= $b['dosis']; ?></td> <!-- dosis -->
                                                <td> <?= number_format($b['vial'], 0, ',', ','); ?> (<?= $b['wadah']; ?>) </td>
                                                <td>
                                                    <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($b['idBatch']) ; ?>
                                                    <?php if($verifikasi_berkas) : ?>
                                                        <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                                                            <a href="#" class="badge badge-success" data-toggle='tooltip' title='Diterima, Dokumen Lengkap'><i class="fa fa-check"></i></a>
                                                            <?php $status_very = true ; ?>
                                                        <?php else : //if($verifikasi_berkas['statusVB'] == 2) ?>
                                                            <i class="text-danger"><?= $verifikasi_berkas['keteranganVB']; ?> <br> Silahkan Lengkapi Dokumen</i>
                                                            <?php $status_very = false ; ?>
                                                        <?php endif ; ?>
                                                    <?php else : ?>
                                                        <i class="text-warning">Menunggu Verifikasi Dokumen</i>
                                                        <?php $status_very = false ; ?>
                                                    <?php endif ; ?>
                                                </td>

                                                <td>
                                                    <?php if($status_very == true) : ?>
                                                        <?php $pembayaran = $this->Petugas_model->getVerifikasiPembayaran($b['idBatch']); ?>
                                                        <?php if($pembayaran) : ?>
                                                            <?php if($pembayaran['status_verifikasi_bayar'] == 1) : ?>
                                                                <a href="<?= base_url(); ?>assets/file-upload/biling/bukti-bayar/<?= $pembayaran['fileBuktiBayar'] ; ?>" class="badge badge-success" data-toggle='tooltip' title='Pembayaran Diterima' target='blank'><i class="fa fa-check"></i></a>
                                                            <?php elseif($pembayaran['status_verifikasi_bayar'] == 0) : ?>
                                                                <a href="<?= base_url(); ?>assets/file-upload/biling/bukti-bayar/<?= $pembayaran['fileBuktiBayar'] ; ?>" class="badge badge-warning" data-toggle='tooltip' title='Pembayaran Belum Di Verifikasi' target='blank'><i class="fa fa-file"></i></a>
                                                                <br>
                                                                <i class="text-warning">Menunggu Verifikasi</i>
                                                            <?php else : ?>
                                                                <i class="text-danger">Pembayaran Ditolak, Silahkan Unggah Ulang</i>
                                                                <a href="<?= base_url(); ?>assets/file-upload/biling/file-biling/<?= $verifikasi_berkas['kode_biling'];?>" class="badge badge-secondary" target='blank' data-toggle='tooltip' title='Tampilkan Biling Pembayaran'><i class="fa fa-file"></i></a>
                                                                <a href="" class="badge badge-primary" data-toggle='modal' data-target='#upload-pembayaran-<?= $b['idBatch'];?>' data-toggle='tooltip' title='Upload File'><i class="fa fa-upload"></i></a>
                                                            <?php endif ; ?>
                                                        <?php else : ?>
                                                            <a href="<?= base_url(); ?>assets/file-upload/biling/file-biling/<?= $verifikasi_berkas['kode_biling'];?>" class="badge badge-secondary" target='blank' data-toggle='tooltip' title='Tampilkan Biling Pembayaran'><i class="fa fa-file"></i></a>
                                                            <a href="" class="badge badge-primary" data-toggle='modal' data-target='#upload-pembayaran-<?= $b['idBatch'];?>' data-toggle='tooltip' title='Upload File'><i class="fa fa-upload"></i></a>
                                                        <?php endif ; ?>
                                                            <!-- Modal pembayaran -->
                                                                <div class="modal fade text-left" id="upload-pembayaran-<?= $b['idBatch'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Bayar</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form  method="post" enctype="multipart/form-data" action="<?= base_url();?>sample_/tambah_verifikasi_pembayaran/<?= $sample['idSurat'];?>/<?= $sample['idSample'];?>/<?= $b['idBatch'];?>">
                                                                                <div class="modal-body">
                                                                                    <label> Biling Pembayaran </label>
                                                                                    <div id="biling-<?=$verifikasi_berkas['idVB'];?>"></div> <br>
                                                                                    <label for="berkas">Unggah Bukti Bayar</label>
                                                                                    <input type="file" name="berkas" id="berkas" class='form-control'>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    $(document).ready(function(){
                                                                        $('#biling-<?=$verifikasi_berkas['idVB'];?>').html(`
                                                                        <a href="<?= base_url(); ?>assets/file-upload/biling/file-biling/<?= $verifikasi_berkas['kode_biling'];?>" class="badge badge-secondary" target='blank' data-toggle='tooltip' title='Tampilkan Biling Pembayaran'><i class="fa fa-file"></i></a>
                                                                        `) ;
                                                                    });
                                                                </script>
                                                            <!-- Modal pembayaran -->
                                                    <?php else : ?>
                                                        -
                                                    <?php endif ; ?>
                                                </td>
                                                <td>
                                                    <?php if($status_very = true) : ?>
                                                        <?php $jenisDokumen = $this->User_Sample_model->getDataVerifikasiBerkasJenisDokumen($b['idBatch']) ?>
                                                        <?php if($jenisDokumen['idJenisDokumen'] == 2) : ?>
                                                            <?= $b['pelulusan'] + $b['pengujian']; ?> Hari Kerja
                                                        <?php elseif($jenisDokumen['idJenisDokumen'] == 3) : ?>
                                                            <?= $b['pelulusan']  ?> Hari Kerja
                                                        <?php else : ?>
                                                            <i class="text-warning">null</i>
                                                        <?php endif ; ?>
                                                    <?php else : ?>
                                                        <i class="text-warning">null</i>
                                                    <?php endif ; ?>
                                                </td>

                                                <!-- modal batch edit -->
                                                    <div class="modal fade" id="modalBatch<?= $b['idBatch'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content ">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Batch</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" action="<?= base_url() ; ?>sample_/ubahDataBatch/<?= $idSurat ; ?>/<?= $sample['idSample'];?>">
                                                                <input type="hidden" name="idBatch" value='<?= $b['idBatch'];?>'>
                                                                <div class="modal-body">
                                                                    <label for="batchEdit<?= $b['idBatch'];?>">No Batch</label>
                                                                    <input type="number" name="batchEdit<?= $b['idBatch'];?>" id="batchEdit<?= $b['idBatch'];?>" class='form-control' placeholder='Nomer Batch' value='<?= $b['noBatch'];?>'> <br>

                                                                    <label for="DosisEdit<?= $b['idBatch'];?>">Dosis</label>
                                                                    <input type="number" name="DosisEdit<?= $b['idBatch'];?>" id="DosisEdit<?= $b['idBatch'];?>" class='form-control' placeholder='Dosis(1/2/5/10/20)' value='<?= $b['dosis'];?>'> <br>

                                                                    <label for="vial<?= $b['idBatch'];?>">Vial</label>
                                                                    <textarea name="vial<?= $b['idBatch']; ?>" id="vial<?= $b['idBatch']; ?>" cols="30" rows="10" class="form-control"><?= $b['vial']; ?></textarea>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!-- modal batch edit -->

                                        <?php endforeach ; ?>
                                    </tbody>
                                </table>
                            <?php endif ; ?>
                        </td>

                    </tr>
                <!-- batch -->
            </table>
        </div>
    </div>


</div>


<!-- tambah batch -->
    <div class="modal fade" id="tambahbatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Batch</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="<?= base_url() ; ?>sample_/tambahBatch/<?= $idSurat ; ?>/<?= $sample['idSample'];?>">

            <div class="modal-body">
                <label for="batch">No Batch</label>
                <input type="number" name="batch" id="batch" class='form-control' placeholder='Nomer Batch'> <br>

                <label for="Dosis">Dosis</label>
                <input type="number" name="Dosis" id="Dosis" class='form-control' placeholder='Dosis(1/2/5/10/20)'> <br>

                <label for="jmlvial">Jumlah Produksi</label>
                <input type="number" class="form-control" name="jmlvial" id="jmlvial" placeholder="1xxxxxx" >

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>
        </div>
    </div>
    </div>
<!-- tambah batch -->

