<div class="card p-2">
    <div class="row d-flex justify-content-between">
        <div class="col-9"> <h2> <?= $tabel['nama_tbl_proses']; ?> </h2> <br> </div>
        <div class="col-3"> 
            <div class="d-flex justify-content-end">
                <a href="tabel" class="btn btn-success mr-2" data-toggle='tooltip' title='ubah tabel'>
                    <i class="fa fa-edit"></i>
                </a> <!-- ubah hapus -->
                <a href="#tabel" class="btn btn-danger" data-toggle='tooltip' title='hapus tabel' onclick="return confirm('yakin?')" id='hapusTabel'>
                    <i class="fa fa-trash"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- header -->
        <h5 class="text-secondary">
            Header  <a href="#header" class="badge badge-primary" data-toggle='modal' data-target='#headerTambah<?= $tabel['id_tbl_proses']; ?>' data-toggle='tooltip' title='Tambah Tabel Header'> <i class="fa fa-plus"></i> </a>
        </h5>
        <div id='header'>
            <?php if($header) : ?>
                <ul class="list-group">
                    <?php foreach ($header as $row) : ?>
                        <li class='list-group-item'><?= $row['nama_tbl_header']; ?></li>
                    <?php endforeach ; ?>
                </ul>
            <?php else : ?>
                <i class="text-warning">kosong</i>
            <?php endif ; ?>
        </div>
    <!-- header -->



    <br><br>


    <!-- kolom -->
        <h5 class="text-secondary">
            Kolom Tabel  <a href="#kolom" class="badge badge-primary" data-toggle='modal' data-target='#kolomTambah<?= $tabel['id_tbl_proses']; ?>' data-toggle='tooltip' title='Tambah Kolom Tabel'> <i class="fa fa-plus"></i> </a>
        </h5>

        <div class="table-responsive" id='kolom'>
            <?php if($kolom) : ?>
            
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <?php $noKolom = count($kolom) + 1 ; ?>
                            <?php foreach ($kolom as $klm) : ?>
                                <th><?= $klm['nama_kolom']; ?></th>
                            <?php endforeach ; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php for($i = 0; $i < $noKolom ; $i++ ):?>
                                <td></td>
                            <?php endfor ; ?>
                        </tr>
                    </tbody>
                </table>
                
            <?php else:  ?>
                    
                    <i class="text-warning">kosong</i>
                    
            <?php endif ; ?>
        </div>
    <!-- kolom -->


    <br><br>


    <!-- footer -->
        <h5 class="text-secondary">
            Footer  <a href="#footer" class="badge badge-primary" data-toggle='modal' data-target='#footerTambah<?= $tabel['id_tbl_proses']; ?>' data-toggle='tooltip' title='Tambah Tabel Footer'> <i class="fa fa-plus"></i> </a>
        </h5>
        <div id='footer'>
            <?php if($footer) : ?>
                <ul class="list-group">
                    <?php foreach ($footer as $row) : ?>
                        <li class='list-group-item'><?= $row['nama_tbl_footer']; ?></li>
                    <?php endforeach ; ?>
                </ul>
            <?php else : ?>
                <i class="text-warning">kosong</i>
            <?php endif ; ?>
        </div>
    <!-- footer -->

</div>

<script>
    $(document).ready(function() {
        $("#formHeader").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>form/tambahHeader/<?= $tabel['id_tbl_proses'];  ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {      
                    document.getElementById("formHeader").reset();
                    $('#header').html(data) ; 
                }
            });
        });
    }) ;

    $(document).ready(function() {
        $("#formKolom").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>form/tambahKolom/<?= $tabel['id_tbl_proses'];  ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {      
                    document.getElementById("formKolom").reset();
                    $('#kolom').html(data) ; 
                }
            });
        });
    }) ;

    $(document).ready(function() {
        $("#formFooter").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>form/tambahFooter/<?= $tabel['id_tbl_proses'];  ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {      
                    document.getElementById("formFooter").reset();
                    $('#footer').html(data) ; 
                }
            });
        });
    }) ;

    $(document).ready(function() {
        $("#hapusTabel").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>form/hapusTabel/<?= $tabel['id_tbl_proses']; ?>/<?= $idJS;?>',
                data: $(this).serialize(),             
                success: function(data) {      
                    $('#listTabel').html(data) ; 
                    $('#tampilTabel').html('') ; 
                }
            });
        });
    }) ;
</script>

<!-- Modal Header -->
    <div class="modal fade" id="headerTambah<?= $tabel['id_tbl_proses']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Header</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id='formHeader'>
                    <div class="modal-body">
                        <label for="namaHeader">Header</label>
                        <input type="text" name="namaHeader" id="namaHeader" class='form-control'>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Modal Header -->



<!-- Modal Kolom -->
    <div class="modal fade" id="kolomTambah<?= $tabel['id_tbl_proses']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kolom</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id='formKolom'>
                    <div class="modal-body">
                        <label for="namaKolom">Kolom</label>
                        <input type="text" name="namaKolom" id="namaKolom" class='form-control'>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Modal Kolom -->


<!-- Modal footer -->
    <div class="modal fade" id="footerTambah<?= $tabel['id_tbl_proses']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Footer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id='formFooter'>
                    <div class="modal-body">
                        <label for="namaFooter">Footer</label>
                        <input type="text" name="namaFooter" id="namaFooter" class='form-control'>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Modal footer -->
