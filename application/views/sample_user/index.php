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
            <th class='align-middle'>Jenis Vaksin</th>
            <th class='align-middle'>Perusahaan</th>
            <th class='align-middle'>No MA</th>
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
                <td><?= $row['jenisSample']; ?></td>
                <td>
                    <?php if($row['idJenisManufacture'] == 2)  : ?>
                        <?php if($row['namaImportir'] == null) : ?>
                            <i>null</i> <br>
                            ( <?= $row['namaJenisManufacture']; ?> )
                        <?php else : ?>
                            <?= $row['namaImportir']; ?> <br> ( <?= $row['namaJenisManufacture']; ?> )
                        <?php endif ; ?>
                    <?php else : ?>
                        <?= $row['namaEU']; ?>
                    <?php endif ; ?>
                </td>

                <td> <?= $row['noMA']; ?> </td>
                <td>
                    <?php if($batch = $this->User_Sample_model->getBatch($row['idSample']) ) : ?>
                        <?= count($batch); ?> <br>
                    <?php else : ?> 
                        0
                    <?php endif ; ?>
                </td>
                <td>
                    <div class="dropdown" id='dd'>
                        <a href='#' class="badge badge-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="flip">
                            <i class="fa fa-bars"></i>
                        </a>

                        <div class="dropdown-menu pl-3" style='width:180px ;' aria-labelledby="dropdownMenuButton">
                            <a href="<?=base_url();?>sample_/batch_add/<?= $row['idSurat']; ?>/<?= $row['idSample'];?>" class="badge badge-primary" data-toggle='tooltip' title='Lengkapi Dokumen'>
                                <i class="fa fa-pen"></i>
                            </a>

                            <a href="<?=base_url();?>sample_/form/<?= $row['idJenisSample']; ?>/<?= $row['idSurat']; ?>/<?= $row['idSample'];?>" class="badge badge-secondary" data-toggle='tooltip' title='Lengkapi Data'>
                                <i class="fa fa-file"></i>
                            </a>

                            
                        </div>
                    </div>
                </td>

        <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>