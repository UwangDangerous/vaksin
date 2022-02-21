<div class="card p-3">
    <table class="table table-striped table-bordered text-center " id='tabel-pengujian'>
        <thead>
            <tr>
                <th class='align-middle'>No</th>
                <th class='align-middle'>Perihal Surat</th>
                <th class='align-middle'>Jenis Sampel</th>
                <th class='align-middle'>Nama Sampel / Produk</th>
                <th class='align-middle'>Jenis Perusahaan</th>
                <th class='align-middle'>Pengirim</th>
                <th class='align-middle'>Batch</th>
                <th class='align-middle'>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1 ; ?>
            <?php foreach ($pengujian as $row) : ?>
                <tr>
                    <?php $id = $row['idSample'] ; ?>
                    <td><?= $no++; ?></td>
                    <td>
                        <?= $row['namaSurat']; ?> 
                        <a target='_blank' href="<?= base_url() ; ?>assets/file-upload/surat/<?= $row['fileSurat'];?>" class="badge badge-warning" data-toggle='tooltip' title='Tampilkan Surat'><i class="fa fa-envelope"></i></a>
                    </td>
                    <td><?= $row['jenisSample']; ?></td>
                    <td><?= $row['namaSample']; ?></td>
                    <td><?= $row['namaJenisManufacture']; ?></td>
                    <td>
                        <?php if($row['idJenisManufacture'] == 2) : ?> 
                            <?= $this->Pengujian_model->getImportir($id)['namaImportir']; ?> <br> ( Importir <?= $row['namaEU']; ?> )
                        <?php else : ?>
                            <?= $row['namaEU']; ?> 
                        <?php endif ; ?>
                    </td>
                    <td> <?= $this->Pengujian_model->getBatch($id); ?> </td>
                    <td>
                        <a href="<?= base_url() ; ?>pengujian/detail/<?= $id;?>" class="badge badge-primary" data-toggle='tooltip' title='Rincian dan Tambah Hasil Uji'><i class="fa fa-pen"></i></a>
                    </td>
                </tr>
            <?php endforeach ; ?>
        </tbody>
    </table>
</div>