<?php if($kolom) : ?>
    <div class="table-responsive pt-2">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>No</th>

                    <?php $jmlKolom = count($kolom) ; ?>
                    <?php $idKolom = [] ; ?>
                    <?php foreach ($kolom as $k) : ?>
                        <th><?= $k['nama_kolom']; ?></th>
                        <?php $idKolom[] = $k['id_kolom'] ?>
                    <?php endforeach ; ?>

                </tr>
                <tr>
                    <td>1</td>
                    <?php foreach ($idKolom as $idk) : ?>
                        <td>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                            
                            <div class="d-flex justify-content-left pt-2">
                                <button class="btn btn-outline-primary" data-toogle='tooltip' title='Simpan'><i class="fa fa-save"></i></button>
                                <button class="btn btn-outline-success" data-toogle='tooltip' title='Ubah Data'><i class="fa fa-edit"></i></button>
                                <button class="btn btn-outline-danger" data-toogle='tooltip' title='Hapus'><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    <?php endforeach ; ?>
                </tr>
            </thead>
        </table>
    </div>
<?php endif ; ?>