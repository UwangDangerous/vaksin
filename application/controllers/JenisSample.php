<?php 

    class JenisSample extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('JenisSample_model');
        }
        
        public function index($hal=0)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Daftar Vaksin '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Daftar Vaksin'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Daftar Vaksin';
            $data['hal'] = $hal ; 

            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->JenisSample_model->getDataJS($hal);
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function dokumen()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Jenis Dokumen '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Jenis Dokumen'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Jenis Dokumen'; 

            $data['dok'] = $this->db->get('_jenisDokumen')->result_array();
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('jenisSample/dokumen');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function TambahData() 
        {
            $wadah = explode('|', $this->input->post('wadah')) ;
            $query = [
                'jenisSample' => $this->input->post('nama'),
                'waktuPengujian' => $this->input->post('lama'),
                'wadah' => $wadah[0],
                'jsIng' => $this->input->post('namaIng'),
                'wIng' => $wadah[1],
                'produksi' => $this->input->post('produksi')
            ];
            if( $this->db->insert('_jenisSample',$query) ) {

                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan' ,
                    'warna' => 'success' 
                ];

            }else{

                $pesan = [
                    'pesan' => 'Data Gagal Disimpan' ,
                    'warna' => 'danger' 
                ];

            }
            $this->session->set_flashdata($pesan);
            redirect('jenisSample') ;
        }


        public function UbahData($id,$hal) 
        {
            $wadah = explode('|', $this->input->post('wadah')) ;
            $query = [
                'jenisSample' => $this->input->post('nama'),
                'waktuPengujian' => $this->input->post('lama'),
                'wadah' => $wadah[0],
                'jsIng' => $this->input->post('namaIng'),
                'wIng' => $wadah[1],
                'produksi' => $this->input->post('produksi')
            ];
            $this->db->where('idJenisSample', $id);
            $this->db->update('_jenisSample',$query);

            $pesan = [
                'pesan' => 'Data Berhasil Disimpan' ,
                'warna' => 'success' 
            ];
            $this->session->set_flashdata($pesan);
            redirect('jenisSample/index/'.$hal) ;
        }

        public function ubahDok($id) 
        {
            $query = [
                'namaJenisDokumen' => $this->input->post('nama'),
                'KeteranganDokumen' => $this->input->post('keterangan')
            ];

            $this->db->where('idJenisDokumen', $id);
            if($this->db->update('_jenisdokumen', $query)) {
                $pesan = [
                    'pesan' => 'data berhasil disimpan' ,
                    'warna' => 'success' 
                ];
            }else{
                $pesan = [
                    'pesan' => 'data gagal disimpan' ,
                    'warna' => 'danger' 
                ];
            }

            $this->session->set_flashdata($pesan);
            redirect('jenisSample/dokumen') ;
        }


        
    } 

?>