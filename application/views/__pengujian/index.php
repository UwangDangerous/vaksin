<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="tabel-tugas">
            <thead>
                <tr>
                    <th  class='align-middle'>No Admin</th>
                    <th  class='align-middle'>Nama Sampel / No Batch</th>
                    <th  class='align-middle'>Jenis Sample</th>
                    <th  class='align-middle'>Pengujian</th>
                    <th  class='align-middle'>Jumlah</th>
                    <th  class='align-middle'>Surat Perintah</th>
                    <th  class='align-middle'>Waktu Pengerjaan</th>
                    <th  class='align-middle'>Upload Laporan Hasil Pengujian</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pengujian as $row) : ?>
                    <?php $noAdm =  $row['PnoAdm'] .'/'. $row['PkodeAdm'] .'/'. $row['PkodeBulan'] .'/'. $row['Ptahun'] ; ?>
                    <tr>
                        <td class='align-top'>
                           <?= $noAdm; ?>
                        </td>
                        <td class='align-top'><?= $row['namaSample']; ?> <br> (<?= $row['noBatch']; ?>)</td>
                        <td class='align-top'>
                            <b><?= $row['jenisSample']; ?></b>
                            <br>
                            <?php if($row['idJenisManufacture'] == 1) : ?>
                                <?= $row['namaJenisManufacture']; ?> <br> (<?= $row['namaJenisDokumen']; ?>)
                            <?php else : ?>
                                <?= $row['namaJenisManufacture']; ?>
                            <?php endif ; ?>
                        </td>
                        <td class='align-top'><?= $row['namaJenisPengujian']; ?></td>
                        <td class='align-top'><?= $row['pengiriman']; ?> <?= $row['ingJenisKemasan']; ?> </td>
                        <td class='align-top'><a href="<?= base_url();?>cetak/surat_perintah_kerja/<?= $row['idBatch'];?>/2/<?= $row['idJP_used'];?>" class="btn btn-warning" data-toggle='tooltip' title='cetak surat perintah kerja' target='blank'><i class="fa fa-print"></i></a></td>
                        <td class='align-top'>blm selesai</td>
                        <td class='align-top'><a href="" class="btn btn-primary" data-toggle='modal' data-target='#upload-<?= $row['idJP_used'];?>' data-toggle='tooltip' title='Upload pengujian dengan no. admin <?= $noAdm;?>'><i class="fa fa-upload"></i></a></td>
                        <!-- note -->
                    </tr>


                    <!-- Modal Upload -->
                    <div class="modal fade" id="upload-<?= $row['idJP_used'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Hasil Pengujian No. Admin <br> <?= $noAdm ;?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <label for="tgl_expiry_pengujian">Tanggal Kadaluarsa</label>
                                    <input type="date" name="tgl_expiry_pengujian" id="tgl_expiry_pengujian" class='form-control'>
                                    <label for="berkas">Upload Hasil Pengujian</label>
                                    <input type="file" name="berkas" id="berkas" class='form-control'>
                                    <i class="text-danger">*file pdf,doc,docx</i>
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