<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="tabel-tugas">
            <thead>
                <tr>
                    <th>No Admin</th>
                    <th>Nama Sampel</th>
                    <th>Jenis Pekerjaan</th>
                    <th>Jumlah</th>
                    <th>Surat Perintah</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($evaluasi as $row) : ?>
                    <tr>
                        <td>
                            <?= $row['noAdm']; ?>/<?= $row['kodeAdm']; ?>/<?= $row['kodeBulan']; ?>/<?= $row['tahun']; ?>
                        </td>
                        <td><?= $row['namaSample']; ?> <br> (<?= $row['noBatch']; ?>)</td>
                        <td class='text-left'>

                            <?php $pekerjaan = $this->__Evaluasi_model->getDataPekerjaan($row['idBatch']) ; ?>
                            <?php if($pekerjaan) : ?>
                                <ul>
                                    <?php foreach ($pekerjaan as $work) : ?>
                                        <li><?= $work['namaJenisPekerjaan']; ?></li>
                                    <?php endforeach ; ?>
                                </ul>
                            <?php else : ?>
                                
                            <?php endif ; ?>

                        </td>
                        <td><?= $row['pengiriman']; ?> <?= $row['ingJenisKemasan']; ?> </td>
                        <td><a href="<?= base_url();?>cetak/surat_perintah_kerja" class="btn btn-warning" data-toggle='tooltip' title='cetak surat perintah kerja'><i class="fa fa-print"></i></a></td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>