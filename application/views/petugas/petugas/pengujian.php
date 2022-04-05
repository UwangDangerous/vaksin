<div class="card p-2 mb-2 pengujian">
    <h5>Pengujian</h5>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id='tabel-penguji'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sampel Yang Di Uji</th>
                    <th>Petugas Penguji</th>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($pengujian as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaJenisPengujian']; ?></td>
                        <td>
                            <?php $petugas_penguji = $this->_Petugas_model->getPetugasPenguji($row['idJP_used']) ?>
                            <?php if($petugas_penguji) : ?>
                                <?php foreach ($petugas_penguji as $pj) : ?>
                                    <form action="" method='post' id="ubah_petugas_pengujian_<?= $pj['idPP'];?>">
                                        <div class="input-group mb-3">
                                            <input type="hidden" name='idPP' value='<?= $pj['idPP'] ;?>'>
                                            <input type="hidden" name='idJP' value='<?= $row['idJP_used'] ;?>'>
                                            <select name="idIU" class='form-control'>
                                                <?php foreach ($petugas as $p) : ?>

                                                    <?php if($p['idIU'] == $pj['idIU']) : ?>
                                                        <option selected value="<?= $p['idIU'];?>"><?= $p['namaIU']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $p['idIU'];?>"><?= $p['namaIU']; ?></option>
                                                    <?php endif ; ?>

                                                <?php endforeach ; ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success" type='submit' data-toggle='tooltip' title='Ubah Petugas Penguji' type="button" ><div class="fa fa-edit"></div></button>
                                                <button class="btn btn-outline-danger" id="hapus_petugas_pengujian_<?= $pj['idPP'];?>" type='button' data-toggle='tooltip' title='Hapus Petugas Penguji' type="button" ><div class="fa fa-trash"></div></button>
                                            </div>
                                        </div>  
                                    </form>

                                    <script>
                                        $('#ubah_petugas_pengujian_<?= $pj['idPP'];?>').submit(function(e){
                                            if(confirm("Buah Petugas Penguji ?")){
                                                e.preventDefault();
                                                $.ajax({
                                                    url: '<?= base_url(); ?>_petugas/ubahPetugasPenguji/<?= $id ;?>',
                                                    type: 'post',
                                                    data: $(this).serialize(),             
                                                    success: function(data) {               
                                                        $('#pengujian').html(data) ;      
                                                    }
                                                });
                                            }else{
                                                return false;
                                            }
                                        });

                                        $('#hapus_petugas_pengujian_<?= $pj['idPP'];?>').click(function(e){
                                            if(confirm("Hapus Petugas Penguji ?")){
                                                e.preventDefault();
                                                $.ajax({
                                                    url: '<?= base_url(); ?>_petugas/hapusPetugasPenguji/<?= $id ;?>/<?= $pj['idPP'] ;?>/<?= $row['idJP_used'] ;?>',
                                                    type: 'post',
                                                    data: $(this).serialize(),             
                                                    success: function(data) {               
                                                        $('#pengujian').html(data) ;      
                                                    }
                                                });
                                            }else{
                                                return false;
                                            }
                                        });
                                    </script>

                                <?php endforeach ; ?>
                            <?php endif ; ?>

                            <form action="" method='post' id="simpan_petugas_pengujian_<?= $row['idJP_used'];?>">
                                <div class="input-group mb-3">
                                    <input type="hidden" name='idJP' value='<?= $row['idJP_used'] ;?>'>
                                    <select name="idIU" class='form-control'>
                                        <?php foreach ($petugas as $p) : ?>
                                            <option value="<?= $p['idIU'];?>"><?= $p['namaIU']; ?></option>
                                        <?php endforeach ; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type='submit' data-toggle='tooltip' title='Tambah Petugas Penguji' type="button" ><div class="fa fa-save"></div></button>
                                    </div>
                                </div>  
                            </form>
                            <br>
                            <?php if($this->session->flashdata("pesan_Penguji_".$row['idJP_used'])) : ?>
                                <i class="text-<?= $this->session->flashdata("warna_Penguji_".$row['idJP_used']) ;?>">
                                    <?= $this->session->flashdata("pesan_Penguji_".$row['idJP_used']) ; ?>
                                </i>
                            <?php endif ; ?>
                        </td>
                    </tr>

                    <script>
                        $('#simpan_petugas_pengujian_<?= $row['idJP_used'];?>').submit(function(e){
                            if(confirm("Simpan Petugas Penguji ?")){
                                e.preventDefault();
                                $.ajax({
                                    url: '<?= base_url(); ?>_petugas/simpanPetugasPenguji/<?= $id ;?>',
                                    type: 'post',
                                    data: $(this).serialize(),             
                                    success: function(data) {               
                                        $('#pengujian').html(data) ;      
                                    }
                                });
                            }else{
                                return false;
                            }
                        });
                    </script>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tabel-penguji').dataTable();
</script>