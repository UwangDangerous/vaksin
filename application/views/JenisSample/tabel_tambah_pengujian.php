<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 
    <div class="table-responsive">
        <table class="table table-bordered table-stripe text-center" id="tabel_tambah_pengujian">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengujian</th>
                    <th>Aktif / Tidak AKtif</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($tabel_pengujian as $row) : ?>
                    <tr>
                        <td><?= $no++ ; ?></td>
                        <td><?= $row['namaJenisPengujian']; ?></td>
                        <td>
                            <?php $this->db->where('idJenisSample', $id) ?>
                            <?php $this->db->where('idJenisPengujian', $row['idJenisPengujian']) ?>
                            <?php $used = $this->db->get('_js_used')->row_array() ; ?>
                            <?php if($used) : ?>
                                <a href="<?= base_url(); ?>jenisSample/pengaturanPengujian/nonaktif/<?= $id; ?>/<?= $row['idJenisPengujian'];?>" class="badge badge-danger" data-toggle='tooltip' title='non aktif' onclick="return confirm('Non Aktifkan <?= $row['namaJenisPengujian']; ?> ')"><i class="fa fa-minus"></i></a>
                            <?php else : ?>
                                <a href="<?= base_url(); ?>jenisSample/pengaturanPengujian/aktif/<?= $id; ?>/<?= $row['idJenisPengujian'];?>" class="badge badge-success" data-toggle='tooltip' title='aktif' onclick="return confirm('Aktifkan <?= $row['namaJenisPengujian']; ?> ')"><i class="fa fa-plus"></i></a>
                            <?php endif ; ?>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>