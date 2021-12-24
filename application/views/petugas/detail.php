<div class="card p-3">
    <h4>Sample <?= $sample['namaSample']; ?> ( <?= $sample['jenisSample']; ?> )</h4>
    <div class="row p-3">
        <div class="col-md-6">
            <table cellpadding=2>
                <tr>
                    <th>Pengirim</th>
                    <td>:</td> 
                    <td><?= $sample['namaEU']; ?></td>
                </tr>

                <tr>
                    <th>Alamat Pengirim</th>
                    <td>:</td> 
                    <td><?= $sample['alamat']; ?></td>
                </tr>

                <tr>
                    <th>Keterangan</th>
                    <td>:</td> 
                    <td>
                        <?= $sample['namaSurat']; ?> <a href="<?= base_url(); ?>assets/file-upload/surat/<?= $sample['fileSurat']; ?>" target='blank' class="badge badge-secondary" data-toggle='tooltip' title='Lihat Surat'> <i class="fa fa-eye"></i> </a>
                    </td>
                </tr>

                <tr>
                    <th>Nama Perusahaan</th>
                    <td>:</td> 
                    <td><?= $sample['namaManufacture']; ?> ( <?= $sample['namaJenisManufacture']; ?> ) </td>
                </tr>

                <tr>
                    <th>Alamat Perusahaan</th>
                    <td>:</td> 
                    <td><?= $sample['alamatManufacture']; ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>:</td> 
                    <td><?= $sample['email']; ?></td>
                </tr>

                <tr>
                    <th>Dokumen</th>
                    <td>:</td> 
                    <td><?= $sample['namaJenisDokumen']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table cellpadding=2>
                 
                <tr>
                    <th>Tanggal Pengiriman Sample</th>
                    <td>:</td> 
                    <td> <?= $this->_Date->formatTanggal( $sample['tgl_pengiriman'] ); ?></td>
                </tr>

                <tr>
                    <th>Bukti Bayar</th>
                    <td>:</td> 
                    <td>
                        <?php if($bukti = $this->Petugas_model->getBuktiBayar($sample['idSample'])) : ?>
                            <?= $this->_Date->formatTanggal($bukti['tgl_bayar']); ?> <?= $bukti['jam_bayar']; ?>
                            <a href="<?= base_url(); ?>assets/file-upload/bukti-bayar/<?= $bukti['fileBuktiBayar']; ?>" target='blank' class="badge badge-secondary" data-toggle='tooltip' title='Lihat Bukti Bayar'> <i class="fa fa-eye"></i> </a>
                        <?php else : ?>
                            <i class="text-danger">Tidak Tersedia</i>
                        <?php endif ; ?>
                    </td>
                </tr>

                <tr>
                    <th>No Marketing Authorization (MA) </th>
                    <td>:</td> 
                    <td><?= $sample['noMA']; ?></td>
                </tr>

                <tr>
                    <td colspan=3>
                        <br>
                        <div id="accordion">
                                <h5 class="mb-0">
                                    <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Data Dukung
                                    </button>
                                </h5>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    
                                    <ul class="list-group">
                                        <?php $dataDukung = $this->Petugas_model->dataDukung($sample['idSample']) ; ?>
                                        <?php foreach ($dataDukung as $dd) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= $dd['namaJenisDataDukung']; ?>
                                                <a href="<?= base_url(); ?>assets/file-upload/data-dukung/<?= $dd['fileDataDukung']; ?>" data-toggle='tooltip' title='lihat data dukung <?= $dd['namaJenisDataDukung']; ?>' class="badge badge-primary"><i class="fa fa-eye"></i></a>
                                            </li>
                                        <?php endforeach ; ?>
                                    </ul>

                                </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card p-3 mt-3">
    <div class="d-flex justify-content-between">
        <h3>Riwayat Pengerjaan</h3>
        <a href="" class="btn btn-primary" data-toggle='tooltip' title='Kirim Pesan Data Kurang'><i class="fa fa-pen"></i></a>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mengirim Surat Pengajan</td>
                    <td><?=  $this->_Date->formatTanggal( $sample['tgl_kirim_surat'] ); ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mengirim Sample</td>
                    <td><?=  $this->_Date->formatTanggal( $sample['tgl_pengiriman'] ); ?></td>
                </tr>

                <?php if($bukti = $this->Petugas_model->getBuktiBayar($sample['idSample'])) : ?>
                    <tr>
                        <td>3</td>
                        <td>
                            Mengirim Bukti Bayar <a href="<?= base_url(); ?>assets/file-upload/bukti-bayar/<?= $bukti['fileBuktiBayar']; ?>" target='blank' class="badge badge-secondary" data-toggle='tooltip' title='Lihat Bukti Bayar'> <i class="fa fa-eye"></i> </a>
                        </td>

                        <td>
                            <?= $this->_Date->formatTanggal($bukti['tgl_bayar']); ?> <br> ( <?= $bukti['jam_bayar']; ?> )
                        </td>
                    </tr>

                    <?php $jam = explode(':',$bukti['jam_bayar']); ?>
                    <?php if($jam > 12) : ?>
                        <tr>
                            <td><?= $no = 4 ; ?></td>
                            <td>Mulai Pengerjaan</td>
                            <td> 
                                <?= $this->_Date->formatTanggal( date('Y-m-d', strtotime("+1 day", strtotime($bukti['tgl_bayar'])) ) );?>
                            </td>
                        </tr>
                    <?php endif ; ?>

                <?php else : ?>
                    <?php $no = 3 ?>
                <?php endif ; ?>

                <?php $riwayat = $this->Petugas_model->RiwayatPekerjaan($sample['idSample']);?>
                <?php foreach ($riwayat as $row) : ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $row['keterangan']; ?></td>
                        <td><?= $this->_Date->formatTanggal( $row['tgl_riwayat'] ); ?></td>
                    </tr>
                <?php endforeach ; ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>