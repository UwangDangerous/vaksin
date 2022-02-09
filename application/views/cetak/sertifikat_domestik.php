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
            font-family : "Arial";
        }
        .judul{
            height:40px;
            width:400px;
            margin:auto;
            padding-top : 100px;
            padding-button : 60px;
            text-align : center;
            font-size : 18;
        }
        

        .isi{
            width:600px;
            margin:auto;
            padding-top : 10px;
            padding-button : 20px;
        }

        .isi p{
            text-align: justify;
            line-height:30px;
            line-height: 1.3;
        }

        .p-kanan{
            // padding-top : -35px ;
            text-align : right ;
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

        table{
            text-align : center ;
            width : 100% ;
        }
    </style>
</head>

<body>' ;
// foreach($batch as $b) {
    $html .= '
    <div class="judul">
            SERTIFIKAT PELULUSAN <br>
            <b><U> CERTIFICATE OF RELEASE </U></b><br>
            No :'.$sertifikat['noSertifikat'].'
    </div>
    <div class="isi">

        <p>
            Nama Sediaan Vaksin '.$sample['jenisSample'].' diproduksi oleh <br>
            <b> The following lot of '.$sample['jsIng'].' produced by '.$sample['namaEU'].', '.$sample['alamat'].'<b/> 
            <div class="p-kanan">memenuhi syarat <br> <b>meets all National Requirements, </b></div>
        </p> <br>
        
        <p>
            Farmakope Indonesia V, 2014 dan Persyaratan WHO untuk Vaksin '.$sample['jenisSample'].' <br>
            <b>
            Indonesian  Pharmacopoeia V, 2014; WHO Technical Report Series Fifty Sixth Report, Geneva, 2007; Part A of Recommendations to Assure the Quality, Safety and Efficacy of '.$sample['jsIng'].', WHO Technical Report Series 978, Sixty First  Report,  Geneva,  2013;  Part  A  of  the  Recommendations  for  the  Production  and Control of H. influenzae type B Conjugate Vaccines, Annex 1, WHO Technical Report Series,  No.  897,   Geneva,  2000  and  Manual  of  Laboratory  Methods  for  Testing  of Vaccines Used in the WHO Expanded Programme on Immunization,  WHO/VSQ/ 97.04, Geneva, 1997. 
            <b/>
        </p> <br>

        <table >
        <tr>
            <td>No.Bets</td>
            <td>No.Kode</td>
            <td>Tgl.Kadaluarsa</td>
            <td>Jumlah Vial</td>
        </tr>
        <tr>
            <th>Batch No.</th>
            <th>Code Number</th>
            <th>Expiration Date</th>
            <th>Number of vials</th>
        </tr>';
        foreach($batch as $b) {
$html .=    '
        <tr>
            <td>'.$b['noBatch'].'</td>
            <td>-</td>
            <td>'. $this->_Date->dateFormat( $hasil_evaluasi['tgl_expiry'] ).'</td>
            <td>'.$b['vial'].'</td>
        </tr>';
        }
$html .= ' 
              
    </table>

        
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
    
    
    ';

// }
$html .= '
</body>
</html>' ;

$mpdf->SetHTMLFooter('<div class="footer">'.$hasil_evaluasi['nomer_ceklis'].'</div> <div class="footer-kanan">Page {PAGENO}</div>') ;
$mpdf->WriteHTML($html);
$mpdf->Output();

?>