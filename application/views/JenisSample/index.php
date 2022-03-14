<div class="card p-3">
    <div class="row">
        <div class="col-md-1">
            <a href="#" data-toggle="modal" data-target="#tambahData" data-toogle='tooltip' title='Simpan Data' class="btn btn-primary">
                <i class="fa fa-pen"></i>
            </a>
        </div>
        <!-- <div class="col-md-6">
            <form action="<?//= base_url(); ?>jenisSample" method='post'>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari..." aria-describedby="basic-addon2" name='cari' id='cari' autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-outline-primary" type="submit" name='btn-cari' value='cari' > 
                    </div>
                </div>
            </form>
        </div> -->
    </div>

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php endif ; ?> 
    
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered text-center" id="jenisSample">
            <thead>
                <tr>
                    <th class='align-middle'>No</th>
                    <th class='align-middle'>Vaksin</th>
                    <th class='align-middle'>Jenis Wadah</th>
                    <th class='align-middle'>Pelulusan</th>
                    <th class='align-middle'>Produksi</th>
                    <th class='align-middle'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <div class="row">
                                <div class="col-md-6"><?= $row['jenisSample'] ?></div>
                                <div class="col-md-6"><i> <?= $row['jsIng'] ?> </i></div>
                            </div>
                        </td>
                        <td><?= $row['namaJenisKemasan']; ?> / <i> <?= $row['ingJenisKemasan']; ?> </i></td>
                        <td><?= $row['pelulusan'] ?> Hari</td>
                        <td><?= $row['namaJenisManufacture'] ; ?></td>
                        <td>
                            <a href="#"  data-toggle="modal" data-target="#ubahData<?= $row['idJenisSample'];?>"  data-toggle='tooltip' title='Ubah Data' class="badge badge-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url(); ?>form/index/<?= $row['idJenisSample']; ?>" data-toggle='tooltip' title='Buat Form' class="badge badge-primary">
                                <i class="fa fa-table"></i>
                            </a>
                            <?php if($row['idJenisManufacture'] != 2) : ?>
                                <a href="<?= base_url() ;?>jenisSample/tabel_tambah_pengujian/<?= $row['idJenisSample']?>" class="badge badge-warning" data-toggle='tooltip' title='Pilih Pengujian'>
                                    <i class="fa fa-syringe"></i>
                                </a>
                            <?php endif ; ?>
                        </td>

                        <!-- Modal Ubah Data-->
                            <div class="modal fade" id="ubahData<?= $row['idJenisSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jenis Vaksin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <form action="<?= base_url(); ?>jenisSample/UbahData/<?= $row['idJenisSample'];?>" method="post">
                                            <div class="modal-body">
                                                    <label for="nama">Vaksin</label>
                                                    <input type="text" name="nama" id="nama" class='form-control' value="<?= $row['jenisSample'];?>" placeholder='Nama Vaksin' autofocus>

                                                    <label for="namaIng"><i>Treanslate</i></label>
                                                    <input type="text" name="namaIng" id="namaIng" class='form-control' placeholder='Name Vaccine' value="<?= $row['jsIng'];?>">
                                                    
                                                    <label for="lama">Durasi Pengerjaan Pelulusan</label>
                                                    <input type="number" name="lama" id="lama" class='form-control' placeholder='Hitungan Hari' value="<?= $row['pelulusan'];?>">
                                                    
                                                    <label for="kemasan"></label>
                                                    <select name="kemasan" id="kemasan" class="form-control">
                                                        <?php foreach ($kemasan as $k) : ?>
                                                            <?php if($k['idJenisKemasan'] == $row['idJenisKemasan']) : ?>
                                                                <option selected value="<?= $k['idJenisKemasan'];?>"> <?= $k['namaJenisKemasan']; ?> ( <i><?= $k['ingJenisKemasan']; ?></i> ) </option>
                                                            <?php else : ?>
                                                                <option value="<?= $k['idJenisKemasan'];?>"> <?= $k['namaJenisKemasan']; ?> ( <i><?= $k['ingJenisKemasan']; ?></i> ) </option>
                                                            <?php endif ; ?>
                                                        <?php endforeach ; ?>
                                                    </select>
                                                    <label for="produksi">Jenis Sampel</label>
                                                    <select name="produksi" id="produksi" class="form-control">
                                                        <?php foreach ($produksi as $p) : ?>
                                                            <?php if($p['idJenisManufacture'] == $row['idJenisManufacture']) : ?>
                                                                <option selected value="<?= $p['idJenisManufacture'];?>"> <?= $p['namaJenisManufacture'];?> </option>
                                                            <?php else : ?>
                                                                <option value="<?= $p['idJenisManufacture'];?>"> <?= $p['namaJenisManufacture'];?> </option>
                                                            <?php endif ; ?>
                                                        <?php endforeach ; ?>
                                                    </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal Ubah Data-->

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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jenis Vaksin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?= base_url(); ?>jenisSample/TambahData" method="post">
            <div class="modal-body">
                    <label for="nama">Vaksin</label>
                    <input type="text" name="nama" id="nama" class='form-control' placeholder='Nama Vaksin' autofocus>
                    <label for="namaIng"><i>Treanslate</i></label>
                    <input type="text" name="namaIng" id="namaIng" class='form-control' placeholder='Name Vaccine'>
                    <label for="lama">Durasi Pengerjaan Pelulusan</label>
                    <input type="number" name="lama" id="lama" class='form-control' placeholder='Hitungan Hari'>
                    <label for="kemasan">Kemasan</label>
                    <select name="kemasan" id="kemasan" class="form-control">
                        <?php foreach ($kemasan as $k) : ?>
                            <option value="<?= $k['idJenisKemasan'];?>"> <?= $k['namaJenisKemasan']; ?> ( <i><?= $k['ingJenisKemasan']; ?></i> ) </option>
                        <?php endforeach ; ?>
                    </select>
                    <label for="produksi">Jenis Sampel</label>
                    <select name="produksi" id="produksi" class="form-control">
                        <?php foreach ($produksi as $p) : ?>
                            <option value="<?= $p['idJenisManufacture'];?>"> <?= $p['namaJenisManufacture'];?> </option>
                        <?php endforeach ; ?>
                    </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>
