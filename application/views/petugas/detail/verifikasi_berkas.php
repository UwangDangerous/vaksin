<?php $vb = false ; ?>
<?php $vs = false ; ?>
<div id='kelengkapan-berkas'>
    
    <div class="row">
        <div class="col-md-6">
            
            <div class="card p-2">

                <?php if(!empty($this->session->flashdata('pesan_verif') )) : ?>
                        
                        <div class="alert alert-<?= $this->session->flashdata('warna_verif') ?> alert-dismissible fade show" role="alert">
                            <?=  $this->session->flashdata('pesan_verif'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                <?php endif ; ?>
                <h5>Data Dukung</h5>
                <ul class="list-group mt-2">
                    <?php foreach ($dataDukung as $dd) : ?>
                        <?php $isiDataDukung = $this->Petugas_model->setDataDukung($id, $dd['idJenisDataDukung']); ?>
            
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $dd['namaJenisDataDukung']; ?>
                            <?php if($isiDataDukung) : ?>
                                <a  href="<?= base_url(); ?>assets/file-upload/data-dukung/<?= $isiDataDukung['fileDataDukung'];?>" data-toogle='tooltip' title='Tampilkan' target='blank' class="badge badge-primary"><i class="fa fa-eye"></i></a>
                            <?php else : ?>
                                <span><i class="text-danger"> (null) </i></span>
                            <?php endif ; ?>
                        </li>
            
                    <?php endforeach ; ?>
                </ul>
                <br>

                <div class="row">
                    <div class="col">

                        <?php $verifikasi_berkas = $this->Petugas_model->getVerifikasiBerkas($id) ; ?>
                        <?php if($verifikasi_berkas) : ?>

                            <?php if($verifikasi_berkas['statusVB'] == 1) : ?>
                                <i class="text-success"><?= $verifikasi_berkas['keteranganVB']; ?></i>
                                <?php $vb = true ; ?>
                            <?php else : ?>
                                <?php $vb = false ;?>
                                <i class="text-danger"><?= $verifikasi_berkas['keteranganVB']; ?> - Verifikasi Ulang</i> <br><br>
                                <button id="aksi-terima" class='btn btn-success' data-toggle='tooltip' title='Verifikasi Data Dukung Sesuai'><i class="fa fa-check"></i></button>
                                <button id="aksi-tolak" class='btn btn-danger' data-toggle='tooltip' title='Verifikasi Data Tidak Dukung Sesuai'><i class="fa fa-times"></i></button>
                            <?php endif ; ?>
                            
                        <?php else : ?>
                            <?php $vb = false ;?>

                            <button id="aksi-terima" class='btn btn-success' data-toggle='tooltip' title='Verifikasi Data Dukung Sesuai'><i class="fa fa-check"></i></button>
                            <button id="aksi-tolak" class='btn btn-danger' data-toggle='tooltip' title='Verifikasi Data Dukung Tidak Sesuai'><i class="fa fa-times"></i></button>
                            
                        <?php endif ; ?>

                    </div>  
                </div>

                <br>
                
                <div id="aksi_kelengkapan_berkas"></div>
            </div>
        </div>

        <?php if($vb == true) : ?>
                
            <div class="col-md-6">
                <div class="card p-2">
                    <div id="pekerjaan"></div>
                </div>
            </div>
            
        <?php endif ; ?>
    </div>

</div>

<script>
    $("#aksi-terima").click(function(e){
        if(confirm("Data Sesuai?")){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>petugas/aksi_kelengkapan_berkas/<?= $id ;?>/<?= $idJenisManufacture;?>/terima',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#kelengkapan-berkas').html(data) ;      
                }
            });
        }else{
            return false;
        }
    }); 
    
    $("#aksi-tolak").click(function(e){
        $("#aksi_kelengkapan_berkas").load("<?= base_url();?>petugas/verifikasi_berkas_tolak/<?= $id; ?>/<?= $idJenisManufacture;?>");
    }); 

    $("#pekerjaan").load("<?= base_url(); ?>petugas/getPekerjaan/<?= $id; ?>")
</script>

<br>