<?php 

//tutor 1

// $awal_cuti = '1-07-2020';
// $akhir_cuti = '31-08-2020';
 
// // // tanggalnya diubah formatnya ke Y-m-d 
// $awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
// $awal_cuti = date_format($awal_cuti, 'Y-m-d');
// $awal_cuti = strtotime($awal_cuti);
 
// $akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
// $akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
// $akhir_cuti = strtotime($akhir_cuti);
 
// $haricuti = array();
// $sabtuminggu = array();
 
// for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
//     if (date('w', $i) !== '0' && date('w', $i) !== '6') {
//         $haricuti[] = $i;
//     } else {
//         $sabtuminggu[] = $i;
//     }
 
// }
// // var_dump($i) ;
// $jumlah_cuti = count($haricuti);
// $jumlah_sabtuminggu = count($sabtuminggu);
// $abtotal = $jumlah_cuti + $jumlah_sabtuminggu;
// echo "<pre>";
// echo "<h1>Sistem Cuti Online</h1>";
// echo "<hr>";
// echo "Mulai Cuti : " . date('d-m-Y', $awal_cuti) . "<br>";
// echo "Terakhir Cuti : " . date('d-m-Y', $akhir_cuti) . "<br>";
// echo "Jumlah Hari Cuti : " . $jumlah_cuti ."<br>";
// echo "Jumlah Sabtu/Minggu : " . $jumlah_sabtuminggu ."<br>";
// echo "Total Hari : " . $abtotal ."<br>";

// tutor 2

// echo date('Y-m-d', strtotime('+127 day', strtotime( "2021-12-01" ))); //tambah tanggal sebanyak 6 bulan
// date('Y-m-d', strtotime('+6 year', strtotime( variabel_tgl_awal ))); //tambah tanggal sebanyak 6 tahun

// $waktuAwal = '2021-12-01' ;
// $pengerjaan = 3 ;
// $clockOFF = '2021-12-02' ;

// echo date('d-m-Y', strtotime("+$pengerjaan day", strtotime($waktuAwal))) ;

// tutor 3
// $awal  = strtotime('2019-02-25 10:05:25'); //waktu awal

// $akhir = strtotime('2019-02-25 11:07:33'); //waktu akhir

// $diff  = $akhir - $awal;

// $jam   = floor($diff / (60 * 60));

// $menit = $diff - $jam * (60 * 60);

// echo 'Waktu Tersisa tinggal: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';

// tutor 4

date_default_timezone_set('Asia/Jakarta');
// $awal = date("d-m-Y h:i:s");
// $pengerjaan = 60;

// echo 'Berkas Diterima '.date("d-m-Y h:i:s"); 
// echo '<br>' ;
// echo 'Estimasi Pengerjaan '.date('d-m-Y h:i:s', strtotime("+$pengerjaan day", strtotime($awal))) ;


$awal = '2021-12-17';
$pengerjaan = 7;
$hasil = date('Y-m-d', strtotime("+$pengerjaan day", strtotime($awal))) ;


$awalPengerjaan = $awal;
$akhirPengerjaan = $hasil;
 
// // tanggalnya diubah formatnya ke Y-m-d 
$awalPengerjaan = date_create_from_format('Y-m-d', $awalPengerjaan);
$awalPengerjaan = date_format($awalPengerjaan, 'Y-m-d');
$awalPengerjaan = strtotime($awalPengerjaan);
 
$akhirPengerjaan = date_create_from_format('Y-m-d', $akhirPengerjaan);
$akhirPengerjaan = date_format($akhirPengerjaan, 'Y-m-d');
// var_dump($akhirPengerjaan) ;
$akhirPengerjaan = strtotime($akhirPengerjaan);
 
$haricuti = array();
$sabtuminggu = array();
 
for ($i=$awalPengerjaan; $i <= $akhirPengerjaan; $i += (60 * 60 * 24)) {
    if (date('w', $i) !== '0' && date('w', $i) !== '6') {
        $haricuti[] = $i;
    } else {
        $sabtuminggu[] = $i;
    }
 
}
// var_dump($i) ;
$jumlah_cuti = count($haricuti);
$jumlah_sabtuminggu = count($sabtuminggu);
$abtotal = $jumlah_cuti + $jumlah_sabtuminggu;


$hariKerja = $pengerjaan + $jumlah_sabtuminggu ;
$hasil = date('Y-m-d', strtotime("+$hariKerja day", strtotime($awal))) ;
echo $hariKerja;
echo 'Berkas Diterima '. $this->_Date->formatTanggal( $awal );
echo '<br>' ;
echo '<br>' ;
echo 'Clock OFF' ;
echo '<br>' ;
echo '<br>' ;
echo "Pengerjaan $pengerjaan Hari, Akan Selesai Pada Tanggal ". $this->_Date->formatTanggal($hasil) ;



echo '<hr>' ;

$coba = strtotime('2021-12-15');
$coba2 = strtotime( date('Y-m-d') );
$awalWaktu = strtotime('1970-01-01') ;
// $coba3 = ($coba - $awalWaktu) + ($coba2 - $awalWaktu) ;
echo date("Y-m-d", $coba );
echo '<br>' ;
echo date("Y-m-d", $coba2 );
echo '<br>' ;
// echo date("Y-m-d", $coba) ;
$jarak = $coba2 - $coba;

$hari = $jarak / 60 / 60 / 24;
echo $hari;

echo "<br>" ;
echo $coba ;
echo "<br>" ;
echo $coba2 ;
echo "<br>" ;
echo $jarak ;
echo "<hr>" ;
$awal_cuti = '17-12-2021';
$akhir_cuti = '26-12-2021';
 
// tanggalnya diubah formatnya ke Y-m-d 
$awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
$awal_cuti = date_format($awal_cuti, 'Y-m-d');
$awal_cuti = strtotime($awal_cuti);
 
$akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
$akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
$akhir_cuti = strtotime($akhir_cuti);
 
$haricuti = array();
$sabtuminggu = array();
 
for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
    if (date('w', $i) !== '0' && date('w', $i) !== '6') {
        $haricuti[] = $i;
    } else {
        $sabtuminggu[] = $i;
    }
 
}
$jumlah_cuti = count($haricuti);
$jumlah_sabtuminggu = count($sabtuminggu);
$abtotal = $jumlah_cuti + $jumlah_sabtuminggu;
echo "<pre>";
echo "<h1>Sistem Cuti Online</h1>";
echo "<hr>";
echo "Mulai Cuti : " . date('d-m-Y', $awal_cuti) . "<br>";
echo "Terakhir Cuti : " . date('d-m-Y', $akhir_cuti) . "<br>";
echo "Jumlah Hari Cuti : " . $jumlah_cuti ."<br>";
echo "Jumlah Sabtu/Minggu : " . $jumlah_sabtuminggu ."<br>";
echo "Total Hari : " . $abtotal ."<br>";
 
 
echo "<h1>Hari Kerja</h1>";
echo "<hr>";
    foreach ($haricuti as $value) {
        echo date('d-m-Y', $value)  . " -> " . strftime("%A, %d %B %Y", date($value)) . "\n" . "<br>";
    }
 
echo "<h1>Sabtu Minggu</h1>";
echo "<hr>";
    foreach ($sabtuminggu as $value) {
        echo date('d-m-Y', $value) . " -> " . strftime("%A, %d %B %Y", date($value)) . "\n" . "<br>";
    }
?>

