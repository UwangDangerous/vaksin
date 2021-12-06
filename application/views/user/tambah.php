<div class="card p-5">
<form method='post' action="">
  <div class="form-group">
    <label for="nama">Nama User</label>
    <input type="text" class="form-control" id="nama" placeholder="Nama User" name='nama' value="<?= set_value('nama'); ?>">
    <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama'); ?></small>
  </div>
  <div class="form-group">
    <label for="nip">NIP</label>
    <input type="text" class="form-control" id="nip" placeholder="NIP" name='nip' value="<?= set_value('nip'); ?>" >
    <small id="usernameHelp" class="form-text text-danger"><?= form_error('nip'); ?></small>
  </div>
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

  <br><br>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>