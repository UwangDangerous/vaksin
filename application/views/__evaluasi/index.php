<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="tabel-tugas">
            <thead>
                <tr>
                    <th  class='align-middle'>No Admin</th>
                    <th  class='align-middle'>Nama Sampel / No Batch</th>
                    <th  class='align-middle'>Jenis Sample</th>
                    <th  class='align-middle'>Jenis Pekerjaan</th>
                    <th  class='align-middle'>Jumlah</th>
                    <th  class='align-middle'>Surat Perintah</th>
                    <th  class='align-middle'>Waktu Pengerjaan</th>
                    <th  class='align-middle'>Evaluasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($evaluasi as $row) : ?>
                    <tr>
                        <td>
                            <?= $row['noAdm']; ?>/<?= $row['kodeAdm']; ?>/<?= $row['kodeBulan']; ?>/<?= $row['tahun']; ?>
                        </td>
                        <td><?= $row['namaSample']; ?> <br> (<?= $row['noBatch']; ?>)</td>
                        <td>
                            <b><?= $row['jenisSample']; ?></b>
                            <br>
                            <?php if($row['idJenisManufacture'] == 1) : ?>
                                <?= $row['namaJenisManufacture']; ?> <br> (<?= $row['namaJenisDokumen']; ?>)
                            <?php else : ?>
                                <?= $row['namaJenisManufacture']; ?>
                            <?php endif ; ?>
                        </td>
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
                        <td><a href="<?= base_url();?>cetak/surat_perintah_kerja/<?= $row['idBatch'];?>/1" class="btn btn-warning" data-toggle='tooltip' title='cetak surat perintah kerja' target='blank'><i class="fa fa-print"></i></a></td>
                        <td>blm selesai</td>
                        <td><a href="<?= base_url();?>Evaluasi/form/<?= $row['idJenisSample'];?>/<?= $row['idBatch'];?>" class="btn btn-primary" data-toggle='tooltip' title='Evaluasi Dokumen'><i class="fa fa-pen"></i></a></td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>