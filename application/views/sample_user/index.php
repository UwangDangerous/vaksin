<div class="card p-3">
<div class="row">
    <div class="col-md-1">
        <a href="<?= base_url(); ?>sample_/tambah/<?= $id; ?>" class="btn btn-primary" data-toggle="tooltip" title="Tambah Sampel"><i class="fa fa-pen"></i></a>
    </div>
    <div class="col-md-6">
        <form action="" post>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pencarian" >
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div><!-- col 1 --> 
</div><!-- row 1 --> 

<?php if(!empty($this->session->flashdata('pesanImportir') )) : ?>
    
    <div class="alert alert-<?=  $this->session->flashdata('warnaImportir'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesanImportir'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?> 
<br>
<div class="table-responsive">
<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th class='align-middle'>No</th>
            <th class='align-middle'>Nama Sample / Produk</th>
            <th class='align-middle'>Nama Perusahaan</th>
            <th class='align-middle'>Jenis Perusahaan</th>
            <th class='align-middle'>No MA</th>
            <th class='align-middle'>Jumlah Batch</th>
            <th class='align-middle'>Tanggal Pengiriman</th>
            <th class='align-middle'>Lengkapi Dokumen</th>
            <th class='align-middle'>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php foreach ($sample as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['namaSample'];?> <br>( <?= $row['jenisSample']; ?> )</td>
                <td>
                    <?php if($row['idJenisManufacture'] == 2)  : ?>
                        <?= $row['namaImportir']; ?> <br>
                        ( <?= $row['namaEU']; ?> Imported)
                    <?php else : ?>
                        <?= $row['namaEU']; ?>
                    <?php endif ; ?>
                </td>
                
                <td>
                        <?= $row['namaJenisManufacture']; ?>
                </td>

                <td> <?= $row['noMA']; ?> </td>
                <td>
                    <?php if($batch = $this->User_Sample_model->getBatch($row['idSample']) ) : ?>
                        <?= $batch; ?>
                    <?php else : ?>
                        0
                    <?php endif ; ?>
                </td>
                <td><?= $this->_Date->formatTanggal( $row['tgl_pengiriman'] ); ?></td>

                <!-- lengkapi dokumen -->
                <td>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="pagedok<?= $row['idSample']; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#dok<?= $row['idSample']; ?>" aria-expanded="true" aria-controls="dok<?= $row['idSample']; ?>">
                                    Melengkapi <br>
                                    <?= $dokIsi = $this->User_Sample_model->jmlDokumenTerisi($row['idSample']); ?> dari <?= $dok = $this->User_Sample_model->jmlDokumen($row['idJenisManufacture']); ?>
                                    <br> Dokumen
                                </button>
                                <?php $tombolNotaPembayaran = '' ?>
                                <?php if($dok == $dokIsi) : ?>
                                    <?php $tombolNotaPembayaran = '<a href="" class="badge badge-secondary" data-toggle="modal" data-target="#pembayaran'.$row['idSample'].'" data-toggle="tooltip" title="Upload Bukti Pembayaran"> <i class="fa fa-file-invoice"></i> </a>' ; ?>
                                    <!-- modal bukti bayar -->
                                    <div class="d-flex text-left">
                                        <div class="modal fade" id="pembayaran<?= $row['idSample']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> <label for="berkas"> Upload Bukti Bayar </label></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- form bukti bayar -->
                                                <form action="<?= base_url(); ?>sample_/uploadBuktiBayar/<?= $row['idSample']; ?>/<?= $row['idSurat'];?>" method='post' class='myform' enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="file" class="form-control" id="berkas" name='berkas' >
                                                            <b class='text-center'>*tipe file pdf,jpg,jpeg,png</b>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                                </form>
                                                <!-- form bukti bayar -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal bukti bayar -->
                                <?php endif ; ?>

                                
                            </h5>
                            </div>

                            <div id="dok<?= $row['idSample']; ?>" class="collapse" aria-labelledby="pagedok<?= $row['idSample']; ?>" data-parent="#accordion">
                            <div class="card-body">
                            <?php $manufacture = $this->User_Sample_model->getJenisDataDukung($row['idJenisManufacture']); ?>
                            <ul class="list-group text-left">
                                <?php foreach ($manufacture as $jm) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $jm['namaJenisDataDukung']; ?>

                                        <?php if($this->User_Sample_model->cekDataDukung($row['idSample'], $jm['idJenisDataDukung']) > 0) : ?>
                                            
                                            <span class="badge badge-success"><i class="fa fa-check"></i></span>
                                            
                                        <?php else : ?>
                                            
                                            <a href="#" class="badge badge-primary" data-toggle="modal" data-target="#datadukung<?= $row['idSample'].''.$jm['idJenisDataDukung'];?>" data-toggle='tooltip' title='upload <?= $jm['namaJenisDataDukung'];?>'> 
                                                <i class="fa fa-upload"></i>
                                            </a>

                                        <?php endif ; ?>
                                        
                                    </li>
                                    <!-- Modal -->
                                    <div class="modal fade " id="datadukung<?= $row['idSample'].''.$jm['idJenisDataDukung'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Upload File <?= $jm['namaJenisDataDukung'];?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- form -->
                                                <form action="<?= base_url(); ?>sample_/uploadDataDukung/<?= $row['idSurat']; ?>" method='post' class='myform' enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" name='idSample' value="<?= $row['idSample']; ?>">
                                                        <input type="hidden" name='idJenisDataDukung' value="<?= $jm['idJenisDataDukung']; ?>">
                                                        <input type="hidden" name='namaJenisDataDukung' value="<?= $jm['namaJenisDataDukung']; ?>">

                                                        <div class="form-group">
                                                            <label for="berkas">Upload File</label>
                                                            <input type="file" class="form-control" id="berkas" name='berkas' >
                                                            <b class='text-center'>*tipe file pdf</b>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ; ?>
                            </ul>
                            </div>
                            </div>  
                        </div>
                    </div>
                </td>
                <!-- akhir lengkapi dokumen -->
                <td>
                    <a href="<?=base_url();?>sample_/batch/<?= $row['idSurat']; ?>/<?= $row['idSample'];?>" class="badge badge-warning" data-toggle='tooltip' title='Lengkapi Dokumen'>
                        <i class="fa fa-pen"></i>
                    </a>

                    <a href="#" class="badge badge-primary" data-toggle='tooltip' title='Riwayat Pekerjaan'> <i class="fa fa-clipboard"></i> </a>
                    <a href="#" class="badge badge-success" data-toggle='tooltip' title='Ubah Data Sample'> <i class="fa fa-edit"></i> </a>
                    <a href="#" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data Sample"> <i class="fa fa-trash"></i> </a>

                    <?php if($this->User_Sample_model->cekBuktiBayar($row['idSample'])) : ?>
                        <a href='#' data-toggle='tooltip' title='sudah di upload' class='badge badge-success'> <i class="fa fa-check"></i> </a>
                    <?php else : ?>
                        <?= $tombolNotaPembayaran; ?>
                    <?php endif ; ?>
                </td>
        <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>