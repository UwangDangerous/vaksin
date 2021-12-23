<?php 

    class cobaTanggal extends CI_Controller {
        public function index() 
        {
            $this->load->model('_Date');
            $this->load->view('cobatanggal/index');
            
            // $data = json_decode( file_get_contents("https://api-harilibur.vercel.app/api?year=2021"), true ) ;

            // foreach ($data as $d) {
            //     if($d['is_national_holiday'] == true){
            //         var_dump($d['holiday_name'].' | '.$d['holiday_date']) ;
            //     }
            // }

            // var_dump(date('D-m-y'+weekday));
            // $this->load->view('cobatanggal/index');

 
 
// echo "<h1>Hari Kerja</h1>";
// echo "<hr>";
//     foreach ($haricuti as $value) {
//         echo date('d-m-Y', $value)  . " -> " . strftime("%A, %d %B %Y", date($value)) . "\n" . "<br>";
//     }
 
// echo "<h1>Sabtu Minggu</h1>";
// echo "<hr>";
//     foreach ($sabtuminggu as $value) {
//         echo date('d-m-Y', $value) . " -> " . strftime("%A, %d %B %Y", date($value)) . "\n" . "<br>";
//     }
        }


    }

?>