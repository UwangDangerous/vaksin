<?php

    // $nama_dokumen = 
    $mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);
    $mpdf->SetHTMLHeader('<div class="header"><b>BALAI PENGUJIAN PRODUK BIOLOGI</b></div>') ;
    // $mpdf->SetProtection(array('extract','copy'), 'Bpom');
    // $mpdf->SetDocTemplate('logoheader.pdf',true);
    // $mpdf->SetTitle('My Title');
    

    $htmlHeader = '
    <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="'.base_url().'assets/css/cetak/form_evaluasi.css">
                <link rel="icon" href="'.base_url().'assets/img/logo-bpom.png">
                <title>Cetak Hasil Evaluasi</title>
            </head>

            <body>

            <div class="header-body">
                <b><u>CHECK LIST FOR RELEASE<u><b>
                <br>
                <b> '. $sample['jenisSample'] .' </b>
            </div> 

    ' ;
// general informasi
    $htmlBody = '
    <div class="general_informasi">
    
        <table cellpadding=2 cellspacing=2>
        
        <tr><td> <b>General Informasi </b></td></tr>                 <tr><td></td></tr>
        <tr>
            <td>Name of Product</td>
            <td>:</td>
            <td>'.$sample['jenisSample'].' ( '.$sample['namaSample'].' )</td>
        </tr>
        ' ;

    if($sample['idJenisManufacture'] == 1){
        $htmlBody .= '
        <tr>
            <td>Name and address of manufacturer</td>
            <td>:</td>
            <td>'.$sample['namaEU'].' , '.$sample['alamat'].'</td>
        </tr>' ;
    }else{
        $this->db->where('idSample', $idSample) ;
        $import =  $this->db->get('_importir')->row_array();
        $htmlBody .= '
        <tr>
            <td>Name and address of manufacturer</td>
            <td>:</td>
            <td>'.$import['namaImportir'].' , '.$import['alamatImportir'].'</td>
        </tr>
        <tr>
            <td>Imported by</td>
            <td>:</td>
            <td>'.$sample['namaEU'].' , '.$sample['alamat'].'</td>
        </tr>' ;
    }

    $this->db->where('idBatch', $idBatch);
    $batch = $this->db->get('sample_batch')->result_array();

    $htmlBody .= '
        <tr>
            <td>Batch No.</td>
            <td>:</td> 
            <td>' ;
    

        if(count($batch) < 2){
            foreach($batch as $b) {
                $htmlBody .= $b['noBatch'];
            }
        }else{
            $htmlBody .= '<ul>' ;
            foreach($batch as $b) {
                $htmlBody .= '<ol> - '.$b['noBatch'].'</ol>';
            }
            $htmlBody .= '</ul>' ;
        }

    $htmlBody .= '<td></tr>' ;
            
            
    foreach($general_informasi as $gi) {
        $gi_used = $this->Evaluasi_model->getData_GI_Use($gi['idGI']) ;
        $this->db->where('id_gi_used', $gi_used) ;
        $this->db->where('idBatch', $idBatch) ;
        $isi_gi_used = $this->db->get('isi_tbl_gi')->row_array() ;
        $htmlBody .= '
            <tr>
                <td>'.$gi['namaGI'].'</td>
                <td> : </td>
                <td> '.$isi_gi_used['isi_gi'].' </td>
            </tr>' ;
    }

    $htmlBody .= '
        </table>
    </div>' ;

// // general informasi
    


