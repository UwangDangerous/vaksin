<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Dokumen</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($dok as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaJenisDokumen']; ?></td>
                        <td><?= $row['keteranganDokumen']; ?></td>
                        <td><a href="#" class="badge badge-success" data-toggle='modal' data-target='#modal<?= $row['idJenisDokumen']; ?>' data-toggle='tooltip' title='Edit Data'><i class="fa fa-edit"></i></a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="modal<?= $row['idJenisDokumen']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="<?= base_url(); ?>jenisSample/ubahDok/<?= $row['idJenisDokumen'];?>">
                                    <div class="modal-body">
                                        <label for="nama">Jenis Dokumen</label>
                                        <input type="text" name="nama" id="nama" value='<?= $row['namaJenisDokumen'] ?>' class='form-control'>
                                        <label for="username">Username</label>
                                        <textarea name="keterangan" id="username" cols="30" rows="5" class='form-control'><?= $row['KeteranganDokumen']; ?></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>