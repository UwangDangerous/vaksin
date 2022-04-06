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
    
    <div class="alert alert-<?= $this->session->flashdata('warna') ;?> alert-dismissible fade show" role="alert">
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
                    <a href="#" class="badge badge-success" data-toggle='modal' data-target='#ubah-data-<?= $row['idIU'];?>' data-toggle="tooltip" title="Ubah Data User"> <i class="fa fa-edit"></i> </a>
                    <a href="<?= base_url();?>user/hapus/<?= $row['idIU']; ?>" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data User" onclick="return confirm('Apakah Anda Yakin?');"> <i class="fa fa-trash"></i> </a>
                    <a href="" class="badge badge-secondary" data-toggle="tooltip" title="Reset Password" onclick="return confirm('Apakah Anda Yakin?');"> <i class="fa fa-redo"></i> </a>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="ubah-data-<?= $row['idIU'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url(); ?>user/ubah/<?= $row['idIU']; ?>" method="post" enctype="multipart/form-data" class='myform'>
                        <div class="modal-body">
                            <label for="nama">Nama User</label>
                            <input type="text" name="nama" id="nama" class='form-control' value="<?= $row['namaIU'];?>">

                            <label for="nip">NIP</label>
                            <input type="number" name="nip" id="nip" class='form-control' value="<?= $row['nip'];?>">

                            <label for="level">Level User</label>
                            <select name="level" id="level" class='form-control'>
                                <?php foreach ($level as $lvl) : ?>
                                    <?php if($lvl['idLevel'] == $row['idLevel']) : ?>
                                        <option selected value="<?= $lvl['idLevel'];?>"> <?= $lvl['namaLevel']; ?> </option>
                                    <?php else : ?>
                                        <option value="<?= $lvl['idLevel'];?>"> <?= $lvl['namaLevel']; ?> </option>
                                    <?php endif ; ?>
                                <?php endforeach ; ?>
                            </select>

                            <input type="hidden" name='ttd_lama' value='<?= $row['tanda_tangan'];?>'>

                            <label for="ttd">Tanda Tangan</label>
                            <input type="file" name="ttd" id="ttd" class='form-control'>
                            <i class='text-danger'>*file PNG</i >

                            <br><br>

                            <i class="text-warning">Ubah Username dan Password jika pengguna lupa</i>
                            <input type="hidden" name='username_lama' value='<?= $row['username'] ;?>'>
                            <input type="hidden" name='password_lama' value='<?= $row['password'] ;?>'>

                            <label for="username">Username Baru</label>
                            <input type="text" name="username" id="username" class='form-control' placeholder='kosongkan jika tidak ingin mengubah username'>
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class='form-control' placeholder='kosongkan jika tidak ingin mengubah password'>
                        </div>
                        <div class="modal-footer">
                            <button type="submot" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        <?php endforeach ; ?>
    </tbody>
</table>