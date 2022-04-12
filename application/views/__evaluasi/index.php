<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?= $this->session->flashdata('warna') ;?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?>

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
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target='#noEvaluasi<?= $row['idBatch'];?>' data-toggle='tooltip' title='Evaluasi Dokumen'>
                                <i class="fa fa-pen"></i>
                            </button>
                        </td>
                        

                        <!-- Modal Evaluasi -->
                            <div class="modal fade" id="noEvaluasi<?= $row['idBatch'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Penomoran Evaluasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php $hasil_evaluasi = $this->__Evaluasi_model->getHasilEvaluasi($row['idBatch']) ; ?>
                                    <?php if($hasil_evaluasi) : ?>
                                        <form action="<?= base_url();?>__evaluasi/ubahPenomoranEvaluasi" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name='idBatch' value='<?= $row['idBatch'];?>'>
                                                <input type="hidden" name='id_hasil_evaluasi' value='<?= $hasil_evaluasi['id_hasil_evaluasi'];?>'>
                                                <label for="nomor_ceklis">Nomor Ceklis</label>
                                                <input type="text" name="nomor_ceklis" id="nomor_ceklis" class='form-control' value="<?= $hasil_evaluasi['nomor_ceklis'] ;?>">
                                                <label for="tgl_expiry">tanggal Kadaluarsa</label>
                                                <input type="date" name="tgl_expiry" id="tgl_expiry" class='form-control' value='<?= $hasil_evaluasi['tgl_expiry'] ;?>'> <br>
                                                <button type="submit" class="btn btn-primary" data-toggle='tooltip' title='Ubah Penomoran'>Ubah</button>
                                                <a href="<?= base_url();?>__evaluasi/hapusPenomoranEvaluasi/<?= $hasil_evaluasi['id_hasil_evaluasi'];?>/<?= $row['idBatch'];?>" class="btn btn-danger" onclick='return confirm("Hapus Penomoran Evaluasi");'>Hapus</a>
                                                <a href="<?= base_url();?>cetak/form_evaluasi/<?= $row['idJenisSample'];?>/<?= $row['idBatch'];?>" class="btn btn-warning" target='blank'>Cetak Hasil Evaluasi</a>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?= base_url();?>Evaluasi/form/<?= $row['idJenisSample'];?>/<?= $row['idBatch'];?>" class="btn btn-primary" data-toggle='tooltip' title='Mulai Evaluasi Dokumen'>Mulai Evaluasi Dokumen</a>
                                            </div>
                                        </form>
                                    <?php else : ?>
                                        <form action="<?= base_url();?>__evaluasi/simpanPenomoranEvaluasi" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name='idBatch' value='<?= $row['idBatch'];?>'>
                                                <label for="nomor_ceklis">Nomor Ceklis</label>
                                                <input type="text" name="nomor_ceklis" id="nomor_ceklis" class='form-control' placeholder='F/BIO/9999'>
                                                <label for="tgl_expiry">tanggal Kadaluarsa</label>
                                                <input type="date" name="tgl_expiry" id="tgl_expiry" class='form-control'> <br>
                                                <button type="submit" class="btn btn-primary" data-toggle='tooltip' title='Simpan Penomoran'>Simpan</button>
                                                <br>
                                                <i class="text-danger">*simpan setelah selesai evaluasi dokumen</i>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?= base_url();?>Evaluasi/form/<?= $row['idJenisSample'];?>/<?= $row['idBatch'];?>" class="btn btn-primary" data-toggle='tooltip' title='Mulai Evaluasi Dokumen'>Mulai Evaluasi Dokumen</a>
                                            </div>
                                        </form>
                                    <?php endif ; ?>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal Evaluasi -->
                    </tr>

                    
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>