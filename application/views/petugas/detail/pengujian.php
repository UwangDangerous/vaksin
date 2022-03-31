<div id="pengujian-sample"></div>
    <div class="card p-2">
        <h5>Pilih Pengujian</h5>
        <?php if(!empty($this->session->flashdata('pesan_pengujian') )) : ?>
                                    
            <div class="alert alert-<?= $this->session->flashdata('warna_pengujian') ?> alert-dismissible fade show" role="alert">
                <?=  $this->session->flashdata('pesan_pengujian'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php endif ; ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center" id="tabel-pilih-pengujian">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengujian</th>
                        <th>Jumlah Sampel</th>
                        <th>Lama Pengujian</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pengujian as $p) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['namaJenisPengujian']; ?></td>
                            <td><?= $p['jumlahSample']; ?></td>
                            <td><?= $p['lamaPengujian']; ?></td>
                            <td>
                                <?php $jp = $this->Petugas_model->getJPUsed($id, $p['idJenisPengujian']) ; ?>
                                <?php if($jp) : ?>
                                    <a href="#" data-toggle="tooltip" title='Hapus Pengujian <?= $p['namaJenisPengujian'];?>' id='hapus_pengujian_<?= $p['idJenisPengujian'];?>' class="badge badge-danger"><i class="fa fa-minus"></i></a>
                                <?php else : ?>
                                    <a href="#" data-toggle="tooltip" title='Tambah Pengujian <?= $p['namaJenisPengujian'];?>' id='tambah_pengujian_<?= $p['idJenisPengujian'];?>' class="badge badge-primary"><i class="fa fa-plus"></i></a>
                                <?php endif ; ?>
                            </td>
                        </tr>

                        <script>
                            $("#tambah_pengujian_<?= $p['idJenisPengujian'];?>").click(function(e){
                                if(confirm("Tambah Pengujian <?= $p['namaJenisPengujian'];?>?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>petugas/tambah_pengujian_sample/<?= $id ;?>/<?= $p['idJenisPengujian'];?>',
                                        type: 'post',
                                        data: $(this).serialize(),             
                                        success: function(data) {               
                                            $('#pengujian-sample').html(data) ;      
                                        }
                                    });
                                }else{
                                    return false;
                                }
                            }) ;

                            $("#hapus_pengujian_<?= $p['idJenisPengujian'];?>").click(function(e){
                                if(confirm("Hapus Pengujian <?= $p['namaJenisPengujian'];?>?")){
                                    e.preventDefault();
                                    $.ajax({
                                        url: '<?= base_url(); ?>petugas/hapus_pengujian_sample/<?= $id ;?>/<?= $p['idJenisPengujian'];?>',
                                        type: 'post',
                                        data: $(this).serialize(),             
                                        success: function(data) {               
                                            $('#pengujian-sample').html(data) ;      
                                        }
                                    });
                                }else{
                                    return false;
                                }
                            }) ;
                        </script>
                    <?php endforeach ; ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>  

<script>
    $("#tabel-pilih-pengujian").dataTable();
</script>
