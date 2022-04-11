<?php 

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]); //215, 330 | 210, 297
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
                    <td>Jakarta, '. $this->_Date->formatTanggal( date("Y-m-d") ).'</td>
                </tr>
                <tr><td></td><td>Kepada Yth,</td></tr>
                <tr><td></td><td><u>'.$surat['namaIU'].'</u></td></tr>
            </table>

            <br>
            
            <table cellspacing=3 cellpadding=3 >
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Hal </td>
                    <td valign="top"> : </td>
                    <td>'.$tugas.'</td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Asal </td>
                    <td valign="top"> : </td>
                    <td>'.$surat['namaDepan'].'. '.$surat['namaEU'].'</td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> No.Surat Permintaan </td>
                    <td valign="top"> : </td>
                    <td>'.$surat['noSurat'].'</td>
                </tr>
                <tr> 
                    <td valign="top"  style="padding-right:50px;"> Tanggal Surat </td>
                    <td valign="top"> : </td>
                    <td>'. $this->_Date->formatTanggal( $surat['tgl_kirim_surat'] ) .'</td>
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
                        <th valign="top">Jenis Pekerjaan</th>
                        <th valign="top">Jumlah</th>
                    </tr> 
                    <tr> 
                        <td valign="top"> 1 </td>
                        <td valign="top"> '.$surat['noAdm'].'/'.$surat['kodeAdm'].'/'.$surat['kodeBulan'].'/'.$surat['tahun'].' </td>
                        <td valign="top"> '.$surat['namaSample'].' <br> ('.$surat['noBatch'].') </td>
                        ' ;
                    if($tugas == 'Pengujian') {
    $html .= '          <td valign="top">' .$surat['namaJenisPengujian'].' </td>' ;
                    }else{
    $html .= '          <td class="untuk-list">   
                            <ul class="ul-param"> ';
                            
                            $pekerjaan = $this->Cetak_model->getDataPengujian($id) ;
                            foreach($pekerjaan as $tugas){
    $html .= '                  <li>'.$tugas['namaJenisPekerjaan'].'</li>' ;
                            }
                               
    $html .= '              </ul>
                        </td> ';
                    }
    $html .= '              
                        <td valign="top">'.$surat['jumlah_sample'].' '.$surat['ingJenisKemasan'].'</td>
                    </tr> 
                </table>

                <br>

                
            </div>

            <table>
                <tr>
                    <td>Catatan</td>
                <tr>
                <tr>
                    <td>Sample di terima</td>
                    <td>:</td>
                    <td>'. $this->_Date->formatTanggal($surat['tgl_verifikasi_sample']) .'</td>
                <tr>
            </table>

            <br>

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
                    <td width=33% valign=top>Yang menyerahkan <br> Kepala BPPB</td>
                </tr>
                <tr>
                    <td><img src="'.base_url().'assets/file-upload/ttd/'.$surat['tanda_tangan'].'" height=80px></td>
                    <td><img src="'.base_url().'assets/file-upload/ttd/'.$verifikator['tanda_tangan'].'" height=80px></td>
                    <td><img src="'.base_url().'assets/file-upload/ttd/contoh.png" height=80px></td>
                </tr>
                <tr>
                    <td><u> 
                        '.$surat['namaIU'].' <br> NIP. '.$surat['nip'].'
                    </u></td>
                    <td><u> 
                        '.$verifikator['namaIU'].' <br> NIP. '.$verifikator['nip'].'
                    </u></td>
                    <td><u> 
                        Dra. Elizabeth Ika Prawahju Arisetianingsih, (M.Biomed) <br> NIP. 196405311989102000
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

$mpdf->SetHTMLFooter('<div class="footer">F/xxx/0000</div> <div class="footer-kanan">Halaman {PAGENO}</div>') ;
$mpdf->WriteHTML($html);

$mpdf->Output('Evaluasi Dokumen Produksi Vaksin .pdf' ,'I');

// $mpdf->Output();
// echo $html ;


?>




