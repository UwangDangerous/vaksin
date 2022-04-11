<?php 

    class Evaluasi extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            // $this->load->library('form_validation');
            $this->load->model('Evaluasi_model');
        }



        // form
            public function form($id, $idBatch) //$id = $idJenisSample
            {
                $data['judul'] = 'Lengkapi Data '. $this->session->userdata('namaLevel'); 
                $data['header'] = 'Lengkapi Data'; 
                $data['bread'] = 'Dashboard / <a href="'.base_url().'__evaluasi">  Evaluasi </a> / Form '; 

                $data['id'] = $id ;
                $data['idBatch'] = $idBatch ;

                // $data['tabelProses'] = $this->Evaluasi_model->getDataForTabel($id) ;
                
                if( $this->session->userdata('key') != null )
                {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('evaluasi/form/index');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                    redirect('auth') ;
                }
            }

            // general informasi
                public function general_informasi($id, $idBatch) 
                {
                    $data['id'] = $id ;
                    $data['idBatch'] = $idBatch ;
                    $data['general_informasi'] = $this->Evaluasi_model->getDataForGI($id);
                    $this->load->view('evaluasi/form/general_informasi', $data) ;
                }

                public function tambah_gi($id, $idBatch) 
                {
                    if($this->input->post('isi_gi') == '') {
                        $pesan = [
                            'pesan_isi' => 'Form Tidak Boleh Kosong' ,
                            'warna_isi' =>'danger'
                        ];
                    }else{
                        $query = [
                            'idBatch' => $idBatch,
                            'id_gi_used' => $this->input->post('id_isi_gi'),
                            'isi_gi' => $this->input->post('isi_gi')
                        ] ; 
        
                        if($this->db->insert('isi_tbl_gi', $query)) {
                            $pesan = [
                                'pesan_isi' => 'Data Berhasil Di Tambahkan' ,
                                'warna_isi' =>'success'
                            ];
                        }else{
                            $pesan = [
                                'pesan_isi' => 'Data Gagal Di Tambahkan' ,
                                'warna_isi' =>'danger'
                            ];
                        }
                    }

                    $this->session->set_flashdata($pesan) ;
                    $this->general_informasi($id, $idBatch) ;
                }

                public function ubah_gi($id, $idBatch) 
                {
                    $this->db->where('id_isi_gi', $this->input->post('id_isi_gi') );
                    if($this->db->update('isi_tbl_gi', ['isi_gi' => $this->input->post('isi_gi')] ) ) {
                        $pesan = [
                            'pesan_isi' => 'Data Berhasil Di Ubah' ,
                            'warna_isi' => 'success'
                        ];
                    }else{
                        $pesan = [
                            'pesan_isi' => 'Data Gagal Di Ubah' ,
                            'warna_isi' => 'danger'
                        ];
                    }

                    $this->session->set_flashdata($pesan) ;
                    $this->general_informasi($id, $idBatch) ;
                }

                public function hapus_gi($id, $idBatch, $idIsi)
                {
                    $this->db->where('id_isi_gi', $idIsi) ;
                    if($this->db->delete('isi_tbl_gi')) {
                        $pesan = [
                            'pesan_isi' => 'Data Berhasil Di Hapus' ,
                            'warna_isi' =>'success'
                        ];
                    }else{
                        $pesan = [
                            'pesan_isi' => 'Data Gagal Di Hapus' ,
                            'warna_isi' =>'danger'
                        ];
                    }

                    $this->session->set_flashdata($pesan) ;
                    $this->general_informasi($id, $idBatch) ;
                }
            // general informasi








            //tabel 
                public function tabel($id, $idBatch)
                {
                    $data['id'] = $id ;
                    $data['idBatch'] = $idBatch ;
                    $data['tabelProses'] = $this->Evaluasi_model->getDataForTabel($id);
                    $this->load->view('evaluasi/form/tabel', $data) ;
                }

                // header
                    public function header($idTbl, $id, $idBatch) //id tabel proses , id jenis sample, idsample
                    {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idBatch'] = $idBatch ;
                        $data['header'] =$this->Evaluasi_model->getDataForTabelHeader($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/header', $data);
                    }

                    public function tambah_tbl_header($idTbl, $id, $idBatch)
                    {
                        $query = [
                            'idBatch' => $idBatch,
                            'id_tbl_header' => $this->input->post('idHeader'),
                            'isi_header' => $this->input->post('namaHeader')
                        ];

                        if($this->db->insert('isi_tbl_proses_header', $query) ) {
                            $pesan = [
                                "pesan_isi_header_$idTbl" => 'Data Berhasil Disimpan' ,
                                "warna_isi_header_$idTbl" => 'success' 
                            ] ;
                        }else{
                            $pesan = [
                                "pesan_isi_header_$idTbl" => 'Data Gagal Disimpan' ,
                                "warna_isi_header_$idTbl" => 'danger' 
                            ] ;
                        }

                        $this->session->set_flashdata($pesan);
                        $this->header($idTbl, $id, $idBatch);
                    }

                    public function hapus_tbl_header($idTbl, $id, $idSample, $id_isi_Header)
                    {
                        $this->db->where('id_isi_tbl_header', $id_isi_Header);
                        if($this->db->delete('isi_tbl_proses_header') ) {
                            $pesan = [
                                "pesan_isi_header_$idTbl" => 'Data Berhasil Di Hapus' ,
                                "warna_isi_header_$idTbl" => 'success' 
                            ] ;
                        }else{
                            $pesan = [
                                "pesan_isi_header_$idTbl" => 'Data Gagal Di Hapus' ,
                                "warna_isi_header_$idTbl" => 'danger' 
                            ] ;
                        }

                        $this->session->set_flashdata($pesan);
                        $this->header($idTbl, $id, $idSample);
                    }

                    public function ubah_tbl_header($idTbl, $id, $idSample, $id_isi_Header)
                    {
                        $this->db->where('id_isi_tbl_header', $id_isi_Header);
                        $this->db->set('isi_header', $this->input->post('namaHeader'));
                        if($this->db->update('isi_tbl_proses_header') ) {
                            $pesan = [
                                "pesan_isi_header_$idTbl" => 'Data Berhasil Di Ubah' ,
                                "warna_isi_header_$idTbl" => 'success' 
                            ] ;
                        }else{
                            $pesan = [
                                "pesan_isi_header_$idTbl" => 'Data Gagal Di Ubah' ,
                                "warna_isi_header_$idTbl" => 'danger' 
                            ] ;
                        }

                        $this->session->set_flashdata($pesan);
                        $this->header($idTbl, $id, $idSample);
                    }
                // header

                
                // kolom
                    public function kolom($idTbl, $id, $idBatch) 
                    {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idBatch'] = $idBatch ;
                        $data['kolom'] =$this->Evaluasi_model->getDataForTabelKolom($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/kolom', $data);  
                    }

                    public function isi_kolom($idTbl, $id, $idBatch) {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idBatch'] = $idBatch ;
                        $data['kolom'] =$this->Evaluasi_model->getDataForTabelKolom($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/isi_kolom',$data);
                    }

                    public function tambahIsiKolom($idTbl, $id, $idBatch) 
                    {
                        $ArrayIDK = $this->input->post('ArrayIDK');
                        $ArrayIDK = explode(',',$ArrayIDK) ;
                        foreach($ArrayIDK as $Arr) {
                            if($this->input->post("isi_kolom_$Arr") == null){
                                $isi = '-' ;
                            }else{
                                $isi = $this->input->post("isi_kolom_$Arr")  ;
                            }
                            $query = [
                                'id_kolom' => $Arr ,
                                'idBatch' => $idBatch,
                                'isi_kolom' => $isi
                            ] ;

                            $this->db->insert('isi_tbl_kolom', $query);
                        }

                        $pesan = [
                            'pesan_kolom'.$idTbl => 'Data Berhasil DiSimpan' ,
                            'warna_kolom'.$idTbl => 'success'
                        ];
                        $this->session->set_flashdata($pesan);
                        $this->isi_kolom($idTbl, $id, $idBatch);
                    }

                    public function ubahIsiKolom($idTbl, $id, $idBatch,$idKolom) 
                    {
                        if($this->input->post("text_isi_kolom_$idKolom") == null) {
                            $isi = '-' ;
                        }else{
                            $isi = $this->input->post("text_isi_kolom_$idKolom") ;
                        }
                        $this->db->where('id_isi_tbl_kolom', $idKolom);
                        $this->db->set(['isi_kolom' => $isi]);
                        if($this->db->update('isi_tbl_kolom')) {
                            $pesan = [
                                'pesan_kolom'.$idTbl => 'Data Berhasil Di Ubah' ,
                                'warna_kolom'.$idTbl => 'success'
                            ];
                        }else{
                            $pesan = [
                                'pesan_kolom'.$idTbl => 'Data Gagal Di Ubah' ,
                                'warna_kolom'.$idTbl => 'danger'
                            ];
                        }
                        
                        $this->session->set_flashdata($pesan);
                        $this->isi_kolom($idTbl, $id, $idBatch);
                        // echo 'ok' ;
                    }

                    public function hapusIsiKolom($idTbl, $id, $idBatch,$ArrayIDK) 
                    {
                        $ArrayIDK = explode('%7C',$ArrayIDK) ;
                        foreach($ArrayIDK as $Arr) {
                            $this->db->where('id_isi_tbl_kolom', $Arr);
                            $this->db->delete('isi_tbl_kolom');
                            // echo $Arr ;
                        }
                        
                        $pesan = [
                            'pesan_kolom'.$idTbl => 'Data Berhasil Di Hapus' ,
                            'warna_kolom'.$idTbl => 'success'
                        ];
                        // echo 'ok' ;
                        $this->session->set_flashdata($pesan);
                        $this->isi_kolom($idTbl, $id, $idBatch);
                    }

                // kolom


                // footer
                    public function footer($idTbl, $id, $idBatch)
                    {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idBatch'] = $idBatch ;
                        $data['footer'] =$this->Evaluasi_model->getDataForTabelFooter($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/footer', $data);
                    }

                    public function tambah_tbl_footer($idTbl, $id, $idBatch)
                    {
                        $query = [
                            'idBatch' => $idBatch,
                            'id_tbl_footer' => $this->input->post('idFooter'),
                            'isi_footer' => $this->input->post('namaFooter')
                        ];

                        if($this->db->insert('isi_tbl_proses_footer', $query) ) {
                            $pesan = [
                                "pesan_isi_footer_$idTbl" => 'Data Berhasil Disimpan' ,
                                "warna_isi_footer_$idTbl" => 'success' 
                            ] ;
                        }else{
                            $pesan = [
                                "pesan_isi_footer_$idTbl" => 'Data Gagal Disimpan' ,
                                "warna_isi_footer_$idTbl" => 'danger' 
                            ] ;
                        }

                        $this->session->set_flashdata($pesan);
                        $this->footer($idTbl, $id, $idBatch);
                    }

                    public function hapus_tbl_footer($idTbl, $id, $idBatch, $id_isi_Footer)
                    {
                        $this->db->where('id_isi_tbl_footer', $id_isi_Footer);
                        if($this->db->delete('isi_tbl_proses_footer') ) {
                            $pesan = [
                                "pesan_isi_footer_$idTbl" => 'Data Berhasil Di Hapus' ,
                                "warna_isi_footer_$idTbl" => 'success' 
                            ] ;
                        }else{
                            $pesan = [
                                "pesan_isi_footer_$idTbl" => 'Data Gagal Di Hapus' ,
                                "warna_isi_footer_$idTbl" => 'danger' 
                            ] ;
                        }

                        $this->session->set_flashdata($pesan);
                        $this->footer($idTbl, $id, $idBatch);
                    }

                    public function ubah_tbl_footer($idTbl, $id, $idBatch, $id_isi_Footer)
                    {
                        $this->db->where('id_isi_tbl_footer', $id_isi_Footer);
                        if($this->db->update('isi_tbl_proses_footer',['isi_footer' => $this->input->post('namaFooter')]) ) {
                            $pesan = [
                                "pesan_isi_footer_$idTbl" => 'Data Berhasil Di Hapus' ,
                                "warna_isi_footer_$idTbl" => 'success' 
                            ] ;
                        }else{
                            $pesan = [
                                "pesan_isi_footer_$idTbl" => 'Data Gagal Di Hapus' ,
                                "warna_isi_footer_$idTbl" => 'danger' 
                            ] ;
                        }

                        $this->session->set_flashdata($pesan);
                        $this->footer($idTbl, $id, $idBatch);
                    }
                // footer
                
            //tabel


















            public function ceklis($hash, $idBatch)
            {
                $data['hash_isi_kolom'] = $hash;
                $data['idBatch'] = $idBatch;
                $data['ceklis'] = $this->Evaluasi_model->ceklis_pass($hash, $idBatch) ;
                $this->load->view('evaluasi/form/tabel/ceklis', $data);
            }

            public function tambah_ceklis($hash, $idBatch)
            {
                $query = [
                    'id_hash_isi_tbl_kolom' => $hash,
                    'idBatch' => $idBatch
                ] ;
                $this->db->insert('isi_tbl_kolom_ceklis', $query);

                $this->ceklis($hash, $idBatch);
            }

            public function hapus_ceklis($hash, $idBatch)
            {
                $this->db->where('id_hash_isi_tbl_kolom', $hash);
                $this->db->where('idBatch', $idBatch);
                $this->db->delete('isi_tbl_kolom_ceklis');

                $this->ceklis($hash, $idBatch);
            }

            public function simpanNoCeklis($id,$idBatch) 
            {
                if( $this->input->post('nomer_ceklis') != null) {
                    $query = [
                        'idBatch' => $idBatch,
                        'nomer_ceklis' => $this->input->post('nomer_ceklis')
                    ] ;

                    if($this->db->insert('hasil_evaluasi', $query)){
                        $pesan = [
                            'pesan_check' => 'Data Berhasil Disimpan',
                            'warna_check' => 'success'
                        ];
                    }else{
                        $pesan = [
                            'pesan_check' => 'Data Gagal Disimpan',
                            'warna_check' => 'danger'
                        ];
                    }

                    $this->session->set_flashdata($pesan);
                    $this->check($id,$idBatch);
                }else{
                    $pesan = [
                        'pesan_check' => 'Data Tidak Boleh Kosong',
                        'warna_check' => 'danger'
                    ];
                    $this->session->set_flashdata($pesan);
                    $this->check($id,$idBatch);
                }
            }

            public function ubahNoCeklis($id,$idBatch) 
            {
                if( $this->input->post('nomer_ceklis') != null) {
                    $query = [
                        'idBatch' => $idBatch,
                        'nomer_ceklis' => $this->input->post('nomer_ceklis')
                    ] ;
                    $this->db->where('id_hasil_evaluasi',$this->input->post('id'));
                    $this->db->set($query);
                    if($this->db->update('hasil_evaluasi')){
                        $pesan = [
                            'pesan_check' => 'Data Berhasil Di Ubah',
                            'warna_check' => 'success'
                        ];
                    }else{
                        $pesan = [
                            'pesan_check' => 'Data Gagal Di Ubah',
                            'warna_check' => 'danger'
                        ];
                    }

                    $this->session->set_flashdata($pesan);
                    $this->check($id,$idBatch);
                }else{
                    $pesan = [
                        'pesan_check' => 'Data Tidak Boleh Kosong',
                        'warna_check' => 'danger'
                    ];
                    $this->session->set_flashdata($pesan);
                    $this->check($id,$idBatch);
                }
            }

            public function check($id,$idBatch) 
            {
                $data['idBatch'] = $idBatch ;
                $data['id'] = $id ;
                $this->db->where('idBatch', $idBatch);
                $data['check'] = $this->db->get('hasil_evaluasi')->row_array();

                $this->load->view('evaluasi/form/tabel/check',$data);
            }
        // form

    }

?>