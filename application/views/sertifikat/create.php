<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <div class="row p-2 justify-content-between">
        <div class="col-md-11">
            <table cellpadding='3'>
                <tr>
                    <th>Nama Surat</th>
                    <td>:</td>
                    <td><?= $judulSurat; ?></td>
                </tr>
                <tr>
                    <th>Pengirim</th>
                    <td>:</td>
                    <td><?= $pengirim; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <form action="<?= base_url(); ?>sertifikat/buatSertifikat" method='post'>
        <input type="hidden" name='id' value='<?= $id ; ?>'>
        <input type="hidden" name='no1' value='<?= "PP.01.01.02i.11.111.".date('d.m.y').'.';  ?>'>
        <div class="row">
            <div class="col-md-8">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">PP.01.01.02i.11.111. <?= date('d.m.y'); ?>.</span>
                    </div>
                    <input type="text" class="form-control" placeholder="No Sertifikat" name='no2'>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" onclick="return confirm('yakin?');">Buat Sertifikat</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="table-responsive ">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Nama Sample</th>
                        <th class="align-middle">Jenis Sample</th>
                        <th class="align-middle">Vial Diterima</th>
                        <th class="align-middle">Tanggal Terima</th>
                        <th class="align-middle">Masa Berlaku</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Keterangan</th>
                        <th class="align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; $idSample = '' ;?>
                    <?php foreach ($sample as $row) : ?>
                        <?php $idSample .= $row['idSample'].',' ?>
                        <input type="hidden" name='idArray' value='<?= rtrim($idSample , ','); ?>'>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['namaSample']; ?></td>
                            <td><?= $row['namaJS']; ?></td>
                            <td>
                                <?php if($row['vialLolos'] == null) : ?>
                                    <p class="text-danger">Belum Evaluasi</p>
                                <?php else : ?>
                                    <?= $row['vialLolos']; ?>
                                    <?php $vial = explode(',' , $row['vialLolos']); ?>
                                    (@ <?= count($vial); ?> Vial)
                                <?php endif ; ?>
                            </td>
                            <td><?= $this->_Date->formatTanggal( $row['tgl_terima_sample'] ) ; ?></td>
                            <td>
                                <?php if( $row['tgl_expiry'] ) : ?>
                                    <?= $this->_Date->formatTanggal( $row['tgl_expiry'] ) ; ?>
                                <?php else : ?>
                                    <p class="text-danger">Belum Evaluasi</p>
                                <?php endif ; ?>
                            </td>
                            <?php if( $row['status'] ) : ?>
                                <td class="<?= $row['warna']; ?>">
                                    <?= $row['indo']  ; ?>
                                </td>
                            <?php else : ?>
                                <td>
                                    <p class="text-danger">Belum Verifikasi</p>
                                </td>
                            <?php endif ; ?>

                            <td>
                                <?php if( $row['status'] ) : ?>
                                        <?= $row['keterangan']  ; ?>
                                <?php else : ?>
                                    <p class="text-danger">Belum Verifikasi</p>
                                <?php endif ; ?>
                            </td>
                            <td>
                                <?php if( $row['status']) : ?>

                                    <?php if( $row['sertifikat'] == 1) : ?>
                                        <p class="text-success">Sertifikat Tersedia</p>
                                    <?php else : ?>
                                        <input type="checkbox" name='check<?= $row['idSample'] ; ?>' value='<?= $row['idVerifikasi']; ?>'>
                                    <?php endif ; ?>

                                <?php else : ?>
                                    <p class="text-danger">Belum Verifikasi</p>
                                <?php endif ; ?>
                            </td>

                            <!-- <td>
                                <a href="<?//= base_url(); ?>sample/cetak/<?//= $row['idSample']; ?>" class="badge badge-primary" target='blank'><i class="fa fa-print"></i></a>
                            </td> -->
                        </tr>
                    <?php endforeach ; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

