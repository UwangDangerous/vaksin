<?php 

class Libur_model extends CI_Model{
    public function getDataLiburJSON($thn) {
        $j_son = file_get_contents("https://api-harilibur.vercel.app/api?year=$thn") ; 
        $data = json_decode($j_son, true) ;

        $dataLibur = [] ;
        
        foreach($data as $d) {
            if($d['is_national_holiday'] == true) {
                $dataLibur[] = [
                    'tanggal' => $d['holiday_date'] ,
                    'nama' => $d['holiday_name']
                ] ; 
            }
        }

        return $dataLibur ;
    }

    public function tahun() 
    {
        return [2021, 2022, 2023, 2024, 2025, 2026] ;
    }

    public function getDataLibur()
    {
        $this->db->order_by('idLibur','desc') ;
        return $this->db->get('harilibur')->result_array();
    }

}

?>