    
<div class="card p-2">
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="input-group mt-3">
                    <input type="text" name="nama" id="nama" placeholder="general information" class="form-control">
                    <div class="input-group-append">
                        <button type='submit' class="btn btn-outline-primary">Simpan</button>
                    </div>
                </div>
                <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama'); ?></small>
        
                <br>
            </form>
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
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id='tabel_form_gi'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>General Informasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if($general_informasi) : ?>
                    
                    <?php foreach ($general_informasi as $gi) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $gi['namaGI']; ?></td>
                            <td>
                                <a href="#" class="badge badge-success" data-toggle='modal' data-target='#ubah<?= $gi['idGI'];?>' data-toggle='tooltip' title='ubah data'><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url(); ?>form_gi/hapus/<?= $gi['idGI']; ?>" class="badge badge-danger" data-toggle='tooltip' title='hapus data' onclick="return confirm('Menghapus data ini akan menghapus data yang lainnya, anda yakin?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- modal ubah data -->
                            <div class="modal fade" id="ubah<?= $gi['idGI'];?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data General Informasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="<?= base_url(); ?>form_gi/ubahDataGI/<?= $gi['idGI'];?>">
                                            <div class="modal-body">
                                                <label for="nama_gi">General Informasi</label>
                                                <input type="text" name="nama_gi" id="nama_gi" class='form-control' value='<?= $gi['namaGI'];?>'>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- modal ubah data -->
                    <?php endforeach ; ?>

                <?php else : ?>

                    <tr>
                        <td colspan = 3> <i class="text-danger">data kosong</i> </td>
                    </tr>

                <?php endif ; ?> 
            </tbody>
        </table>
    </div>
</div>