// // body
    $htmlBody .= '<br><br><div class="body">' ;

    $table = $this->Evaluasi_model->getDataForTabel($sample['idJenisSample']);
    foreach($table as $row) {
        $htmlBody.= '<b><u>'.$row['nama_tbl_proses'].'</u></b> ' ;
        // header
            $tbl_header = $this->Evaluasi_model->getDataForTabelHeader($row['id_tbl_proses']);
            if($tbl_header) {
                $htmlBody.= '<table>' ;

                foreach($tbl_header as $header){
                    $htmlBody .= '<tr>' ;
                    $htmlBody .= '<td>'.$header['nama_tbl_header'].'</td>
                                    <td>:</td>
                                    <td>'. $this->Evaluasi_model->cekIsiDataHeader($header['id_tbl_header'], $idBatch)['isi_header'].'</td>' ;
                    $htmlBody .= '</tr>' ;
                }
                $htmlBody .= '</table> <br>' ;
            }
        // header

        // kolom
            $kolom = $this->Evaluasi_model->getDataForTabelKolom($row['id_tbl_proses']); 
            if($kolom) {
                $jmlKolom = count($kolom) ;
                $htmlBody .= '<table class="myTabel" border=1> 
                    <tr>
                        <th>No</th>' ;

                foreach($kolom as $k){
                    $htmlBody .= ' <th>'.$k['nama_kolom'].'</th>' ;
                }   
                
                $loop = 0 ;
                $klm = [] ;
                $isi_kolom_array = $this->Evaluasi_model->getDataFor_Isi_kolom_array($row['id_tbl_proses'], $idBatch); 

                foreach ($isi_kolom_array as $ika) : 
                    $klm[] = $ika['id_isi_tbl_kolom'].'|'.$ika['isi_kolom'] ;
                endforeach ;
                $kolomBagi = count($isi_kolom_array) / $jmlKolom;
                $isi_kolom_fix = [] ;
                for($i=0; $i < $kolomBagi; $i++){
                    for($j=0; $j < $jmlKolom; $j++){
                        $isi_kolom_fix[$i][$j]=$klm[$loop];
                        $loop++;
                    }
                }
                    
                $htmlBody .='
                        <th>Pass / Available</th>
                    </tr>';

                $no_kolom = 1 ;
                if($isi_kolom_fix == null) {
                    $htmlBody .= '<tr><td colspan='.($jmlKolom+2).'><i>kosong</i></td></tr>' ;
                }else{
                    foreach($isi_kolom_fix as $row2) {
                        $htmlBody .= '<tr>
                                        <td align="center">'. $no_kolom++ .'</td>' ;

                        $id_isi_kolom = '' ;
                        $hash_isi_kolom = '' ;
                        $jml_isi_kolom = 0 ;
                        foreach ($row2 as $row3){
                           $row3 = explode('|',$row3) ; 
                           $id_isi_kolom .= $row3[0].'|' ; 
                           $jml_isi_kolom += $row3[0] ; 

                           $htmlBody .= '<td>'. $row3[1] .'</td>' ;
                        }

                        $hash_isi_kolom = substr( md5($jml_isi_kolom), 1, 5);
                        
                        $this->db->where('idBatch', $idBatch);
                        $this->db->where('id_hash_isi_tbl_kolom', $hash_isi_kolom);
                        if($this->db->get('isi_tbl_kolom_ceklis')->row_array()) {
                            $htmlBody .= ' 
                                        <td align="center"> <img src="'.base_url().'assets/img/check-solid.png" width="10px" > </td>
                                    </tr>' ;
                        }else{
                            $htmlBody .= '
                                <td align="center"> <img src="'.base_url().'assets/img/times-solid.png" width="10px" > </td>
                            </tr>' ;
                        }

                    }
                }
                $htmlBody .='</table><br>' ;
            }
        // kolom

        // footer
            $tbl_footer = $this->Evaluasi_model->getDataForTabelFooter($row['id_tbl_proses']);
            if($tbl_footer){
                $htmlBody.= '<table cellpadding=2 cellspacing=2>' ;
                
                foreach($tbl_footer as $footer){
                    $htmlBody .= '<tr>' ;
                    $htmlBody .= '<td>'.$footer['nama_tbl_footer'].'</td>
                                    <td>:</td>
                                    <td>'. $this->Evaluasi_model->cekIsiDataFooter($footer['id_tbl_footer'], $idBatch)['isi_footer'].'</td>' ;
                    $htmlBody .= '</tr>' ;
                }
                $htmlBody .= '</table> <br>' ;
            }
        // footer
    }
    $htmlBody .= '</div>' ;
// body


// verify
    $petugasVerify = $this->Cetak_model->getPetugasVerivikasi($idBatch);
    $petugasCheck = $this->Cetak_model->getPetugasCheck();

    $chcek = $this->Cetak_model->getInfoCeklis($idBatch);
    $hasil_verifikasi = $this->Cetak_model->getHasilVerifikasi($chcek['id_hasil_evaluasi']);
    $hasil_periksa = $this->Cetak_model->getHasilPeriksa($chcek['id_hasil_evaluasi']);
    $dateVerify = '-' ;
    $sigVerify = '-' ;
    $datePeriksa = '-' ;
    $sigPeriksa = '-' ;
    if($hasil_verifikasi) {
        if($hasil_verifikasi['status_verifikasi'] == "diterima" ){
            $dateVerify = $this->_Date->dateFormat( $hasil_verifikasi['tanggal_verifikasi'] ) ;
            $sigVerify = '<img height="40px" src="'.base_url().'assets/file-upload/ttd/'.$petugasVerify['tanda_tangan'].'">' ;
        }
    }
    if($hasil_periksa) {
        if($hasil_periksa['status_periksa'] == "diterima" ){
            $datePeriksa = $this->_Date->dateFormat( $hasil_periksa['tanggal_periksa'] ) ;
            $sigPeriksa = '<img height="40px" src="'.base_url().'assets/file-upload/ttd/'.$petugasCheck['tanda_tangan'].'">' ;
        }
    }
    $htmlBody .= '
        <div class="verify">
            <div class="row">
                <div class="col">
                    <table>
                        <tr>
                            <td>Verified by</td>
                            <td>:</td>
                            <td>'.$petugasVerify['namaIU'].'</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td>'.$dateVerify.'</td>
                        </tr>
                        <tr>
                            <td>Signature</td>
                            <td>:</td>
                            <td>'.$sigVerify.'</td>
                        </tr>
                    </table>
                </div>
                <div class="col col2">
                    <table>
                        <tr>
                            <td>Checked by</td>
                            <td>:</td>
                            <td>'.$petugasCheck['namaIU'].'</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td>'.$datePeriksa.'</td>
                        </tr>
                        <tr>
                            <td>Signature</td>
                            <td>:</td>
                            <td>'.$sigPeriksa.'</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    ';
// verify





















    $htmlBody .= '</body>' ;

    // $mpdf->AddPage('','','2','i','on');
    // $mpdf->setFooter('{PAGENO}');
    
    $html = $htmlHeader.'<br>'.$htmlBody ;

    $mpdf->SetHTMLFooter('<div class="footer">'.$chcek['nomor_ceklis'].'</div> <div class="footer-kanan">{PAGENO}</div>') ;
    $mpdf->WriteHTML($html);
    // // $mpdf->Output();

    $mpdf->Output('Evaluasi Dokumen Produksi Vaksin '.$sample['namaSample'].' ( '. $sample['jenisSample'] .' ).pdf' ,'I');

    // echo $html ;
?> 