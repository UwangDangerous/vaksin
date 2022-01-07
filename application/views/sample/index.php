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
            <th class='align-middle'>No Surat</th>
            <th class='align-middle'>Nama Surat / Judul</th>
            <th class='align-middle'>Pengirim</th>
            <th class='align-middle'>Tanggal Surat</th>
            <th class='align-middle'>Surat</th>
            <th class='align-middle'>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sample as $row) : ?>
            <tr>
                <td><?= $row['noSurat']; ?></td>
                <td><?= $row['namaSurat']; ?></td>
                <td><?= $row['namaEU']; ?></td>
                <td><?= $this->_Date->formatTanggal( $row['tgl_kirim_surat'] ) ;?></td>
                <td>
                    <a href="<?=base_url(); ?>assets/file-upload/surat/<?=$row['fileSurat'];?>" target='blank' data-toggle='tooltip' title='Lihat Surat' class="badge badge-secondary"><i class="fa fa-eye"></i></a>
                </td>
                <td>
                    <a href="<?=base_url(); ?>petugas/index/<?=$row['idSurat'];?>" target='blank' data-toggle='tooltip' title='Data Sample' class="badge badge-primary"><i class="fa fa-bars"></i></a>
                </td>
            </tr>
        <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>