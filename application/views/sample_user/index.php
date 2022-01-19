<div class="card p-3">
<div class="row">
    <div class="col-md-1">
        <a href="<?= base_url(); ?>sample_/tambah/<?= $id; ?>" class="btn btn-primary" data-toggle="tooltip" title="Tambah Sampel"><i class="fa fa-pen"></i></a>
    </div>
    <div class="col-md-6">
        <form action="" post>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pencarian" >
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div><!-- col 1 --> 
</div><!-- row 1 --> 

<?php if(!empty($this->session->flashdata('pesan') )) : ?>
    
    <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?>

<?php if(!empty($this->session->flashdata('pesanImportir') )) : ?>
    
    <div class="alert alert-<?=  $this->session->flashdata('warnaImportir'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesanImportir'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?> 
<br>
<div class="table-responsive">
<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th class='align-middle'>No</th>
            <th class='align-middle'>Nama Sample / Produk</th>
            <th class='align-middle'>Nama Perusahaan</th>
            <th class='align-middle'>Jenis Perusahaan</th>
            <th class='align-middle'>No MA</th>
            <th class='align-middle'>Jumlah Batch</th>
            <th class='align-middle'>Tanggal Pengiriman</th>
            <th class='align-middle'>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php foreach ($sample as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['namaSample'];?> <br>( <?= $row['jenisSample']; ?> )</td>
                <td>
                    <?php if($row['idJenisManufacture'] == 2)  : ?>
                        <?= $row['namaImportir']; ?> <br>
                        ( <?= $row['namaEU']; ?> Imported)
                    <?php else : ?>
                        <?= $row['namaEU']; ?>
                    <?php endif ; ?>
                </td>
                
                <td>
                        <?= $row['namaJenisManufacture']; ?> <br> ( <?= $row['namaJenisDokumen']; ?> )
                </td>

                <td> <?= $row['noMA']; ?> </td>
                <td>
                    <?php if($batch = $this->User_Sample_model->getBatch($row['idSample']) ) : ?>
                        <?= $batch; ?> <br>
                    <?php else : ?>
                        0
                    <?php endif ; ?>
                </td>
                <td><?= $this->_Date->formatTanggal( $row['tgl_pengiriman'] ); ?></td>
                <td>
                    <a href="<?=base_url();?>sample_/batch_add/<?= $row['idSurat']; ?>/<?= $row['idSample'];?>" class="badge badge-primary" data-toggle='tooltip' title='Lengkapi Dokumen'>
                        <i class="fa fa-pen"></i>
                    </a>

                    
                    <?php $petugas = $this->User_Sample_model->getInfoPetugas($row['idSample']) ; ?>
                    <?php if($petugas == 0) : ?>
                        <a href="#" class="badge badge-success" data-toggle='modal' data-target='#edit<?= $row['idSample'];?>' data-toggle='tooltip' title='Ubah Data Sample'> <i class="fa fa-edit"></i> </a>
                        <a href="<?= base_url() ; ?>sample_/hapus/<?= $row['idSurat']; ?>/<?= $row['idSample']; ?>" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data Sample" onclick="return confirm(' Apakah Anda Yakin ? ');"> <i class="fa fa-trash"></i> </a>
                    <?php else : ?>
                        <!-- nanti di ganti informasi pekerjaan diganti -->
                        <a href="#" class="badge badge-warning" data-toggle='tooltip' title='Riwayat Pekerjaan'> <i class="fa fa-clipboard"></i> </a>
                    <?php endif ; ?>
                    <!-- informasi pekerjaan -->
                    <a href="#" class="badge badge-warning" data-toggle="modal" data-target="#informasi<?= $row['idSample'] ;?>" data-toggle='tooltip' title='Riwayat Pekerjaan'> <i class="fa fa-clipboard"></i> </a>

                    <!-- bukti bayar -->
                    <?php if($batch > 0) : ?>
                        <?php if($this->User_Sample_model->cekBuktiBayar($row['idSample'])) : ?>
                            <a href='#' data-toggle='tooltip' title='sudah upload bukti bayar' class='badge badge-success' > <i class="fa fa-check"></i> </a>
                        <?php else : ?>
                            <a href='#' data-toggle="modal" data-target="#pembayaran<?= $row['idSample'] ;?>" data-toggle='tooltip' title='upload bukti pembayaran bayar' class='badge badge-secondary'> <i class="fa fa-upload"></i> </a>
                        <?php endif ; ?>
                    <?php endif ; ?>
                </td>

                <!-- bukti bayar -->
                    <div class="modal fade" id="pembayaran<?= $row['idSample']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> <label for="berkas"> Upload Bukti Bayar </label></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- form bukti bayar -->
                            <form action="<?= base_url(); ?>sample_/uploadBuktiBayar/<?= $row['idSample']; ?>/<?= $row['idSurat'];?>" method='post' class='myform' enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="berkas" name='berkas' >
                                        <b class='text-danger'>*tipe file pdf,jpg,jpeg,png</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                            <!-- form bukti bayar -->
                            </div>
                        </div>
                    </div>
                <!-- bukti bayar -->


                <!-- Modal Edit -->
                    <div class="modal fade" id="edit<?= $row['idSample'] ; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Sampel <br> <?= $row['namaSample']; ?> ( <?= $row['jenisSample']; ?> )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="<?= base_url(); ?>sample_/editDataSample/<?= $row['idSurat'] ;?>">
                                    <div class="modal-body">
                                        <input type="hidden" name='id' value='<?= $row['idSample']; ?>'>
                                        <label for="nama">Nama Sampel / Produk</label>
                                        <input type="text" name="nama" id="nama" class='form-control' value='<?= $row['namaSample']; ?>'>
                                        <label for="js">Jenis Sampel</label>
                                        <select name="js" id="js" class="form-control">
                                            <?php foreach ($jenisSample =  $this->db->get('_jenisSample')->result_array() as $js) : ?>
                                                <?php if($js['idJenisSample'] == $row['idJenisSample']) : ?>
                                                    <option selected value="<?= $js['idJenisSample']; ?>">
                                                        <?= $js['jenisSample']; ?> ( <?= $js['waktuPengujian']; ?> Hari Kerja )
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?= $js['idJenisSample']; ?>">
                                                        <?= $js['jenisSample']; ?> ( <?= $js['waktuPengujian']; ?> Hari Kerja )
                                                    </option>
                                                <?php endif ; ?>
                                            <?php endforeach ; ?>
                                        </select>

                                        <label for="jp">Jenis Perusahaan</label>
                                        <select name="jp" id="jp" class="form-control">
                                            <?php foreach ($jenisPerusahaan =  $this->db->get('_jenisManufacture')->result_array() as $jp) : ?>
                                                <?php if($jp['idJenisManufacture'] == $row['idJenisManufacture']) : ?>
                                                    <option selected value="<?= $jp['idJenisManufacture']; ?>">
                                                        <?= $jp['namaJenisManufacture']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?= $jp['idJenisManufacture']; ?>">
                                                        <?= $jp['namaJenisManufacture']; ?>
                                                    </option>
                                                <?php endif ; ?>
                                            <?php endforeach ; ?>
                                            <script>
                                                $('#jp').change(function () {
                                                    var option_value = $(this).val();
                                                    if(option_value == '1') {
                                                        $('#jenisPerusahaan').html(``);
                                                    }else{
                                                        $('#jenisPerusahaan').html(`
                                                            <div class="card p-2 mb-2 mt-2 text-danger">
                                                                <div class="card-header">
                                                                    <span> <i class='fa fa-info-circle'></i> </span> keterangan
                                                                </div>
                                                                <div class="card-body">
                                                                    anda harus upload data dukung baru
                                                                </div>
                                                            </div>`
                                                        );
                                                    }
                                                });
                                            </script>
                                        </select>

                                        <div id="jenisPerusahaan"></div>

                                        <label for="jd">Jenis Dokumen</label>
                                        <select name="jd" id="jd" class="form-control">
                                            <?php foreach ($jenisDokumen =  $this->db->get('_jenisDokumen')->result_array() as $jd) : ?>
                                                <?php if($jd['idJenisDokumen'] == $row['idJenisDokumen']) : ?>
                                                    <option selected value="<?= $jd['keteranganDokumen'].'|'.$jd['idJenisDokumen']; ?>">
                                                        <?= $jd['namaJenisDokumen']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?= $jd['keteranganDokumen'].'|'.$jd['idJenisDokumen']; ?>">
                                                        <?= $jd['namaJenisDokumen']; ?>
                                                    </option>
                                                <?php endif ; ?>
                                            <?php endforeach ; ?>
                                        </select>

                                        <script>
                                                $('#jd').change(function () {
                                                    var value_dok = $(this).val();
                                                    var jDokumen = value_dok.split("|") ;
                                                    if(jDokumen[0] == '') {
                                                        $('#jenisDokumen').html(``);
                                                    }else{
                                                        $('#jenisDokumen').html(`
                                                            <div class="card p-2 mb-2 mt-2 text-info">
                                                                <div class="card-header">
                                                                    <span> <i class='fa fa-info-circle'></i> </span> keterangan
                                                                </div>
                                                                <div class="card-body">
                                                                    `+jDokumen[0]+`
                                                                </div>
                                                            </div>`
                                                        );
                                                    }
                                                });
                                            </script>
                                        </select>

                                        <div id="jenisDokumen"></div>

                                        <label for="noMA">Nomer MA (Marketing Authorization)</label>
                                        <input type="number" name="noMA" id="noMA" name='noMA' class='form-control' placeholder='Nomer MA (Marketing Authorization)' value='<?= $row['noMA'];?>'> 
                                        
                                        <label for="tanggal">Nomer MA (Marketing Authorization)</label>
                                        <input type="date" name="tanggal" id="tanggal" name='tanggal' class='form-control' value='<?= $row['tgl_pengiriman'];?>'> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- Modal Edit -->

                <!-- informasi pekerjaan  -->
                    <div class="modal fade" id="informasi<?= $row['idSample'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Informasi Pekerjaan Sample <br> <?= $row['namaSample']; ?> ( <?= $row['jenisSample']; ?> )
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="cobaTampil<?= $row['idSample']; ?>"></div>
                                    <script>
                                        $('#cobaTampil<?= $row['idSample']; ?>').load("<?= base_url() ;?>sample_/cobaTampil/<?= $row['idSample'] ;?>") ;
                                    </script>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- informasi pekerjaan  -->
        <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>