<?php 

    class JenisSample extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('JenisSample_model');
        }
        
        public function index()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Jenis Sampel '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Jenis Sampel'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Jenis Sampel'; 

            $this->db->order_by('jenisSample', 'asc');
            $data['sample'] = $this->db->get('_jenisSample')->result_array();
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('jenisSample/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function TambahData() 
        {
            $query = [
                'jenisSample' => $this->input->post('nama'),
                'waktuPengujian' => $this->input->post('lama')
            ];
            $this->db->insert('_jenisSample',$query);

            $pesan = [
                'pesan' => 'Data Berhasil Disimpan' ,
                'warna' => 'success' 
            ];
            $this->session->set_flashdata($pesan);
            redirect('jenisSample') ;
        }

        public function UbahData($id) 
        {
            $query = [
                'jenisSample' => $this->input->post('nama'),
                'waktuPengujian' => $this->input->post('lama')
            ];
            $this->db->where('idJenisSample', $id);
            $this->db->update('_jenisSample',$query);

            $pesan = [
                'pesan' => 'Data Berhasil Disimpan' ,
                'warna' => 'success' 
            ];
            $this->session->set_flashdata($pesan);
            redirect('jenisSample') ;
        }
    } 

?>