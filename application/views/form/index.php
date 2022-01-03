<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#form_gi">
                General Informasi
                </button>
            </h5>
        </div>
        <div id="form_gi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="myscroll">
                            <ul class="list-group">
                                <?php foreach ($general_informasi as $gi) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $gi['namaGI']; ?>
                                            <?php if($gi['tugasGI'] == 1) : 
                                                $tugas = 'Evaluasi' ;
                                            else : 
                                                $tugas = 'Pemohon' ;
                                            endif ; ?>
                                        <a href='' class="badge badge-primary"> <i class="fa fa-plus"></i> </a>
                                    </li>
                                <?php endforeach ; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8"></div>
                </div>
            </div>
        </div>
    </div>
</div>