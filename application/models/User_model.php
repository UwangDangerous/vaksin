<?php 

    class User_model extends CI_Model{
        public function getDataUser() 
        {
            // $this->db->where('level.idLevel != 5 and level.idLevel != 6');
            $this->db->join('level', 'level.idLevel = inUser.idLevel');
            return $this->db->get('inUser')->result_array();
        }

        public function getDataLevel() {
            // $this->db->where('level.idLevel != 5 and level.idLevel != 6');
            return $this->db->get('level')->result_array();
        }

        public function addDataUser() {
            $this->load->model('_Upload') ;
            if(empty($_FILES['ttd']['name']) ) {
                $file = 'contoh.png' ;
            }else{
                $file = $this->_Upload->uploadEksUser('ttd', 'assets/file-upload/ttd' , 'png', 'user/tambah' , 'tanda_tangan_'.$this->input->post('nama')) ;
            }

            $this->load->helper('security');
            $query = [
                'namaIU' => $this->input->post('nama',true) ,
                'nip' => $this->input->post('nip',true) ,
                'username' => $this->input->post('nip',true) ,
                'password' => do_hash("p@ssw0rd") ,
                'idLevel' => $this->input->post('level'),
                'tanda_tangan' => $file 
            ];

            if($this->db->insert('inuser',$query)) {
                $pesan = [
                    'pesan' => 'Internal User Berhasi Disimpan' ,
                    'warna' => 'success' 
                ];
            }else{
                $pesan = [
                    'pesan' => 'Internal User Gagal Disimpan' ,
                    'warna' => 'danger' 
                ];
            }

            $this->session->set_flashdata($pesan);
        }

        public function getDataUserEksternal()
        {
            return $this->db->get('eksuser')->result_array();
        }
    }

?>