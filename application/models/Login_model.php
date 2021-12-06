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
        $password = do_hash($password) ;
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('eksuser')->row_array();
        // var_dump($query['idIU']) ; die
        if( $query['aktif'] != 1){
            $this->session->set_flashdata('login' , 'Anda Belum Melakukan Aktivasi Silahkan Cek Email Anda');
            redirect('auth');
        }

        if ($query){

            $sesi = [
                'eksId' => $query['idEU'] ,
                'eksNama' => $query['namaEU'] ,
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

}

?>