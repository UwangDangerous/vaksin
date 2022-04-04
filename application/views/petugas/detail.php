<?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?= $this->session->flashdata('warna') ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
<?php endif ; ?>

<div class="card p-3">
    <div class="row">
        <div class="col-md-6">
            <table cellpadding=2 cellspacing=2>
                <tr>
                    <th class='align-top'>Nama Sampel / Produk</th>
                    <td class='align-top'>:</td>
                    <td><?= $batch['namaSample']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jenis Vaksin</th>
                    <td class='align-top'>:</td>
                    <td><?= $batch['jenisSample']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Nama Perusahaan</th>
                    <td class='align-top'>:</td> 
                    <?php if($batch['idJenisManufacture'] == 2) : ?>
                        <td><?= $batch['namaImportir']; ?> <br> ( Importir <?= $batch['namaEU']; ?> ) </td>
                    <?php else : ?>
                        <td> <?= $batch['namaEU']; ?> </td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th class='align-top'>Nomor Betch</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['noBatch']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jumlah Produksi</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['vial']; ?> ( <?= $batch['namaJenisKemasan']; ?> )</td>
                </tr>
                <tr>
                    <th class='align-top'>Dosis</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['dosis']; ?></td>
                </tr>
                <tr>
                    <th class='align-top'>Jenis Dokumen</th>
                    <td class='align-top'>:</td> 
                    <td><?= $batch['namaJenisDokumen']; ?></td>
                </tr>
            </table>
        </div>

        <div class="col-md-6">
            <table cellpadding=2 cellspacing=2 class='text-left'>

                <?php if($batch['idJenisManufacture'] == 2) : ?> <!-- impor -->
                    
                    <!-- pelulusan -->
                    <tr>
                        <th valign='top'>No. Adm. Pelulusan</th>
                        <th valign='top'>:</th>
                        <td valign='top'><div id="no_urut_pelulusan"></div></td>
                    </tr>
                    
                <?php elseif($batch['idJenisManufacture'] == 1) : ?> <!-- domestik -->

                    <!-- pelulusan -->
                    <tr>
                        <th valign='top'>No. Adm. Pelulusan</th>
                        <th valign='top'>:</th>
                        <td valign='top'><div id="no_urut_pelulusan"></div></td>
                    </tr>

                    <?php if($batch['idJenisDokumen'] == 3) : ?> <!-- non label -->
                        
                        <!-- pengujian -->
                        <tr>
                            <th valign='top'>No. Adm. Pengujian</th>
                            <th valign='top'>:</th>
                            <td valign='top'><div id="no_urut_pengujian"></div></td>
                        </tr>

                    <?php endif ; ?>
                    
                <?php else : ?>

                    <!-- pengujian -->
                    <tr>
                        <th valign='top'>No. Adm. Pengujian</th>
                        <th valign='top'>:</th>
                        <td valign='top'><div id="no_urut_pengujian"></div></td>
                    </tr>

                <?php endif ; ?>
            </table>

            <script>
                $("#no_urut_pelulusan").load("<?= base_url() ; ?>_NoAdm/no_adm_pelulusan/<?= $batch['idBatch'];?>") ;
                $("#no_urut_pengujian").load("<?= base_url() ; ?>_NoAdm/no_adm_pengujian/<?= $batch['idBatch'];?>/<?= $batch['idJenisManufacture'];?>")
            </script>
        </div>
    </div>
</div>

<!-- verifikasi pembayaran -->
    <div id="pembayaran"></div>

    <script>
        $("#pembayaran").load("<?= base_url() ;?>petugas/ver_pembayaran/<?= $batch['idBatch'];?>/<?= $batch['idJenisManufacture'];?>")
    </script>
<!-- verifikasi pembayaran -->



<br>

<!-- kelengkapan berkas dan sampel -->

    <div class="card p-3">
        <?php if($batch['idJenisManufacture'] == 2) : ?>
            <h4>Verifikasi Berkas</h4>
        <?php elseif($batch['idJenisManufacture'] == 1) : ?>
            <?php if($batch['idJenisDokumen'] == 2) : ?>
                <h4>Verifikasi Berkas</h4>
            <?php else : ?>
                <h4>Verifikasi Berkas dan Sampel</h4>
            <?php endif ; ?>
        <?php else : ?>
            <h4>Verifikasi Sampel</h4>
        <?php endif ; ?>
        
        <div id="kelengkapan-berkas"></div>
        
        <div id="kelengkapan-sample"></div>

        <script> 
            <?php if($batch['idJenisManufacture'] == 2) : ?> <!-- impor -->
                    $("#kelengkapan-berkas").load("<?= base_url(); ?>petugas/kelengkapan_berkas/<?= $batch['idBatch'];?>/<?= $batch['idJenisManufacture'];?>") ;
                    $("#kelengkapan-sample").load("<?= base_url(); ?>petugas/kelengkapan_sample/<?= $batch['idBatch'];?>") ;
                
            <?php elseif($batch['idJenisManufacture'] == 1) : ?> <!-- domesik label -->
                
                    $("#kelengkapan-berkas").load("<?= base_url(); ?>petugas/kelengkapan_berkas/<?= $batch['idBatch'];?>/<?= $batch['idJenisManufacture'];?>") ;
                    $("#kelengkapan-sample").load("<?= base_url(); ?>petugas/kelengkapan_sample/<?= $batch['idBatch'];?>") ;
                
            <?php else : ?>
                
                    $("#kelengkapan-sample").load("<?= base_url(); ?>petugas/kelengkapan_sample/<?= $batch['idBatch'];?>") ;

            <?php endif ; ?>
        </script>
    </div>


<!-- kelengkapan berkas dan sampel -->

<br>

<!-- petugas evaluasi dan verifikasi -->
<div id="petugas"></div>
<!-- petugas evaluasi dan verifikasi -->

<!-- riwayat dan respon tanggapan -->

    <div class="row mt-4">
        <div class="col-md-6">
            <!-- riwayat pekerjaan -->
            <div class="card p-2" >
                <div id="riwayat"></div>
            </div>
            <!-- riwayat pekerjaan -->
        </div>
        
        <div class="col-md-6">
            <!-- respon tanggapan -->
            <div class="card p-2">
                <div id="respon_tanggapan"></div>
            </div>
            <!-- respon tanggapan -->
        </div>
    </div>

<!-- riwayat dan respon tanggapan -->



<script>
    $(document).ready(function(){
        $("#riwayat").load("<?= base_url();?>home/riwayat/<?= $batch['idBatch'];?>") ;
        $("#respon_tanggapan").load("<?= base_url();?>home/respon_tanggapan/<?= $batch['idBatch'];?>") ;
        $("#petugas").load("<?= base_url();?>_petugas/index/<?= $batch['idBatch'];?>/<?= $batch['idJenisManufacture'];?>") ;
    });
</script>