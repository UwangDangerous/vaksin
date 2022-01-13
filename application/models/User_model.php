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
            $this->load->helper('security');
            $query = [
                'namaIU' => $this->input->post('nama',true) ,
                'nip' => $this->input->post('nip',true) ,
                'username' => $this->input->post('nip',true) ,
                'password' => do_hash(123456) ,
                'idLevel' => $this->input->post('level')
            ];
            $this->db->insert('inuser',$query);
        }

        public function getDataUserEksternal()
        {
            return $this->db->get('eksuser')->result_array();
        }
    }

?>