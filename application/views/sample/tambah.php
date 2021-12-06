<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <div class="row p-2 justify-content-between">
        <div class="col-md-11">
            <table cellpadding='3'>
                <tr>
                    <th>Nama Surat</th>
                    <td>:</td>
                    <td><?= $judulSurat; ?></td>
                </tr>
                <tr>
                    <th>Pengirim</th>
                    <td>:</td>
                    <td><?= $pengirim; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-1">
            <a href="<?= base_url(); ?>sample/tambahSample/<?= $id; ?>" class="btn btn-primary" data-toggle="tooltip" title="Tambah Sample"> <i class="fa fa-pen"></i> </a>
        </div>
    </div>

    <div class="table-responsive ">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Sample</th>
                    <th>Jenis Sample</th>
                    <th>vial</th>
                    <th>Tanggal Terima</th>
                    <th>Ceklis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaSample']; ?></td>
                        <td><?= $row['namaJS']; ?></td>
                        <td>
                            <?= $row['vial']; ?>
                            <?php $vial = explode(',' , $row['vial']); ?>
                            (@ <?= count($vial); ?> Vial)
                        </td>
                        <td><?= $row['tgl_terima_sample']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>assets/file-upload/ceklis-evaluator/<?= $row['ceklis']; ?>" class="badge badge-warning" data-toggle="tooltip" title="Ceklis Evaluator" target="blank"> <i class="fa fa-eye"></i> </a>
                        </td>
                        <td>
                            <a href="<?= base_url(); ?>sample/ubahSample/<?= $row['idPenerimaan'].'/'.$row['idSample'];?>" class="badge badge-success" data-toggle="tooltip" title="Ubah Data Sample"> <i class="fa fa-edit"></i> </a>
                            <a href="<?= base_url(); ?>sample/hapusSample/<?= $row['idPenerimaan'].'/'.$row['idSample'];?>" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data Sample"> <i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>