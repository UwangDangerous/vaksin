<a href="<?=base_url(); ?>surat/kirim" class="btn btn-primary"> <i class="fa fa-pen"></i> </a> <br> <br>
<div class="card p-4">
    

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <table class="table-striped table-bordered text-center">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Surat / Keterangan</th>
            <th>Sertifikat</th>
            <th>Dokumen dari Manufaktur</th>
            <th>Surat</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>
        <?php $no=1; ?>
        <?php foreach ($surat as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['keterangan']; ?></td>
                <td> <!-- blm beres sertifikat --> 
                    <a href="<?= base_url(); ?>sample/cetak/<?= $row['idPenerimaan']; ?>" class='badge badge-secondary' data-toggle="tooltip" title="Cek Sertifikat"><i class="fa fa-file-signature"></i></a>
                </td>
                <td>
                    <a href="" class='badge badge-info' data-toggle="modal" data-target="#dok<?= $row['idPenerimaan']; ?>">
                        <i class="fa fa-upload" data-toggle="tooltip" title="Upload Dokumen dari Manufactur"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="dok<?= $row['idPenerimaan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Dokumen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                            <form action="<?=base_url(); ?>surat/tambahDokumen" method='post' enctype="multipart/form-data" class='myform'>
                                <input type="hidden" value="<?= $row['idPenerimaan']; ?>" name='id'>
                                <div class="form-group">
                                    <label for="nama">Nama Dokumen</label>
                                    <input type="input" class="form-control" id="nama" name='nama' placeholder='Nama Dokumen'>
                                </div>
                                <div class="form-group">
                                    <label for="berkas">Upload File</label>
                                    <input type="file" class="form-control" id="berkas" name='berkas' >
                                    <b>*tipe file pdf dan zip</b>
                                </div>
                                
                                <br><br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                            <br>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- Modal -->

                    <!-- acordion -->
                    <div id="accordion">
                        <!-- <div class="card"> -->
                            <div class="card-headerkomen" id="headingThree">
                                <a class="badge badge-warning collapsed" data-toggle="collapse" data-target="#collapseThree<?= $row['idPenerimaan']; ?>" aria-expanded="false" aria-controls="collapseThree" data-toggle="tooltip" title="Lihat Dokumen dari Manufactur">
                                    <i class="fa fa-eye" ></i>
                                </a>
                            </div>
                            <div id="collapseThree<?= $row['idPenerimaan']; ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <ul class="list-group">
                                    <?php $dokumen = $this->Surat_model->addDokumen($row['idPenerimaan']); ?>
                                    <?php foreach ($dokumen as $dok) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $dok['namaDokumen'] ;?> 
                                            <a href="<?= base_url(); ?>assets/file-upload/dokumen-manufaktur/<?= $dok['namaBerkas'];?>" class="badge badge-warning"  data-toggle="tooltip" title="Cek Dokumen" target='blank'><i class="fa fa-eye"></i></a>
                                        </li>
                                    <?php endforeach ; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- acordion -->
                </td>
                <td><a href="<?= base_url(); ?>assets/file-upload/surat/<?= $row['namaFile']; ?>" class='badge badge-primary' target='blank'><i class="fa fa-eye" data-toggle="tooltip" title="Lihat Surat"></i></a></td>
                <td>
                    <a href="" class='badge badge-success'><i class="fa fa-edit" data-toggle="tooltip" title="Ubah Data Surat"></i></a>
                    <a href="" class='badge badge-danger'><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('apakah anda yakin?');"></i></a>
                </td>
            </tr>
        <?php endforeach ; ?>
        </tbody>
    </table>
</div>