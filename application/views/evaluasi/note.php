<?php $pekerjaan = $this->__Evaluasi_model->getDataPekerjaan($row['idBatch']) ; ?>
                            <?php if($pekerjaan) : ?>
                                <ul>
                                    <?php foreach ($pekerjaan as $work) : ?>
                                        <li><?= $work['namaJenisPekerjaan']; ?></li>
                                    <?php endforeach ; ?>
                                </ul>
                            <?php else : ?>
                                
                            <?php endif ; ?>


                            <td><a href="<?= base_url();?>Evaluasi/form/<?= $row['idJenisSample'];?>/<?= $row['idBatch'];?>" class="btn btn-primary" data-toggle='tooltip' title='Evaluasi Dokumen'><i class="fa fa-pen"></i></a></td>