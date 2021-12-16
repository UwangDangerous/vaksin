<?php

// require_once base_url(). 'vendor/autoload.php';

// 1
// $config['composer_autoload'] = "./vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);


$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coba Print</title>
    <style>
        body{
            background-image:url('.base_url().'assets/img/sertifikat-temp/body.jpg) ;
            background-size:cover;
            background-attachment:fixed;
            font-family: "Arial";
        }
        .judul{
            height:40px;
            width:400px;
            margin:auto;
            padding-top : 70px;
            padding-button : 60px;
        }
        
        .judul h3{
            text-align : center;
        }

        .isi{
            width:600px;
            margin:auto;
            padding-top : 10px;
            padding-button : 20px;
        }

        .isi p{
            text-align : justify;
            line-height:30px;
        }

        .ttd{
            width:600px;
            padding-left : 400px;
            padding-top : 50px;
            position : relative ;
        }


         img{
            padding-left : 400px;
            padding-top : -150px;
            position : absolute ;
        }
    </style>
</head>

<body>
    <div class="judul">
        <h3>
            <U> CERTIFICATE OF RELEASE </U><br>
            No : PP.01.01.02i.11.111.03.10.21.33
        </h3>

    </div>

    <div class="isi">
        <p>
            The following lot of <b> COVID-19 Vaccine (Vero Cell), Inactived (CORONAVAC) Batch No. 2021081671,</b> vial 1 mL (2 doses). expiry date 20<sup>th</sup> February 2022 produced by Sinovac Life Sciences Co., Ltd., China, has been evaluated by Pusat Pengembangan Pengujian Obat dan Makanan Nasional based on examination of the production protocols. 
            
        </p>
    </div>

    <div class="ttd">
        Jakarta, '.date("d-m-Y").' <br>

        <h5>
            PUSAT PENGEMBANGAN PENGUJIAN <br>
            OBAT DAN MAKANAN NASIONAL
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <u>E.Ika Prawahju A. </u> <br>
            Kepala Balai Pengujian Produk Biologi
        </h5>
    </div>
        <img src="'.base_url().'assets/img/sertifikat-temp/ttd-polos.png" alt="">
</body>
</html>' ;


$mpdf->WriteHTML($html);
$mpdf->Output();

?>