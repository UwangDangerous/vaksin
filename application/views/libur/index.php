<div class="card p-3">
     <div class="row">
         <div class="col-1">
             <a href="<?= base_url(); ?>libur/tambah" class="btn btn-primary" data-toggle='tooltip' title='tambah hari libur'><i class="fa fa-pen"></i></a> <br>
         </div>
     </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id='libur'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Libur Nasional</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ; ?>
                <?php foreach ($libur as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaLibur']; ?></td>
                        <td> <?= $this->_Date->formatTanggalHari( $row['tglLibur'] ); ?></td>
                        <td>
                            <a href="<?= base_url(); ?>libur/ubah/<?= $row['idLibur']; ?>" class="badge badge-success" data-toogle='tooltip' title="Ubah Data"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url(); ?>libur/hapus/<?= $row['idLibur']; ?>" class="badge badge-danger" data-toggle="tooltip" title="hapus data" onclick="return confirm('yakin? data akan di hapus')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>
