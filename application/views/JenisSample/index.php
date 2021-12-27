<div class="card p-3">
    <div class="row">
        <div class="col">
            <a href="#" data-toggle="modal" data-target="#tambahData" data-toogle='tooltip' title='Simpan Data' class="btn btn-primary">
                <i class="fa fa-pen"></i>
            </a>
        </div>
    </div>

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Sample</th>
                    <th>Waktu Pengujian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['jenisSample'] ?></td>
                        <td><?= $row['waktuPengujian'] ?> Hari</td>
                        <td>
                            <a href="#"  data-toggle="modal" data-target="#ubahData<?= $row['idJenisSample'];?>"  data-toogle='tooltip' title='Ubah Data' class="badge badge-success">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>

                        <!-- Modal Ubah Data-->
                        <div class="modal fade" id="ubahData<?= $row['idJenisSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jenis Sample</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form action="<?= base_url(); ?>jenisSample/UbahData/<?= $row['idJenisSample'];?>" method="post">
                                        <div class="modal-body">
                                                <label for="nama">Jenis Sample</label>
                                                <input type="text" name="nama" id="nama" class='form-control' value="<?= $row['jenisSample'];?>">
                                                <label for="lama">Waktu Pengujian</label>
                                                <input type="number" name="lama" id="lama" class='form-control' value="<?= $row['waktuPengujian'];?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>




















<!-- Modal Tambah Data-->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jenis Sample</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?= base_url(); ?>jenisSample/TambahData" method="post">
            <div class="modal-body">
                    <label for="nama">Jenis Sample</label>
                    <input type="text" name="nama" id="nama" class='form-control'>
                    <label for="lama">Waktu Pengujian</label>
                    <input type="number" name="lama" id="lama" class='form-control'>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>