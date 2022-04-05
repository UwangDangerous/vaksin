<div id="respon_tanggapan">
    <div class="row">
        <div class="col-10">
            <h6>Respon Tanggapan</h6>
        </div>
        <div class="col-2">
            <a href="#respon_tanggapan" class="btn btn-info" data-toggle='tooltip' title='Refresh' id='refresh-respon'><i class="fa fa-sync"></i></a>
        </div>
    </div>
</div>
<br>
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered text-center" style="font-size:10pt;" id="tabel_respon_tanggapan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($respon as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $("#refresh-respon").click(function(){
        $("#respon_tanggapan").load("<?= base_url();?>/home/respon_tanggapan/<?= $idBatch; ?>") ;
    });

    $('#tabel_respon_tanggapan').dataTable();
</script>