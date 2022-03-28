<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
            
            <div class="alert alert-<?= $this->session->flashdata('warna') ?> alert-dismissible fade show" role="alert">
                <?=  $this->session->flashdata('pesan'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
    <?php endif ; ?>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="tabel-tugas">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Tugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($tugas as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaTugas']; ?></td>
                        <td>
                            <?php if($row['idTugas'] == 1) : ?>
                                Verifikator
                            <?php else : ?>
                                Evaluator
                            <?php endif ; ?>
                        </td>
                        <td>
                            <a href="#" class="badge badge-success" data-toggle='modal' data-target='#ubah_<?= $row['idTugas'];?>' data-toggle='tooltip' title='Ubah Data <?= $row['namaTugas'];?>'><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="ubah_<?= $row['idTugas'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data <?= $row['namaTugas']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url();?>jenisSample/ubahDataTugas/<?= $row['idTugas'];?>" method="post">
                                    <div class="modal-body">
                                        <label for="nama">Nama Tugas</label>
                                        <input type="text" name="nama" id="nama" class='form-control' value='<?= $row['namaTugas'];?>'>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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