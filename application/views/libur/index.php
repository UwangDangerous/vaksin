<div class="card p-3">
    <form method="post" action="<?=base_url();?>libur">
        <div class="row">
            <div class="col-md-1">
                <a href="<?= base_url(); ?>libur/tambah" class="btn btn-primary mb-3" data-toggle='tooltip' title='Tambah Hari Libur Nasional'><i class="fa fa-pen"></i></a>
            </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <select class="custom-select" id="bulan" name='bulan'>
                            <option value=''>-Pilih Bulan-</option>
                            <?php foreach ($bulan as $bln) : ?>
                                <?php $bln = explode('|', $bln) ?>
                                <option value="<?= $bln[0]; ?>"><?= $bln[1]; ?></option>
                            <?php endforeach ; ?>
                        </select>
                        <select class="custom-select" id="tahun" name='tahun'>
                            <option value="">-pilih-</option>
                            <?php foreach ($tahun as $thn) : ?>
                                <option value="<?= $thn; ?>"><?= $thn; ?></option>
                            <?php endforeach ; ?>
                        </select>
                        <!-- <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name='cariTahun' data-toggle='tooltip' title='Pencarian Berdasarkan Bulan Dan Tahun'><i class="fa fa-search"></i></button>
                        </div> -->
                    </div>
                </div>
            <!-- </form> -->

            <div class="col-md-2">
                    <div class="input-group">
                        <select class="custom-select" id="jenis" name='jenis'>
                            <option value=''>-pilih-</option>
                            <option value='Nasional'>Nasional</option>
                            <option value='BPOM'>BPOM</option>
                        </select>
                        <!-- <div class="input-group-append">
                            <button class="btn btn-primary" type="Submit" name='cariJenis'  data-toggle='tooltip' title='Pencarian Berdasarkan Bulan Dan Tahun'><i class="fa fa-search"></i></button>
                        </div> -->
                    </div>
                <!-- </form> -->
            </div>
            
                <div class="col-md-5">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari.."  name='nama'>
                        <!-- <div class="input-group-append">
                            <button class="btn btn-primary" type="Submit" name='cariNama' data-toggle='tooltip' title='Pencarian Berdasarkan Libur Nasional'><i class="fa fa-search"></i></button>
                        </div> -->
                    </div>
                </div>
            <!-- </form> -->

            <div class="col-md-1">
                <button type="submit" name='cari' class="btn btn-primary mb-3" data-toggle='tooltip' title='Pencarian'><i class="fa fa-search"></i></button>
            </div>

            
        </div>
    </form>

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>
        
        <div class="alert alert-<?= $this->session->flashdata('warna'); ?> alert-dismissible fade show" role="alert">
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
                    <th>Libur Nasional</th>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=$start ; ?>
                <?php foreach ($libur as $row) : ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $row['namaLibur']; ?></td>
                        <td> <?= $this->_Date->formatTanggal( $row['tglLibur'] ); ?></td>
                        <td>Libur <?= $row['tipe']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>libur/ubah/<?= $row['idLibur']; ?>" class="badge badge-success" data-toogle='tooltip' title="Ubah Data"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url(); ?>libur/hapus/<?= $row['idLibur']; ?>" class="badge badge-danger" data-toggle="tooltip" title="hapus data" onclick="return confirm('yakin? data akan di hapus')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->pagination->create_links(); ?>
<i>Tersedia <?= $total_rows; ?> Data</i>