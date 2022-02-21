<div class="row">
<div class="col-md-6">
    <div class="row">
        <div class="col-md-1">
            <a href="<?= base_url(); ?>user/tambah" class="btn btn-primary" data-toggle="tooltip" title="Tambah Data User"><i class="fa fa-pen"></i></a>
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

<table class="table table-bordered table-striped text-center" id='internal-user'>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Nip</th>
            <th>Level User</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php foreach ($user as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['namaIU']; ?></td>
                <td><?= $row['nip']; ?></td>
                <td><?= $row['namaLevel']; ?></td>
                <td>
                    <a href="" class="badge badge-success" data-toggle="tooltip" title="Ubah Data User"> <i class="fa fa-edit"></i> </a>
                    <a href="" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data User" onclick="return confirm('Apakah Anda Yakin?');"> <i class="fa fa-trash"></i> </a>
                    <a href="" class="badge badge-warning" data-toggle="tooltip" title="Reset Username" onclick="return confirm('Apakah Anda Yakin?');"> <i class="fa fa-redo"></i> </a>
                    <a href="" class="badge badge-secondary" data-toggle="tooltip" title="Reset Password" onclick="return confirm('Apakah Anda Yakin?');"> <i class="fa fa-redo"></i> </a>
                </td>
            </tr>
        <?php endforeach ; ?>
    </tbody>
</table>