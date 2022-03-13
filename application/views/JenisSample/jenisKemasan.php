<div>
<div class="card p-3">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?= $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?>
    <div class="row">
        <div class="col-md-1">
            <a href="" class="btn btn-primary" data-toggle='modal' data-target='#tambah-data' data-toggle='tooltip' title='tambah data pengujian' id='tambah'><i class="fa fa-pen"></i></a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id='tabelManufactureXjenisSample'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kemasan</th>
                    <th>Dalam Bahasa Inggris</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($jenisKemasan as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaJenisKemasan']; ?></td>
                        <td> <i> <?= $row['ingJenisKemasan']; ?> </i> </td>
                        <td>
                            <a href="" class="badge badge-success" data-toggle='modal' data-target='#ubah_<?= $row['idJenisKemasan'];?> ' data-toggle='tooltip' title='ubah data'> <i class="fa fa-edit"></i> </a>
                            <a href="<?= base_url() ;?>jenisSample/hapusJenisKemasan/<?= $row['idJenisKemasan'];?>" class="badge badge-danger" data-toggle='tooltip' title='hapus data' onclick='return confirm("yakin ingin hapus data?");'> <i class="fa fa-trash"></i></a>
                        </td>

                        <!-- Modal Ubah-->
                            <div class="modal fade" id="ubah_<?= $row['idJenisKemasan'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jenis Kemasan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url(); ?>jenisSample/ubahJenisKemasan/<?= $row['idJenisKemasan'];?>" method='post'>
                                            <div class="modal-body">
                                                <label for="namaJenisKemasan">Nama Jenis Kemasan</label>
                                                <input type="text" name="namaJenisKemasan" id="namaJenisKemasan" placeholder = 'Nama Jenis Kemasan' class='form-control' value='<?= $row['namaJenisKemasan'];?>'>
                                                <label for="ingJenisKemasan">Dalam Bahasa Inggris</label>
                                                <input type="text" name="ingJenisKemasan" id="ingJenisKemasan" placeholder = 'Dalam Bahasa Inggris' class='form-control' value='<?= $row['ingJenisKemasan'];?>'>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal Ubah-->
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- modal tambah -->
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Kemasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>jenisSample/tambahJenisKemasan" method='post'>
                    <div class="modal-body">
                        <label for="namaJenisKemasan">Nama Jenis Kemasan</label>
                        <input type="text" name="namaJenisKemasan" id="namaJenisKemasan" placeholder = 'Nama Jenis Kemasan' class='form-control'>
                        <label for="ingJenisKemasan">Dalam Bahasa Inggris</label>
                        <input type="text" name="ingJenisKemasan" id="ingJenisKemasan" placeholder = 'Dalam Bahasa Inggris' class='form-control'>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>