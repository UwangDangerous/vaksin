
    <table id="cobaTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>no</th>
                <th>nama</th>
                <th>alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ; ?>
            <?php foreach ($jenisSample as $js) : ?>
            
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $js['jenisSample']; ?></td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, eius.</td>
                </tr>

            <?php endforeach ; ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">
            <form action="<?= base_url();?>coba/tambah" method='post'>
                <div id="editor">
                    <textarea name="cobatini" id="mytextarea" cols="30" rows="10"></textarea>
                </div>
                <button type='submit'>mantap</button>
            </form>
        </div>
    </div>

    