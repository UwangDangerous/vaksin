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
                <th>NO Admin</th>
                <th>No Batch</th>
                <th>Nama Petugas</th>
                <th>Konfirmasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($petugas as $p) : ?>
                <?php $penguji = $this->__Konfirmasi_model->getDataPetugasPenguji($p['idBatch']) ?>
                <?php if($penguji) : ?>
                    <?php foreach ($penguji as $uji) : ?>
                        <tr>
                            <td>
                                <?= $uji['PnoAdm']; ?>/<?= $uji['PkodeAdm'];?>/<?= $uji['PkodeBulan'];?>/<?= $uji['Ptahun'];?>
                            </td>
                            <td><?= $uji['noBatch']; ?></td>
                            <td><?= $uji['namaIU']; ?></td>
                            <td>
                                <?php if($uji['konfirmasiPP'] == 0) : ?>
                                    <a href="<?= base_url();?>__konfirmasi/konfirmasi_terima_pengujian/<?= $uji['idPP'];?>/1/<?= $uji['idBatch'];?>" class="badge badge-success" data-toggle='tooltip' title='Konfirmasi Pengujian Dilaksanakan' onclick="return confirm('Konfirmasi Pengujian Dilaksanakan..?');"><i class="fa fa-check"></i></a>
                                    <a href="<?= base_url();?>__konfirmasi/konfirmasi_terima_pengujian/<?= $uji['idPP'];?>/2/<?= $uji['idBatch'];?>" class="badge badge-danger" data-toggle='tooltip' title='Konfirmasi Pengujian Tidak Dilaksanakan' onclick="return confirm('Konfirmasi Pengujian Tidak Dilaksanakan..?');"><i class="fa fa-times"></i></a>
                                <?php elseif($uji['konfirmasiPP'] == 1) : ?>
                                    <i class="text-success"> Selesai Konfirmasi </i>
                                <?php else : ?>
                                    <a href="<?= base_url();?>__konfirmasi/hapus_petugas_pengujian/<?= $uji['idPP'];?>/<?= $uji['idBatch'];?>" class="badge badge-danger" data-toggle='tooltip' title='Hapus Petugas' onclick="return confirm('Hapus Petugas..?');"><i class="fa fa-trash"></i></a>
                                <?php endif ; ?>
                            </td>
                        </tr>
                    <?php endforeach ; ?>
                <?php endif ; ?>
            <?php endforeach ; ?>
        </tbody>
    </table>
</div>