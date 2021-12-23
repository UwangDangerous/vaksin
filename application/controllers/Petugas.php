<?php 

class Petugas extends CI_Controller{
    public function __construct() 
    {
        parent::__construct() ;
        $this->load->library('form_validation');
        $this->load->model('Petugas_model');
    }

    public function index()
    {
        $this->load->model('_Date');
        $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Data Sampel'; 
        $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Sampel'; 
        $data['sample'] = $this->Petugas_model->getSample();
        // $data['petugas'] = $this->Petugas_model->getPetugas();
        if( ($this->session->userdata('key') != null) )
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('petugas/index',$data);
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function detail($id)
    {
        $this->load->model('_Date');
        $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Data Sampel'; 
        $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Petugas'; 
        $data['sample'] = $this->Petugas_model->getSample();
        // $data['petugas'] = $this->Petugas_model->getPetugas();
        if( ($this->session->userdata('key') != null) )
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('petugas/index',$data);
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function tambahPetugas() {
        // 'idIU' => $this->input->post('evaluator'),
        //     'idIU' => $this->input->post('verifikator'),
        //     'idIU' => $this->input->post('ve'),
        if( $iu = $this->input->post('ve') ) {
            $i = 0 ;
            for($i; $i<2; $i++) {

                if($i == 0) {
                    $level = 3; //evaluator
                }else{
                    $level = 4; //verifikator
                }
                
                $query = [
                    'idSample' => $this->input->post('idSample'),
                    'idIU' => $iu ,
                    'idLevel' => $level 
                ];
                // var_dump($query) ;
                $this->db->insert('petugas', $query);
            }
                
        }else{
            $i = 0 ;
            for($i; $i<2; $i++) {

                if($i == 0) {
                    $level = 3; //evaluator
                    $iu = $this->input->post('evaluator') ;
                    
                    if($iu) {
                        $query = [
                            'idSample' => $this->input->post('idSample'),
                            'idIU' => $iu ,
                            'idLevel' => $level 
                        ];
                        // var_dump($query) ;
                        $this->db->insert('petugas', $query);
                    }
                }else{
                    $level = 4; //verifikator
                    $iu = $this->input->post('verifikator');
                    if($iu) {
                        $query = [
                            'idSample' => $this->input->post('idSample'),
                            'idIU' => $iu ,
                            'idLevel' => $level 
                        ];
                        // var_dump($query) ;
                        $this->db->insert('petugas', $query);
                    }
                }
                
            }
        }


        // var_dump($query) ;
    }

    public function tambahPetugasSusulan($lvl) 
    {
        if($lvl == 4) {
            $iu = $this->input->post('verifikator') ;
            $petugas = "Verifikator" ;
        }else{
            $iu = $this->input->post('evaluator') ;
            $petugas = "Evaluator" ;
        }

        $query = [
            'idSample' => $this->input->post('idSample'),
            'idIU' => $iu ,
            'idLevel' => $lvl 
        ];

        $this->db->insert('petugas', $query);

        $this->session->set_flashdata('pesan', "Petugas $petugas Berhasil Ditambahkan");
        redirect("petugas") ;
        
    }

    public function ubahPetugasSusulan($lvl) 
    {
        if($lvl == 4) {
            $iu = $this->input->post('verifikator') ;
            $petugas = "Verifikator" ;
        }else{
            $iu = $this->input->post('evaluator') ;
            $petugas = "Evaluator" ;
        }

        $query = [
            'idSample' => $this->input->post('idSample'),
            'idIU' => $iu ,
            'idLevel' => $lvl 
        ];

        $this->db->where('idPetugas', $this->input->post('idPetugas'));
        $this->db->update('petugas', $query);

        $this->session->set_flashdata('pesan', "Petugas $petugas Berhasil Di Ubah");
        redirect("petugas") ;
        
    }
}

?>