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
    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                <td><?= $row['namaSample']; ?></td>
                <td><?= $row['namaManufacture()']; ?></td>
                <td><?= $row['tgl_pengiriman']; ?></td>
        <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>