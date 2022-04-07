<?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
    <div class="alert alert-<?= $this->session->flashdata('warna') ;?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?>

<div class="table-responsive mt-2">
    <table class="table table-bordered table-striped text-center" id="tabel-tugas">
        <thead>
            <tr>
                <th class='align-middle'>NO Admin</th>
                <th class='align-middle'>No Batch</th>
                <th class='align-middle'>Nama Petugas</th>
                <th class='align-middle'>Konfirmas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($petugas as $p) : ?>
                <?php $petugas = $this->__Konfirmasi_model->getDataPelulusanEvaluasi($p['idBatch']) ?>
                <?php if($petugas) : ?>

                    <tr>
                        <?php if(empty($petugas['noAdm'])) : ?>
                            <td><i class="text-danger">null</i></td>
                        <?php else : ?>
                            <td><?= $petugas['noAdm']; ?>/<?= $petugas['kodeAdm'];?>/<?= $petugas['kodeBulan'];?>/<?= $petugas['tahun'];?></td>
                        <?php endif ; ?>
                        <td><?= $petugas['noBatch']; ?></td>
                        <td><?= $petugas['namaIU']; ?></td>
                        <td>
                            <?php if($petugas['konfirmasi'] == 0) : ?>
                                <a href="<?= base_url();?>__konfirmasi/konfirmasi_terima/<?= $petugas['idPetugas'];?>/1/<?= $petugas['idBatch'];?>" class="badge badge-success" data-toggle='tooltip' title='Konfirmasi Penugasan' onclick='return confirm("Konfirmasi Penugasan..?");'><i class="fa fa-check"></i></a>
                                <a href="<?= base_url();?>__konfirmasi/konfirmasi_terima/<?= $petugas['idPetugas'];?>/2/<?= $petugas['idBatch'];?>" class="badge badge-danger" data-toggle='tooltip' title='Batal Penugasan' onclick='return confirm("Batal Penugasan..?");'><i class="fa fa-times"></i></a>
                            <?php elseif($petugas['konfirmasi'] == 1) : ?>
                                <i class="text-success">Dikonfirmasi</i>
                            <?php else : ?>
                                <a href="<?= base_url();?>__konfirmasi/hapus_petugas_pelulusan/<?= $petugas['idPetugas'];?>/<?= $petugas['idBatch'];?>" class="badge badge-danger" onclick='return confirm("Hapus Data Penugasan..?");'><i class="fa fa-trash"></i></a>
                            <?php endif ; ?>
                        </td>
                    </tr>
                        
                <?php endif ; ?>
            <?php endforeach ; ?>
        </tbody>
    </table>
</div>