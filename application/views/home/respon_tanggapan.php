<h5>Respon Tanggapan</h5> <br>
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

<script>
    $('#tabel_respon_tanggapan').dataTable();
</script>