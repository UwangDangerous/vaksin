<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <div class="table-responsive ">
        <table class="table table-bordered table-striped text-center" id='sampel-evaluasi'>
            <thead>
                <tr>
                    <th class='align-middle'>No Bets</th>
                    <th class='align-middle'>Nama Sampel</th> 
                    <th class='align-middle'>Jenis Sampel</th> 
                    <th class='align-middle'>Aksi</th> 
                </tr>
            </thead>
            <tbody>
                <?php// $no = 1; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <!-- <td><?//= $no++; ?></td> 1 -->
                        <td><?= $row['noBatch']; ?></td>
                        <td><?= $row['namaSample']; ?></td>
                        <td><?= $row['jenisSample']; ?></td>
                        <td>
                            
                            <?php 
                                $this->db->where('idJenisManufacture', $row['idJenisManufacture']) ; 
                                $datadukung = $this->db->get('_jenisDataDukung')->result_array() ;
                            ?>

                            <div class="dropdown">
                                <a class="badge badge-primary dropdown-toggle" href="#" id="dd-<?= $row['idSample']; ?>" data-toggle="dropdown" data-toggle='tooltip' title='data dukung'>
                                    <i class="fa fa-folder"></i>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dd-<?= $row['idSample']; ?>">
                                    <?php foreach ($datadukung as $dd) : ?>
                                        <?php 
                                            $this->db->where('idBatch', $row['idBatch']) ;    
                                            $this->db->where('idJenisDataDukung', $dd['idJenisDataDukung']) ;    
                                            $berkas = $this->db->get('_datadukung_batch')->row_array() ;
                                        ?>

                                        <?php if($berkas) : ?>
                                            <a class="dropdown-item" href="#" data-toggle='tooltip' title='tampilkan data dukung'> <?= $dd['namaJenisDataDukung']; ?> </a>
                                        <?php else : ?>
                                            <span class='dropdown-item'> <?= $dd['namaJenisDataDukung']; ?> </span>
                                        <?php endif ; ?>

                                    <?php endforeach ; ?>
                                </div>
                            </div>

                            
                            
                            <a href="<?= base_url(); ?>evaluasi/form/<?= $row['idJenisSample']; ?>/<?= $row['idSurat']; ?>/<?= $row['idSample']; ?>" class="badge badge-secondary" data-toogle='tooltip' title='form evaluasi'><i class="fa fa-file"></i></a>
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
                                            <?php if($cn['judul']) : ?>
                                                
                                                <?= $cn['judul']; ?>  <br>
                                                ( <?= $this->_Date->formatTanggal( $cn['clock_off'] ); ?> - 
                                                <?= $this->_Date->formatTanggal( $cn['clock_on'] ); ?> )
                                                <a class="badge badge-primary" href='<?= base_url();?>assets/file-upload/berkas-clock-off/<?= $cn['berkas_cf'];?>'> 
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                            <?php else : ?> 

                                                <i class="text-danger"> Data TidakTersedia </i>

                                            <?php endif ; ?>
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