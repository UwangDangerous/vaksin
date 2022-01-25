<?php if(!empty($this->session->flashdata('pesan_header') )) : ?>
            
    <div class="alert alert-<?=  $this->session->flashdata('warna_header'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan_header'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?> 

<ul class="list-group" id='header'>
    <?php foreach ($header as $row) : ?>
        <li class='list-group-item'><?= $row['nama_tbl_header']; ?></li>
    <?php endforeach ; ?>
</ul>