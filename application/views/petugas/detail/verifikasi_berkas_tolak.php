<br>


<div class="card p-3">
    <form action="" method="post" id="tolak">
        <label for="ket">Keterangan <i class="text-danger">Data Dukung Tidak Sesuai</i></label>
        <textarea name="ket" id="ket" cols="30" rows="7" class="form-control"></textarea>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    $("#tolak").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?= base_url(); ?>petugas/aksi_kelengkapan_berkas/<?= $id ;?>/<?= $idJenisManufacture;?>/tolak',
            type: 'post',
            data: $(this).serialize(),             
            success: function(data) {               
                $('#kelengkapan-berkas').html(data) ;      
            }
        }) ;
    }) ;
</script>