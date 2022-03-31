<div class="card mt-2 p-2">
    <?php if($status == 'sesuai') : ?>
        <i class="text-success">sampel sesuai</i>
    <?php else : ?>
        <i class="text-danger">sampel tidak sesuai</i>
    <?php endif ; ?>

    
    <form action="" method="post" id='simpan-verifikasi'>
        <label for="jml">Jumlah Sampel Saat Tiba</label>
        <input type="number" name="jml" id="jml" class='form-control'>

        <label for="suhu">Suhu Sampel Saat Tiba</label>
        <div class="row">
            <div class="col-6"><input type="number" name="suhu" id="suhu" class='form-control'></div>
            <div class="col-6">
                <select name="satuan" class='form-control'>
                    <option value="C">&deg; C</option>
                    <option value="F">&deg; F</option>
                    <option value="k">&deg; k</option>
                    <option value="R">&deg; R</option>
                </select>
            </div>
            <div class="col-6">
                <label for="tgl">Tanggal Kedatangan</label>
                <input type="date" name="tgl" id="tgl" class='form-control'>
            </div>
            <div class="col-6">
                <label for="pengiriman">Pengiriman</label>
                <select name="pengiriman" id="pengiriman" class='form-control'>
                    <option value="Datang Langsung">Datang Langsung</option>
                    <option value="Ekspedisi">Ekspedisi</option>
                </select>
            </div>
        </div>

        <?php if($idJenisManufacture == 2) : ?>
                    <input type="hidden" name='keperluan' value='0'>
                <?php elseif($idJenisManufacture == 1) : ?>

                    <?php if($idJenisDokumen == 2) : ?>
                        <input type="hidden" name='keperluan' value='0'>
                    <?php else : ?>
                        <label for="keperluan">Keperluan</label>
                        <select name="keperluan" id="keperluan" class='form-control'>
                            <option value="0">Disimpan</option>
                            <option value="1">Pengujian</option>
                        </select>
                    <?php endif ; ?>
                    
                <?php else : ?>
                    <label for="keperluan">Keperluan</label>
                    <select name="keperluan" id="keperluan" class='form-control'>
                        <option value="0">Disimpan</option>
                        <option value="1">Pengujian</option>
                    </select>
                <?php endif ; ?>



        <?php if($status == 'sesuai') : ?>
            <input type="hidden" name='ket' value='Sampel Sesuai'>
            <input type="hidden" name='status' value='1'>
        <?php else : ?>
            <label for="ket">Keterangan</label>
            <textarea rows=5 name="ket" id="ket" class='form-control'></textarea>
            <input type="hidden" name='status' value='2'>
        <?php endif ; ?>

        <br>
        
        <button class="btn btn-primary">simpan</button>
    </form>
</div>

<script>
    $("#simpan-verifikasi").submit(function(e){
        if(confirm("Verifikasi Kelengkapan Sampel?")){
                e.preventDefault();
                $.ajax({
                    url: '<?= base_url(); ?>petugas/simpan_kelengkapan_sample/<?= $id ;?>',
                    type: 'post',
                    data: $(this).serialize(),             
                    success: function(data) {               
                        $('#kelengkapan-sample').html(data) ;      
                    }
                });
        }else{
            return false;
        }
    }) ;
</script>

<!-- keperluan 0 = disimpan | 1 diuji -->

