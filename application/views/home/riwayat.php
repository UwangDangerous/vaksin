<div class="row">
    <div class="col-10">
        <h5>Riwayat Pekerjaan</h5>
    </div>
    <div class="col-2">
        <a href="#riwayat" class="btn btn-info" data-toggle='tooltip' title='Refresh' id='refresh-riwayat'><i class="fa fa-sync"></i></a>
    </div>
</div>

<br>

<div id="riwayat">

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center table-sm" style="font-size:10pt;" id="tabel_riwayat_petugas_detail">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Hal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($riwayat_pekerjaan as $ri) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $this->_Date->formatTanggal($ri['tgl_riwayat']); ?> (<?= $ri['jam_riwayat']; ?>)</td>
                        <td><?= $ri['perihal_riwayat']; ?></td>
                        <td><?= $ri['keteranganRiwayat']; ?></td>
                    </tr>
                <?php endforeach ; ?>
                <?php 
                
                    $this->db->where('idBatch', $idBatch) ;
                    $this->db->join('_sample', '_sample.idSample = sample_batch.idSample') ;    
                    $this->db->join('_surat', '_surat.idSurat = _sample.idSurat') ;  
                    $this->db->select('tgl_submit, namaSample, namaSurat, tgl_submit_sample') ; 
                    $surat = $this->db->get('sample_batch')->row_array() ; 

                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td> <?= $this->_Date->formatTanggal( $surat['tgl_submit'] ); ?> </td>
                    <td>Sampel</td>
                    <td>Submit Sampel ( <?= $surat['namaSample']; ?> )</td>
                </tr>
                <tr>
                    <td><?= $no; ?></td>
                    <td> <?= $this->_Date->formatTanggal( $surat['tgl_submit_sample'] ); ?> </td>
                    <td>Surat</td>
                    <td>Submit Surat ( <?= $surat['namaSurat']; ?> )</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    $("#refresh-riwayat").click(function(){
        $("#riwayat").load('<?= base_url();?>home/riwayat/<?= $idBatch ;?>') ;
    });
    $('#tabel_riwayat_petugas_detail').dataTable();
</script>