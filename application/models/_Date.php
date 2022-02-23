<?php 

    class _Date extends CI_Model{
        public function formatTanggal($tanggal) 
        {
            $bulan = explode('-', $tanggal);
            $b = '' ;

            switch ($bulan[1]) {
                case 1 :
                    $b = 'Januari' ; break ;
                case 2 :
                    $b = 'Februari' ; break ;
                case 3 :
                    $b = 'Maret' ; break ;
                case 4 :
                    $b = 'April' ; break ;
                case 5 :
                    $b = 'Mei' ; break ;
                case 6 :
                    $b = 'Juni' ; break ;
                case 7 :
                    $b = 'Juli' ; break ;
                case 8 :
                    $b = 'Agustus' ; break ;
                case 9 :
                    $b = 'September' ; break ;
                case 10 :
                    $b = 'Oktober' ; break ;
                case 11 :
                    $b = 'November' ; break ;
                case 12 :
                    $b = 'Desember' ; break ;
                default :
                    $b = '00' ;
            }

            if($b == '00') {
                return '-' ;
            }else{
                return $bulan[2].' '.$b.' '.$bulan[0] ;
            }
        }

        public function formatTanggalHari($tanggal) 
        {
            $bulan = date('Y-m-d l', strtotime($tanggal)) ;
            $bulan = explode(' ', $bulan) ;

            $hari = $bulan[1] ;
            
            if($hari == 'Sunday'){
                $hari = 'Minggu' ;
            }elseif($hari == 'Monday'){
                $hari = 'Senin' ;
            }elseif($hari == 'Tuesday'){
                $hari = 'Selasa' ;
            }elseif($hari == 'Wednesday'){
                $hari = 'Rabu' ;
            }elseif($hari == 'Thursday'){
                $hari = 'Kamis' ;
            }elseif($hari == 'Friday'){
                $hari = 'Jumat' ;
            }elseif($hari == 'Saturday'){
                $hari = 'Sabtu' ;
            }else{
                $hari = '' ;
            }



            $bulan = explode('-', $bulan[0]);
            $b = '' ;

            switch ($bulan[1]) {
                case 1 :
                    $b = 'Januari' ; break ;
                case 2 :
                    $b = 'Februari' ; break ;
                case 3 :
                    $b = 'Maret' ; break ;
                case 4 :
                    $b = 'April' ; break ;
                case 5 :
                    $b = 'Mei' ; break ;
                case 6 :
                    $b = 'Juni' ; break ;
                case 7 :
                    $b = 'Juli' ; break ;
                case 8 :
                    $b = 'Agustus' ; break ;
                case 9 :
                    $b = 'September' ; break ;
                case 10 :
                    $b = 'Oktober' ; break ;
                case 11 :
                    $b = 'November' ; break ;
                case 12 :
                    $b = 'Desember' ; break ;
                default :
                    $b = '00' ;
            }

            if($b == '00') {
                return '-' ;
            }else{
                return $hari.', '.$bulan[2].' '.$b.' '.$bulan[0] ;
            }
        }

        public function dateFormat($tanggal) 
        {
            $bulan = explode('-', $tanggal);
            $b = '' ;

            switch ($bulan[1]) {
                case 1 :
                    $b = 'January' ; break ;
                case 2 :
                    $b = 'February' ; break ;
                case 3 :
                    $b = 'March' ; break ;
                case 4 :
                    $b = 'April' ; break ;
                case 5 :
                    $b = 'May' ; break ;
                case 6 :
                    $b = 'June' ; break ;
                case 7 :
                    $b = 'July' ; break ;
                case 8 :
                    $b = 'August' ; break ;
                case 9 :
                    $b = 'September' ; break ;
                case 10 :
                    $b = 'October' ; break ;
                case 11 :
                    $b = 'November' ; break ;
                case 12 :
                    $b = 'December' ; break ;
                default :
                    $b = '00' ;
            }

            return $bulan[2].' '.$b.' '.$bulan[0] ;
        }


        public function pengerjaan($id, $lamaPengerjaan, $mulai, $jam )
        {
            // if($mulai ){


                $this->db->where('idSample', $id);
                $clockOFF = $this->db->get('clockoff')->result_array();

                $dataKurang = [] ;
                $jumlahHariDataKurang = 0;
                if($clockOFF) {
                    foreach($clockOFF as $cf) {

                        if($cf['clock_on'] == '0000-00-00') {
                            // $co = date('Y-m-d') ;
                            $dataKurang[] = [
                                'clock_off' => strtotime($cf['clock_off']),
                                'clock_on' => strtotime(date('Y-m-d')) 
                            ];
                        }else{
                            // $co = $cf['clock_on'] ;
                            $dataKurang[] = [
                                'clock_off' => strtotime( $cf['clock_off'] ),
                                'clock_on' => strtotime( $cf['clock_on'] ) 
                            ];
                        }

                        
                    }
                }

                foreach($dataKurang as $dk) {
                    $jumlahHariDataKurang += ( $dk['clock_on'] - $dk['clock_off'] ) / (60 * 60 * 24) ;
                }

                $time = explode(':', $jam) ;
                if($time[0] < 12) {
                    $mulai = date('Y-m-d', strtotime("-1 day",  strtotime($mulai))) ;
                }

                //mengitung tanggal akhir pengerjaan untuk libur
                $awalPengerjaan = strtotime($mulai) ;
                $pengerjaan = $lamaPengerjaan + $jumlahHariDataKurang;
                
                for($i=1 ; $i<=$pengerjaan; $i++) {
                    $proses = date('Y-m-d l', strtotime("+$i day", $awalPengerjaan)) ;
                    $hari = explode(' ', $proses) ;
                    if($hari[1] == 'Saturday') {
                        $pengerjaan ++;
                    }

                    if($hari[1] == 'Sunday') {
                        $pengerjaan ++;
                    }
                }

            
                $akhirPengerjaan = date('Y-m-d', strtotime("+$pengerjaan day", $awalPengerjaan) ) ;

                $this->db->where("tglLibur BETWEEN '$mulai' AND '$akhirPengerjaan'");
                $liburan = $this->db->get('harilibur')->result_array();
                $libur = count($liburan) ;

                $ket = false ;
                foreach($liburan as $lbr) {
                    if($lbr['tglLibur'] == date('Y-m-d')) {
                        $ket = true ;
                    }
                }

                //mengitung tanggal final
                $awalPengerjaan = strtotime($mulai) ;
                $pengerjaan = $lamaPengerjaan + $jumlahHariDataKurang + $libur;
                $sabtuMinggu = 0 ;
                
                for($i=1 ; $i<=$pengerjaan; $i++) {
                    $proses = date('Y-m-d l', strtotime("+$i day", $awalPengerjaan)) ;
                    $hari = explode(' ', $proses) ;
                    if($hari[1] == 'Saturday') {
                        $pengerjaan ++;
                        $sabtuMinggu ++ ;
                    }

                    if($hari[1] == 'Sunday') {
                        $pengerjaan ++;
                        $sabtuMinggu ++ ;
                    }
                }

                $akhirPengerjaan = date('Y-m-d', strtotime("+$pengerjaan day", $awalPengerjaan) ) ;
                $waktuBerjalan = (strtotime( $akhirPengerjaan ) - strtotime( date('Y-m-d') ) ) / (60 * 60 * 24) - $sabtuMinggu ;

                $total = $lamaPengerjaan + $jumlahHariDataKurang + $libur ;

                
                

                    // $data = [
                    //     'awalPengerjaan' => date('Y-m-d' ,$awalPengerjaan),
                    //     'akhirPengerjaan' => $akhirPengerjaan,
                    //     'lamaPengerjaan' => $lamaPengerjaan ,
                    //     'penundaan' => $jumlahHariDataKurang,
                    //     'libur' => $libur ,
                    //     'total' => $total,
                    //     'waktuBerjalan' =>  $total - $waktuBerjalan  
                    // ];

                    $data = [
                        'libur' => $libur ,
                        'penundaan' => $jumlahHariDataKurang,
                        'total' => $total - $libur -  $jumlahHariDataKurang,
                        'waktuBerjalan' =>  $total - $waktuBerjalan - ($libur -  $jumlahHariDataKurang),
                        'ket' => $ket
                    ] ;
            
            // }else{

            //     $data = [
            //         'lamaPengerjaan' => $lamaPengerjaan ,
            //         'penundaan' => 0,
            //         'libur' => 0 ,
            //         'total' => $lamaPengerjaan,
            //         'waktuBerjalan' => 0 
            //     ];

            // }

            return $data ;

            // mulai
            // selesai
            // libur
            // 

        }

    }

?>