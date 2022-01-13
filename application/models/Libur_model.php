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
        $this->load->library('pagination');

        //pencarian
            if(isset($_POST['cari']) ){
                $keyTahun = $_POST['tahun'];
                $this->session->set_userdata('keyTahun', $keyTahun);

                $keyBulan = $_POST['bulan'];
                $this->session->set_userdata('keyBulan', $keyBulan);

                $keyJenis = $_POST['jenis'];
                $this->session->set_userdata('keyJenis', $keyJenis);

                $keyNama = $_POST['nama'];
                $this->session->set_userdata('keyNama', $keyNama);
            }else{
                $keyTahun = $this->session->userdata('keyTahun');
                $keyBulan = $this->session->userdata('keyBulan');
                $keyJenis = $this->session->userdata('keyJenis');
                $keyNama = $this->session->userdata('keyNama');
            }
        //pencarian

        // $this->whereDataLibur($keyTahun,$keyBulan,$keyJenis,$keyNama);
        $this->db->like('tipe', $keyJenis);
        $this->db->like('tglLibur', $keyTahun);
        $this->db->like('tglLibur', $keyBulan);
        $this->db->like('namaLibur', $keyNama);
        $this->db->from('harilibur');
        $config['total_rows'] = $this->db->count_all_results();

        $data['total_rows'] = $config['total_rows'] ;
        $config['per_page'] = 4 ;
        $config['num_links'] = 3 ; //default nya 2
        $config['base_url'] = base_url()."libur/resetIndex" ;
        
        $this->pagination->initialize($config);
        
        $data['start'] = $this->uri->segment(3) ;
        

        $this->db->like('tipe', $keyJenis);
        $this->db->like('tglLibur', $keyTahun.'-'.$keyBulan);
        $this->db->like('namaLibur', $keyNama);
        $this->db->order_by('tglLibur', 'desc');
        $data['libur'] = $this->db->get('harilibur',$config['per_page'], $data['start'])->result_array();



        $this->load->view('libur/index',$data);
    }

}

?>