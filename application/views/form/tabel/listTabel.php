<?php if(!empty($this->session->flashdata('pesan_tbl') )) : ?>
            
    <div class="alert alert-<?=  $this->session->flashdata('warna_tbl'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan_tbl'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?>








<li class='list-group-item d-flex justify-content-between align-items-center'>
    Tambah Tabel
    <a href="#tabel" class="badge badge-primary" data-toggle='modal' data-target='#modalTabel' data-toggle='tooltip' title='Tambah Tabel'><fa class="fa fa-plus"></fa> </a>
</li>
<?php foreach ($tabel as $tbl) : ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= $tbl['nama_tbl_proses']; ?>

        <a href="#tabel" id='btnTampilTabel<?= $tbl['id_tbl_proses'];?>' class="badge badge-success" data-toggle='tooltip' title='Tampilkan Tabel'><fa class="fa fa-eye"></fa> </a>
            
    </li>
    
    <script>
        $(document).ready(function() {
            $("#btnTampilTabel<?= $tbl['id_tbl_proses'];?>").click(function() {
                $("#tampilTabel").load("<?= base_url(); ?>form/tabel/<?= $tbl['id_tbl_proses'];?>/<?= $idJS;?>") ;
            });
        });
    </script>
<?php endforeach ; ?>