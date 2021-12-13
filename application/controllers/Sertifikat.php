<?php 

    class Sertifikat Extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Sample_model');
            $this->load->model('Sertifikat_model');
            $this->load->model('_Date');
        }

        public function index()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Penerimaan Surat'; 
            $data['sample'] = $this->Sample_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sertifikat/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function create($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'sample"> Penerimaan Surat </a> / Data Sample '; 
            // $data['sample'] = $this->Sample_model->getDataSample();

            
            $surat =  $this->Sample_model->judul($id);

            $data['judulSurat'] = $surat['keterangan'];
            $data['pengirim'] = $surat['namaEU'];
            $data['id'] = $id ;

            $data['sample'] =  $this->Sertifikat_model->getSampleVerifikasi($id);

            if( $this->session->userdata('key') != null)
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sertifikat/create');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function buatSertifikat()
        {
            if(empty($this->input->post('no2'))) {
                $this->session->set_flashdata(['pesan' => 'Nomer Sertifikat Harap Di Isi', 'warna' => 'danger']);
                redirect("sertifikat/create/".$this->input->post('id'));
            }
            // echo $this->input->post('id');
            // echo $this->input->post('no1');
            // echo $this->input->post('no2').'<br>';
            // echo $this->input->post('idArray');

            $i=0;
            $jumlah = explode(',', $this->input->post('idArray')) ;
            $idArray = '' ;
            for($i ; $i<count($jumlah); $i++) {
                $idArray .= $this->input->post('check'.$jumlah[$i] ).',' ; 
            }

            $idArray = rtrim($idArray,',') ;

            if($idArray == null) {
                $this->session->set_flashdata(['pesan' => 'Tidak Ada Sample Terpilih', 'warna' => 'danger']);
                redirect("sertifikat/create/".$this->input->post('id'));
            }

            $query = [
                'noSertifikat' => $this->input->post('no1').''.$this->input->post('no2'),
                'idVerifikasi' => $idArray,
                'dibuat' => date('Y-m-d')
            ];
            $j = 0;
            if($this->db->insert('sertifikat', $query)){
                for($j ; $j<count($jumlah); $j++) {
                    $this->db->where('idVerifikasi', $this->input->post('check'.$jumlah[$j] ) );
                    $this->db->set('sertifikat', 1);
                    $this->db->update('verifikasi');  
                }

                $this->session->set_flashdata(['pesan' => 'Sertifikat Berhasil Di Buat', 'warna' => 'success']);
                redirect("sertifikat/create/".$this->input->post('id'));
            }else{
                $this->session->set_flashdata(['pesan' => 'Sertifikat Gagal Di Buat', 'warna' => 'danger']);
                redirect("sertifikat/create/".$this->input->post('id'));
            }

        }
    }

?>