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
                        <td class='align-top'>
                            <?php $this->db->where('idJP_used', $row['idJP_used']) ; ?>
                            <?php $hasil_pengujian = $this->db->get('hasil_pengujian')->row_array() ; ?>
                            <?php if($hasil_pengujian) : ?>
                                <a href="" class="btn btn-success" data-toggle='modal' data-target='#ubah-<?= $row['idJP_used'];?>' data-toggle='tooltip' title='Ubah Hasil Pengujian dengan no. admin <?= $noAdm;?>'><i class="fa fa-edit"></i></a>
                            <?php else : ?>
                                <a href="" class="btn btn-primary" data-toggle='modal' data-target='#upload-<?= $row['idJP_used'];?>' data-toggle='tooltip' title='Upload pengujian dengan no. admin <?= $noAdm;?>'><i class="fa fa-upload"></i></a>
                            <?php endif ; ?>
                        </td>
                        <!-- note -->
                    </tr>


                    <!-- Modal Upload Simpen Hasil Pengujian -->
                    <div class="modal fade" id="upload-<?= $row['idJP_used'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload Hasil Pengujian No. Admin <br> <?= $noAdm ;?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="<?= base_url();?>__pengujian/simpan_hasil_pengujian/<?= $row['idJP_used']; ?>/<?= $row['idBatch'];?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name='noAdm' value='<?= $noAdm; ?>'>

                                        <label for="uji_yg_dilakukan">Uji Yang Dilakukan </label>
                                        <input type="text" name="uji_yg_dilakukan" id="uji_yg_dilakukan" class='form-control'>
                                        
                                        <label for="hasil">Hasil Pengujian </label>
                                        <input type="text" name="hasil" id="hasil" class='form-control'>

                                        <label for="acuan">Acuan </label>
                                        <input type="text" name="acuan" id="acuan" class='form-control'>

                                        <label for="syarat">Syarat </label>
                                        <input type="text" name="syarat" id="syarat" class='form-control'>

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

                    <?php if($hasil_pengujian) : ?>
                    <!-- Modal ubah Hasil Pengujian -->
                        <div class="modal fade" id="ubah-<?= $row['idJP_used'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Hasil Pengujian No. Admin <br> <?= $noAdm ;?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="<?= base_url();?>__pengujian/ubah_hasil_pengujian/<?= $hasil_pengujian['id_hasil_pengujian']; ?>/<?= $row['idBatch'];?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name='noAdm' value='<?= $noAdm; ?>'>

                                            <label for="uji_yg_dilakukan">Uji Yang Dilakukan </label>
                                            <input type="text" name="uji_yg_dilakukan" id="uji_yg_dilakukan" class='form-control' value='<?= $hasil_pengujian['uji_yg_dilakukan'];?>'>
                                            
                                            <label for="hasil">Hasil Pengujian </label>
                                            <input type="text" name="hasil" id="hasil" class='form-control' value='<?= $hasil_pengujian['hasil'];?>'>

                                            <label for="acuan">Acuan </label>
                                            <input type="text" name="acuan" id="acuan" class='form-control' value='<?= $hasil_pengujian['acuan'];?>'>

                                            <label for="syarat">Syarat </label>
                                            <input type="text" name="syarat" id="syarat" class='form-control' value='<?= $hasil_pengujian['syarat'];?>'>

                                            <label for="tgl_expiry_pengujian">Tanggal Kadaluarsa</label>
                                            <input type="date" name="tgl_expiry_pengujian" id="tgl_expiry_pengujian" class='form-control' value='<?= $hasil_pengujian['tgl_kadaluarsa_sample'];?>'>
                                            
                                            <label for="berkas">Upload Hasil Pengujian</label>
                                            <input type="file" name="berkas" id="berkas" class='form-control'>
                                            <i class="text-danger">*file pdf,doc,docx <br> *tambahkan berkas jika ingin ubah berkas hasil pengujian</i>

                                            <label for="">Hasil Pengujian</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif ; ?>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>