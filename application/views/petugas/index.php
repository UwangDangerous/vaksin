<?php $tglBayarFormat = ''; ?>
<div class="card p-3">

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 


    <div class="table-responsive ">
        <table class="table table-bordered table-striped text-center" id='tabel-sampel'>
            <thead>
                <tr>
                    <th class='align-middle'>No</th>
                    <th class='align-middle'>Pengirim</th>
                    <th class='align-middle'>Nama Sampel / Produk</th>
                    <th class='align-middle'>Jenis Vaksin</th>
                    <th class='align-middle'>Jumlah Batch</th>
                    <th class='align-middle'>No MA</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($sample as $row) : ?>
                    <?php $idSample = $row['idSample'] ; ?>
                    <tr>
                        <!-- 1 -->
                        <td><?= $no++; ?></td>
                        <!-- 2 -->
                        <td><?= $row['namaEU']; ?></td>
                        <!-- 3 -->
                        <td><?= $row['namaSample']; ?></td>
                        <!-- 4 -->
                        <td><?= $row['jenisSample']; ?> <br> ( <?= $row['waktuPengujian']; ?> Hari)</td>
                        <!-- 5 -->
                        <td>
                            <?php if($batch = $this->User_Sample_model->getBatch($row['idSample']) ) : ?>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?= count($batch); ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php foreach ($batch as $bat) : ?>
                                            <a class="dropdown-item" href="<?= base_url() ; ?>petugas/detail/<?= $row['idSurat']; ?>/<?= $idSample;?>/<?= $bat['idBatch']; ?>"> <?= $bat['noBatch']; ?> </a>
                                        <?php endforeach ; ?>
                                    </div>
                                </div>
                            <?php else : ?> 
                                0
                            <?php endif ; ?>
                        </td>
                        <td><?= $row['noMA']; ?></td>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>
<?//php date_default_timezone_set('Asia/Jakarta'); ?>
<?//= date('h:m:s'); ?>



 