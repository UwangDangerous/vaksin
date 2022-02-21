<div class="row">
<div class="col-md-6">
    <div class="row">
        <div class="col-md-1">
            <a href="<?= base_url(); ?>user/tambahEksternal" class="btn btn-primary" data-toggle="tooltip" title="Tambah Data User"><i class="fa fa-pen"></i></a>
        </div> <!-- col 2 --> 
    </div> <!-- row 2 --> 
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

<table class="table table-bordered table-striped text-center" id='eksternal-user'>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Perusahaan</th>
            <th>email</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php foreach ($user as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['namaEU']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <?php if($row['aktif'] == 1) : ?>
                        Aktif
                    <?php elseif($row['aktif'] == 2) : ?>
                        Tidak Aktif
                    <?php else : ?>
                        Tidak Melakukan Aktivasi
                    <?php endif ; ?>
                </td>
                <td>
                    <a href="" class="badge badge-info" data-toggle="tooltip" title="Ubah Data User"> <i class="fa fa-edit"></i> </a>
                    <?php if($row['aktif']==2) : ?>
                        <a href="<?= base_url() ;?>user/aktif/<?= $row['idEU'];?>" class="badge badge-success" data-toggle="tooltip" title="Aktifkan User" onclick="return confirm('Aktifkan User ?');"> <i class="fa fa-check"></i> </a>
                    <?php else : ?>
                        <a href="<?= base_url() ;?>user/nonAktif/<?= $row['idEU'];?>" class="badge badge-danger" data-toggle="tooltip" title="Non Aktifkan User" onclick="return confirm('Non Aktifkan User ?');"> <i class="fa fa-times"></i> </a>
                    <?php endif ; ?>
                </td>
            </tr>
        <?php endforeach ; ?>
    </tbody>
</table>