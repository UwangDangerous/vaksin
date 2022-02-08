<?php 

    class Evaluasi extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Evaluasi_model');
            // $this->load->model('User_Sample_model');
        }

        public function index()
        {
            $this->load->model('_Date');
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Evaluasi'; 
            $data['sample'] = $this->Evaluasi_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('evaluasi/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambahEvaluasi($id)
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/hasil-evaluasi','pdf','evaluasi','hasil-evaluasi');
            // $namaBerkas, $path, $type,$redirect,$namaTambahan = ''

            $query = [
                'idSample' => $id,
                'hasilEvaluasi' => $upload
            ];
            $queryRiwayat = [
                'idSample' => $id,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Di Evaluasi Oleh '. $this->session->userdata('nama')
            ];

            if($this->db->insert('evaluasi', $query)){
                if($this->db->insert('riwayatPekerjaan', $queryRiwayat)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Tambah',
                        'warna' => 'success' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Tambah',
                        'warna' => 'danger' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("evaluasi") ;
            }
        }


        public function pesanEvaluasi($id)
        {
            $query = [
                'idSample' => $id,
                'clock_off' => date('Y-m-d'),
                'judul' => $this->input->post('judul'),
                'keterangan' => $this->input->post('isi'),
                'clock_on' => '0000-00-00'
            ];
            $queryRiwayat = [
                'idSample' => $id,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Clock off '.$this->input->post('judul').' | Oleh ' . $this->session->userdata('nama'). ' (Evaluasi)'
            ];

            if($this->db->insert('clockoff', $query)){
                if($this->db->insert('riwayatPekerjaan', $queryRiwayat)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Tambah',
                        'warna' => 'success' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Tambah',
                        'warna' => 'danger' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("evaluasi") ;
            }
        }





























        // form
            public function form($id, $idSurat, $idSample) //$id = $idJenisSample
            {
                $data['judul'] = 'Lengkapi Data '. $this->session->userdata('namaLevel'); 
                $data['header'] = 'Lengkapi Data'; 
                $data['bread'] = 'Dashboard / Riwayat Surat / <a href="'.base_url().'sample_/index/'.$idSurat.'">  Informasi Sample </a> / Lengkapi Dokumen '; 

                $data['id'] = $id ;
                $data['idSample'] = $idSample ;

                $data['tabelProses'] = $this->Evaluasi_model->getDataForTabel($id) ;
                
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
                public function general_informasi($id, $idSample) 
                {
                    $data['id'] = $id ;
                    $data['idSample'] = $idSample ;
                    $data['general_informasi'] = $this->Evaluasi_model->getDataForGI($id);
                    $this->load->view('evaluasi/form/general_informasi', $data) ;
                }

                public function tambah_gi($id, $idSample) 
                {
                    if($this->input->post('isi_gi') == '') {
                        $pesan = [
                            'pesan_isi' => 'Form Tidak Boleh Kosong' ,
                            'warna_isi' =>'danger'
                        ];
                    }else{
                        $query = [
                            'idSample' => $idSample,
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
                    $this->general_informasi($id, $idSample) ;
                }

                public function ubah_gi($id, $idSample) 
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
                    $this->general_informasi($id, $idSample) ;
                }

                public function hapus_gi($id, $idSample, $idIsi)
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
                    $this->general_informasi($id, $idSample) ;
                }
            // general informasi








            //tabel 
                public function tabel($id, $idSample)
                {
                    $data['id'] = $id ;
                    $data['idSample'] = $idSample ;
                    $data['tabelProses'] = $this->Evaluasi_model->getDataForTabel($id);
                    $this->load->view('evaluasi/form/tabel', $data) ;
                }

                // header
                    public function header($idTbl, $id, $idSample) //id tabel proses , id jenis sample, idsample
                    {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idSample'] = $idSample ;
                        $data['header'] =$this->Evaluasi_model->getDataForTabelHeader($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/header', $data);
                    }

                    public function tambah_tbl_header($idTbl, $id, $idSample)
                    {
                        $query = [
                            'idSample' => $idSample,
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
                        $this->header($idTbl, $id, $idSample);
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
                    public function kolom($idTbl, $id, $idSample) 
                    {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idSample'] = $idSample ;
                        $data['kolom'] =$this->Evaluasi_model->getDataForTabelKolom($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/kolom', $data);  
                    }

                    public function isi_kolom($idTbl, $id, $idSample) {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idSample'] = $idSample ;
                        $data['kolom'] =$this->Evaluasi_model->getDataForTabelKolom($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/isi_kolom',$data);
                    }

                    public function tambahIsiKolom($idTbl, $id, $idSample) 
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
                                'idSample' => $idSample,
                                'isi_kolom' => $isi
                            ] ;

                            $this->db->insert('isi_tbl_kolom', $query);
                        }

                        $pesan = [
                            'pesan_kolom'.$idTbl => 'Data Berhasil DiSimpan' ,
                            'warna_kolom'.$idTbl => 'success'
                        ];
                        $this->session->set_flashdata($pesan);
                        $this->isi_kolom($idTbl, $id, $idSample);
                    }

                    public function ubahIsiKolom($idTbl, $id, $idSample,$idKolom) 
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
                        $this->isi_kolom($idTbl, $id, $idSample);
                        // echo 'ok' ;
                    }

                    public function hapusIsiKolom($idTbl, $id, $idSample,$ArrayIDK) 
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
                        $this->isi_kolom($idTbl, $id, $idSample);
                    }

                // kolom


                // footer
                    public function footer($idTbl, $id, $idSample)
                    {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idSample'] = $idSample ;
                        $data['footer'] =$this->Evaluasi_model->getDataForTabelFooter($idTbl) ;
                        $this->load->view('evaluasi/form/tabel/footer', $data);
                    }

                    public function tambah_tbl_footer($idTbl, $id, $idSample)
                    {
                        $query = [
                            'idSample' => $idSample,
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
                        $this->footer($idTbl, $id, $idSample);
                    }

                    public function hapus_tbl_footer($idTbl, $id, $idSample, $id_isi_Footer)
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
                        $this->footer($idTbl, $id, $idSample);
                    }

                    public function ubah_tbl_footer($idTbl, $id, $idSample, $id_isi_Footer)
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
                        $this->footer($idTbl, $id, $idSample);
                    }
                // footer
                
            //tabel


















            public function ceklis($hash, $idSample)
            {
                $data['hash_isi_kolom'] = $hash;
                $data['idSample'] = $idSample;
                $data['ceklis'] = $this->Evaluasi_model->ceklis_pass($hash, $idSample) ;
                $this->load->view('evaluasi/form/tabel/ceklis', $data);
            }

            public function tambah_ceklis($hash, $idSample)
            {
                $query = [
                    'id_hash_isi_tbl_kolom' => $hash,
                    'idSample' => $idSample
                ] ;
                $this->db->insert('isi_tbl_kolom_ceklis', $query);

                $this->ceklis($hash, $idSample);
            }

            public function hapus_ceklis($hash, $idSample)
            {
                $this->db->where('id_hash_isi_tbl_kolom', $hash);
                $this->db->where('idSample', $idSample);
                $this->db->delete('isi_tbl_kolom_ceklis');

                $this->ceklis($hash, $idSample);
            }

            public function simpanNoCeklis($id,$idSample) 
            {
                if( $this->input->post('nomer_ceklis') != null) {
                    $query = [
                        'idSample' => $idSample,
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
                    $this->check($id,$idSample);
                }else{
                    $pesan = [
                        'pesan_check' => 'Data Tidak Boleh Kosong',
                        'warna_check' => 'danger'
                    ];
                    $this->session->set_flashdata($pesan);
                    $this->check($id,$idSample);
                }
            }

            public function ubahNoCeklis($id,$idSample) 
            {
                if( $this->input->post('nomer_ceklis') != null) {
                    $query = [
                        'idSample' => $idSample,
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
                    $this->check($id,$idSample);
                }else{
                    $pesan = [
                        'pesan_check' => 'Data Tidak Boleh Kosong',
                        'warna_check' => 'danger'
                    ];
                    $this->session->set_flashdata($pesan);
                    $this->check($id,$idSample);
                }
            }

            public function check($id,$idSample) 
            {
                $data['idSample'] = $idSample ;
                $data['id'] = $id ;
                $this->db->where('idSample', $idSample);
                $data['check'] = $this->db->get('hasil_evaluasi')->row_array();

                $this->load->view('evaluasi/form/tabel/check',$data);
            }
        // form

    }

?>