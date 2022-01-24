<?php if(!empty($this->session->flashdata('pesan_gi') )) : ?>
            
    <div class="alert alert-<?=  $this->session->flashdata('warna_gi'); ?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan_gi'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?> 

<h4> Penggunaan General Informasi </h4>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>General Informasi</th>
                <th>Pengguna</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sample as $row) : ?>
                <tr>
                    <td><?= $row['namaGI']; ?></td>
                    <td>
                        <?php if( $row['tugasGI'] == 1) : ?>
                            Evaluasi
                        <?php else : ?>
                            Pihak Ke 3
                        <?php endif ; ?>
                    </td>
                </tr>
            <?php endforeach ; ?>
        </tbody>
    </table>
</div>