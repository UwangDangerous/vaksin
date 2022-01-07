<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 

    <form action="" method='post' > <!-- enctype="multipart/form-data" class='myform' --> 
        <input type="hidden" name='id' value="<?= $id; ?>"> 
        <!-- nama sempel --> 
        <div class="form-group">
            <label for="nama">Nama Sampel / Produk</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama Sampel / Produk" name='nama' value="<?= set_value('nama'); ?>" >
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama'); ?></small>
        </div>

        <div class="row">
            <div class="col-md-6">

                <!-- jenis sampel -->
                <div class="form-group">
                    <label for="js">Jenis Sampel</label>
                    <select class="form-control" id='js'  name='js'>
                        <option value=''>-pilih-</option>
                        <?php foreach ($jenisSample as $js) : ?>
                            <option value="<?= $js['idJenisSample']; ?>"> <?= $js['jenisSample']; ?> ( <?= $js['waktuPengujian']; ?> Hari Kerja ) </option>
                        <?php endforeach ; ?>
                    </select>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('js'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- jenis dokumen -->
                <div class="form-group">
                    <label for="jd">Jenis Dokumen</label>
                    <select class="form-control" id='jd'  name='jd'>
                        <option value=''>-pilih-</option>
                        <?php foreach ($jenisDokumen as $jd) : ?>
                            <option value="<?= $jd['idJenisDokumen']; ?>|<?= $jd['keteranganDokumen']; ?>|<?= $jd['idProses']; ?>"> 
                                <?= $jd['namaJenisDokumen']; ?> 
                            </option>
                        <?php endforeach ; ?>
                    </select>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('jd'); ?></small>
                </div>

                <script>
                    $('#jd').change(function () {
                        var option_value = $(this).val();
                        var jDokumen = option_value.split("|") ;
                        if(jDokumen[0] == '') {
                            $('#jenisDokumen').html(``);
                        }else{
                            $('#jenisDokumen').html(`
                                <div class="card p-2 mb-2 text-info">
                                    <div class="card-header">
                                        <span> <i class='fa fa-info-circle'></i> </span> keterangan
                                    </div>
                                    <div class="card-body">
                                        `+jDokumen[1]+`
                                    </div>
                                </div>
                                <input type='hidden' value='`+jDokumen[2]+`' name='proses'> 
                            `);
                        }
                    });
                </script>
                
                    <div id="jenisDokumen"></div>
                

            </div>


            <div class="col-md-6">

                <!-- jenis perusahaan -->
                <div class="form-group">
                    <label for="jm">Jenis Perusahaan</label>
                    <select class="form-control" id='jm'  name='jm'>
                        <option value=''>-pilih-</option>
                        <?php foreach ($jenisManufacture as $jm) : ?>
                            <option value="<?= $jm['idJenisManufacture']; ?>"> <?= $jm['namaJenisManufacture']; ?> </option>
                        <?php endforeach ; ?>
                    </select>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('jd'); ?></small>
                </div>

            </div>

            <div class="col-md-6">

                <!-- no ma -->
                <div class="form-group">
                    <label for="noMA">Nomer MA (Marketing Authorization)</label>
                    <input type="text" class="form-control" id="noMA" placeholder="Nomer MA (Marketing Authorization)" name='noMA' value="<?= set_value('noMA'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('noMA'); ?></small>
                </div>

            </div>

            <!-- tanggal penerimaan -->
            <div class="col-md-6">

                <div class="form-group">
                    <label for="tanggal">Tanggal Pengiriman Sample</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Pengiriman" name='tanggal' value="<?= set_value('tanggal'); ?>" >
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                </div>

            </div>
        </div>

        <br><br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>