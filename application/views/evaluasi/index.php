<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari..">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button"> <i class="fa fa-search"></i> </button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive ">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th class='align-middle'>No</th>
                    <th class='align-middle'>Nama Sample</th>
                    <th class='align-middle'>Sample</th>
                    <th class='align-middle'>Jenis Dokumen</th>
                    <th class='align-middle'>Pengerjaan</th>
                    <th class='align-middle'>Dokumen</th>
                    <th class='align-middle'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaSample']; ?>( <?= $row['namaJenisManufacture']; ?> )</td>
                        <td><?= $row['jenisSample']; ?></td>
                        <td><?= $row['namaJenisDokumen']; ?></td>
                        <td>
                            <!-- public function pengerjaan($id, $lamaPengerjaan, $mulai, $jam ) -->
                            <!-- $this->_Date->pengerjaan($row['idSample'], $row['waktuPengujian'], ) -->
                            <?php 
                            if( $bukti = $this->Evaluasi_model->buktiBayar($row['idSample']) ) : ?>
                                <?php $pengerjaan = $this->_Date->pengerjaan($row['idSample'], $row['waktuPengujian'], $bukti['tgl_bayar'] , $bukti['jam_bayar'] ) ; ?>

                                <a href="#" data-toggle="modal" data-target="#exampleModalBukti<?= $row['idSample'];?>">
                                    <?= $pengerjaan['waktuBerjalan']; ?> dari <?= $pengerjaan['total']; ?>
                                </a>

                                <!-- Modal -->
                                <div class="d-flex text-left">
                                    <div class="modal fade" id="exampleModalBukti<?= $row['idSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Rincian Pengerjaan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <li>
                                                        Awal Pengerjaan <?= $this->_Date->formatTanggal( $pengerjaan['awalPengerjaan'] ); ?>
                                                    </li>
                                                    <li>
                                                        Lama Pengerjaan <?= $pengerjaan['lamaPengerjaan']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Libur Nasional / Libur Kerja Bpom <?= $pengerjaan['libur']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Penundaan / Clock Off <?= $pengerjaan['penundaan']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Total <?= $pengerjaan['total']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Selesai <?= $this->_Date->formatTanggal( $pengerjaan['akhirPengerjaan'] ); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            <?php else : ?>
                                <i class="text-danger">Belum Melakukan Pembayaran</i>
                            <?php endif ; ?>
                        </td>
                        <td>

                            <div id="accordion">
                                <a href="" class="badge badge-warning collapsed" data-toggle="collapse" data-target="#collapseTwo<?= $row['idSample'];?>" data-toggle='tooltip' title='Data Dukung'>
                                    <i class="fa fa-clone"></i>
                                </a>
                                <div id="collapseTwo<?= $row['idSample'];?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list-group d-flex text-left">
                                        <?php $dataDukung = $this->Evaluasi_model->getDataDukung($row['idSample']) ; ?>
                                        <?php foreach ($dataDukung as $dd) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= $dd['namaJenisDataDukung']; ?>
                                                <a href="<?= base_url(); ?>assets/file-upload/data-dukung/<?= $dd['fileDataDukung'];?>" class="badge badge-warning" data-toggle='tooltip' title='Lihat Dokumen' target='blank'>
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            </li>
                                        <?php endforeach ; ?>
                                    </ul>
                                </div>
                                </div>
                            </div>

                        </td>
                        <td>
                            <?php $cf = $this->Evaluasi_model->clockoff($row['idSample']); ?>
                            <?php if($cf) : ?>
                                
                                <?php// foreach ($clockoff as $cf) : ?>
                                    <?php if($cf['clock_on'] == '0000-00-00') : ?>
                                
                                        <i class="text-danger">Clock OFF</i>

                                    <?php else : ?>

                                        <?php if($evaluasi = $this->Evaluasi_model->getDataEvaluasi($row['idSample'])) : ?>
                                            <a href="<?= base_url(); ?>assets/file-upload/hasil-evaluasi/<?= $evaluasi['hasilEvaluasi'];?>" class="badge badge-secondary" data-toggle='tooltip' title='Lihat Hasil Evaluasi' target='blank'>
                                                <i class="fa fa-file-signature"></i>
                                            </a> <!-- lihat dokumen --> 
                                            <a href="" class="badge badge-success" data-toggle='tooltip' title='Ubah Ceklis'>
                                                <i class="fa fa-edit"></i>
                                            </a> <!-- ubah ceklis --> 
                                        <?php else : ?>
                                            <a href="#"  class="badge badge-primary"   data-toggle="modal" data-target="#tambah<?= $row['idSample'];?>" data-toggle='tooltip' title='upload hasil evaluasi'>
                                                <i class="fa fa-pen"></i>
                                            </a> <!-- tambah dokumen --> 

                                            <a href="#"  class="badge badge-primary"   data-toggle="modal" data-target="#pesan<?= $row['idSample'];?>" data-toggle='tooltip' title='mengirim pesan jika data dukung kurang'>
                                                <i class="fa fa-envelope"></i>
                                            </a> <!-- tambah dokumen --> 

                                            <a href="#"  class="badge badge-secondary"   data-toggle="modal" data-target="#clockoff<?= $row['idSample'];?>" data-toggle='tooltip' title='data dukung baru'>
                                                <i class="fa fa-file"></i>
                                            </a> <!-- tambah dokumen --> 
                                            

                                        <?php endif ; ?>

                                    <?php endif ; ?>

                                <?//php endforeach ; ?>

                            <?php else : ?>
                                <?php if($evaluasi = $this->Evaluasi_model->getDataEvaluasi($row['idSample'])) : ?>
                                    <a href="<?= base_url(); ?>assets/file-upload/hasil-evaluasi/<?= $evaluasi['hasilEvaluasi'];?>" class="badge badge-secondary" data-toggle='tooltip' title='Lihat Hasil Evaluasi'>
                                        <i class="fa fa-file-signature"></i>
                                    </a> <!-- lihat dokumen --> 
                                    <a href="" class="badge badge-success" data-toggle='tooltip' title='Ubah Ceklis'>
                                        <i class="fa fa-edit"></i>
                                    </a> <!-- ubah ceklis --> 
                                <?php else : ?>
                                    <a href="#"  class="badge badge-primary"   data-toggle="modal" data-target="#tambah<?= $row['idSample'];?>" data-toggle='tooltip' title='upload hasil evaluasi'>
                                        <i class="fa fa-pen"></i>
                                    </a> <!-- tambah dokumen --> 
                                    <a href="#"  class="badge badge-primary"   data-toggle="modal" data-target="#pesan<?= $row['idSample'];?>" data-toggle='tooltip' title='mengirim pesan jika data dukung kurang'>
                                        <i class="fa fa-envelope"></i>
                                    </a> <!-- tambah dokumen --> 
                                <?php endif ; ?>
                            <?php endif ; ?>
                        </td>
                    </tr>


                    <!-- modal tambah -->
                    <div class="modal fade" id="tambah<?= $row['idSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hasil Evaluasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- form -->
                            <form  class='myform' action="<?= base_url() ; ?>evaluasi/tambahEvaluasi/<?= $row['idSample'];?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <label for="berkas">Upload Ceklis</label>
                                    <input type="file" name="berkas" id="berkas" class='form-control'>
                                    <b class='text-danger'>*file pdf</b>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            <!-- form -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- modal pesan -->
                    <div class="modal fade" id="pesan<?= $row['idSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- form -->
                            <form  action="<?= base_url() ; ?>evaluasi/pesanEvaluasi/<?= $row['idSample'];?>" method="post" >
                                <div class="modal-body">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul" class='form-control'>
                                    <br>
                                    <div class="form-group">
                                        <label for="isi">Isi Pesan</label>
                                        <textarea class="form-control" id="isi" rows="4" name='isi'></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                            <!-- form -->
                            </div>
                        </div>
                    </div>

                    <!-- modal clock off -->
                    <div class="modal fade" id="clockoff<?= $row['idSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Clock ON / Clock OFF</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php $clock_on = $this->Evaluasi_model->clock_on($row['idSample']); ?>
                                <ul class="list-group">
                                    <?php foreach ($clock_on as $cn) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $cn['judul']; ?>  <br>
                                            ( <?= $this->_Date->formatTanggal( $cn['clock_off'] ); ?> - 
                                             <?= $this->_Date->formatTanggal( $cn['clock_on'] ); ?> )
                                            <a class="badge badge-primary" href='<?= base_url();?>assets/file-upload/berkas-clock-off/<?= $cn['berkas_cf'];?>'> 
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </li>
                                    <?php endforeach ; ?>
                                </ul>
                            </div>
                        </div>
                    </div>



                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>