<?php 

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);
$mpdf->SetHTMLHeader('<div class="header"><b>'.$judul.'</b></div>') ;

// header
    $html =$header ;
// header

// body 
    $html .= '
        <div class="isi">
            <table>
                <tr>
                    <td style="padding-right:100px; vertical-align:top;">Kepada</td>
                    <td style="vertical-align:top;">:</td>
                    <td>xxxxxx <br> xxxx</td>
                </tr>
            </table>

            <br>
            
            <table cellspacing=3 cellpadding=3 >
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Perihal </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Asal Contoh </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Np./ Tanggal Surat Pengiriman </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Tanggal Terima di PPPOMN </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Tanggal Terima di Balai </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
            </table>

            <br>

            Agar dilakukan evaluasi dengan parameter seperti tersebut di bawah ini untuk contoh sebagai berikut : 
            <br>

            <div class="param-uji">
                <br>

                <table class="tbl-param" border="1" cellspacing=3 cellpadding=3>
                    <tr> 
                        <th valign="top">No</th> 
                        <th valign="top">No. Kode Contoh</th>
                        <th valign="top">Nama Cpntoh dan <br> Nomor bets</th>
                        <th valign="top">Paramter</th>
                        <th valign="top">Metode /<br> Pustaka</th>
                    </tr> 
                    <tr> 
                        <td valign="top"> 1 </td>
                        <td valign="top"> xx/000x/xxx/00 </td>
                        <td valign="top"> xxxxxx <br> 00000 </td>
                        <td class="untuk-list">
                            <ul class="ul-param">
                                <li> xxxxxxxx </li>
                                <li> xxxx </li>
                                <li> xxxx </li>
                            </ul>
                        </td> 
                        <td>WHO/TRS</td>
                    </tr> 
                </table>

                <br>

                
            </div>

            Kami harap hasil dilaporkan dalam waktu yang singkat. Atas kerjasamanya diucapkan terima kasih.

            <br>
            <br>
            <br>
            <br>
            <br>

            <table class="ttd" cellpadding=2 cellspacing=2>
                <tr>
                    <td width=33% valign=top>Yang Menerima</td>
                    <td width=33% valign=top></td>
                    <td width=33% valign=top>Yang menyerahkan <br> Plt. Kasie Pengujian Mutu PB</td>
                </tr>
                <tr>
                    <td><img src="'.base_url().'assets/file-upload/ttd/contoh.png" height=80px></td>
                    <td></td>
                    <td><img src="'.base_url().'assets/file-upload/ttd/contoh.png" height=80px></td>
                </tr>
                <tr>
                    <td><u> 
                        namanamanamanam <br> NIP. 00000000
                    </u></td>
                    <td></td>
                    <td><u> 
                        namanamanamanam <br> NIP. 00000000
                    </u></td>
                </tr>
            </table>

            <br>
            <br>


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




