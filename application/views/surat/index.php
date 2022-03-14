<a href="<?=base_url(); ?>surat/kirim" class="btn btn-primary"> <i class="fa fa-pen"></i> </a> <br> <br>
<div class="card p-4">
    

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 


    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id='surat'>
            <thead>
            <tr>
                <th>No</th>
                <th>No Surat</th>
                <th>Perihal</th>
                <th>Tanggal Surat</th>
                <th>Jumlah Sample</th>
                <th>Isi Surat</th>
                <th>Aksi</th>
            </tr>
            </thead>

            <tbody>
            <?php $no=1; ?>
            <?php foreach ($surat as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['noSurat']; ?></td>
                    <td><?= $row['namaSurat']; ?></td>
                    <td><?= $this->_Date->formatTanggal( $row['tgl_kirim_surat'] ); ?></td>
                    <td>
                        <?= $this->Surat_model->getJumlahSample($row['idSurat']); ?>
                    </td>
                    <td>
                        <a href="<?= base_url(); ?>assets/file-upload/surat/<?= $row['fileSurat']; ?>" class="badge badge-warning" data-toggle="tooltip" title="Cek Surat" target='blank'> <i class="fa fa-eye"></i> </a>
                    </td>
                    <td>
                        <a href="<?= base_url(); ?>sample_/index/<?= $row['idSurat']; ?>" class="badge badge-primary" data-toggle="tooltip" title="Info Sampel / Tambah Sampel"> <i class="fa fa-bars"></i> </a>
                        <a href="<?= base_url(); ?>surat/hapusSurat/<?= $row['idSurat']; ?>" class="badge badge-danger" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('yakin ingin hapus data ini?') ;" > <i class="fa fa-trash"></i> </a>
                    </td>
            <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>