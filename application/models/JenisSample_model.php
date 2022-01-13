<?php 

    class JenisSample_model extends CI_Model {
        public function getDataJS($hal)
        {
            $this->load->library('pagination');
            
            if($this->input->post('btn-cari')) {
                $data['keyword'] = $this->input->post('cari');
                $this->session->set_userdata('keywordJS', $data['keyword']);
            }else{
                $data['keyword'] = $this->session->set_userdata('keywordJS') ;
            }

            $this->db->like('jenisSample', $data['keyword']);
            $this->db->from('_jenisSample');
            $config['total_rows'] = $this->db->count_all_results();
            $data['total_rows'] = $config['total_rows'] ;
            $config['per_page'] = 4 ;
            $config['num_links'] = 3 ; //default nya 2
            $config['base_url'] = base_url()."jenisSample/index" ;
            
            $this->pagination->initialize($config);
            
            $data['start'] = $this->uri->segment(3) ;
            
            $this->db->order_by('jenisSample','asc');
            $this->db->like('jenisSample', $data['keyword']);
            $data['sample'] = $this->db->get('_jenisSample', $config['per_page'], $data['start'])->result_array();

            $data['wadah'] = ['vial|vial', 'ampul|ampoule'] ;
            $data['produksi'] = ['Domestik', 'Import'] ;

            $this->load->view('jenisSample/index',$data);
        }
    }

?>