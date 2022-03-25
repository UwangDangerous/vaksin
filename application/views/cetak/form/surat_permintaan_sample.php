<?php 

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);
$mpdf->SetHTMLHeader('<div class="header"><b>'.$judul.'</b></div>') ;

// header
    $html =$header ;
// header

// body 
    $html .= '
        <!--  
        <style>
            body{
                background-image:url('.base_url().'assets/img/sertifikat-temp/template-sertifikat.png) ;
                background-size:cover;
                background-attachment:fixed;
                font-family : "Arial";
            }
        </style>
        -->


        <div class="isi">
            <table class="tbl-kepada">
                <tr>
                    <td width="70%"></td>
                    <td>Jakarta, '.date('d-m-Y').'</td>
                </tr>
            </table>

            <br>
            
            <table cellspacing=2 cellpadding=2 >
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Nomor </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Lampiran </td>
                    <td valign="top"> : </td>
                    <td>-</td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Hal </td>
                    <td valign="top"> : </td>
                    <td>Permintaan Sampel Vaksin xxxxxxxxxxx</td>
                </tr>
            </table>

            <br>

            <b>
                Yth : <br>
                Kepala Balai Besar POM xxxxxxx <br>
                xxxxxxx <br>
                xxxxx <br>
            </b>

            <br>
            <br>
            <br>

            Dalam rangka pelaksanaan pengujian parameter uji lengkap vaksin di Pusar Pengembangan Pengujian Obat dan Makanan Nasional (PPPOMN ), kami memerlukan tambahan sampel vaksin sebagai berikut :
            <br>

            <div class="param-uji">
                <br>

                <table class="tbl-param" border="1" cellspacing=3 cellpadding=3>
                    <tr> 
                        <th valign="top">Nama Vaksin</th> 
                        <th valign="top">No. Bets</th>
                        <th valign="top">Jumlah</th>
                    </tr> 
                    <tr> 
                        <td valign="top"> xxxxx </td>
                        <td valign="top"> 000000 </td>
                        <td valign="top"> 00 vial </td>
                    </tr> 
                    <tr> 
                        <td valign="top"> xxxxx </td>
                        <td valign="top"> 000000 </td>
                        <td valign="top"> 00 vial </td>
                    </tr> 
                </table>

                <br>

                
            </div>

            Atas Perhatian dan kerja sama yang baik, diucapkan terima kasih.

            <br>
            <br>
            <br>
            <br>
            <br>

            <table class="ttd" cellpadding=2 cellspacing=2>
                <tr>
                    <td width=33% valign=top></td>
                    <td width=33% valign=top></td>
                    <td width=33% valign=top>Yang menyerahkan <br> Plt. Kasie Pengujian Mutu PB</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="isi-ttd"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><u> 
                        namanamanamanam <br> NIP. 00000000
                    </u></td>
                </tr>
            </table>

            <br>
            <br>
            <br>
            <br>

            Tembusan : <br>
            Direktur Utama PT. xxxxx <br>
            JL. xxxxxxxx No. 00 xxxxxx
            


        </div>
    ' ;
// body 

// footer
    $html .= '</body></html>' ;
// footer

$mpdf->SetHTMLFooter('<div class="footer">F/xxx/0000</div> <div class="footer-kanan">{PAGENO}</div>') ;
$mpdf->WriteHTML($html);

$mpdf->Output('Evaluasi Dokumen Produksi Vaksin .pdf' ,'I');

// $mpdf->Output();
// echo $html ;


?>




