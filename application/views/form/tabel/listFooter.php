<?php if(!empty($this->session->flashdata('pesan_footer') )) : ?>
            
    <div class="alert alert-<?=  $this->session->flashdata('warna_footer'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan_footer'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?> 

<ul class="list-group" id='footer'>
    <?php foreach ($footer as $row) : ?>
        <li class='list-group-item'><?= $row['nama_tbl_footer']; ?></li>
    <?php endforeach ; ?>
</ul>