<div id="pembayaran">
    <?php $verify_berkas= false ; ?>
    <?php $verify_sample = false ; ?>
    <?php $verify_bayar = false ; ?>
    <?php $aksi_pembayaran = 9 ; ?>


    <?php $verifikasi_sample = $this->Petugas_model->getVerifikasiSample($id) ;?>
    <?php if($verifikasi_sample) : ?>
        
        <?php if($verifikasi_sample['status_verifikasi_sample'] == 1) : ?>
            <?php $verify_sample = true ; ?>
        <?php else : ?>
            <?php $verify_sample = false ; ?>
        <?php endif ; ?>

    <?php else : ?>

        <?php $verify_sample = false ; ?>

    <?php endif ; ?>

    <?php if($idJenisManufacture <= 2) : ?>

        <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($id) ;?>

        <?php if($verifikasi_berkas) : ?>
        
            <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                <?php $verify_berkas = true ; ?>
            <?php else : ?>
                <?php $verify_berkas = false ; ?>
            <?php endif ; ?>

        <?php else : ?>

            <?php $verify_berkas = false ; ?>

        <?php endif ; ?>

        <?php if($verifikasi_sample == true && $verifikasi_berkas) : ?>
            <?php $verify_bayar = true ; ?>
        <?php else : ?>
            <?php $verify_bayar = false ; ?>
        <?php endif ; ?>

    <?php else : ?>

        <?php if($verifikasi_sample == true) : ?>
            <?php $verify_bayar = true ; ?>
        <?php else : ?>
            <?php $verify_bayar = false ; ?>
        <?php endif ; ?>

    <?php endif ; ?>


    <br>

    <div class="card p-2">
        <div class="row d-flex justify-content-between">
            <div class="col-md-11"><h3>Pembayaran</h3></div>
            <div class="col-md-1"><button class="btn btn-info"><i class="fa fa-sync" data-toggle='tooltip' title='Refresh' id="refresh-pembayaran"></i></button></div>
        </div>
        
        <?php if($verify_bayar == true) : ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-2">
                        <h5>Biling Pembayaran</h5>
                        <?php if(!empty($this->session->flashdata('pesan_bayar') )) : ?>
                                    
                            <div class="alert alert-<?= $this->session->flashdata('warna_bayar') ?> alert-dismissible fade show" role="alert">
                                <?=  $this->session->flashdata('pesan_bayar'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php endif ; ?>
                        <?php $pembayaran = $this->Petugas_model->getVerifikasiPembayaran($id) ; ?>
                        <?php if($pembayaran) : ?>
                            <?php $aksi_pembayaran = $pembayaran['status_verifikasi_bayar'] ; ?>
                            <div class="row">
                                <div class="col">
                                    <a class='btn btn-primary' href="<?= base_url(); ?>assets/file-upload/biling/file-biling/<?= $pembayaran['kode_biling'];?>" data-toggle='tooltip' title='Tampilkan' target='blank'>
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <?php if($aksi_pembayaran == 3) : ?>
                                        
                                        <a class='btn btn-danger' href="#" data-toggle='tooltip' title='Hapus biling' target='blank' id='hapus-pembayaran'>
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        <script>
                                             $("#hapus-pembayaran").click(function(e){
                                                if( confirm("Hapus biling") ) {
                                                    e.preventDefault();
                                                        $.ajax({
                                                            url: '<?= base_url(); ?>petugas/hapus_pembayaran/<?= $id ;?>/<?= $idJenisManufacture ;?>/<?= $pembayaran['idBuktiBayar'];?>',
                                                            type: 'post',
                                                            data: $(this).serialize(),             
                                                            success: function(data) {               
                                                                $('#pembayaran').html(data) ;      
                                                            }
                                                        });
                                                }else{
                                                    return false;
                                                }
                                            });
                                        </script>

                                    <?php endif ; ?>
                                </div>
                            </div>
                            <iframe src="<?= base_url(); ?>assets/file-upload/biling/file-biling/<?= $pembayaran['kode_biling'];?>" frameborder="0" height="250px" width='100%'></iframe>

                        <?php else : ?>
                            <form enctype="multipart/form-data" method="post" id='uploadBiling' >
                                <label for="berkas">Upload Biling Pembayaran</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="berkas" id="berkas" class='form-control'>
                                    <div class="input-group-append">
                                        <button type='submit' class="btn btn-outline-primary"><i class="fa fa-upload"></i></button>
                                    </div>
                                </div>
                                <i class="text-danger">*file pdf,jpg,png</i>
                            </form>
                        <?php endif ; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php if($aksi_pembayaran != 9) : ?>
                        <div class="card p-2">
                            <div class="row">
                                <div class="col">

                                    <h5>Pembayaran</h5>

                                    <table cellpadding=2 cellspacing=2>
                                        <tr>
                                            <th valign='top'>Tanggal Kirim Biling</th>
                                            <th valign='top'>:</th>
                                            <td valign='top'> <?= $this->_Date->formatTanggal( $pembayaran['tgl_kode_biling'] ); ?> (<?= $pembayaran['jam_kode_biling']; ?>)</th>
                                        </tr>

                                        <?php if($aksi_pembayaran == 0) : ?>
                                            <i class="text-warning"> verifikasi Pembayaran </i>  
                                        <?php elseif($aksi_pembayaran == 1) : ?>
                                            <i class="text-success"> Pembayaran Sesuai </i>
                                        <?php elseif($aksi_pembayaran == 2) : ?>
                                           <i class="text-danger"> Pembayaran Tidak Sesuai - Verifikasi Ulang / Menunggu User Upload Data Kembali </i>
                                        <?php else : ?>
                                            <i class="text-info"> Menunggu Pembayaran </i>
                                        <?php endif ; ?>
        

                                        <?php if($aksi_pembayaran != 3) : ?>
                                            <tr>
                                                <th valign='top'>Tanggal Pembayaran</th>
                                                <th valign='top'>:</th>
                                                <td valign='top'> <?= $this->_Date->formatTanggal( $pembayaran['tgl_bayar'] ); ?> (<?= $pembayaran['jam_bayar']; ?>)</th>
                                            </tr>
                                            <tr>
                                                <th valign='top'></th>
                                                <th valign='top'></th>
                                                <td valign='top'>
                                                    <a href="<?= base_url(); ?>/assets/file-upload/biling/bukti-bayar/<?= $pembayaran['fileBuktiBayar'];?>" target='blank' data-toggle='tooltip' title='Tampilkan Bukti Bayar' class="btn btn-secondary"> <i class="fa fa-file"></i> </a>
                                                </th>
                                            </tr>
                                        <?php endif ; ?>

                                        <?php if($aksi_pembayaran == 1 || $aksi_pembayaran == 2) : ?>
                                            <tr>
                                                <th valign='top'>Tanggal Verifikasi</th>
                                                <th valign='top'>:</th>
                                                <td valign='top'> <?= $this->_Date->formatTanggal( $pembayaran['tgl_verifikasi_pembayaran'] ); ?> (<?= $pembayaran['jam_verifikasi_bayar']; ?>)</th>
                                            </tr>
                                        <?php endif ; ?>
                                        
                                        <?php if($aksi_pembayaran == 2 || $aksi_pembayaran == 0) : ?>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <button class="btn btn-success" data-toggle='tooltip' title='Pembayaran Sesuai' id="aksi_pembayaran_terima"><i class="fa fa-check"></i></button>
                                                    <button class="btn btn-danger" data-toggle='tooltip' title='Pembayaran Tidak Sesuai' id="aksi_pembayaran_tolak"><i class="fa fa-times"></i></button>
                                                </th>
                                            </tr>                                    
                                        <?php endif ; ?>
                                        
                                    </table>

                                    <br>

                                    <div id="form_pembayaran_tolak">
                                        <form method='post' id='form_tolak'>
                                            <label for="ket"><i class="text-danger"> Keterangan Pembayaran Tidak Sesuai </i></label>
                                            <textarea name="ket" id="ket" cols="30" rows="7" class='form-control'></textarea> 

                                            <br>

                                            <button type='submit' class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                             
                        </div>

                        <script>
                            $(document).ready(function(){

                                $("#form_pembayaran_tolak").hide() ;

                                $("#aksi_pembayaran_terima").click(function(e){
                                    if(confirm("Pembayaran Sesuai?")) {
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>petugas/aksi_pembayaran/<?= $id ;?>/<?= $idJenisManufacture;?>/<?= $pembayaran['idBuktiBayar'];?>/1',
                                            type: 'post',
                                            data: $(this).serialize(),             
                                            success: function(data) {               
                                                $('#pembayaran').html(data) ;      
                                            }
                                        });
                                    }else{
                                        return false ;
                                    }
                                });
    
                                $("#aksi_pembayaran_tolak").click(function(){
                                    $("#form_pembayaran_tolak").show() ;

                                    $("#form_tolak").submit(function(e){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>petugas/aksi_pembayaran/<?= $id ;?>/<?= $idJenisManufacture;?>/<?= $pembayaran['idBuktiBayar'];?>/2',
                                            type: 'post',
                                            data: $(this).serialize(),             
                                            success: function(data) {               
                                                $('#pembayaran').html(data) ;      
                                            }
                                        });
                                    }) ;
                                }) ;

                            }) ;
                        </script>
                    <?php endif ; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="card p-2">
                <i class="text-warning">Menunggu Verifikasi Selesai</i>
            </div>
        <?php endif ; ?>
    </div>
</div>

<script>
    $("#uploadBiling").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?= base_url(); ?>petugas/uploadBiling/<?= $id ;?>/<?= $idJenisManufacture;?>',
            type: 'post',
            data: new FormData(this), //ajax untuk upload
            processData:false,
            contentType:false,
            cache:false, 
            async:false, //ajax untuk upload            
            success: function(data) {               
                $('#pembayaran').html(data) ;      
            }
        });
    }) ;

    $("#refresh-pembayaran").click(function(){
        $('#pembayaran').load("<?= base_url(); ?>petugas/ver_pembayaran/<?= $id;?>/<?= $idJenisManufacture;?>") ;
    }) ;
</script>