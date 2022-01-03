    
<div class="row">
    <div class="col-md-4">
        <div class="card p-2">
            <form method="post" action="<?= base_url(); ?>form_gi/simpan">
                <label for="nama">General Informasi</label>
                <input type="text" name="nama" id="nama" placeholder="General Informasi" class="form-control">

                <br>
                <label for="">Penugasan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="penugasan" id="pemohon" value="2">
                    <label class="form-check-label" for="pemohon">
                        Pemohon
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="penugasan" id="evaluasi" value="1">
                    <label class="form-check-label" for="evaluasi">
                        Evaluasi
                    </label>
                </div>
                <br>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <?php if(!empty($this->session->flashdata('pesan') )) : ?>
            
            <div class="alert alert-<?=  $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
                <?=  $this->session->flashdata('pesan'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
        <?php endif ; ?> 
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>General Informasi</th>
                        <th>Penugasan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if($general_informasi) : ?>
                        
                        <?php foreach ($general_informasi as $gi) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $gi['namaGI']; ?></td>
                                <td>
                                    <?php if($gi['tugasGI'] == 1) : ?>
                                        Evaluasi
                                    <?php else : ?>
                                        Pemohon
                                    <?php endif ; ?>
                                </td>
                                <td>
                                    <a href="" class="badge badge-success"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ; ?>

                    <?php else : ?>

                        <tr>
                            <td colspan = 3> <i class="text-danger">data kosong</i> </td>
                        </tr>

                    <?php endif ; ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>
