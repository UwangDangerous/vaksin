<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base_url(); ?>assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="<?= base_url(); ?>assets/js/jquery.js" ></script>
    
    <!-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> -->
</head>
<body>
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

    <form action="<?= base_url();?>dashboard?test=mantap">
        <button type='submit'>mantap</button>
    </form>

    <script src="<?= base_url(); ?>assets/js/dataTables.js" ></script>
    <script>
        $(document).ready(function() {
            // $('.display').dataTable();
            $('#cobaTable').dataTable();
        } );
    </script>
</body>
</html>