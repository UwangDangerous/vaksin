<?php //var_dump($sample) ; ?>
<?php $very_pelulusan = false ; ?>
<?php $very_pengujian = false ; ?>
<?php $very_pembayaran = false ; ?>
<?php $time_line = false ; ?>
<?php $pekerjaan = '' ; ?>
<?php $domestik = '' ; ?>
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
                    <td class='align-top'><?= $sample['namaJenisManufacture']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'></th>
                    <td class='align-top'>:</td>
                    <td class='align-top'><?= $sample['jenisSample']; ?></td>
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
                                    <td class='align-top'> : </td>
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
                        <th valign='top'>Tambah Batch</th>
                        <td>:</td>
                        <td>
                            <a href="" class="btn btn-primary" data-toggle='modal' data-target='#tambahbatch' data-toggle='tooltip' title='tambah batch'>
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                    </tr>
                <!-- batch -->
            </table>

            <?php if($batch) : ?>
                <div class="table-responsive">
                    <table cellpadding=2 class='table table-striped table-bordered text-center'>
                        <thead>
                            <tr>
                                <th class='align-middle' rowspan=2>No</th> <!-- 1 -->

                                <th class='align-middle' rowspan=2>Aksi</th> <!-- 2 -->

                                <?php if($sample['idJenisManufacture'] == 1 || $sample['idJenisManufacture'] == 2) : ?>
                                    <th class='align-middle' rowspan=2>Data Dukung</th>
                                <?php endif ; ?> <!-- 3 -->

                                <th class='align-middle' rowspan=2>No Batch</th> <!-- 4 -->
                                <th class='align-middle' rowspan=2>Dosis</th> <!-- 5 -->
                                <th class='align-middle' rowspan=2>Jenis Dokumen</th> <!-- 6 -->
                                <th class='align-middle' colspan=2>Jumlah Sampel</th> <!-- 7 -->

                                <!-- 8 -->
                                <?php if($sample['idJenisManufacture'] == 1) : ?>  
                                    <?php $pekerjaan = 'semua' ; ?>
                                    <th class='align-middle' colspan=2>Status Verifikasi</th>
                                <?php elseif($sample['idJenisManufacture'] == 2) : ?> 
                                    <?php $pekerjaan = 'pelulusan' ;?>
                                    <th class="align-middle" rowspan=2>Status Verifikasi Pelulusan</th>
                                <?php else : ?> 
                                    <?php $pekerjaan = 'pengujian' ; ?>
                                    <th class="align-middle" rowspan=2>Status Verifikasi Pengujian</th>
                                <?php endif ; ?> 
                                <!-- 8 -->



                                <th class='align-middle' rowspan=2>Bukti Bayar</th> <!-- 9 -->
                                <th class='align-middle' rowspan=2>Lama Pengerjaan</th> <!-- 10 -->
                            </tr>
                            <tr>
                                <th>Produksi</th>
                                <th>Pengiriman</th>
                                <?php if($sample['idJenisManufacture'] == 1) : ?>  <!-- 8 -->
                                    <th>Pengujian</th>
                                    <th>Pelulusan</th>
                                <?php endif ; ?>  <!-- 8 -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ; ?>
                            <?php foreach ($batch as $b) : ?>
                                <tr>
                                    <td><?= $no++; ?></td> <!-- 1 -->

                                    <td> <!-- aksi --> <!-- 2 -->
                                        <a href="#" class="badge badge-success" data-toggle='modal' data-target='#modalBatch<?= $b['idBatch'];?>' data-toggle='tooltip' title='ubah data batch'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="badge badge-danger" data-toggle='tooltip' title='hapus data batch' onclick='return confirm("Apakah anda yakin?")'>
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="#" class="badge badge-primary" data-toggle='tooltip' title='Detail'>
                                            <i class="fa fa-info"></i>
                                        </a>
                                    </td> <!-- aksi --> <!-- 2 -->

                                    <?php if($sample['idJenisManufacture'] == 1 || $sample['idJenisManufacture'] == 2) : ?> <!-- 3 -->
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
                                        </td><!-- data dukung -->
                                    <?php endif ; ?> <!-- 3 -->

                                    <td><?= $b['noBatch']; ?></td> <!-- no batch --> <!-- 4 -->

                                    <td><?= $b['dosis']; ?></td> <!-- dosis --> <!-- 5 -->

                                    <td><?= $b['namaJenisDokumen']; ?></td> <!-- dosis --> <!-- 6 -->

                                    <!-- 7 -->
                                    <td> <?= number_format($b['vial'], 0, ',', ','); ?> </td> <!-- jumlah produksi -->
                                    <td> <?= number_format($b['pengiriman'], 0, ',', ','); ?> </td> <!-- jumlah pengiriman -->
                                    <!-- 7 -->

                                     <!-- 8 -->                                       
                                    <!-- pengujian dan pelulusan -->
                                    <?php if($sample['idJenisManufacture'] == 1) : ?> <!-- domestik -->
                                        <!-- ==================================================== -->
                                        <?php $pekerjaan = 'domestik' ; ?>
                                        <?php if($b['idJenisDokumen'] == 2) : ?> <!-- label -->
                                            <?php $domestik = 'label' ; ?>
                                            <td>
                                                <i class="text-danger">tidak ada proses</i>
                                            </td>
                                            <td>
                                                <div id='pelulusan<?= $b['idBatch'] ; ?>'></div>
                                            </td>
                                        <?php else : ?> <!-- non label -->
                                            <?php $domestik = 'non-label' ; ?>
                                            <td>
                                                <div id='pengujian<?= $b['idBatch'] ; ?>'></div>
                                            </td>
                                            <td>
                                                <div id='pelulusan<?= $b['idBatch'] ; ?>'></div>
                                            </td>
                                        <?php endif ; ?>
                                        <!-- ==================================================== -->

                                    <?php elseif($sample['idJenisManufacture'] == 2) : ?> <!-- impor -->

                                        <!-- ==================================================== -->
                                        <?php $pekerjaan = 'impor' ;?>
                                        <td>
                                            <div id='pelulusan<?= $b['idBatch'] ; ?>'></div>
                                        </td>
                                        <!-- ==================================================== -->
                                        
                                    <?php else : ?> <!-- selain impor dan domestik -->
                                        
                                        <!-- ==================================================== -->
                                        <?php $pekerjaan = 'non-vaksin' ; ?>
                                        <td>
                                            <div id='pengujian<?= $b['idBatch'] ; ?>'></div>
                                        </td>
                                        <!-- ==================================================== -->

                                    <?php endif ; ?> 
                                    <!-- 8 -->

                                    <script>
                                        $(document).ready(function(){
                                            // 
                                            $('#pelulusan<?= $b['idBatch']; ?>').html(`
                                                <?php //string ?>
                                                
                                                <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($b['idBatch']) ; ?>
                                                <?php if($verifikasi_berkas) : ?>
                                                    <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                                                        <a href="#" class="badge badge-success" data-toggle='tooltip' title='Diterima, Dokumen Lengkap'><i class="fa fa-check"></i></a>
                                                        <?php $very_pelulusan = true ; ?>
                                                    <?php else : //if($verifikasi_berkas['statusVB'] == 2) ?>
                                                        <i class="text-danger"><?= $verifikasi_berkas['keteranganVB']; ?> <br> Silahkan Lengkapi Dokumen</i>
                                                        <?php $very_pelulusan = false ; ?>
                                                    <?php endif ; ?>
                                                <?php else : ?>
                                                    <i class="text-warning">Menunggu Verifikasi Dokumen</i>
                                                    <?php $very_pelulusan = false ; ?>
                                                <?php endif ; ?>

                                                <?php //string ?>
                                            `) ;

                                            // 
                                            $('#pengujian<?= $b['idBatch']; ?>').html(`
                                                <?php $verifikasi_pengujian = $this->Petugas_model->getVerifikasiSample($b['idBatch']) ; ?>
                                                <?php if($verifikasi_pengujian) : ?>
                                                   <a href="" class="badge badge-success" data-toggle='tooltip' title='Sampel pengujian diterima'><i class="fa fa-check"></i></a>
                                                    <?php $very_pengujian = true ; ?>
                                                <?php else : ?> 
                                                    <i class="text-warning">Menunggu Verifikasi Sampel Pengujian</i>
                                                    <?php $very_pengujian = false ; ?>
                                                <?php endif ; ?>
                                            `) ;
                                        });
                                    </script>

                                    <!-- 9 --> <!-- pembayaran / bukti bayar -->
                                        <td>
                                            <?php $verifikasi_pembayaran = $this->Petugas_model->getVerifikasiPembayaran($b['idBatch']) ; ?>
                                            <?php if($verifikasi_pembayaran) : ?>
                                                <?php if($verifikasi_pembayaran['kode_biling'] == '' ) : ?>
                                                    <a href="" class="badge badge-primary" data-toggle='tooltip' title='Upload, Bukti Bayar'><i class="fa fa-upload"></i></a>
                                                    <?php $very_pembayaran = false ; ?>
                                                <?php else : ?>
                                                    <?php if($verifikasi_pembayaran['status_verifikasi_bayar'] == 1) : ?>
                                                        <a href="" class="badge badge-success" data-toggle='tooltip' title='Pembayaran Diterima'><i class="fa fa-check"></i></a>
                                                        <?php $very_pembayaran = true ; ?>
                                                    <?php else : ?>
                                                        <?php $very_pembayaran = false ; ?>
                                                        <a href="" class="badge badge-danger" data-toggle='tooltip' title='Pembayaran Ditolak Silahkan Upload Kembali'><i class="fa fa-check"></i></a>
                                                        <a href="" class="badge badge-primary" data-toggle='tooltip' title='Upload ulang, Bukti Bayar'><i class="fa fa-upload"></i></a>
                                                    <?php endif ; ?>
                                                <?php endif ; ?>
                                            <?php else : ?>
                                                -
                                                <?php $very_pembayaran = false ; ?>
                                            <?php endif ; ?>
                                        </td>
                                    <!-- 9 -->

                                    

                                    <!-- 10 --> <!-- lama pengerjaan -->
                                    <td>
                                        <?php if($very_pembayaran == true) : ?>
                                            
                                            <?php if($sample['idJenisManufacture'] == 1) : ?> <!-- domestik -->
                                                <!-- ==================================================== -->
                                                <?php $pekerjaan = 'domestik' ; ?>
                                                <?php if($b['idJenisDokumen'] == 2) : ?> <!-- label -->
                                                    <?= $b['pelulusan']; ?>
                                                <?php else : ?> <!-- non label -->
                                                    <?php $usePengujian = $this->User_Sample_model->useJenisSample($sample['idJenisSample']) ; ?>
                                                    <?php if($usePengujian) : ?>
                                                        <?php $time_pengujian =  max($usePengujian) ; ?>
                                                    <?php else : ?>
                                                        <?php $time_pengujian = 0 ; ?>
                                                    <?php endif ; ?>
                                                    <?php $time_pelulusan = $b['pelulusan']; ?>

                                                    <?php $fulltime = $time_pelulusan + $time_pengujian; ?>
                                                    <span data-toggle='tooltip' title='<?= $time_pelulusan; ?> hari evaluasi dokumen + <?= $time_pengujian; ?> hari pengujian'><?= $fulltime;?> Hari</span>
                                                <?php endif ; ?>
                                                <!-- ==================================================== -->

                                            <?php elseif($sample['idJenisManufacture'] == 2) : ?> <!-- impor -->

                                                <!-- ==================================================== -->
                                                <?= $b['pelulusan']; ?> Hari
                                                <!-- ==================================================== -->
                                                
                                            <?php else : ?> <!-- selain impor dan domestik -->
                                                
                                                <!-- ==================================================== -->
                                                    <?php $usePengujian = $this->User_Sample_model->useJenisSample($sample['idJenisSample']) ; ?>
                                                        <?php if($usePengujian) : ?>
                                                            <?=  max($usePengujian) ; ?>
                                                        <?php else : ?>
                                                            <?= 0 ; ?>
                                                        <?php endif ; ?>
                                                <!-- ==================================================== -->

                                            <?php endif ; ?> 
                                        <?php else : ?>
                                            -
                                        <?php endif ; ?>
                                    </td>
                                    <!-- 10 --> <!-- lama pengerjaan -->

                                    <!-- modal batch edit -->
                                        <div class="modal fade" id="modalBatch<?= $b['idBatch'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
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
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="batch">No Batch</label>
                                                                <input type="text" name="batch" id="batch" class='form-control' placeholder='Nomer Batch' value='<?= $b['noBatch'];?>'>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="Dosis">Dosis</label>
                                                                <input type="number" name="Dosis" id="Dosis" class='form-control' placeholder='Dosis(1/2/5/10/20)' value='<?= $b['dosis'];?>'>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jmlvial">Jumlah Produksi</label>
                                                                <input type="number" class="form-control" name="jmlvial" id="jmlvial" placeholder="1xxxxxx" value='<?= $b['vial'];?>'>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jmlPengiriman">Jumlah Pengiriman</label>
                                                                <input type="number" class="form-control" name="jmlPengiriman" id="jmlPengiriman" placeholder="1xxxxxx" value='<?= $b['pengiriman'];?>'>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="exp">Tanggal Kadaluarsa</label>
                                                                <input type="date" class="form-control" name="exp" id="exp" value='<?= $b['tgl_kadaluarsa'];?>'>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="suhu">Suhu Pada Saat DIkirim</label>
                                                                <div class="input-group">
                                                                <input type="number" class="form-control" name="suhu" id="suhu" placeholder='0' value='<?= $b['suhu'];?>'>
                                                                <div class="input-group-append">
                                                                    <select name="satuanSuhu" id="" class="form-control">
                                                                        <?php foreach ($suhu as $s) : ?>
                                                                            <?php if($s == $b['satuan']) : ?>
                                                                                <option selected><?= $s; ?></option>
                                                                            <?php else : ?>
                                                                                <option><?= $s; ?></option>
                                                                            <?php endif ; ?>
                                                                        <?php endforeach ; ?>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jdEdit">Jenis Dokumen</label>
                                                                <select name="jdEdit" id="jdEdit" class="form-control">
                                                                    <?php $jenisDokumen = $this->db->get('_jenisDokumen')->result_array(); ?>
                                                                    <option value="-">-pilih-</option>
                                                                    <?php foreach ($jenisDokumen as $jd) : ?>
                                                                        <?php if($b['idJenisDokumen'] == $jd['idJenisDokumen']) : ?>
                                                                            <option selected value="<?= $jd['idJenisDokumen'];?>|<?= $jd['keteranganDokumen'];?>|<?= $jd['namaJenisDokumen'];?>"><?= $jd['namaJenisDokumen'];?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $jd['idJenisDokumen'];?>|<?= $jd['keteranganDokumen'];?>|<?= $jd['namaJenisDokumen'];?>"><?= $jd['namaJenisDokumen'];?></option>
                                                                        <?php endif ; ?>
                                                                    <?php endforeach ; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                            <div class="col-md-6">
                                                                <div id="jdokumenEdit"></div>
                                                            </div>
                                                        </div>
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
                </div>
            <?php endif ; ?>
        </div>
    </div>


