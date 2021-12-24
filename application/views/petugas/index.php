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


    <div class="table-responsive ">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th class='align-middle'>No</th>
                    <th class='align-middle'>Pengirim</th>
                    <th class='align-middle'>Nama Sampel / Produk</th>
                    <th class='align-middle'>Sampel</th>
                    <th class='align-middle'>Jenis Pengujian</th>
                    <th class='align-middle'>Tanggal Terima</th>
                    <th class='align-middle'>Bukti Bayar</th>
                    <th class='align-middle'>Tanggal Pembayaran</th>
                    <th class='align-middle'>Pengerjaan
                    <th class='align-middle'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namaEU']; ?></td>
                        <td><?= $row['namaSample']; ?></td>
                        <td><?= $row['jenisSample']; ?> ( <?= $row['waktuPengujian']; ?> Hari)</td>
                        <td><?= $row['namaJenisDokumen']; ?></td>
                        <td><?= $this->_Date->formatTanggal( $row['tgl_pengiriman'] ); ?></td>
                        <td>
                            <?php if($bukti = $this->Petugas_model->getBuktiBayar($row['idSample']) ) : ?>
                                <a href="<?= base_url(); ?>assets/file-upload/bukti-bayar/<?= $bukti['fileBuktiBayar']; ?>" class="badge badge-success" data-toogle='tooltip' title='Lihat Bukti Bayar'><i class="fa fa-check"></i></a>

                                <?php $tglBayarFormat = $this->_Date->formatTanggal( $bukti['tgl_bayar'] ).'<br>( '.$bukti['jam_bayar'].' )' ; ?> <br>
                                <?php 
                                    $pengerjaan = $this->_Date->Pengerjaan( $row['idSample'], $row['waktuPengujian'], $bukti['tgl_bayar'], $bukti['jam_bayar'] ) ; 
                                ?>  
                            <?php else : ?>
                                <a href="#" class="badge badge-danger" data-toogle='tooltip' title='Belum Ada Bukti Bayar'><i class="fa fa-times"></i></a>
                                <?php  $pengerjaan = $this->_Date->Pengerjaan( $row['idSample'], $row['waktuPengujian'], null , null ) ; ?>

                                <?php $tglBayarFormat = '';  ?>
                            <?php endif ; ?>
                        </td>
                        <td><?= $tglBayarFormat; ?></td>
                        <td> <?= $pengerjaan['waktuBerjalan']; ?> dari <?= $pengerjaan['total'] ; ?>

                        <td>
                            <!-- acordion -->
                            <div id="accordion">
                                <!-- <div class="card"> -->
                                    <div class="card-headerkomen" id="headingThree">
                                        <a class="badge badge-warning collapsed" data-toggle="collapse" data-target="#collapseThree<?= $row['idSample']; ?>" aria-expanded="false" aria-controls="collapseThree" data-toggle="tooltip" title="Petugas">
                                            <i class="fa fa-user-tie" ></i>
                                        </a>
                                    </div>
                                    <div id="collapseThree<?= $row['idSample']; ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <ul class="list-group">
                                        <?php $petugas = $this->Petugas_model->getPetugas($row['idSample']); ?>
                                        <?php if($petugas == null) : ?>
                                            <li class="list-group-item">
                                                <a class='badge badge-danger' data-toggle="modal"  data-toggle="tooltip" title="Pilih Petugas" data-target="#petugas<?= $row['idSample'];?>" type='button'> 
                                                    <i class="fa fa-plus"></i> 
                                                </a>
                                            </li>
                                        <?php else : ?>
                                            <li class="list-group-item">
                                                <a class='badge badge-success' data-toggle="modal"  data-toggle="tooltip" title="Lihat Petugas" data-target="#viewPetugas<?= $row['idSample'];?>" type='button'> 
                                                    <i class="fa fa-eye"></i> 
                                                </a>
                                            </li>
                                        <?php endif ; ?>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- acordion -->
                                            
                            <!-- Modal Tambah-->
                            <div class="modal fade" id="petugas<?= $row['idSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">

                                        <form action="<?= base_url(); ?>petugas/tambahPetugas" method='post'> 
                                            <input type="hidden" value="<?= $row['idSample']; ?>" name='idSample'>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Pilih Petugas Evaluator dan Verifikator</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-4"><label for="evaluator">Evaluator</label></div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <select class="form-control" id="evaluator" name='evaluator'>
                                                                        <option value="">-pilih-</option>
                                                                        <?php foreach ($this->Petugas_model->getPilihPetugas(3) as $eva) : ?>
                                                                            <option value="<?= $eva['idIU']; ?>"><?= $eva['namaIU']; ?></option>
                                                                        <?php endforeach ; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-4"><label for="verifikator">Verifikator</label></div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <select class="form-control" id="verifikator" name='verifikator'>
                                                                        <option value="">-pilih-</option>
                                                                        <?php foreach ($this->Petugas_model->getPilihPetugas(4) as $ver) : ?>
                                                                            <option value="<?= $ver['idIU']; ?>"><?= $ver['namaIU']; ?></option>
                                                                        <?php endforeach ; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-4"><label for="ve">Evaluator dan Verifikator</label></div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <select class="form-control" id="ve" name='ve'>
                                                                        <option value="">-pilih-</option>
                                                                        <?php foreach ($this->Petugas_model->getPilihPetugas(5) as $ve) : ?>
                                                                            <option value="<?= $ve['idIU']; ?>"><?= $ve['namaIU']; ?></option>
                                                                        <?php endforeach ; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <button class="btn btn-primary" type='submit'>Simpan</button> <br><br>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal Tambah-->

                            <!-- Modal View Petugas-->
                            <div class="modal fade" id="viewPetugas<?= $row['idSample'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        
                                        <!-- <input type="hidden" value="<?//= $row['idSample']; ?>" name='idSample'> -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Petugas Evaluator dan Verifikator <?= $row['namaSample']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <?php $pe = $this->Petugas_model->getDataPetugas(3,$row['idSample'])['idIU'] ; ?>
                                                    <?php $idPE = $this->Petugas_model->getDataPetugas(3,$row['idSample'])['idPetugas'] ; ?>
                                                    
                                                    <?php if($pe) : ?>
                                                        <form action="<?= base_url(); ?>petugas/ubahPetugasSusulan/3" method='post'>
                                                        <input type="hidden" value="<?= $idPE; ?>" name='idPetugas'>
                                                    <?php else : ?>
                                                        <form action="<?= base_url(); ?>petugas/tambahPetugasSusulan/3" method='post'> 
                                                    <?php endif ; ?>

                                                    <div class="row">
                                                        <div class="col-md-2"><label for="evaluator">Evaluator</label></div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">

                                                                <input type="hidden" value="<?= $row['idSample']; ?>" name='idSample'>
                                                                <select class="form-control" id="evaluator" name='evaluator'>
                                                                    <option value="">-pilih-</option>
                                                                    <?php foreach ($this->Petugas_model->getPilihPetugas(3) as $eva) : ?>
                                                                        <?php if($eva['idIU'] == $pe = $this->Petugas_model->getDataPetugas(3,$row['idSample'])['idIU']) : ?>
                                                                            <option selected value="<?= $eva['idIU']; ?>"><?= $eva['namaIU']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $eva['idIU']; ?>"><?= $eva['namaIU']; ?></option>
                                                                        <?php endif ; ?>
                                                                    <?php endforeach ; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                                <?php if($pe) : ?>
                                                                <button type='submit' class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                            <?php else : ?>
                                                                <button type='submit' class="btn btn-primary"><i class="fa fa-pen"></i></button>
                                                            <?php endif ; ?>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </li>

                                                <li class="list-group-item">
                                                    <?php $pv = $this->Petugas_model->getDataPetugas(4,$row['idSample'])['idIU'] ; ?>
                                                    <?php $idPV = $this->Petugas_model->getDataPetugas(4,$row['idSample'])['idPetugas'] ; ?>

                                                    <?php if($pv) : ?>
                                                        <form action="<?= base_url(); ?>petugas/ubahPetugasSusulan/4" method='post'>
                                                        <input type="hidden" value="<?= $idPV; ?>" name='idPetugas'>
                                                    <?php else : ?>
                                                        <form action="<?= base_url(); ?>petugas/tambahPetugasSusulan/4" method='post'> 
                                                    <?php endif ; ?>

                                                        <input type="hidden" value="<?= $row['idSample']; ?>" name='idSample'>
                                                        <div class="row">
                                                            <div class="col-md-2"><label for="verifikator">Verifikator</label></div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <select class="form-control" id="verifikator" name='verifikator'>
                                                                        <option value="">-pilih-</option>
                                                                        <?php foreach ($this->Petugas_model->getPilihPetugas(4) as $ver) : ?>
                                                                            <?php if($ver['idIU'] == $pv ) : ?>
                                                                                <option selected value="<?= $ver['idIU']; ?>"><?= $ver['namaIU']; ?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?= $ver['idIU']; ?>"><?= $ver['namaIU']; ?></option>
                                                                            <?php endif ; ?>
                                                                        <?php endforeach ; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <?php if($pv) : ?>
                                                                    <button type='submit' class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                                <?php else : ?>
                                                                    <button type='submit' class="btn btn-primary"><i class="fa fa-pen"></i></button>
                                                                <?php endif ; ?>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal View Petugas-->
                            <a href="<?= base_url() ; ?>petugas/detail/<?= $row['idSample']; ?>" class="badge badge-primary" data-toggle='tooltip' title='Lihat Rincian'><i class="fa fa-info"></i></a>
                        </td>

                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>
<?//php date_default_timezone_set('Asia/Jakarta'); ?>
<?//= date('h:m:s'); ?>


 