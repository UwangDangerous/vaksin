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

            return $bulan[2].' '.$b.' '.$bulan[0] ;
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
    }

?>