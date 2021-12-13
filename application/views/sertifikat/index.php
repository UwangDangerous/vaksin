<div class="card p-3">
<div class="row">
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
            <th>No</th>
            <th>Nama Surat</th>
            <th>Pengirim</th>
            <th>Tanggal Pengiriman</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php foreach ($sample as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['keterangan']; ?></td>
                <td><?= $row['namaEU']; ?></td>
                <td><?= $this->_Date->formatTanggal( $row['tgl_pengiriman'] ); ?></td>
                <td>
                    <a href="<?= base_url(); ?>sertifikat/create/<?= $row['idPenerimaan'];?>" class="badge badge-primary" data-toggle="tooltip" title="Buat Sertifikat"> <i class="fa fa-pen"></i> </a>
                    <!-- <a href="" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data User" onclick="return confirm('Apakah Anda Yakin?');"> <i class="fa fa-trash"></i> </a> -->
                </td>
            </tr>
        <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>