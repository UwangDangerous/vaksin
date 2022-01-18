<?php 

class Petugas extends CI_Controller{
    public function __construct() 
    {
        parent::__construct() ;
        $this->load->library('form_validation');
        $this->load->model('Petugas_model');
    }

    public function index($id=null)
    {
        if($this->input->post('cariByDokumen')) {
            $cari = $this->input->post('cariJenisDok');
        }else{
            $cari = '' ;
        }

        if($id == 0) {
            $id = null ;
        }
        $this->load->model('_Date');
        $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Data Sampel'; 
        $data['bread'] = 'Dashboard / <a href="'.base_url().'sample"> Penerimaan Surat </a> / Sampel'; 
        $data['sample'] = $this->Petugas_model->getSample($id,$cari);
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

    public function detail($idSurat,$id)
    {
        $this->load->model('_Date');
        // $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Rinscian Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Rinscian Data Sampel'; 
        $data['bread'] = 'Dashboard / <a href="'.base_url().'petugas/index/'.$idSurat.'"> Sampel </a> / Rincian Sampel'; 
        $data['sample'] = $this->Petugas_model->getDetailSample($idSurat,$id);
        $data['petugas'] = $this->Petugas_model->getPetugas($id);
        $data['id'] = $id ;
        // $data['petugas'] = $this->Petugas_model->getPetugas();
        if( ($this->session->userdata('key') != null) )
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('petugas/detail');
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function tambahPetugas() {
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

            $this->session->set_flashdata('pesan', "Petugas Berhasil Di Simpan");
            redirect("petugas") ;
                
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
            $this->session->set_flashdata('pesan', "Petugas Berhasil Di Simpan");
            redirect("petugas") ;
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

    public function inputDataKurang($id) 
    {
        $query=[
            'idSample' => $id,
            'clock_off' => date('Y-m-d'),
            'judul' => $this->input->post('judul'),
            'keterangan' => $this->input->post('keterangan',true),
            'clock_on' => '0000-00-00'
        ];

        if( $this->db->insert('clockoff', $query) ) {
            $queryRiwayat = [
                'idSample' => $id,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Clock Off ( '.$this->input->post('keterangan',true).' )'
            ];
            $this->db->insert('riwayatpekerjaan', $queryRiwayat);
            $pesan = [
                'pesan' => 'Data Berhasil Disimpan' ,
                'warna' => 'success'
            ];
            $this->session->set_flashdata($pesan);
            redirect('petugas/detail/'.$id) ;

            
        }else{
            $pesan = [
                'pesan' => 'Data Gagal Disimpan' ,
                'warna' => 'danger'
            ];
            $this->session->set_flashdata('pesan');
            redirect('petugas/detail/'.$id) ;
        }
    }

    public function ubahIdProsesSample($id,$idSurat)
    {
        // echo $this->input->post('cmbProses');
        $this->db->where('idSample',$id); 
        if($this->db->update('_sample', [ 'idProses' => $this->input->post('cmbProses') ] ) ) {
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
        $this->session->set_flashdata('pesan');
        redirect("petugas/index/$idSurat/$id") ;
    }
}

?>