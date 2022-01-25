<?php if(!empty($this->session->flashdata('pesan_kolom') )) : ?>
            
    <div class="alert alert-<?=  $this->session->flashdata('warna_kolom'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan_kolom'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?>


<div class="table-responsive" id='kolom'>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <?php foreach ($kolom as $klm) : ?>
                    <th><?= $klm['nama_kolom']; ?></th>
                <?php endforeach ; ?>
            </tr>
        </thead>
    </table>
</div>