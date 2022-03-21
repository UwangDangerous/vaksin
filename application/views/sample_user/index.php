<div class="card p-3">
    <div class="row">
        <div class="col">
            <a href="<?= base_url(); ?>sample_/tambah/<?= $id; ?>" class="btn btn-primary" data-toggle="tooltip" title="Tambah Sampel"><i class="fa fa-pen"></i></a>
        </div>
    </div>

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?>

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
        <table class="table table-bordered table-striped text-center" id='sampel_user'>
            <thead>
                <tr>
                    <th class='align-middle'>No</th>
                    <th class='align-middle'>Nama Sampel / Produk</th>
                    <th class='align-middle'>Jenis Sampel</th>
                    <!-- <th class='align-middle'>Tanggal Kadaluarsa</th> -->
                    <th class='align-middle'>Jumlah Batch</th>
                    <th class='align-middle'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaSample'];?></td>
                        <td>
                            <div class="row">
                                <div class="col-md-6"><?= $row['jenisSample']; ?></div>
                                <div class="col-md-6"><?= $row['namaJenisManufacture']; ?></div>
                            </div>
                        </td>

                        <!-- <td> <?//= $this->_Date->formatTanggal($row['tgl_kadaluarsa']); ?> </td> -->
                        <td>
                            <?php if($batch = $this->User_Sample_model->getBatch($row['idSample']) ) : ?>
                                <?= count($batch); ?> <br>
                            <?php else : ?> 
                                0
                            <?php endif ; ?>
                        </td>
                        <td>
                            <a href="<?=base_url();?>sample_/batch_add/<?= $row['idSurat']; ?>/<?= $row['idSample'];?>" class="badge badge-primary" data-toggle='tooltip' title='Rincian & Lengkapi Dokumen'>
                                <i class="fa fa-pen"></i>
                            </a>
                            <?php if($this->User_Sample_model->cekPetugas($row['idSample']) == null) : ?>
                                <a href="#" class="badge badge-success" data-toggle='modal' data-target='#ubah_<?= $row['idSample']; ?>' data-toggle='tooltip' title='Ubah Data'>
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= base_url(); ?>sample_/hapus/<?= $row['idSample'];?>" class="badge badge-danger" data-toggle='tooltip' title='Hapus Data'>
                                    <i class="fa fa-trash"></i>
                                </a>
                            <?php endif ; ?>
                            <a href="#" class="badge badge-secondary" data-toggle='modal' data-target='#riwayat_<?= $row['idSample']; ?>' data-toggle='tooltip' title='Riwayat Pekerjaan'>
                                <i class="fa fa-file-signature"></i>
                            </a>
                        </td>

                        <div class="modal fade" id="riwayat_<?= $row['idSample']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Riwayat Pekerjaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <?php $riwayat = $this->User_Sample_model->riwayatDataSample($row['idSample']) ?>
                                            <?php foreach ($riwayat as $r) : ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= $r['keteranganRiwayat']; ?>
                                                    <span class=""><?= $this->_Date->formatTanggalHari( $r['tgl_riwayat'] ); ?> (<?= $r['jam_riwayat'] ?>)</span>
                                                </li>
                                            <?php endforeach ; ?>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="ubah_<?= $row['idSample']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>