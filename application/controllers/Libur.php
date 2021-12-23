<?php 

class Libur extends CI_Controller{
    public function __construct() 
    {
        parent::__construct() ;
        $this->load->library('form_validation');
        $this->load->model('Libur_model');
        $this->load->model('_Date');
    }

    public function index()
    {
        $this->load->model('_Date');
        $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Libur Nasional '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Libur Nasional'; 
        $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Libur'; 

        $data['bulan'] = [
                '01|Januari', '02|Februari', '03|Maret', '04|April', '05|Mei', '06|Juni',
                '07|Juli', '08|Agustus', '09|September', '10|Oktober', '11|November', '12|Desember'
        ];

        $data['tahun'] = $this->Libur_model->tahun();

        $data['libur'] = $this->Libur_model->getDataLibur();

        if( ($this->session->userdata('key') != null) ) 
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('Libur/index');
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function tambah()
    {
        
        $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Tambah Hari Libur Nasional '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Tambah Hari Libur Nasional'; 
        $data['bread'] = 'Dashboard / <a href="'.base_url().'libur"> Libur </a> / Tambah Data';
        
        $data['tahun'] = $this->Libur_model->tahun();

        if( ($this->session->userdata('key') != null) ) 
        {
            $this->form_validation->set_rules('nama', 'Nama Hari Libur', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal Libur', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('Libur/tambah');
                    $this->load->view('temp/dashboardFooter');
                }else{

                }
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function inputAutoLibur() 
    {
        $i = 1 ;
        for($i; $i<$this->input->post('jumlah'); $i++) {
            $query = [
                'namaLibur' => $this->input->post("nama$i"),
                'tglLibur' => $this->input->post("tanggal$i"),
                'tipe' => 'Nasional'
            ];
            $this->db->insert('harilibur', $query);
        }
        $i -- ;

        $pesan = [
            'pesan' => $i.' Data Berhasil Disimpan',
            'warna' => 'success'
        ];
        $this->session->set_flashdata($pesan);
        redirect('libur') ;
    }

    public function inputLiburManual()
    {
        $query = [
                'namaLibur' => $this->input->post("namaLN"),
                'tglLibur' => $this->input->post("tanggalLN"),
                'tipe' => 'Nasional'
            ];
            if( $this->db->insert('harilibur', $query) ) {
                
                $pesan = [
                    'pesan' => ' Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
                $this->session->set_flashdata($pesan);

            }else{

                $pesan = [
                    'pesan' => ' Data Gagal Disimpan',
                    'warna' => 'danger'
                ];
                $this->session->set_flashdata($pesan);

            }
            redirect('libur') ;
    }

    public function inputLiburBpom()
    {
        $query = [
                'namaLibur' => $this->input->post("nama"),
                'tglLibur' => $this->input->post("tanggal"),
                'tipe' => 'BPOM'
            ];
            if( $this->db->insert('harilibur', $query) ) {
                
                $pesan = [
                    'pesan' => ' Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
                $this->session->set_flashdata($pesan);

            }else{

                $pesan = [
                    'pesan' => ' Data Gagal Disimpan',
                    'warna' => 'danger'
                ];
                $this->session->set_flashdata($pesan);

            }
            redirect('libur') ;
    }

    public function hapus($id) 
    {
        $this->db->where('idLibur', $id);
        if($this->db->delete('harilibur')){
                
            $pesan = [
                'pesan' => ' Data Berhasil Dihapus',
                'warna' => 'success'
            ];
            $this->session->set_flashdata($pesan);

        }else{

            $pesan = [
                'pesan' => ' Data Gagal Dihapus',
                'warna' => 'danger'
            ];
            $this->session->set_flashdata($pesan);

        }
        redirect('libur') ;
        
    }

}

?>