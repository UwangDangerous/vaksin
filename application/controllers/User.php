<?php 

    class User extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('User_model');
            $this->load->library('form_validation');
        }

        public function index()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data User Internal'. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data User Internal'; 
            $data['bread'] = '<a href="'.base_url().'dashboard">Dashboard</a> / Data User'; 

            $data['user'] = $this->User_model->getDataUser();
            $data['level'] = $this->User_model->getDataLevel();

            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('user/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
            }
        }


        public function tambah()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Tambah Data User '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Tambah Data User'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'user">Data User</a> / Tambah Data'; 

            $data['user'] = $this->User_model->getDataUser();
            $data['level'] = $this->User_model->getDataLevel();

            if( ($this->session->userdata('key') != null) )
            {
                $this->form_validation->set_rules('nama', 'Nama User', 'required');
                $this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
                $this->form_validation->set_rules('level', 'Level User', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('user/tambah');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->User_model->addDataUser();
                    redirect('user') ;
                }

            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
            }
        }

        public function hapus($id)
        {
            $this->db->where('idIU', $id) ;
            if($this->db->delete('inuser')) {
                $pesan = [
                    'pesan' => 'Data Berhasil Di Hapus',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Hapus',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect('user') ;
        }

        public function ubah($id)
        {
            $this->load->model('_Upload') ;
            if(empty($_FILES['ttd']['name']) ) {
                $file = $this->input->post('ttd_lama') ;
            }else{
                $file = $this->_Upload->uploadEksUser('ttd', 'assets/file-upload/ttd' , 'png', 'user/tambah' , 'tanda_tangan_'.$this->input->post('nama')) ;
            }

            if(empty( $this->input->post('username') ) ) {
                $username = $this->input->post('username_lama') ;
            }else{
                $username = $this->input->post('username') ;
            }

            if(empty( $this->input->post('password') ) ) {
                $password = $this->input->post('password_lama') ;
            }else{
                $this->load->helper('security');
                $password = $this->input->post('password') ;
                $password = do_hash($password) ;
            }

            $query = [
                'namaIU' => $this->input->post('nama'),
                'nip' => $this->input->post('nip'),
                'idLevel' => $this->input->post('level'),
                'tanda_tangan' => $file,
                'username' => $username ,
                'password' => $password
            ];

            $this->db->where('idIU', $id) ;
            if($this->db->update('inuser', $query)) {
                $pesan = [
                    'pesan' => 'Data Berhasil Diubah',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Diubah',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect('user') ;
        }





        public function eksternal()
        {
            $data['judul'] = 'Data User Eksternal'. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data User Eksternal'; 
            $data['bread'] = '<a href="'.base_url().'dashboard">Dashboard</a> / Data User'; 

            $data['user'] = $this->User_model->getDataUserEksternal();

            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('user/eksternal');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth') ;
            }
        }

        public function nonAktif($id) 
        {
            $this->db->where('idEU', $id);
            if($this->db->update('eksuser', ['aktif' => 2])){
                $pesan = [
                    'pesan' => 'User Di Non Aktifkan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Gagal Non Aktifkan User',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan);
            redirect('user/eksternal') ;
        }

        public function aktif($id) 
        {
            $this->db->where('idEU', $id);
            if($this->db->update('eksuser', ['aktif' => 1])){
                $pesan = [
                    'pesan' => 'User Di Aktifkan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Gagal Aktifkan User',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan);
            redirect('user/eksternal') ;
        }
    }

?>