<?php 

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);
$mpdf->SetHTMLHeader('<div class="header"><b>'.$judul.'</b></div>') ;

// header
    $html =$header ;
// header

// body 
    $html .= '

        <div class="isi" >
            <H3> LEMBAR TANGGAPAN <H3>
            <table cellpadding=3 cellspacing=3 >
                <tr>
                    <td width=200px> Nomor Tanggapan </td> <td width="20px"> : </td> <td> xxxxxxxxxx / xxxxx </td>
                </tr>
                <tr>
                    <td> Asal Surat </td> <td> : </td> <td> PT. xxxxx , kota </td>
                </tr>
                <tr>
                    <td> No. / Tanggal Surat Pengiriman </td> <td> : </td> <td> ..... </td>
                </tr>
                <tr>
                    <td> Tgl. di terima di Laboratorium </td> <td> : </td> <td> ..... </td>
                </tr>
                <tr>
                    <td> Perihal </td> <td> : </td> <td> ..... </td>
                </tr>
            </table>

            <table class="dituju" cellpadding=10 cellspacing=3 border=1>
                <tr>
                    <th> DITUJU KEPADA </th>
                    <th> RINGKASAN </th>
                </tr>
                <tr>
                    <td valign=top width=35%> 
                        Yth. <br>
                        PT. xxxxxx <br>
                        Alamat Lengkap <br>
                        Kota <br> <br>

                        Tanggapan <br> <br>

                        <ol>
                            <li> Untuk diketahui <input type="checkbox"></li>
                            <li> Untuk digunakan <input type="checkbox"> </li> 
                            <li> Untuk ditindaklanjuti <input type="checkbox"> </li>
                            <li> Untuk diteliti kelayakannya <input type="checkbox"> </li>
                            <li> Dibahas Bersama <input type="checkbox"> </li>
                        </ol>

                        <br><br><br>

                        Tembusan : <br>
                        xxxxxxxx

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                    <td valign=top> 
                        Mohon dikirimkan data formulir induk dari vaksin Jerap Td no bets 00000000 - 0000001. <br> <br>

                        Terimakasih. <br> Mohon ditindak lanjuti
                    </td>
                </tr>
                <tr>
                    <td>
                        Dikirim Ke :  QA  <br>
                        No Fax : .... <br> 
                        Tgl. Fax : .... 
                    </td> 
                    <td>
                        Pengirim :  E.Ika Prawahju  <br>
                        No Fax : 021-424515 <br> 
                        Tgl. Fax : .... 
                    </td>
                </tr>
            </table>
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

