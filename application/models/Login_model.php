<?php 

class Login_model extends CI_model {

    public function loginInUser($username,$password)
    {
        $this->load->helper('security');
        $password = do_hash($password) ;
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->join('level' , 'level.idLevel = inuser.idLevel');
        $query = $this->db->get('inuser')->row_array();
        if ($query){

            $sesi = [
                'key' => $query['idIU'] ,
                'nama' => $query['namaIU'] ,
                'nip' => $query['nip'] ,
                'idLevel' => $query['idLevel'],
                'namaLevel' => $query['namaLevel']
            ] ;
            // var_dump($sesi) ; die;
            $this->session->set_userdata($sesi);
            redirect('dashboard');

        }
        else{
            $this->session->set_flashdata('login' , 'MAAF Username dan Password Anda salah!, Mohon diperiksa kembali');
            redirect('auth/inuser');
        }
    }

    public function loginEksUser($email,$password)
    {
        $this->load->helper('security');
        $password = do_hash($password ) ;
        $this->db->where("(email = '$email' OR username = '$email') AND password = '$password'");
        // $this->db->where('password', $password);
        $query = $this->db->get('eksuser')->row_array();
        // var_dump($query['idIU']) ; die
        
        if ($query){
            if( $query['aktif'] != 1){
                $this->session->set_flashdata('login' , 'Anda Belum Melakukan Aktivasi Silahkan Cek Email Anda');
                redirect('auth');
            }

            $sesi = [
                'eksId' => $query['idEU'] ,
                'eksNama' => $query['namaDepan'].'. '.$query['namaEU'] ,
                'email' => $query['email'] ,
                'aktif' => $query['aktif'] 
            ] ;
            $this->session->set_userdata($sesi);
            redirect('dsb');

        }
        else{
            $this->session->set_flashdata('login' , 'MAAF Email atau Password Anda salah!, Mohon diperiksa kembali');
            redirect('auth');
        }
    }

    public function Registrasi_akun() 
    {
        
        $this->load->helper('security');
        $password = do_hash($this->input->post('password1')) ;
        $email = $this->input->post('email') ;

        $query = [
            'namaDepan' => $this->input->post('namaDepan'),
            'namaEU' => $this->input->post('nama'),
            'npwp' => $this->input->post('npwp'),
            'idProp' => $this->input->post('prop'),
            'idKota' => $this->input->post('kota'),
            'idKec' => $this->input->post('kecamatan'),
            'alamat' => $this->input->post('alamat'),
            'pos' => $this->input->post('pos'),
            'fax' => $this->input->post('fax'),
            'pj' => $this->input->post('pj'),
            'noPj' => $this->input->post('noPj'),
            'jabatan' => $this->input->post('jabatan'),
            'email' => $email,
            'username' => $this->input->post('username'),
            'password' => $password,
            'aktif' => 0
        ];

        $token = base64_encode(random_bytes(32)) ;

        $query_token = [
            'email'         => $email ,
            'token'         => $token ,
            'tanggal_buat'  => time()
        ];

        // kirim aktivasi 

        if($this->db->insert('eksuser', $query)) {
            if($this->db->insert('eksuser_token', $query_token)) {
                $this->_sendMail($token,'verify', $email);
                $pesan = [
                    'pesan' => 'Akun Berhasil Dibuat Silahkan Periksa Email Anda Untuk Aktivasi' ,
                    'warna' => 'success' 
                ] ;
            }else{
                $pesan = [
                    'pesan' => 'Terjadi Kesalahan' ,
                    'warna' => 'danger' 
                ] ;
            }
        }else{
            $pesan = [
                'pesan' => 'Terjadi Kesalahan' ,
                'warna' => 'danger' 
            ] ;
        }

        $this->session->set_flashdata($pesan);
        redirect('auth') ;

    }

    private function _sendMail($token, $type, $email)
        {
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'aribodoamat1@gmail.com',
                'smtp_pass' => 'hahahaha30',
                'smtp_port' => 465 ,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];

            $this->load->library('email',$config) ;


            $this->email->from('aribodoamat1@gmail.com', 'Produksi Biologi');
            $this->email->to($email);

            if($type == 'verify') {
                $this->email->subject('Verifikasi Akun');
                $this->email->message('
                    Klik Link Untuk Aktivasi Akun <a href="'.base_url().'auth/aktivasi?email='.$email.'&token='.$token.'"> Aktif </a> <br> <br>
                    Aktifiasi akub berlaku dalam waktu 48 jam
                ');
            }

            if($this->email->send() ){
                return true ;
            }else{
                return $this->email->print_debugger();
            }
        }

}

?>