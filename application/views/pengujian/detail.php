<?php $id = $pengujian['idSample'] ; ?>
<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?= $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <div class="row">
        <div class="col">
            <table cellpadding='2'> 
                <tr>
                    <th class = 'align-top'>Nama Sampel / Produk</th>
                    <td class = 'align-top'> : </td>
                    <td class='d-flex justify-content-between'> 
                        <?= $pengujian['namaSample']; ?> 
                        <a href="#" class="btn btn-primary" data-toggle='modal' data-target='#modelTambah' data-toggle='tooltip' title='Tambah Hasil Pengujian'> <i class="fa fa-pen"></i> </a>
                    </td>
                </tr>
                <tr>
                    <th colspan='2' class='align-top'>Batch</th>
                    <td> 
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No Batch</th>
                                    <th>Dosis</th>
                                    <th>Jumlah Vial</th>
                                    <th>Vial</th>
                                    <th>Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $batch = $this->Pengujian_model->geDatatBatch($id); ?>
                                <?php foreach ($batch as $row) : ?>
                                    <tr>
                                        <td><?= $row['noBatch']; ?></td>
                                        <td><?= $row['dosis']; ?></td>
                                        <?php $vials = explode(',', $row['vial'] ); ?>
                                        <td><?= count($vials); ?></td>
                                        <td>
                                            <ul class="list-group">
                                                <?php foreach ($vials as $vial) : ?>
                                                    <li class="list-group-item"><?= $vial; ?></li>
                                                <?php endforeach ; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                <?php $dataDukung = $this->Pengujian_model->getDataDukungBatch($row['idBatch']) ; ?>
                                                <?php if($dataDukung) : ?>
                                                    <?php foreach ($dataDukung as $dd) : ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <?= $dd['namaJenisDataDukung']; ?>
                                                            <a href='<?= base_url() ; ?>assets/file-upload/data-dukung/<?= $dd['fileDataDukung']; ?>' class="badge badge-primary ml-4" data-toggle='tooltip' title='Tampilkan <?= $dd['namaJenisDataDukung'] ?>'>
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </li>
                                                    <?php endforeach ; ?>
                                                <?php else : ?> 
                                                    <i class="text-danger">Data Kosong</i>
                                                <?php endif ; ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach ; ?>
                            </tbody>
                        </table>    
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Hasil Pengujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url(); ?>pengujian/tambahPengujian" enctype="multipart/form-data" class='myform' >
                <div class="modal-body">
                    <input type="hidden" name='id' value='<?= $id ; ?>'>
                    <label for="Upload">Uplaod Hasil Pengujian</label>
                    <input type="file" name="Upload" id="Upload" class='form-control'>
                    <b>* file pdf</b>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>