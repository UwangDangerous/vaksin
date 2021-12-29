<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Sample</th>
                <th>Penundaan</th>
                <th>Keterangan</th>
                <th>Clock OFF</th>
                <th>Clock ON</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ; ?>
            <?php foreach ($penundaan as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['namaSample']; ?></td>
                    <td><?= $row['judul']; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <td><?= $this->_Date->formatTanggal( $row['clock_off'] ); ?></td>
                    <?php if($row['clock_on'] == '0000-00-00') : ?>
                        <td>
                            -
                        </td>
                        <td>
                            <a href="#" data-toggle='modal' data-target='#clock-on<?= $row['idSample']; ?>' class="badge badge-primary" data-toggle='tooltip' title='upload data'>
                                <i class="fa fa-upload"></i>
                            </a>
                        </td>
                    <?php else : ?>
                        <td>
                            <?= $this->_Date->formatTanggal( $row['clock_off'] ); ?>
                        </td>
                        <td>
                            <a href="<?= base_url(); ?>assets/file-upload/berkas-clock-off/<?= $row['berkas_cf'];?>" class="badge badge-secondary" data-toggle='tooltip' title='lihat file' target='blank'>
                                <i class="fa fa-file"></i>
                            </a>
                        </td>
                    <?php endif ; ?>


                    <!-- Modal -->
                    <div class="modal fade" id="clock-on<?= $row['idSample']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload Data <?= $row['judul']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="<?= base_url();?>surat/uploadPenundaan/<?= $row['idClockOff']; ?>/<?= $row['idSample'];?>" enctype="multipart/form-data" class='myform'>
                                
                                    <div class="modal-body">
                                        <label for="berkas">Upload File Susulan</label>
                                        <input type="file" name="berkas" id="berkas" class='form-control'>
                                        <b class='text-danger'>*pdf</b>
                                        <br>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" rows="3" name='keterangan'></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </tr>    
            <?php endforeach ; ?>
        </tbody>
    </table>
</div>