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
                    <th class='align-middle'>No</th>
                    <th class='align-middle'>Nama Sample</th>
                    <th class='align-middle'>Sample</th>
                    <th class='align-middle'>Jenis Dokumen</th>
                    <th class='align-middle'>Pengerjaan</th>
                    <th class='align-middle'>Dokumen</th>
                    <th class='align-middle'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaSample']; ?>( <?= $row['namaJenisManufacture']; ?> )</td>
                        <td><?= $row['jenisSample']; ?></td>
                        <td><?= $row['namaJenisDokumen']; ?></td>
                        <td>
                            <!-- public function pengerjaan($id, $lamaPengerjaan, $mulai, $jam ) -->
                            <!-- $this->_Date->pengerjaan($row['idSample'], $row['waktuPengujian'], ) -->
                            <?php 
                            if( $bukti = $this->Evaluasi_model->buktiBayar($row['idSample']) ) : ?>
                                <?php $pengerjaan = $this->_Date->pengerjaan($row['idSample'], $row['waktuPengujian'], $bukti['tgl_bayar'] , $bukti['jam_bayar'] ) ; ?>

                                <a href="#" data-toggle="modal" data-target="#exampleModalBukti<?= $row['idSample'];?>">
                                    <?= $pengerjaan['waktuBerjalan']; ?> dari <?= $pengerjaan['total']; ?>
                                </a>

                                <!-- Modal -->
                                <div class="d-flex text-left">
                                    <div class="modal fade" id="exampleModalBukti<?= $row['idSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Rincian Pengerjaan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <li>
                                                        Awal Pengerjaan <?= $this->_Date->formatTanggal( $pengerjaan['awalPengerjaan'] ); ?>
                                                    </li>
                                                    <li>
                                                        Lama Pengerjaan <?= $pengerjaan['lamaPengerjaan']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Libur Nasional / Libur Kerja Bpom <?= $pengerjaan['libur']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Penundaan / Clock Off <?= $pengerjaan['penundaan']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Total <?= $pengerjaan['total']; ?> Hari
                                                    </li>
                                                    <li>
                                                        Selesai <?= $this->_Date->formatTanggal( $pengerjaan['akhirPengerjaan'] ); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            <?php else : ?>
                                <i class="text-danger">Belum Melakukan Pembayaran</i>
                            <?php endif ; ?>
                        </td>
                        <td>

                            <div id="accordion">
                                <a href="" class="badge badge-success collapsed" data-toggle="collapse" data-target="#collapseTwo<?= $row['idSample'];?>" data-toggle='tooltip' title='Data Dukung'>
                                    <i class="fa fa-clone"></i>
                                </a>
                                <div id="collapseTwo<?= $row['idSample'];?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list-group d-flex text-left">
                                        <?php $dataDukung = $this->Evaluasi_model->getDataDukung($row['idSample']) ; ?>
                                        <?php foreach ($dataDukung as $dd) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= $dd['namaJenisDataDukung']; ?>
                                                <a href="<?= base_url(); ?>assets/file-upload/data-dukung/<?= $dd['fileDataDukung'];?>" class="badge badge-success" data-toggle='tooltip' title='Lihat Dokumen' target='blank'>
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            </li>
                                        <?php endforeach ; ?>
                                    </ul>
                                </div>
                                </div>
                            </div>

                        </td>
                        <td>
                            <?php if($evaluasi = $this->Evaluasi_model->getDataEvaluasi($row['idSample'])) : ?>
                                <a href="<?= base_url(); ?>evaluasi/tambahEvaluasi/<?= $row['idSample'];?>" class="badge badge-secondary" data-toggle='tooltip' title='Tambah Evaluasi'><i class="fa fa-file-signature"></i></a>
                            <?php else : ?>
                                <a href="<?= base_url(); ?>evaluasi/tambahEvaluasi/<?= $row['idSample'];?>" class="badge badge-primary" data-toggle='tooltip' title='Lihat Hasil Evaluasi'><i class="fa fa-pen"></i></a>
                            <?php endif ; ?>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>