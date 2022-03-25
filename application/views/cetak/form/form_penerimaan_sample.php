<?php 

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);
$mpdf->SetHTMLHeader('<div class="header"><b>'.$judul.'</b></div>') ;

// header
    $html =$header ;
// header

// body 
    $html .= '
        <div class="isi">
            <ol class="surat_pengantar">
               <li>Surat Pengantar</li>
               <table cellspacing=3 cellpadding=3>
                    <tr>
                        <td> 1 </td>
                        <td> Nama Pengirim Sample </td>
                        <td> : </td>
                        <td> '.$surat['namaDepan'].'. '. $surat['namaEU'].' </td>
                    </tr>
                    <tr>
                        <td> 2 </td>
                        <td> Nomor / Tanggal Surat Pengantar </td>
                        <td> : </td>
                        <td> '.$surat['noSurat'].' / '.$surat['namaSurat'].' </td>
                    </tr>
                    <tr>
                        <td> 3 </td>
                        <td> Nama Institusi/Perusahaan </td>
                        <td> : </td>
                        <td> '.$surat['namaDepan'].'. '. $surat['namaEU'].' </td>
                    </tr>
                    <tr>
                        <td> 4 </td>
                        <td> Asal Sampel </td>
                        <td> : </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td> 5 </td>
                        <td> No Kontak Yang Dapat Dihubungi </td>
                        <td> : </td>
                        <td> '.$surat['noPj'].' ( '. $surat['pj'].' ) </td>
                    </tr>
                    <tr>
                        <td> 6 </td>
                        <td> Tujuan </td>
                        <td> : </td>
                        <td> '.$surat['namaSurat'].' </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> Tanggal dan Waktu Penerimaan Sampel </td>
                        <td> : </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> Nama Petugas Penerimaan Sampel </td>
                        <td> : </td>
                        <td>  </td>
                    </tr>
                </table>
               <li>Dokumen</li>
                    <table class="tabel-dokumen" border="1" cellspacing=3 cellpadding=3>
                            <tr>
                                <th>No</th>
                                <th>Informasi</th>
                                <th>Keterangan</th>
                                <th>Nama Dan Paraf Penerima</th>
                            </tr> '; 
                        $no = 0 ;
                        foreach($dokumen as $dok) {
                        $sub_dokumen = $this->Cetak_model->getSubInformasiPenerimaan($dok['id_penerimaan']) ;
    $html.= '
                            <tr>
                                <td>'.++$no.'</td>
                                <td align="left">'.$dok['informasi'].'</td>
                                <td>Ya/Tidak*</td>
                                <td></td>';
            //                 if($no == 1) {
            // $html.= '           <td rowspan="'.().'"></td>';
            //                 }
    $html.= '               </tr>';
                            foreach($sub_dokumen as $sdok){
    $html.='        
                                <tr>
                                    <td>-</td>
                                    <td align="left">'.$sdok['informasi_sub'].'</td>
                                    <td>Ya/Tidak*</td>
                                    <td></td>
                                </tr>';
                            }
                        }
    $html .='       </table>



               <li>Contoh</li>';
    $html .='       <table cellspacing=3 cellpadding=3 class="tabel-contoh" border="1">
                        <tr>
                            <th>No</th>
                            <th>Informasi</th>
                            <th>Keterangan</th>
                            <th>Nama Dan Paraf Penerima</th>
                        </tr> '; 
                    $no = 0 ;
                foreach($contoh as $cth) {
                    // $sub_dokumen = $this->Cetak_model->getSubInformasiPenerimaan($cth['id_penerimaan']) ;
    $html.= '
                    <tr>
                        <td>'.++$no.'</td>
                        <td align="left">'.$cth['informasi'].'</td>';

                    if($cth['ket'] == 1) {
                        $ket = 'Pos Udara/Laut/kurir*';
                    }elseif($cth['ket'] == 2) {
                        $ket = '<i> dri ice / <br>ice packs / ice * </i>';
                    }elseif($cth['ket'] == 3) {
                        $ket = 'Ya/Tidak*';
                    }elseif($cth['ket'] == 4) {
                        $ket = 'Jumlah..........';
                    }elseif($cth['ket'] == 5) {
                        $ket = 'Ya/Tida*k <br> Suhu ...... C';
                    }else{
                        $ket ='' ;
                    }

    $html.='             <td>'.$ket.'</td>
                         <td></td>';
    $html .= '        </tr>';
                        $contoh_sub = $this->Cetak_model->getInformasiContohSub($cth['id_contoh']) ;
                        foreach($contoh_sub as $scth){
    $html .='        
                            <tr>
                                <td>-</td>
                                <td align="left">'.$scth['informasi_sub'].'</td>';
                            if($scth['ket_sub'] == 1) {
                                $sket = 'Pos Udara/Laut/kurir*';
                            }elseif($scth['ket_sub'] == 2) {
                                $sket = '<i> dri ice / <br>ice packs / ice * </i>';
                            }elseif($scth['ket_sub'] == 3) {
                                $sket = 'Ya/Tidak*';
                            }elseif($scth['ket_sub'] == 4) {
                                $sket = 'Jumlah..........';
                            }elseif($scth['ket_sub'] == 5) {
                                $sket = 'Ya/Tida*k <br> Suhu ...... C';
                            }else{
                                $sket ='' ;
                            }
    $html.= '                   <td>'.$sket.'</td>
                                <td></td>
                            </tr>';
                        }
                }
    $html .= '</table>
            </ol>
        </div>
    ' ;
// body 

// footer
    $html .= '</body></html>' ;
// footer

$mpdf->SetHTMLFooter('<div class="footer">Petugas Sampel</div> <div class="footer-kanan">{PAGENO}</div>') ;
$mpdf->WriteHTML($html);

$mpdf->Output('Evaluasi Dokumen Produksi Vaksin .pdf' ,'I');

// $mpdf->Output();
// echo $html ;


?>




