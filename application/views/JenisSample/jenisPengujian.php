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
        <table class="table table-bordered table-striped text-center" id='jenisPengujian'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengujian</th>
                    <th>Jumlah Sampel Minimum</th>
                    <th>Durasi Pengujian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($pengujian as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaJenisPengujian']; ?></td>
                        <td><?= $row['jumlahSample']; ?></td>
                        <td><?= $row['lamaPengujian']; ?></td>
                        <td>
                            <a href="" class="badge badge-success" data-toggle='modal' data-target='#ubah_<?= $row['idJenisPengujian'];?> ' data-toggle='tooltip' title='ubah data'> <i class="fa fa-edit"></i> </a>
                            <a href="<?= base_url() ;?>jenisSample/hapusJenisPengujian/<?= $row['idJenisPengujian'];?>" class="badge badge-danger" data-toggle='tooltip' title='hapus data' onclick='return confirm("yakin ingin hapus data?");'> <i class="fa fa-trash"></i></a>
                        </td>

                        <!-- Modal Ubah-->
                            <div class="modal fade" id="ubah_<?= $row['idJenisPengujian'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jenis Pengujian</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url(); ?>jenisSample/ubahJenisPengujian/<?= $row['idJenisPengujian'];?>" method='post'>
                                            <div class="modal-body">
                                                <label for="namaJenisPengujian">Nama Jenis Pengujian</label>
                                                <input type="text" name="namaJenisPengujian" id="namaJenisPengujian" placeholder = 'Nama Jenis Pengujian' class='form-control' value='<?= $row['namaJenisPengujian'];?>'>
                                                <label for="jumlahSample">Durasi Pengujian</label>
                                                <input type="number" name="jumlahSample" id="jumlahSample" placeholder = 'Durasi Pengujian' class='form-control' value='<?= $row['jumlahSample'];?>'>
                                                <label for="lamaPengujian">Durasi Pengujian</label>
                                                <input type="number" name="lamaPengujian" id="lamaPengujian" placeholder = 'Durasi Pengujian' class='form-control' value='<?= $row['lamaPengujian'];?>'>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Pengujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>jenisSample/tambahJenisPengujian" method='post'>
                    <div class="modal-body">
                        <label for="namaJenisPengujian">Nama Jenis Pengujian</label>
                        <input type="text" name="namaJenisPengujian" id="namaJenisPengujian" placeholder = 'Nama Jenis Pengujian' class='form-control'>
                        <label for="jumlahSample">Durasi Pengujian</label>
                        <input type="number" name="jumlahSample" id="jumlahSample" placeholder = 'Durasi Pengujian' class='form-control'>
                        <label for="lamaPengujian">Durasi Pengujian</label>
                        <input type="number" name="lamaPengujian" id="lamaPengujian" placeholder = 'Durasi Pengujian' class='form-control'>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>