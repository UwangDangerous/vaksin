<div class="card p-3">
    <div class="row">
        <div class="col-md-1">
            <a href="#" data-toggle="modal" data-target="#tambahData" data-toogle='tooltip' title='Simpan Data' class="btn btn-primary">
                <i class="fa fa-pen"></i>
            </a>
        </div>
        <div class="col-md-6">
            <form action="<?= base_url(); ?>jenisSample" method='post'>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari..." aria-describedby="basic-addon2" name='cari' id='cari' autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-outline-primary" type="submit" name='btn-cari' value='cari' > 
                        <!-- <i class="fa fa-search"></i>  -->
                    </div>
                </div>
            </form>
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
                    <th class='align-middle'>No</th>
                    <th class='align-middle' colspan=2>Vaksin</th>
                    <th class='align-middle' colspan=2>Jenis Wadah</th>
                    <th class='align-middle'>Lama Pengerjaan</th>
                    <th class='align-middle'>Produksi</th>
                    <th class='align-middle'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = $start ; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $row['jenisSample'] ?></td>
                        <td> <i> <?= $row['jsIng'] ?> </i></td>
                        <td><?= $row['wadah']; ?></td>
                        <td> <i> <?= $row['wIng']; ?> </i></td>
                        <td><?= $row['waktuPengujian'] ?> Hari</td>
                        <td><?= $row['produksi']; ?></td>
                        <td>
                            <a href="#"  data-toggle="modal" data-target="#ubahData<?= $row['idJenisSample'];?>"  data-toogle='tooltip' title='Ubah Data' class="badge badge-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url(); ?>form/index/<?= $row['idJenisSample']; ?>" data-toogle='tooltip' title='Buat Form' class="badge badge-primary">
                                <i class="fa fa-table"></i>
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
                                    <form action="<?= base_url(); ?>jenisSample/UbahData/<?= $row['idJenisSample'];?>/<?= $hal; ?>" method="post">
                                        <div class="modal-body">
                                                <label for="nama">Vaksin</label>
                                                <input type="text" name="nama" id="nama" class='form-control' value="<?= $row['jenisSample'];?>" placeholder='Nama Vaksin' autofocus>

                                                <label for="namaIng"><i>Treanslate</i></label>
                                                <input type="text" name="namaIng" id="namaIng" class='form-control' placeholder='Name Vaccine' value="<?= $row['jsIng'];?>">
                                                
                                                <label for="lama">Durasi Pengerjaan</label>
                                                <input type="number" name="lama" id="lama" class='form-control' placeholder='Hitungan Hari' value="<?= $row['waktuPengujian'];?>">
                                                
                                                <label for="wadah">Jenis Wadah</label>
                                                <select name="wadah" id="wadah" class="form-control">
                                                    <?php foreach ($wadah as $w) : ?>
                                                        <?php $w2 = explode("|",$w);?>
                                                        <?php if($w2[0] == $row['wadah']) : ?>
                                                            <option selected value="<?= $w;?>"> <?= $w2[0];?> </option>
                                                        <?php else : ?>
                                                            <option value="<?= $w;?>"> <?= $w2[0];?> </option>
                                                        <?php endif ; ?>
                                                    <?php endforeach ; ?>
                                                </select>

                                                <label for="produksi">Jenis Produksi</label>
                                                <select name="produksi" id="produksi" class="form-control">
                                                    <?php foreach ($produksi as $p) : ?>
                                                        <?php if($p == $row['produksi']) : ?>
                                                            <option selected value="<?= $p;?>"> <?= $p;?> </option>
                                                        <?php else : ?>
                                                            <option value="<?= $p;?>"> <?= $p;?> </option>
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
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>

    <?= $this->pagination->create_links(); ?>
    <i>Tersedia <?= $total_rows; ?> Data</i>

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
                    <label for="nama">Vaksin</label>
                    <input type="text" name="nama" id="nama" class='form-control' placeholder='Nama Vaksin' autofocus>
                    <label for="namaIng"><i>Treanslate</i></label>
                    <input type="text" name="namaIng" id="namaIng" class='form-control' placeholder='Name Vaccine'>
                    <label for="lama">Durasi Pengerjaan</label>
                    <input type="number" name="lama" id="lama" class='form-control' placeholder='Hitungan Hari'>
                    <label for="wadah">Jenis Wadah</label>
                    <select name="wadah" id="wadah" class="form-control">
                        <?php foreach ($wadah as $w) : ?>
                            <?php $w2 = explode("|",$w);?>
                            <option value="<?= $w;?>"> <?= $w2[0];?> </option>
                        <?php endforeach ; ?>
                    </select>
                    <label for="produksi">Jenis Produksi</label>
                    <select name="produksi" id="produksi" class="form-control">
                        <?php foreach ($produksi as $p) : ?>
                            <option value="<?= $p;?>"> <?= $p;?> </option>
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



<!-- <script>
    $('#cari').keyup(function(){
        var cari = $('#cari').val() ;
        // console.log(cari) ;
        $.ajax({
              url: '<?//= base_url(); ?>jenisSample/index/',
              type: 'post',
            //   data: $(this).serialize(),      
                data : {cari : cari},        
              success: function(data) {               
                $(documen).html('<?//= base_url();?>jenisSample/index') ;             
              }
          });
    }) ;
</script> -->