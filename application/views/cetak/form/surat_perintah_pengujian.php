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
                <tr> <td colspan=4> Agar dilakukan pengujian terhadap</td> </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Nama Contoh </td>
                    <td valign="top"> : </td>
                    <td valign="top"> xxxx </td>
                    <td>
                         00000 <br>
                         00000 
                    </td>
                </tr>
            </table>

            <br>

            <table cellspacing=3 cellpadding=3 >
                <tr> 
                    <td valign="top" style="padding-right:50px;"> No. Adm PPPOMN </td>
                    <td valign="top"> : </td>
                    <td>
                         00000 <br>
                         00000 
                    </td>
                </tr>
            </table>

            <br>
            
            <div class="param-uji">
                <u><b> Parameter Pengujian </b></u> 
                <br>
                <br>

                <table class="tbl-param" border="1" cellspacing=3 cellpadding=3>
                    <tr> 
                        <th>Jenis Pengujian</th> 
                        <th>Metode / Pustaka</th>
                    </tr> 
                    <tr> 
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
                <br>

            </div>

            <table class="ttd" cellpadding=2 cellspacing=2>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Jakarta, xx/xxx/xxxx</td>
                </tr>
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
                    <td><u> namanamanamanam</u></td>
                    <td><u> 
                        namanamanamanam <br> NIP. 00000000
                    </u></td>
                </tr>
            </table>

            <br>
            <br>

            <table class="catatan">
                <tr>
                    <td>Catatan : </td>
                </tr>
                <tr>
                    <td> No. Surat Pengantar </td>
                    <td> : </td>
                    <td> 0000000/xxxxx </td>
                </tr>
                <tr>
                    <td></td>
                    <td> </td>
                    <td> PT.xxxxx <br></td>
                </tr>
                <tr>
                    <td>Sampel diterima di PPPOMN</td>
                    <td> : </td>
                    <td> xx/xxxx/xxxx </td>
                </tr>
                <tr>
                    <td>Diterima di Balai Pengujian Produk Biologi</td>
                    <td> : </td>
                    <td> xx/xxxx/xxxx </td>
                </tr>
            </table>

        </div>
    ' ;
// body 

// footer
    $html .= '</body></html>' ;
// footer

$mpdf->SetHTMLFooter('<div class="footer">*): Verifikator telah ditunjuk oleh Kepala Balai yang dicantumkan pada lembar SP</div> <div class="footer-kanan">{PAGENO}</div>') ;
$mpdf->WriteHTML($html);

$mpdf->Output('Evaluasi Dokumen Produksi Vaksin .pdf' ,'I');

// $mpdf->Output();
// echo $html ;


?>




