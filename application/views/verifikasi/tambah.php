<div class="card p-3">
    <div class="row">
        <div class="col-md-10"> <h4><?= $sample['namaSample'] ; ?></h4> </div>
        <div class="col-md-2 d-flex justify-content-end">
            <a href="<?= base_url();?>assets/file-upload/hasil-evaluasi/<?= $sample['hasilEvaluasi'];?>" class="btn btn-secondary mr-2" data-toggle="tooltip" title="Hasil Evaluasi" target='blank'> <i class="fa fa-file-signature"></i></a>
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modelVerifikasi" data-toggle="tooltip" title="Verifikasi Sample">
                <i class="fa fa-pen"></i>
            </button>
        </div>
    </div>

    <br>
    
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">Batch No</div>
                <div class="col-md-9">: <?= $sample['batch']; ?></div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">Doses </div>
                <div class="col-md-9">: <?= $sample['doses']; ?></div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <?php $vial = explode(',' , $sample['vialLolos']); ?>
                <div class="col-md-3">Vial Setelah Evaluasi </div>
                <div class="col-md-9">: <?= $sample['vialLolos']; ?> (@ <?= count($vial); ?> Vial) </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <?php $vial = explode(',' , $sample['vial']); ?>
                <div class="col-md-3">Vial Sebelum Evaluasi </div>
                <div class="col-md-9">: <?= $sample['vial']; ?> (@ <?= count($vial); ?> Vial) </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">Tanggal Expiry </div>
                <div class="col-md-9">: <?= $this->_Date->formatTanggal($sample['tgl_expiry']); ?></div>
            </div>
        </li>
        <li class="list-group-item d-flex justify-content-end">
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelVerifikasi" data-toggle="tooltip" title="Verifikasi Sample">
                    <i class="fa fa-pen"></i>
                </button>
        </li>
    </ul>
</div>



<!-- Modal -->
<div class="modal fade" id="modelVerifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?= base_url(); ?>verifikasi/verifikasi" method='post'>
            <div class="modal-body">
                <input type="hidden" value="<?= $sample['idEvaluasi']; ?>" name='id'>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="exampleFormControlSelect1" name='status' >
                        <?php foreach ($pesan as $psn) : ?>
                            <option value='<?= $psn['idPesan']; ?>'><?= $psn['indo']; ?></option>
                        <?php endforeach ; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" placeholder="Keterangan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </form>
    </div>
</div>