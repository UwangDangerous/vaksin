<?php $tglBayarFormat = ''; ?>
<div class="card p-3">
    <div class="row">
        <div class="col-md-6">  
            <form action="" method='post'>
                <div class="input-group">
                    <select class="custom-select" name='cariJenisDok'>
                        <option value="">-pilih-</option>
                        <?php foreach ($jenisDokumen = $this->db->get('_jenisDokumen')->result_array() as $jd) : ?>
                            <option value='<?= $jd['idJenisDokumen']; ?>'> <?= $jd['namaJenisDokumen']; ?> </option>
                        <?php endforeach ; ?>
                    </select>
                    <div class="input-group-append">
                        <button type='submit' name='cariByDokumen' class="btn btn-outline-primary" value='cariByDokumen'>
                            <fa class="fa fa-search"></fa>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form action="" method='post'>
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
                    <th class='align-middle'>Tanggal Terima Sampel</th>
                    <th class='align-middle'>Bukti Bayar</th>
                    <th class='align-middle' colspan='2'>Tanggal Pembayaran</th>
                    <th class='align-middle' colspan='2'>Pengerjaan
                    <th class='align-middle'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($sample as $row) : ?>
                    <tr>
                        <!-- 1 -->
                        <td><?= $no++; ?></td>
                        <!-- 2 -->
                        <td><?= $row['namaEU']; ?></td>
                        <!-- 3 -->
                        <td><?= $row['namaSample']; ?></td>
                        <!-- 4 -->
                        <td><?= $row['jenisSample']; ?> ( <?= $row['waktuPengujian']; ?> Hari)</td>
                        <!-- 5 -->
                        <td><?= $row['namaJenisDokumen']; ?></td>
                        <!-- 6 -->
                        <td><?= $this->_Date->formatTanggal( $row['tgl_pengiriman'] ); ?></td>
                        <!-- 7 s/d 10-->
                        <?php if($bukti = $this->Petugas_model->getBuktiBayar($row['idSample']) ) : ?>
                            <?php if($bukti['status_verifikasi_bayar'] == 1) : ?>
                                <!-- 7 -->
                                    <td>
                                        <a href="<?= base_url(); ?>assets/file-upload/bukti-bayar/<?= $bukti['fileBuktiBayar']; ?>" target='blank' class="badge badge-success" data-toogle='tooltip' title='Lihat Bukti Bayar'><i class="fa fa-check"></i></a>
                                    </td>
                                <!-- 7 -->

                                <!-- 8 -->
                                    <td><?= $this->_Date->formatTanggal($bukti['tgl_verifikasi_bayar']); ?></td>
                                    <td><?= $bukti['jam_verifikasi_bayar'] ; ?></td>
                                <!-- 8 -->
                                
                                <!-- 9 -->
                                <?php if($row['idJenisDokumen'] == 1) : ?>
                                    <?php $pengerjaan = $this->_Date->pengerjaan(
                                        $row['idSample'],
                                        $row['waktuPengujian'],
                                        $bukti['tgl_verifikasi_bayar'],
                                        $bukti['jam_verifikasi_bayar']
                                    ); ?>
                                
                                    <?php if($pengerjaan['ket'] == true) : ?>
                                        <td>
                                            <i class='text-danger'>Sedang Libur</i>
                                        </td>
                                    <?php else : ?>
                                        <?php if($pengerjaan['waktuBerjalan'] == $pengerjaan['total']) : ?>
                                            <td class='text-warning'>
                                        <?php elseif($pengerjaan['waktuBerjalan'] > $pengerjaan['total']) : ?>
                                            <td class='text-danger'>
                                        <?php else : ?> 
                                            <td>
                                        <?php endif ; ?>
                                            <?= $pengerjaan['waktuBerjalan']; ?>
                                            /
                                            <?= $pengerjaan['total']; ?>
                                            hari
                                        </td>
                                    <?php endif ; ?>
                                    <td><?= $row['namaProses']; ?></td>
                                <?php else : ?>
                                    <?php if($row['idProses'] == 0) : ?>
                                        <td colspan=2>
                                            <a href="" class='badge badge-primary' data-toggle='modal' data-target='#ver<?= $row['idSample'] ?><?= $row['idProses'] ;?>' data-toggle='tooltip' title='Pilih Pekerjaan'> <i class="fa fa-pen"></i> </a>
                                        </td>
                                    <?php elseif($row['idProses'] == 1) : ?>
                                        <!-- 9 -->
                                            <?php $pengerjaan = $this->_Date->pengerjaan(
                                                $row['idSample'],
                                                $row['waktuPengujian'],
                                                $bukti['tgl_verifikasi_bayar'],
                                                $bukti['jam_verifikasi_bayar']
                                            ); ?>
                                        
                                            <?php if($pengerjaan['ket'] == true) : ?>
                                                <td>
                                                    <i class='text-danger'>Sedang Libur</i>
                                                </td>
                                            <?php else : ?>
                                                <?php if($pengerjaan['waktuBerjalan'] == $pengerjaan['total']) : ?>
                                                    <td class='text-warning'>
                                                <?php elseif($pengerjaan['waktuBerjalan'] > $pengerjaan['total']) : ?>
                                                    <td class='text-danger'>
                                                <?php else : ?> 
                                                    <td>
                                                <?php endif ; ?>
                                                    <?= $pengerjaan['waktuBerjalan']; ?>
                                                    /
                                                    <?= $pengerjaan['total']; ?>
                                                    hari
                                                </td>
                                            <?php endif ; ?>
                                            <td><?= $row['namaProses']; ?></td>
                                        <!-- 9 -->
                                    <?php elseif($row['idProses'] == 2) : ?>
                                        <?php 
                                            $this->db->where('idSample', $row['idSample']);
                                            $hasilPengujian = $this->db->get('prosespengerjaan')->row_array() ;
                                        ?>
                                        <?php if($hasilPengujian) : ?>
                                            <?php $pengerjaan = $this->_Date->pengerjaan(
                                                $row['idSample'],
                                                $row['waktuPengujian'],
                                                $hasilPengujian['tgl_selesai'],
                                                $hasilPengujian['jam_selesai']
                                            ); ?>
                                            <?php if($pengerjaan['ket'] == true) : ?>
                                                <td>
                                                    <i class='text-danger'>Sedang Libur</i>
                                                </td>
                                            <?php else : ?>
                                                <?php if($pengerjaan['waktuBerjalan'] == $pengerjaan['total']) : ?>
                                                    <td class='text-warning'>
                                                <?php elseif($pengerjaan['waktuBerjalan'] > $pengerjaan['total']) : ?>
                                                    <td class='text-danger'>
                                                <?php else : ?> 
                                                    <td>
                                                <?php endif ; ?>
                                                    <?= $pengerjaan['waktuBerjalan']; ?>
                                                    /
                                                    <?= $pengerjaan['total']; ?>
                                                    hari
                                                </td>
                                            <?php endif ; ?>
                                            <td><?= $row['namaProses']; ?></td>
                                        <?php else : ?>
                                            <td colspan=2>
                                                <i class="text-danger">Menunggu Hasil Pengujian</i>
                                            </td>
                                        <?php endif ; ?>
                                    <?php endif ; ?>
                                <?php endif ; ?>
                                <!-- 9 -->

                            <?php else : ?>
                                <td>
                                    <a href="<?= base_url(); ?>sample/buktiBayar?cari=<?= $row['idSample']; ?>" class="badge badge-warning">Verifikasi</a>    
                                </td>
                                <td class='text-warning'><?= $this->_Date->formatTanggal($bukti['tgl_bayar']); ?></td>
                                <td class='text-warning'><?= $bukti['jam_bayar'] ; ?></td>
                                <td colspan=2>-</td>
                            <?php endif ; ?>
                        <?php else : ?>
                            <!-- 7 -->
                                <td colspan='5'> <i class="text-danger"> Kosong </i> </td>
                            <!-- 7 -->
                        <?php endif ; ?>

                        <!-- 10 -->
                        <td>
                            <a href="<?= base_url() ; ?>petugas/detail/<?= $row['idSurat']; ?>/<?= $row['idSample'];?>" class="badge badge-primary" data-toggle='tooltip' title='Lihat Rincian'><i class="fa fa-info"></i></a>
                            <!-- acordion -->
                                <div id="accordion">
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
                                
                                <!-- <a href="" class="badge badge-primary" data-toggle='tooltip' title='1'><i class="fa fa-pen"></i></a>
                                <a href="" class="badge badge-success" data-toggle='tooltip' title='2'><i class="fa fa-pen"></i></a>
                                <a href="" class="badge badge-warning" data-toggle='tooltip' title='4'><i class="fa fa-pen"></i></a>
                                <a href="" class="badge badge-danger" data-toggle='tooltip' title='3'><i class="fa fa-pen"></i></a>
                                <a href="" class="badge badge-secondary" data-toggle='tooltip' title='5'><i class="fa fa-pen"></i></a> -->
                        </td>
                        <!-- 10 -->
                        
                                

                    </tr>
                    <div class="modal fade" id="ver<?= $row['idSample'] ?><?= $row['idProses'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="<?= base_url(); ?>petugas/ubahIdProsesSample/<?= $row['idSample'];?>/<?= $row['idSurat'];?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pilih Pekerjaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <b> Jenis Pekerjaan </b> <br><br>
                                        <?php $this->db->where('idProses != 0'); ?>
                                        <?php foreach ($this->db->get('proses')->result_array() as $p) : ?>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="cmbProses" id="cmb<?= $p['idProses']?>" value="<?= $p['idProses']?>" >
                                                <label class="form-check-label" for="cmb<?= $p['idProses']?>">
                                                    <?= $p['namaProses']; ?>
                                                </label>
                                            </div>
                                        <?php endforeach ; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>
<?//php date_default_timezone_set('Asia/Jakarta'); ?>
<?//= date('h:m:s'); ?>



 