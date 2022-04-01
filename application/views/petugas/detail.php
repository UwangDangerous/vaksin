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
    <div class="card p-3">
        <div class="row">
            <div class="col">
                <h4>Petugas</h4> <br>
                <table cellpadding=2 cellspacing=2>
                    <tr>
                        <?php if($batch['idJenisManufacture'] == 1) : ?>

                            <?php if($batch['idJenisDokumen'] == 2) : ?>
                                <?php $evaluator = true ; ?>
                                <?php $pengujian = false ; ?>
                            <?php elseif($batch['idJenisDokumen'] == 3) : ?>
                                <?php $evaluator = true ; ?>
                                <?php $pengujian = true ; ?>
                            <?php else : ?>
                                <?php $evaluator = false ; ?>
                                <?php $pengujian = false ; ?>
                            <?php endif ; ?>

                        <?php elseif($batch['idJenisManufacture'] == 2) : ?>

                            <?php $evaluator = false ; ?>
                            <?php $pengujian = true ; ?>

                        <?php else : ?>

                            <?php $evaluator = false ; ?>
                            <?php $pengujian = true ; ?>

                        <?php endif ; ?>

                        <?php for($i = 3; $i <= 5 ; $i++ ):?>
                            <tr>
                                <?php if($i == 3) : ?>
                                    <?php $petugas = "Verifikator" ?>
                                    <?php $aktif = true ?>
                                <?php elseif($i == 4) : ?>
                                    <?php $petugas = "Evaluator" ?>
                                    <?php if($evaluator == true) : ?>
                                        <?php $aktif = true ?>
                                    <?php else : ?>
                                        <?php $aktif = false ?>
                                    <?php endif ; ?>
                                <?php else : ?>
                                    <?php $petugas = "Pengujian" ?>
                                    <?php if($pengujian == true) : ?>
                                        <?php $aktif = true ?>
                                    <?php else : ?>
                                        <?php $aktif = false ?>
                                    <?php endif ; ?>
                                <?php endif ; ?>
                                
                                <?php if($aktif == true) : ?>
                                    
                                    <th class='align-top'><?= $petugas; ?></th>
                                    <th class='align-top'>:</th>
                                    <td class='align-top'>
                                        <?php 
                                            $this->db->where('idBatch', $batch['idBatch']) ;
                                            $this->db->where('petugas.idTugas', $i) ;
                                            $this->db->join('inuser', 'inuser.idIU = petugas.idIU') ;
                                            $petugas_pengerjaan = $this->db->get('petugas')->row_array() ;

                                            if($i != 3){
                                                $this->db->where("idLevel = $i OR idLevel = 3");
                                            }else{
                                                $this->db->where('idLevel', $i);
                                            }
                                            // $this->db->where('idBatch', $batch['idBatch']) ;
                                            $inuser = $this->db->get('inuser')->result_array() ;
                                        ?>
                                        <?php if($petugas_pengerjaan) : ?>
                                            <form action="<?= base_url();?>petugas/ubahPetugas/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>/<?= $i;?>/<?= $petugas_pengerjaan['idPetugas'];?>" method="post">
                                                <div class="input-group mb-3">
                                                    <input type="hidden" name='idPetugas' value='<?= $petugas_pengerjaan['idPetugas'];?>'>
                                                    <select name="petugas<?= $i; ?>" class='form-control' style='width:400px'>
                                                        <option value="-">-pilih-</option>
                                                        <?php foreach ($inuser as $iu) : ?>
                                                            <?php if($iu['idIU'] == $petugas_pengerjaan['idIU']) : ?>
                                                                <option selected value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                            <?php endif ; ?>
                                                        <?php endforeach ; ?>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success" type="submit" id="button-addon2" data-toggle='tooltip' title='Ubah Data Petugas <?= $petugas; ?>'><i class="fa fa-edit"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php else : ?>
                                            <form action="<?= base_url();?>petugas/tambahPetugas/<?= $batch['idSurat'];?>/<?= $batch['idSample'];?>/<?= $batch['idBatch'];?>/<?= $i; ?>" method="post">
                                                <div class="input-group mb-3">
                                                    <select name="petugas<?= $i; ?>" class='form-control' style='width:400px'>
                                                        <option value="-">-pilih-</option>
                                                        <?php foreach ($inuser as $iu) : ?>
                                                            <option value="<?=$iu['idIU'] ;?>"><?= $iu['namaIU']; ?></option>
                                                        <?php endforeach ; ?>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary" type="submit" id="button-addon2" data-toggle='tooltip' title='Simpan Data Petugas <?= $petugas; ?>'><i class="fa fa-save"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif ; ?>
                                    </td>
                                <?php endif ; ?>
                            </tr>
                        <?php endfor ; ?>
                </table>
            </div>
        </div>
    </div>
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
    });
</script>

<script>
    $(document).ready(function(){
        $("#respon_tanggapan").load("<?= base_url();?>home/respon_tanggapan/<?= $batch['idBatch'];?>") ;
    });
</script>