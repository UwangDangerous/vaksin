<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <div class="table-responsive ">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Sample</th>
                    <th>Jenis Sample</th>
                    <th>vial</th>
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
                        <td>
                            <a href="<?= base_url(); ?>assets/file-upload/ceklis-evaluator/<?= $row['ceklis']; ?>" class="badge badge-warning" data-toggle="tooltip" title="Ceklis Evaluator" target="blank"> <i class="fa fa-eye"></i> </a>
                        </td>
                        <td>
                            <?php if($eva = $this->Evaluasi_model->cekEvaluasi($row['idSample'])) : ?>
                                <i><a href="<?= base_url(); ?>assets/file-upload/hasil-evaluasi/<?= $eva['hasilEvaluasi']; ?>"  class='text-success' data-toggle="tooltip" title="Lihat Hasil Evaluasi" target='blank'> sudah di evaluasi </a></i>
                            <?php else : ?>
                                <a href="<?= base_url(); ?>evaluasi/tambah/<?= $row['idSample'] ; ?>" class="badge badge-primary" data-toggle="tooltip" title="Tambah Hasil Evaluasi"> <i class="fa fa-pen"></i> </a>
                            <?php endif ; ?>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>