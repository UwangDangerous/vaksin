<!DOCTYPE html>
<html>
<head>
  <title>Belajar Array 2 Dimensi PHP</title>
</head>
<body>
<table border="1">
<tr><td>Nama</td><td>Jurusan</td><td>Jenis Kelamin</td><td>Usia</td></tr>
<?php
$mahasiswa = array(
		array("Dimas", "Teknik Informatika", "Laki-laki",23),
		array("Fitri", "Sistem Informasi", "Perempuan", 22),
		array("Juan",'', "Laki-laki",24),
		array("Wulan", "Teknik Komputer", "Perempuan", 20),
		array("Marcel", "Teknik Informatika", "Laki-laki", 24)
		);
			
	for ($row = 0; $row < 5; $row++) {
		echo "<tr>";
		for ($col = 0; $col < 4; $col++) {
			echo "<td>".$mahasiswa[$row][$col]."</td>";
		}
	echo "</tr>";
}
?>
<?php foreach ($mahasiswa as $mhs) : ?>
    <tr>
        <?php foreach ($mhs as $m) : ?>
            <td><?= $m; ?></td>
        <?php endforeach ; ?>
    </tr>
<?php endforeach ; ?>
</table>
</body>
</html>