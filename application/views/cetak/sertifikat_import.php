<?php

// require_once base_url(). 'vendor/autoload.php';

// 1
// $config['composer_autoload'] = "./vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);


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

<body>' ;
foreach($batch as $b) {
    $html .= '
    <div class="judul">
        <h3>
            <U> CERTIFICATE OF RELEASE </U><br>
            No :'.$sertifikat['noSertifikat'].'
        </h3>

    </div>
    <div class="isi">
        <p>
            The following lot of <b> '.$sample['jenisSample'].', '.$sample['namaSample'] .' ,
            Batch No. '.$b['noBatch'].' ,</b> '.$sample['wIng'].' 1 mL ('.$b['dosis'].' doses). expiry date '. $this->_Date->dateFormat( $hasil_evaluasi['tgl_expiry'] ).' produced by '.$importir['namaImportir'].', '.$importir['alamatImportir'].', has been evaluated by Pusat Pengembangan Pengujian Obat dan Makanan Nasional based on examination of the production protocols. 
            
        </p>
    </div>

    <div class="ttd">
        Jakarta, '. $this->_Date->dateFormat( $sertifikat['tgl_realese'] ).' <br>

        <h5>
            PUSAT PENGEMBANGAN PENGUJIAN <br>
            OBAT DAN MAKANAN NASIONAL
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <u>E.Ika Prawahju A. </u> <br>
            Kepala Balai Pengujian Produk Biologi
        </h5>
        <div class="stempel">
            <img style="opacity:0.7;" height="170px" src="'.base_url().'assets/img/sertifikat-temp/stempel.png" alt="">
        </div>
        <div class="tanda-tangan">
            <img height="70px" src="'.base_url().'assets/file-upload/ttd/contoh.png" alt="">
        </div>
    </div>
    
    
    <pagebreak>
    ';

}
$html .= '
</body>
</html>' ;

$mpdf->SetHTMLFooter('<div class="footer">'.$hasil_evaluasi['nomer_ceklis'].'</div> <div class="footer-kanan">Page {PAGENO}</div>') ;
$mpdf->WriteHTML($html);
$mpdf->Output();

?>