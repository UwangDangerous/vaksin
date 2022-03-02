<?php 

    $libur = null ;
    $judul = '' ;
    if(isset($_POST['pilih'])) {
        $libur = $this->Libur_model->getDataLiburJSON($_POST['tahun']);
        $judul = "Libur Nasional Tahun ".$_POST['tahun'] ;
    }

?>

<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <h3>Libur Nasional</h3> <br>
            <div class="row">
                <div class="col-md-10">
                    <form action="" method='post'>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Pilih Tahun</span>
                            </div>
                            <select class="custom-select" id="inputGroupSelect02" name='tahun'>
                                <?php foreach ($tahun as $thn) : ?>
                                    <?php if($thn == date('Y')) : ?>
                                        <option selected value="<?= $thn; ?>"> <?= $thn; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $thn; ?>"> <?= $thn; ?></option>
                                    <?php endif ; ?>
                                <?php endforeach ; ?>
                            </select>
                            <div class="input-group-append">
                                <input type="submit" name="pilih" class='btn btn-primary' value="Pilih">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"  data-toggle='tooltip' title='Tambah Libur Nasional Manual'> <i class="fa fa-pen"></i> </a>
                </div>
            </div>

            <h5><?= $judul; ?></h5> <br>
            <?php $no=1 ; ?>
            <?php if($libur) : ?>
                <form action="<?= base_url(); ?>libur/inputAutoLibur" method='post'>
                    <div class="row">
                        <?php foreach ($libur as $lbr) : ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal<?= $no ;?>"> <?= $lbr['nama']; ?> </label> 
                                    <input type="text" class="form-control" id="tanggal<?= $no ;?>" value="<?= $lbr['tanggal']; ?>" name='tanggal<?= $no; ?>'>
                                    <input type="hidden" name='nama<?= $no ; ?>' value='<?= $lbr['nama']; ?>'>
                                </div>
                                <?php $no++; ?>
                            </div>
                        <?php endforeach ; ?>
                    </div>
                    <br>
                    <input type="hidden" name='jumlah' value="<?= $no; ?>">
                    <button class="btn btn-primary" type='submit'>Simpan</button>
                </form>
            <?php endif ; ?>
        </div>
    </div>
</div>




















<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url(); ?>libur/inputLiburManual" method='post'>
        <div class="modal-body">
            <div class="form-group">
                <label for="namaLN">Nama Hari Libur</label>
                <input type="text" class="form-control" id="namaLN" placeholder='Nama Hari Libur' name='namaLN'>
            </div>
            <div class="form-group">
                <label for="tanggalLN">Tanggal Libur</label>
                <input type="date" class="form-control" id="tanggalLN" name='tanggalLN'>
            </div>
            <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>