<?php 

    class Form extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Form_model');
        }

        public function index($id)
        {
            $this->load->model('_Date');
            $data['judul'] = 'Form Evaluasi '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Form Evaluasi'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'jenisSample"> Jenis Vaksin </a> / Form Evaluasi'; 
            $data['general_informasi'] = $this->db->get('tbl_general_informasi')->result_array() ;
            $data['idJenisSample'] = $id ;
            $data['jenisSample'] = $this->Form_model->jenisSample($id);
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('form/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        
        public function form($id) 
        {
            $this->db->where('idJenisSample', $id) ;
            $this->db->select('jenisSample') ;
            $judul = $this->db->get('_jenisSample')->row_array() ;
            $judul = $judul['jenisSample'] ;

            $data['judul'] = 'Form '.$judul.' '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Form '.$judul; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'form/index/'.$id.'"> Form Evaluasi </a> / Form'; 
            
            $data['general_informasi'] = $this->Form_model->getDataForGI($id);
            $data['tabelProses'] = $this->Form_model->getDataForTabel($id) ;

            $data['tugas_tabel'] = ['1|Evaluasi','2|Pihak Ke 3'] ;
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('form/form');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }



        // general informasi
            public function add_gi_used($id, $idGI ) 
            {
                $query = [
                    'idGI' => $idGI , 
                    'idJenisSample' => $id 
                ] ;
                
                $this->db->insert('tbl_gi_used', $query) ;

                $pesan = [
                    'pesan_gi' => 'Data Berhasil Di Tambah',
                    'warna_gi' => 'success'
                ];
                $this->session->set_flashdata($pesan);
                $this->gi_used($id);
            }
            
            public function off_gi_used($id, $idGI ) 
            {
                $this->db->where('idGI', $idGI) ;
                $this->db->where('idJenisSample', $id) ;
                $this->db->delete('tbl_gi_used') ;

                $pesan = [
                    'pesan_gi' => 'Data Berhasil Di Hapus',
                    'warna_gi' => 'danger'
                ];
                $this->session->set_flashdata($pesan);
                $this->gi_used($id);
            }

            public function gi_used($id) 
            {
                $data['id'] = $id ;
                $this->db->where('idJenisSample', $id) ;
                $this->db->join('tbl_general_informasi', 'tbl_general_informasi.idGI = tbl_gi_used.idGI') ;
                $data['sample'] = $this->db->get('tbl_gi_used')->result_array() ;
                $this->load->view('form/form_gi/use_form_gi',$data);
            }
        // general informasi



        
        // tabel
            public function tabel($id,$idJS = 0)
            {
                $this->db->where('id_tbl_proses', $id) ;
                $data['tabel'] = $this->db->get('tbl_proses')->row_array() ;
                $data['header'] = $this->Form_model->getDataHeader($id) ;
                $data['kolom'] = $this->Form_model->getDataKolom($id) ;
                $data['footer'] = $this->Form_model->getDataFooter($id) ;
                $data['idJS'] = $idJS ;

                $this->load->view('form/tabelproses', $data) ;
            }

            public function listTabel($id)
            {
                $this->db->where('idJenisSample', $id) ;
                $data['tabel'] = $this->db->get('tbl_proses')->result_array() ;
                $data['idJS'] = $id ;

                $this->load->view('form/tabel/listTabel', $data) ;
            }

            public function tambahTabel($id)
            {
                $query = [
                    'idJenisSample'     => $id ,
                    'nama_tbl_proses'   => $this->input->post('namaTabel', true)
                ] ;

                
                $this->db->insert('tbl_proses', $query) ;

                $pesan = [
                    'pesan_tbl' => 'data berhasil ditambahkan', 
                    'warna_tbl' => 'success'
                ] ;

                $this->session->set_flashdata($pesan) ;
                $this->listTabel($id) ; 
            } 

            public function hapusTabel($id,$idJS)
            {
                $this->db->where('id_tbl_proses', $id) ;
                if($this->db->delete('tbl_proses')) {

                    $this->db->where('id_tbl_proses', $id) ;
                    $this->db->delete('tbl_proses_header') ;

                    $this->db->where('id_tbl_proses', $id) ;
                    $this->db->delete('tbl_proses_kolom') ;

                    $this->db->where('id_tbl_proses', $id) ;
                    $this->db->delete('tbl_proses_footer') ;

                    $pesan = [
                        'pesan_tbl' => 'berhasil di hapus',
                        'warna_tbl' => 'success'
                    ];
                }else{
                    $pesan = [
                        'pesan_tbl' => 'gagal di hapus',
                        'warna_tbl' => 'danger'
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->listTabel($idJS) ;
            }

            // header
                public function listHeader($id)
                {
                    $this->db->where('id_tbl_proses', $id) ;
                    $data['header'] = $this->db->get('tbl_proses_header')->result_array() ;

                    $this->load->view('form/tabel/listHeader', $data) ;
                }

                public function tambahHeader($id) 
                {
                    $query = [
                        'id_tbl_proses' => $id ,
                        'nama_tbl_header' => $this->input->post('namaHeader')
                    ];

                    if($this->db->insert('tbl_proses_header', $query)) {
                        $pesan = [
                            'pesan_header' => 'header berhasil ditambahkan',
                            'warna_header' => 'success'
                        ];
                    }else{
                        $pesan = [
                            'pesan_header' => 'header gagal ditambahkan',
                            'warna_header' => 'danger'
                        ];
                    }

                    $this->session->set_flashdata($pesan);
                    $this->listHeader($id) ;
                }

            // header






            // kolom
                public function listKolom($id)
                {
                    $this->db->where('id_tbl_proses', $id) ;
                    $data['kolom'] = $this->db->get('tbl_proses_kolom')->result_array() ;

                    $this->load->view('form/tabel/listKolom', $data) ;
                }

                public function tambahKolom($id) 
                {
                    $query = [
                        'id_tbl_proses' => $id ,
                        'nama_kolom' => $this->input->post('namaKolom')
                    ];

                    if($this->db->insert('tbl_proses_kolom', $query)) {
                        $pesan = [
                            'pesan_kolom' => 'kolom berhasil ditambahkan',
                            'warna_kolom' => 'success'
                        ];
                    }else{
                        $pesan = [
                            'pesan_kolom' => 'kolom gagal ditambahkan',
                            'warna_kolom' => 'danger'
                        ];
                    }

                    $this->session->set_flashdata($pesan);
                    $this->listKolom($id) ;
                }
            // kolom




            
            // footer
                public function listFooter($id)
                {
                    $this->db->where('id_tbl_proses', $id) ;
                    $data['footer'] = $this->db->get('tbl_proses_footer')->result_array() ;

                    $this->load->view('form/tabel/listFooter', $data) ;
                }

                public function tambahFooter($id) 
                {
                    // echo 'ok' ;
                    $query = [
                        'id_tbl_proses' => $id ,
                        'nama_tbl_footer' => $this->input->post('namaFooter')
                    ];

                    if($this->db->insert('tbl_proses_footer', $query)) {
                        $pesan = [
                            'pesan_footer' => 'footer berhasil ditambahkan',
                            'warna_footer' => 'success'
                        ];
                    }else{
                        $pesan = [
                            'pesan_footer' => 'footer gagal ditambahkan',
                            'warna_footer' => 'danger'
                        ];
                    }

                    $this->session->set_flashdata($pesan);
                    $this->listFooter($id) ;
                }
            // footer

        // tabel































        // public function tabelProses($id) 
        // {
        //     echo 'ok' ;
        // }
    }

?>