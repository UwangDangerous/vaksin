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

<?php if(!empty($this->session->flashdata('pesan') )) : ?>
    
    <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan'); ?>
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
            <th class='align-middle'>No Batch</th>
            <th class='align-middle'>Masa Berlaku</th>
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
                <td><?= $row['namaManufacture']; ?></td>
                
                <td>
                    <?php if($row['idJenisManufacture'] == 2) : ?>
                        <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="jenisManufactureAccord">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#jmAccord<?= $row['idSample'];?>" aria-expanded="true" aria-controls="jmAccord<?= $row['idSample'];?>">
                                    <?= $row['namaJenisManufacture']; ?>
                                </button>
                            </h5>
                            </div>

                            <div id="jmAccord<?= $row['idSample'];?>" class="collapse" aria-labelledby="jenisManufactureAccord" data-parent="#accordion">
                            <div class="card-body">
                                <?php if($import = $this->User_Sample_model->getImportir($row['idSample'])) : ?>
                                    <?= $import['namaImportir']; ?> ,
                                    <?= $import['alamatImportir']; ?>
                                <?php else : ?>
                                    <a href="" class="badge badge-primary" data-toggle="modal" data-toggle='tooltip' title='Tambah Data Importir' data-target="#exampleModal"> 
                                        <i class="fa fa-plus"></i> 
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Data Importir
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form method="post" action="<?= base_url(); ?>sample_/addImportir" class='myform '>
                                                        <input type="hidden" name='id' value='<?= $row['idSample'];?>'>
                                                        <div class="form-group">
                                                            <label for="nama">Nama Importir</label>
                                                            <input type="text" class="form-control" id="nama" name='nama' >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat Importir</label>
                                                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                                                        </div>

                                                        <br><br>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ; ?>
                            </div>  
                        </div>
                    </div>
                    <?php else : ?>
                        <?= $row['namaJenisManufacture']; ?>
                    <?php endif ; ?>
                </td>

                <td> <?= $row['noMA']; ?> </td>
                <td> <?= $row['batchNo']; ?> </td>
                <td> <?= $this->_Date->formatTanggal( $row['expiryDate'] ); ?> </td>
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
                                <?php endif ; ?>
                                <!-- Modal -->
                                <div class="modal fade" id="pembayaran<?= $row['idSample']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Sample <?= $row['namaSample'] ;?> ( <?= $row['jenisSample']; ?> ) </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <div class="modal-body">
                                            <!-- myform -->
                                            <form action="<?= base_url(); ?>sample_/uploadBuktiBayar/<?= $row['idSurat']; ?>" method='post' class='myform' enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name='id' value='<?= $row['idSample']; ?>'>

                                                <div class="form-group">
                                                    <label for="berkas">Upload File</label>
                                                    <input type="file" class="form-control" id="berkas" name='berkas' >
                                                    <b class='text-danger'>*tipe file pdf</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    <a href="#" class="badge badge-primary" data-toggle='tooltip' title='Riwayat Pekerjaan'> <i class="fa fa-clipboard"></i> </a>
                    <a href="#" class="badge badge-success" data-toggle='tooltip' title='Ubah Data Sample'> <i class="fa fa-edit"></i> </a>
                    <a href="#" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data Sample"> <i class="fa fa-trash"></i> </a>
                    <?= $tombolNotaPembayaran; ?>
                </td>
        <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>