<?php 

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);
$mpdf->SetHTMLHeader('<div class="header"><b>'.$judul.'</b></div>') ;

// header
    $html =$header ;
// header

// body 
    $html .= '
        <div class="isi">
            <table class="tbl-kepada">
                <tr>
                    <td width="60%"></td>
                    <td>Jakarta</td>
                </tr>
                <tr><td></td><td>Kepada Yth</td></tr>
                <tr><td></td><td><u>xxxxxxx,</u></td></tr>
            </table>

            <br>
            
            <table cellspacing=3 cellpadding=3 >
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Hal </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Asal </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> No.Surat Permintaan </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Tanggal Surat </td>
                    <td valign="top"> : </td>
                    <td></td>
                </tr>
            </table>

            <br>

            Bersama ini kami kirimkan contoh untuk dilakukan pengujian : 
            <br>

            <div class="param-uji">
                <br>

                <table class="tbl-param" border="1" cellspacing=3 cellpadding=3>
                    <tr> 
                        <th valign="top">No</th> 
                        <th valign="top">No. ADM. PPPOMN</th>
                        <th valign="top">Nama Sampel / <br> Contoh</th>
                        <th valign="top">Jenis Pengujian</th>
                        <th valign="top">Jumlah</th>
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

            <table>
                <tr>
                    <td>Catatan</td>
                <tr>
                <tr>
                    <td>Terima di PPPOMN</td>
                    <td>:</td>
                    <td>xx/xxxxxx/xxxx</td>
                <tr>
                <tr>
                    <td>Terima di Balai</td>
                    <td>:</td>
                    <td>xx/xxxxxx/xxxx</td>
                <tr>
            </table>

            Kami harap hasil dilaporkan dalam waktu yang singkat. Atas kerjasamanya diucapkan terima kasih.

            <br>
            <br>
            <br>
            <br>
            <br>

            <table class="ttd" cellpadding=2 cellspacing=2>
                <tr>
                    <td width=33% valign=top>Yang Menerima</td>
                    <td width=33% valign=top>Verifikator</td>
                    <td width=33% valign=top>Yang menyerahkan <br> Plt. Kasie Pengujian Mutu PB</td>
                </tr>
                <tr>
                    <td><img src="'.base_url().'assets/file-upload/ttd/contoh.png" height=80px></td>
                    <td><img src="'.base_url().'assets/file-upload/ttd/contoh.png" height=80px></td>
                    <td><img src="'.base_url().'assets/file-upload/ttd/contoh.png" height=80px></td>
                </tr>
                <tr>
                    <td><u> 
                        namanamanamanam <br> NIP. 00000000
                    </u></td>
                    <td><u> 
                        namanamanamanam <br> NIP. 00000000
                    </u></td>
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




