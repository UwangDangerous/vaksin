<div class="card p-3">
  <?php if(!empty($this->session->flashdata('pesan') )) : ?>
      
      <div class="alert alert-<?= $this->session->flashdata('warna') ;?> alert-dismissible fade show" role="alert">
          <?=  $this->session->flashdata('pesan'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      
  <?php endif ; ?> 

  <form method='post' action="" enctype="multipart/form-data" class='myform'>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="nama">Nama User</label>
          <input type="text" class="form-control" id="nama" placeholder="Nama User" name='nama' value="<?= set_value('nama'); ?>">
          <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama'); ?></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="nip">NIP</label>
          <input type="text" class="form-control" id="nip" placeholder="NIP" name='nip' value="<?= set_value('nip'); ?>" >
          <small id="usernameHelp" class="form-text text-danger"><?= form_error('nip'); ?></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="level">Level User</label>
          <select class="form-control" id="level" name='level'>
              <option value="">-pilih-</option>
            <?php foreach ($level as $option) : ?>
              <?php if(set_value('level') == $option['idLevel']) : ?>
                  <option selected value="<?= $option['idLevel']; ?>"> <?= $option['namaLevel']; ?></option>
              <?php else : ?>
                  <option value="<?= $option['idLevel']; ?>"> <?= $option['namaLevel']; ?></option>
              <?php endif ; ?>
            <?php endforeach ; ?>
          </select>
          <small id="usernameHelp" class="form-text text-danger"><?= form_error('level'); ?></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="ttd">Tanda Tangan</label>
          <input type="file" class="form-control" id="ttd" placeholder="NIP" name='ttd'>
          <b>*tipe file png</b>
        </div>
      </div>
    </div>

    <br>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>