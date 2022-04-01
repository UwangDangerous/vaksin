<?php $vs = false ; ?>
<div id="kelengkapan-sample" >
    <div class="row">
        <div class="col-md-6">
            <div class="card p-2">
                <h5>Penerimaan Sampel</h5> 
                <?php if(!empty($this->session->flashdata('pesan_sample') )) : ?>
                                    
                    <div class="alert alert-<?= $this->session->flashdata('warna_sample') ?> alert-dismissible fade show" role="alert">
                        <?=  $this->session->flashdata('pesan_sample'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ; ?>    
                <table>
                    <tr>
                        <th valign='top'>Jumlah sampel yang dikirim</th>
                        <th valign='top'>:</th>
                        <td valign='top'><?= $sample['pengiriman']; ?></td>
                    </tr>
                    <tr>
                        <th valign='top'>Kemasan </th>
                        <th valign='top'>: </th>
                        <td valign='top'>
                            <i><?= $sample['ingJenisKemasan']; ?></i> / <?= $sample['namaJenisKemasan']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th valign='top'>Suhu Sebelum Pengiriman</th>
                        <th valign='top'>: </th>
                        <td valign='top'>
                            <?= $sample['suhu']; ?>	&deg;<?= $sample['satuan']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th valign='top'>Tanggal Kadaluarsa</th>
                        <th valign='top'>: </th>
                        <td valign='top'>
                            <?= $this->_Date->formatTanggal( $sample['tgl_kadaluarsa'] ); ?>
                        </td>
                    </tr>
                    <?php if($verifikasi_sample) : ?>

                        <tr>
                            <th valign='top'>Jumlah sampel yang diterima</th>
                            <th valign='top'>:</th>
                            <td valign='top'><?= $verifikasi_sample['jumlah_sample']; ?></td>
                        </tr>
                        <tr>
                            <th valign='top'>Tanggal Kedatangan Sampel</th>
                            <th valign='top'>:</th>
                            <td valign='top'><?= $this->_Date->formatTanggal( $verifikasi_sample['tgl_kedatangan'] ); ?></td>
                        </tr>
                        <tr>
                            <th valign='top'>Pengiriman</th>
                            <th valign='top'>:</th>
                            <td valign='top'><?= $verifikasi_sample['jenis_pengiriman']; ?></td>
                        </tr>
                        <tr>
                            <th valign='top'>Keperluan Sampel</th>
                            <th valign='top'>:</th>
                            <td valign='top'>
                                <?php if($verifikasi_sample['keperluan_sample'] == 0) : ?>
                                    Disimpan
                                    <?php $vs = false ; ?>
                                <?php else : ?>
                                    <?php $vs = true ; ?>
                                    Pengujian
                                <?php endif ; ?>
                            </td>
                        </tr>
                        <tr>
                            <th valign='top'>Keterangan</th>
                            <th valign='top'>:</th>
                            <td valign='top'><?= $verifikasi_sample['keterangan_verifikasi_sample']; ?></td>
                        </tr>
                        <tr>
                            <th valign='top'>Tanggal Verifikasi</th>
                            <th valign='top'>:</th>
                            <td valign='top'><?= $this->_Date->formatTanggal( $verifikasi_sample['tgl_verifikasi_sample'] ); ?> (<?= $verifikasi_sample['jam_verifikasi_sample']; ?>)</td>
                        </tr>

                        <?php if($verifikasi_sample['status_verifikasi_sample'] == 1) : ?>
                            <tr><td colspan=3><i class="text-success">Sampel Sesuai</i></td></tr>
                        <?php else : ?>
                            <tr><td colspan=3><i class="text-danger">Sampel Tidak Sesuai - Konfirmasi ulang</i></td></tr>
                            <tr>
                            <th valign='top'>Verifikasi</th>
                            <th valign='top'>: </th>
                            <td valign='top'>
                                <button type='button' class="btn btn-success" data-toggle='tooltip' title='sampel sesuai' id='sample-sesuai'><i class="fa fa-check"></i></button>
                                <button class="btn btn-danger" data-toggle='tooltip' title='sampel tidak sesuai' id='sample-tidak-sesuai'><i class="fa fa-times"></i></button>
                            </td>
                        </tr>

                        <?php endif ; ?>

                    <?php else : ?>

                        <?php $vs = false ; ?>

                        <tr>
                            <th valign='top'>Verifikasi</th>
                            <th valign='top'>: </th>
                            <td valign='top'>
                                <button type='button' class="btn btn-success" data-toggle='tooltip' title='sampel sesuai' id='sample-sesuai'><i class="fa fa-check"></i></button>
                                <button class="btn btn-danger" data-toggle='tooltip' title='sampel tidak sesuai' id='sample-tidak-sesuai'><i class="fa fa-times"></i></button>
                            </td>
                        </tr>

                    <?php endif ; ?>
                </table>
                <div id="sample-sesuai-aksi"></div>
            </div>
        </div>

        <?php if($vs == true) : ?>
            <div class="col-md-6"> 
                <div id="pengujian-sample"></div>  

                <script>
                    $("#pengujian-sample").load("<?= base_url();?>petugas/pengujian_sample/<?= $id; ?>") ;
                </script>
            </div>
        <?php endif ; ?>
    </div>
</div>

<script>
    $("#sample-sesuai").click(function(){
        $("#sample-sesuai-aksi").load("<?= base_url();?>petugas/kelengkapan_sample_aksi/<?= $id;?>/sesuai/<?= $sample['idJenisManufacture'];?>/<?= $sample['idJenisDokumen'];?>") ;
    }) ;

    $("#sample-tidak-sesuai").click(function(){
        $("#sample-sesuai-aksi").load("<?= base_url();?>petugas/kelengkapan_sample_aksi/<?= $id;?>/tidak_sesuai/<?= $sample['idJenisManufacture'];?>/<?= $sample['idJenisDokumen'];?>") ;
    }) ;

    $("#tabel-pilih-pengujian").dataTable();
</script>