<?php

// require_once base_url(). 'vendor/autoload.php';

// 1
// $config['composer_autoload'] = "./vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf(['format' => [210, 297] ]); //[215, 330] ]


$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Pelulusan</title>
    <style>
        body{
            background-image:url('.base_url().'assets/img/sertifikat-temp/template-sertifikat.png) ;
            background-size:cover;
            background-attachment:fixed;
            font-family: "Arial";
        }
        .judul{
            height:40px;
            width:400px;
            margin:auto;
            padding-top : 100px;
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


        .tanda-tangan {
            
            padding-left : 0px;
            padding-top : -110px;
            position : absolute ;
        }
        .stempel {
            padding-left : -50px;
            padding-top : -180px;
            position : absolute ;
        }

        .footer{
            width: 50%;
            float : left ;
            /* padding-top: 20px; */
        }
        
        .footer-kanan{
            width : 50% ;
            float : left ;
            text-align: right;
            /* margin-top: 20px; */
        }
    </style>
</head>

<body>
 coba coba
</body>
</html>' ;

// $mpdf->SetHTMLFooter('<div class="footer">'.$hasil_evaluasi['nomer_ceklis'].'</div> <div class="footer-kanan">Page {PAGENO}</div>') ;
$mpdf->WriteHTML($html);
$mpdf->Output();

?>