</div>


<!-- tambah batch -->
    <div class="modal fade" id="tambahbatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Batch</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="<?= base_url() ; ?>sample_/tambahBatch/<?= $idSurat ; ?>/<?= $sample['idSample'];?>">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="batch">No Batch</label>
                        <input type="text" name="batch" id="batch" class='form-control' placeholder='Nomer Batch'>
                    </div>
                    <div class="col-md-6">
                        <label for="Dosis">Dosis</label>
                        <input type="number" name="Dosis" id="Dosis" class='form-control' placeholder='Dosis(1/2/5/10/20)'>
                    </div>
                    <div class="col-md-6">
                        <label for="jmlvial">Jumlah Produksi</label>
                        <input type="number" class="form-control" name="jmlvial" id="jmlvial" placeholder="1xxxxxx" >
                    </div>
                    <div class="col-md-6">
                        <label for="jmlPengiriman">Jumlah Pengiriman</label>
                        <input type="number" class="form-control" name="jmlPengiriman" id="jmlPengiriman" placeholder="1xxxxxx" >
                    </div>
                    <div class="col-md-6">
                        <label for="exp">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" name="exp" id="exp" >
                    </div>
                    <div class="col-md-6">
                        <label for="suhu">Suhu Pada Saat DIkirim</label>
                        <div class="input-group">
                        <input type="number" class="form-control" name="suhu" id="suhu" value='0' placeholder='0'>
                        <div class="input-group-append">
                            <select name="satuanSuhu" id="" class="form-control">
                                <?php foreach ($suhu as $s) : ?>
                                    <option><?= $s; ?></option>
                                <?php endforeach ; ?>
                            </select>
                        </div>
                        </div>
                    </div>

                        <?php if($sample['idJenisManufacture'] == 1) : ?>
                            <div class="col-md-6">
                                <!-- vaksin domestik -->
                                    <?php $this->db->where('idJenisDokumen != 4') ; ?>
                                    <?php $jenisDokumen = $this->db->get('_jenisDokumen')->result_array(); ?>

                                    <label for="jd">Jenis Dokumen</label>
                                    <select name="jd" id="jd" class="form-control">
                                        <option value="-">-pilih-</option>
                                        <?php foreach ($jenisDokumen as $jd) : ?>
                                            <option value="<?= $jd['idJenisDokumen'];?>|<?= $jd['keteranganDokumen'];?>|<?= $jd['namaJenisDokumen'];?>"><?= $jd['namaJenisDokumen'];?></option>
                                        <?php endforeach ; ?>
                                    </select>
                                    <!-- vaksin domestik -->
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div id="jdokumen"></div>
                            </div>
                        <?php elseif($sample['idJenisManufacture'] == 2) : ?>
                            <!-- vaksin impor -->
                                <?php $this->db->where('idJenisDokumen' , 3) ?>
                                <?php $jenisDokumen = $this->db->get('_jenisDokumen')->row_array(); ?>

                                <div class="col-md-6">
                                    <label>Jenis Dokumen</label>
                                    <div class="card mt-2">
                                        <h5 class="card-header"><?= $jenisDokumen['namaJenisDokumen']; ?></h5>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <?= $jenisDokumen['keteranganDokumen']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name='jd' value='<?= $jenisDokumen['idJenisDokumen'];?>'>

                                <div class="col-md-6">
                                    <label for="ski">No SKI</label>
                                    <input type="number" name="ski" id="ski" class='form-control' placeholder='No. Surat Keterangan Import'>
                                </div>
                            <!-- vaksin impor -->
                        <?php else : ?>
                            <!-- non vaksin -->
                                <?php $this->db->where('idJenisDokumen' , 4) ?>
                                <?php $jenisDokumen = $this->db->get('_jenisDokumen')->row_array(); ?>

                                <div class="col-md-6">
                                    <label>Jenis Dokumen</label>
                                    <div class="card mt-2">
                                        <h5 class="card-header"><?= $jenisDokumen['namaJenisDokumen']; ?></h5>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <?= $jenisDokumen['keteranganDokumen']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name='jd' value='<?= $jenisDokumen['idJenisDokumen'];?>'>
                                
                            <!-- non vaksin -->
                        <?php endif ; ?>
                </div>
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
            $('#jd').change(function(){
                var jdValue = $('#jd').val() ;
                // $('#jdokumen').html('ok') ;
                if(jdValue != '-') {
                    var jd = jdValue.split('|') ;
                    $('#jdokumen').html(`
                        <div class="card mt-2">
                            <h5 class="card-header">`+jd[2]+`</h5>
                            <div class="card-body">
                                <p class="card-text">
                                    `+jd[1]+`
                                </p>
                            </div>
                        </div>
                    `) ;
                }else{
                    $('#jdokumen').html('') ;
                }
            });
            $('#jdEdit').change(function(){
                var jdValue = $('#jdEdit').val() ;
                // $('#jdokumen').html('ok') ;
                if(jdValue != '-') {
                    var jd = jdValue.split('|') ;
                    $('#jdokumenEdit').html(`
                        <div class="card mt-2">
                            <h5 class="card-header">`+jd[2]+`</h5>
                            <div class="card-body">
                                <p class="card-text">
                                    `+jd[1]+`
                                </p>
                            </div>
                        </div>
                    `) ;
                }else{
                    $('#jdokumenEdit').html('') ;
                }
            });
        });
    </script>
<!-- tambah batch -->

