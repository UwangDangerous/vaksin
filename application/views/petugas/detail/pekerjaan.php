<div id="pekerjaan">
    <?php if(!empty($this->session->flashdata('pesan_kerja') )) : ?>
            
            <div class="alert alert-<?= $this->session->flashdata('warna_kerja') ?> alert-dismissible fade show" role="alert">
                <?=  $this->session->flashdata('pesan_kerja'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
    <?php endif ; ?>
    <h5>Jenis Pekerjaan</h5>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center table-sm" id='tabel-verifikasi-pekerjaan'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pekerjaan Sampel Label</th>
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($pekerjaan as $p) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['namaJenisPekerjaan']; ?></td>
                        <td>
                            <?php $pekerjaan_used = $this->Petugas_model->getUsedPekerjaan($id,$p['idJenisPekerjaan']) ; ?>
                            <?php if($pekerjaan_used) : ?>
                                <a href="#" data-toggle='tooltip' title='hapus Pekerjaan' class="badge badge-danger" id='hapus_pekerjaan_<?= $p['idJenisPekerjaan'];?>'><i class="fa fa-minus"></i></a> <!-- hapus -->
                            <?php else : ?>
                                <a href="#" data-toggle='tooltip' title='Tambah Pekerjaan' class="badge badge-primary" id='tambah_pekerjaan_<?= $p['idJenisPekerjaan'];?>'><i class="fa fa-plus"></i></a> <!-- tambah -->
                            <?php endif ; ?>

                            <script>
                                $('#tambah_pekerjaan_<?= $p['idJenisPekerjaan'];?>').click(function(e){
                                    if(confirm("Tambah Pekerjaan <?= $p['namaJenisPekerjaan'];?> ?")){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>petugas/tambah_pekerjaan/<?= $id ;?>/<?= $p['idJenisPekerjaan'] ;?>',
                                            type: 'post',
                                            data: $(this).serialize(),             
                                            success: function(data) {               
                                                $('#pekerjaan').html(data) ;      
                                            }
                                        });
                                    }else{
                                        return false;
                                    }
                                });
                            </script>

                            <script>
                                $('#hapus_pekerjaan_<?= $p['idJenisPekerjaan'];?>').click(function(e){
                                    if(confirm("Hapus Pekerjaan <?= $p['namaJenisPekerjaan'];?> ?")){
                                        e.preventDefault();
                                        $.ajax({
                                            url: '<?= base_url(); ?>petugas/hapus_pekerjaan/<?= $id ;?>/<?= $pekerjaan_used['idJP'];?>/<?= $p['idJenisPekerjaan'] ;?>',
                                            type: 'post',
                                            data: $(this).serialize(),             
                                            success: function(data) {               
                                                $('#pekerjaan').html(data) ;      
                                            }
                                        });
                                    }else{
                                        return false;
                                    }
                                });
                            </script>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tabel-verifikasi-pekerjaan').dataTable();
</script>
