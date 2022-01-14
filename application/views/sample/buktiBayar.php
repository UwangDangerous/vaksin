<div class="card p-3">
<div class="row">
    <div class="col-md-6">
        <form action="" post>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pencarian" >
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div><!-- col 1 --> 
</div><!-- row 1 --> 

<?php if(!empty($this->session->flashdata('pesan') )) : ?>
    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<?php endif ; ?> 
<br>
<div class="table-responsive">
<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th class='align-middle'>No Surat</th>
            <th class='align-middle'>Nama Surat / Judul</th>
            <th class='align-middle'>Pengirim</th>
            <th class='align-middle'>Nama Sampel / Produk</th>
            <th class='align-middle'>Tanggal Pembayaran</th>
            <th class='align-middle'>Status</th>
            <th class='align-middle'>Aksi</th>
        </tr>
    </thead>
    <tbody>
       <?php foreach ($buktiBayar as $row) : ?>
        <tr>
            <td><?= $row['noSurat']; ?></td>
            <td><?= $row['namaSurat']; ?></td>
            <td><?= $row['namaEU']; ?></td>
            <td><?= $row['namaSample']; ?></td>
            <td><?= $this->_Date->formatTanggal( $row['tgl_bayar'] ); ?></td>
            <td>
                <?php if($row['status_verifikasi_bayar'] == 1) : ?>
                    <i class="text-success">Diterima</i>
                <?php else : ?>
                    <i class="text-danger"> Menunggu Verifikasi </i>
                <?php endif ; ?>
            </td>
            <td>
                <a href="#" class="badge badge-primary"  data-toggle="modal" data-target="#bukti_<?= $row['idBuktiBayar'] ; ?>" data-toggle='tooltip' title='Verifikasi' >
                    <i class="fa fa-pen"></i>
                </a>
            </td>
        </tr>
        <?php 
            $col        = 12 ;
            $judulModal = 'Verifikasi Bukti Bayar' ;
            $btn = false ;
       
            if($row['status_verifikasi_bayar'] == 0) :
                $col        = 9 ;
                $btn = true ; 
            else :
                $judulModal = 'Bukti Bayar '.$row['namaSample'] ; 
            endif ; 
         ?>

        <!-- Modal -->
        <div class="modal fade" id="bukti_<?= $row['idBuktiBayar'] ; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $judulModal ; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-<?= $col ;?>">
                                <iframe src="<?= base_url(); ?>assets/file-upload/bukti-bayar/<?= $row['fileBuktiBayar']; ?>" width='100%' height='400px'></iframe>
                            </div>
                            <?php if($btn == true) : ?>
                                <div class="col-md-2">
                                    <form action="<?= base_url(); ?>sample/verifikasi_pembayaran" method='post'>
                                        <input type="hidden" name='id' value='<?= $row['idBuktiBayar'];?> '>
                                        <input type="hidden" name='idSample' value='<?= $row['idSample'];?> '>
                                        <input type="hidden" name='namaFile' value='<?= $row['fileBuktiBayar'];?> '>
                                        <input type='submit' class="btn btn-primary" name='terima' value='Pembayaran Benar' onclick="return confirm('Apakah Anda Yakin?');"> <br> <br>
                                        <input type='submit' class="btn btn-danger" name='tolak' value='Pembayaran Salah' onclick="return confirm('Data akan di hapus, Apakah Anda Yakin?');">
                                    </form>
                                </div>
                            <?php endif ; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php endforeach ; ?>
    </tbody>
</table>
</div>
</div>