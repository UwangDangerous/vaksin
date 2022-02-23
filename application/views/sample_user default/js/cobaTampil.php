
<div class="table-resposive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class='text-center'>
                <th>No</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $this->db->where('idSample', $id);
                $riwayat = $this->db->get('riwayatpekerjaan')->result_array(); 
            ?>
            <tr>
                <td>1</td>
                <td>Tanggal Kirim Surat</td>
                <td><?= $this->_Date->formatTanggal($tgl_kirim_surat); ?></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tanggal Pengiriman Sampel</td>
                <td><?= $this->_Date->formatTanggal($tgl_pengiriman); ?></td>
                <td></td>
            </tr>
            <?php $no = 3; ?>
            <?php foreach ($riwayat as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['keteranganRiwayat']; ?></td>
                    <td><?= $this->_Date->formatTanggal($row['tgl_riwayat']); ?></td>
                    <td><?= $row['jam_riwayat']; ?></td>
                </tr>
            <?php endforeach ; ?>
        </tbody>
    </table>
</div>