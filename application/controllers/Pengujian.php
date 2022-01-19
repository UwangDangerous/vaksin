<?php 

    class Pengujian extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Pengujian_model');
        }
        
        public function index()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Pengujian Sampel '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Pengujian Sampel'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Pengujian Sampel'; 

            $data['pengujian'] = $this->Pengujian_model->getDataSamplePengujian();
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('pengujian/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembaki');
                redirect('auth') ;
            }
        }

        public function detail($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Tambah Hasil Pengujian Sampel '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Tambah Hasil Pengujian Sampel'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'pengujian"> Pengujian Sampel </a> / Tambah Hasil Pengujian'; 

            $data['pengujian'] = $this->Pengujian_model->getDataSamplePengujianBatch($id);
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('pengujian/detail');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembaki');
                redirect('auth') ;
            }
        }

        public function tambahPengujian()
        {
            date_default_timezone_set('Asia/Jakarta');
            $id = $this->input->post('id');
            $query = [
                'idSample' => $this->input->post('id'),
                'tgl_selesai' => date('Y-m-d'),
                'jam_selesai' => date('G:i:s')
            ] ;

            if($this->db->insert('prosespengerjaan', $query)){
                $query_riwayat = [
                    'idSample' => $this->input->post('id'),
                    'tgl_riwayat' => date('Y-m-d'),
                    'jam_riwayat' => date('G:i:s'),
                    'keteranganRiwayat' => 'Pengujian Selesai ( Awal Pengerjaan Dokumen Pelulusan )'
                ];
                $this->db->insert('riwayatpekerjaan', $query_riwayat);
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan' ,
                    'warna' => 'success' 
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan' ,
                    'warna' => 'success' 
                ];
            }

            $this->session->set_flashdata($pesan);
            redirect("pengujian/detail/$id") ;
        }
    }

?>