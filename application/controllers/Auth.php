<?php 

    class Auth extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('Login_model');
            $this->load->library('form_validation');
        }

        // eksternal user
        
        public function index()
        {
            $this->form_validation->set_rules('password', 'Password', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header');
                    $this->load->view('temp/navbar');
                    $this->load->view('auth/index');
                    $this->load->view('temp/footerPage');
                    $this->load->view('temp/footer');
                }else{
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $this->Login_model->loginEksUser($email,$password);
                }
        }

        public function register()
        {
            $this->load->model('_Address');
            $data['propinsi'] = $this->_Address->getDataProvinsi();
            $data['kota'] = $this->_Address->getDataKota();
            $data['kecamatan'] = $this->_Address->getDataKecamatan();

            $this->form_validation->set_rules('nama', 'Nama Perusahaan', 'required');
            $this->form_validation->set_rules('npwp', 'NPWP', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat Perusahaan', 'required');
            $this->form_validation->set_rules('prop', 'Provinsi', 'required');
            $this->form_validation->set_rules('kota', 'Kabupaten / Kota', 'required');
            $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
            $this->form_validation->set_rules('pos', 'Kode Pos', 'required|numeric');
            $this->form_validation->set_rules('telp', 'Telepon', 'required|numeric');
            $this->form_validation->set_rules('fax', 'FAX', 'required|numeric');
            $this->form_validation->set_rules('pj', 'Penanggung Jawab', 'required');
            $this->form_validation->set_rules('noPj', 'Nomor Telepon Penanggung Jawab', 'required|numeric');
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[eksuser.email]');
            $this->form_validation->set_rules('password1', 'Kata Sandi', 'required|min_length[8]|matches[password2]');
            $this->form_validation->set_rules('password2', 'Konfirmasi Kata Sandi', 'required|min_length[8]|matches[password1]');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header');
                    $this->load->view('temp/navbar');
                    $this->load->view('auth/register',$data);
                    $this->load->view('temp/footerPage');
                    $this->load->view('temp/footer');
                }else{
                    $this->Login_model->Registrasi_akun();
                }
        }

        public function aktivasi() 
        {
            $email = $this->input->get('email');
            $token = $this->input->get('token');


            $user = $this->db->get_where('eksuser', ['email' => $email])->row_array();
            
            if($user) {
                $user_token = $this->db->get_where('eksuser_token', ['token' => $token])->row_array();

                if($user_token) {

                    $limit = $user_token['tanggal_buat'] + (60*60*48) ;
                    var_dump($limit, time())  ;
                    if($limit < time()) {
                        $pesan = [
                            'pesan' => 'Gagal Aktivasi, Token Kadaluarsa, Silahkan Daftar Kembali',
                            'warna' => 'danger'
                        ];

                        $this->db->delete('eksuser', ['email' => $email]);
                        $this->db->delete('eksuser_token', ['email' => $email]);
                    }else{
                        $pesan = [
                            'pesan' => 'Aktivasi Berhasil, Silahkan Login',
                            'warna' => 'success'
                        ];
                        $this->db->delete('eksuser_token', ['email' => $email]);


                        $this->db->where('email', $email);
                        $this->db->update('eksuser', ['aktif' => 1]);
                    }
                    

                }else{
                    $pesan = [
                        'pesan' => 'Gagal Aktivasi, Token Anda Salah',
                        'warna' => 'danger'
                    ];
                }
            }else{
                $pesan = [
                    'pesan' => 'Gagal Aktivasi, Email Anda Salah',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan);
            redirect('auth') ;
        }











        // internal user

        public function inuser()
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header');
                    $this->load->view('temp/navbar');
                    $this->load->view('auth/inuser');
                    $this->load->view('temp/footerPage');
                    $this->load->view('temp/footer');
                }else{
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $this->Login_model->loginInUser($username,$password);
                }
        }





























        // logout
        public function logout() 
        {
            $this->session->sess_destroy();
            redirect('Auth/inuser') ; 
        }

        public function logoutEks() 
        {
            $this->session->sess_destroy();
            redirect('Auth') ; 
        }
    }

?>