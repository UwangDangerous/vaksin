<?php //di akhiri dengan _ artinya revisian

    class Sample_ extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('User_Sample_model');
        }

        public function index($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'surat"> Riwayat Surat </a> / Informasi Sample'; 
            $data['id'] = $id ;
            $data['sample'] = $this->User_Sample_model->getDataSample($id);
            $this->load->model('_Date');
            if( $this->session->userdata('eksId') != null )
            {
                $this->load->view('temp/dsbHeader',$data);
                $this->load->view('sample_user/index');
                $this->load->view('temp/dsbFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                redirect('auth') ;
            }
        }

        // public function batch($idSurat, $idSample)
        // {
        //     $idLevel = $this->session->userdata('idLevel') ;
        //     $data['judul'] = 'Lengkapi Dokumen '. $this->session->userdata('namaLevel'); 
        //     $data['header'] = 'Lengkapi Dokumen'; 
        //     $data['bread'] = 'Dashboard / Riwayat Surat / <a href="'.base_url().'sample_/index/'.$idSurat.'">  Informasi Sample  </a> / Lengkapi Dokumen'; 
        //     // $data['id'] = $idSample ;
        //     $data['idSurat'] = $idSurat ;
        //     $data['sample'] = $this->User_Sample_model->getDataSampleBatch($idSample);
        //     $this->load->model('_Date');
        //     $data['batch'] = $this->User_Sample_model->getDataBatch($idSample) ;
        //     if( $this->session->userdata('eksId') != null )
        //     {
        //         $this->load->view('temp/dsbHeader',$data);
        //         $this->load->view('sample_user/batch');
        //         $this->load->view('temp/dsbFooter');
        //     }else{
        //         $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
        //         redirect('auth') ;
        //     }
        // }

        public function batch_add($idSurat, $idSample)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Lengkapi Dokumen '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Lengkapi Dokumen'; 
            $data['bread'] = 'Dashboard / Riwayat Surat / <a href="'.base_url().'sample_/index/'.$idSurat.'">  Informasi Sample  </a> / Lengkapi Dokumen'; 
            // $data['id'] = $idSample ;
            $data['idSurat'] = $idSurat ;
            $data['sample'] = $this->User_Sample_model->getDataSampleBatch($idSample);
            $this->load->model('_Date');
            $data['batch'] = $this->User_Sample_model->getDataBatch($idSample) ;
            if( $this->session->userdata('eksId') != null )
            {
                $this->load->view('temp/dsbHeader',$data);
                $this->load->view('sample_user/batch_add');
                $this->load->view('temp/dsbFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                redirect('auth') ;
            }
        }

        public function tambah($id)
        {
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'dsb / <a href="'.base_url().'sample_/index/'.$id.'"> Informasi Sample </a> / Data Sample '; 

            $data['id'] = $id ;

            // untuk combo box
            $data['jenisSample'] = $this->db->get('_jenisSample')->result_array();
            $data['jenisManufacture'] = $this->db->get('_jenisManufacture')->result_array();
            $data['jenisDokumen'] = $this->db->get('_jenisDokumen')->result_array();

            if( $this->session->userdata('eksId') != null)
            {

                $this->form_validation->set_rules('nama', 'Nama Surat / Keterangan', 'required');
                $this->form_validation->set_rules('js', 'Jenis Sampel', 'required');
                $this->form_validation->set_rules('jd', 'Jenis Dokumen', 'required');
                $this->form_validation->set_rules('noMA', 'Nomer MA', 'required|numeric');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dsbHeader',$data);
                    $this->load->view('sample_user/tambah');
                    $this->load->view('temp/dsbFooter');
                }else{
                    $this->User_Sample_model->addSample();
                }
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                redirect('auth') ;
            }
        }
            
        public function uploadDataDukung($id) 
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/data-dukung','pdf','sample_/index/'.$id, ''.$this->input->post('namaJenisDataDukung') );
            $query = [
                'idSample' => $this->input->post('idSample'),
                'idJenisDataDukung' => $this->input->post('idJenisDataDukung'),
                'fileDataDukung' => $upload
            ];

            if($this->db->insert('_dataDukung', $query) ) {
                $pesan = [
                    'pesan' => 'Data Dukung Berhasil Ditambahkan' ,
                    'warna' => 'success'
                ];

                $this->session->set_flashdata($pesan);
                redirect("sample_/index/$id") ;
            }else{
                $pesan = [
                    'pesan' => 'Data Dukung Gagal Ditambahkan' ,
                    'warna' => 'danger'
                ];

                $this->session->set_flashdata($pesan);
                redirect("sample_/index/$id") ;
            }
        }

        public function uploadBuktiBayar($id,$idSurat) 
        {
            date_default_timezone_set('Asia/Jakarta');
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/bukti-bayar','pdf|jpg|jpeg|png','sample_/index/'.$id,'buktibayar');
            $query = [
                'idSample' => $id,
                'tgl_bayar' => date('Y-m-d') ,
                'jam_bayar' => date('G:i:s') ,
                'fileBuktiBayar' => $upload
            ];

            if($this->db->insert('_buktibayar', $query) ) {
                $pesan = [
                    'pesan' => 'Bukti Bayar Berhasil Ditambahkan' ,
                    'warna' => 'success'
                ];

            }else{
                $pesan = [
                    'pesan' => 'Bukti Bayar Gagal Ditambahkan' ,
                    'warna' => 'danger'
                ];

            }

            $this->session->set_flashdata($pesan);
            redirect("sample_/index/$idSurat") ;
        }

        public function tambahImportir($idSurat)
        {
            $query = [
                'idSample' => $this->input->post('idSample'),
                'namaImportir' => $this->input->post('namaImportir'),
                'alamatImportir' => $this->input->post('alamatImportir')
            ] ;

            if( $this->db->insert('_importir', $query) ){
                $pesan = [
                    'pesanImportir' => 'Data Berhasil Di Simpan' ,
                    'warnaImportir' => 'success'
                ] ;
            }else{
                $pesan = [
                    'pesanImportir' => 'Data Gagal Di Simpan' ,
                    'warnaImportir' => 'danger'
                ] ;
            }

            $this->session->set_flashdata( $pesan );
            redirect("sample_/batch_add/$idSurat/".$this->input->post('idSample') );

            
        }

        public function tambahBatch($idSurat,$idSample)
        {
            $query = [
                'idSample' => $idSample,
                'noBatch' => $this->input->post('batch'),
                'dosis' => $this->input->post('Dosis'),
                'vial' => $this->input->post('jmlvial')
            ] ;
            // var_dump($query) ;

            if( $this->db->insert('sample_batch', $query) ){
                $pesan = [
                    'pesanImportir' => 'Data Berhasil Di Simpan' ,
                    'warnaImportir' => 'success'
                ] ;
            }else{
                $pesan = [
                    'pesanImportir' => 'Data Gagal Di Simpan' ,
                    'warnaImportir' => 'danger'
                ] ;
            }

            $this->session->set_flashdata( $pesan );
            redirect("sample_/batch_add/$idSurat/$idSample");

            
        }

        // public function tambahBatch($idSurat,$idSample)
        // {
        //     $jmlVial = $this->input->post('jmlvial');
        //     $vials = '' ;
        //     for ($i = 1; $i <= $jmlVial; $i++) {
        //         $vials .= $this->input->post("vial$i").',';
        //     }

        //     $vials = rtrim($vials, ',') ;

        //     $query = [
        //         'idSample' => $idSample,
        //         'noBatch' => $this->input->post('batch'),
        //         'dosis' => $this->input->post('Dosis'),
        //         'vial' => $vials 
        //     ] ;
        //     // var_dump($query) ;

        //     if( $this->db->insert('sample_batch', $query) ){
        //         $pesan = [
        //             'pesanImportir' => 'Data Berhasil Di Simpan' ,
        //             'warnaImportir' => 'success'
        //         ] ;
        //     }else{
        //         $pesan = [
        //             'pesanImportir' => 'Data Gagal Di Simpan' ,
        //             'warnaImportir' => 'danger'
        //         ] ;
        //     }

        //     $this->session->set_flashdata( $pesan );
        //     redirect("sample_/batch/$idSurat/$idSample");

            
        // }

        public function ubahDataBatch($idSurat,$idSample)
        {
            $idBatch = $this->input->post('idBatch');
            $jmlVial = $this->input->post("jmlvialEdit$idBatch");
            $jmlVialAwal = $this->input->post("jml$idBatch");

            $vialAwal = '' ;

            $query = [
                'idSample' => $idSample,
                'noBatch' => $this->input->post("batchEdit$idBatch"),
                'dosis' => $this->input->post("DosisEdit$idBatch"),
                'vial' => $this->input->post("vial$idBatch")
            ] ;

            $this->db->where('idBatch', $idBatch);
            if( $this->db->update('sample_batch', $query) ){
                $pesan = [
                    'pesanImportir' => 'Data Berhasil Di Ubah' ,
                    'warnaImportir' => 'success'
                ] ;
            }else{
                $pesan = [
                    'pesanImportir' => 'Data Gagal Di Ubah' ,
                    'warnaImportir' => 'danger'
                ] ;
            }

            $this->session->set_flashdata( $pesan );
            redirect("sample_/batch_add/$idSurat/$idSample");

            
        }

        public function uploadDataDukungBatch($idSurat,$idSample) 
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser("berkas",'assets/file-upload/data-dukung','pdf','sample_/batch_add/'.$idSurat.'/'.$idSample, $this->input->post('namaJenisDataDukung').'_batch');
            $query = [
                'idBatch' => $this->input->post('idBatch') ,
                'idJenisDataDukung' => $this->input->post('idJenisDataDukung') ,
                'fileDataDukung' =>  $upload
            ];

            // var_dump($query) ;
            if($this->db->insert('_datadukung_batch', $query)) {
                $pesan = [
                    'pesan' =>  $this->input->post('namaJenisDataDukung').' Berhasil di Upload',
                    'warna' => 'success'
                ] ;
            }else{
                $pesan = [
                    'pesan' => 'Gagal Upload',
                    'warna' => 'danger'
                ] ;
            }

            $this->session->set_flashdata($pesan);
            redirect("sample_/batch_add/$idSurat/$idSample") ;

        }


        public function hapus($idSurat,$id) {
            $this->db->where('idSample', $id);
            $this->db->join('_sample', '_surat.idSurat = _sample.idSurat');
            $this->db->select('idEU, idJenisManufacture');
            $auth = $this->db->get('_surat')->row_array();

            if($auth['idEU'] != $this->session->userdata('eksId') ){
                $pesan = [
                    'pesan' => 'bukan data anda' ,
                    'warna' => 'danger'
                ] ;
            }else{
                $this->db->where('idSample', $id);
                $this->db->select('idBatch');
                $batch = $this->db->get('sample_batch')->row_array()['idBatch'];

            if($this->User_Sample_model->getInfoPetugas($id) != 0) {
                    $pesan = [
                        'pesan' => 'Sedang Proses Pengerjaan' ,
                        'warna' => 'danger'
                    ] ;
                }else{
                    $this->db->where('idBatch', $batch);
                    $dataDukung = $this->db->get('_datadukung_batch')->result_array();
                    foreach($dataDukung as $dd) {
                        $link = './assets/file-upload/data-dukung/'.$dd['fileDataDukung'] ;
                        unlink($link) ;
                    }
                    $this->db->where('idSample', $id);
                    if($this->db->delete('_sample')) {
                        
                        

                        //hapus sample_batch 1
                        $this->db->where('idSample', $id);
                        $this->db->delete('sample_batch');
                        
                        //hapus _dataDukung_batch 1.1
                        $this->db->where('idBatch', $batch);
                        $this->db->delete('_datadukung_batch');

                        //hapus bukti bayar 2
                        $this->db->where('idSample', $id);
                        $this->db->delete('_buktibayar');
                        
                        //hapus importir 3
                        if($auth['idJenisManufacture'] == 2 ) {
                            $this->db->where('idSample', $id);
                            $this->db->delete('_importir');
                        }

                        $pesan = [
                            'pesan' => 'Data Berhasil Di Hapus' ,
                            'warna' => 'success'
                        ] ;
                    }else{
                        $pesan = [
                            'pesan' => 'Data Gagal Di Hapus' ,
                            'warna' => 'danger'
                        ] ;
                    }

                }
            }
            
            $this->session->set_flashdata($pesan);
            redirect("sample_/index/$idSurat/$id") ;
        }

        public function editDataSample($idSurat) 
        {
            $id = $this->input->post('id');
            $jp = explode('|', $this->input->post('jd')) ;
 
            $query = [
                'namaSample' => $this->input->post('nama'),
                'idJenisSample' => $this->input->post('js'),
                'idJenisDokumen' => $jp[1],
                'idJenisManufacture' => $this->input->post('jp'),
                'noMA' => $this->input->post('noMA'),
                'tgl_pengiriman' => $this->input->post('tanggal')
            ] ;

            var_dump($query) ;

            $this->db->where('idSample', $id);
            if($this->db->update('_sample', $query)) {
                $pesan = [
                    'pesan' => 'Data Berhasil Di Ubah',
                    'warna' => 'success' 
                ] ;
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Ubah',
                    'warna' => 'danger' 
                ] ;
            }

            $this->session->set_flashdata($pesan);
            redirect("sample_/index/$idSurat/$id") ;
        }














        public function cobaTampil($id) 
        {
            $this->load->model('_Date');
            $data['id'] = $id ;

            $this->db->where('idSample', $id);
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->select('tgl_pengiriman,tgl_kirim_surat');
            $tgl = $this->db->get('_sample')->row_array();
            $data['tgl_pengiriman'] = $tgl['tgl_pengiriman'] ;
            $data['tgl_kirim_surat'] = $tgl['tgl_kirim_surat'] ;
            
            $this->load->view('sample_user/js/cobaTampil',$data) ;
        }























































        // form
            public function form($id, $idSurat, $idSample) //$id = $idJenisSample
            {
                $data['judul'] = 'Lengkapi Data '. $this->session->userdata('namaLevel'); 
                $data['header'] = 'Lengkapi Data'; 
                $data['bread'] = 'Dashboard / Riwayat Surat / <a href="'.base_url().'sample_/index/'.$idSurat.'">  Informasi Sample </a> / Lengkapi Dokumen '; 

                $data['id'] = $id ;
                $data['idSample'] = $idSample ;

                $data['tabelProses'] = $this->User_Sample_model->getDataForTabel($id) ;
                
                if( $this->session->userdata('eksId') != null )
                {
                    $this->load->view('temp/dsbHeader',$data);
                    $this->load->view('sample_user/form/index');
                    $this->load->view('temp/dsbFooter');
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
                    $data['general_informasi'] = $this->User_Sample_model->getDataForGI($id);
                    $this->load->view('sample_user/form/general_informasi', $data) ;
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
                    $data['tabelProses'] = $this->User_Sample_model->getDataForTabel($id);
                    $this->load->view('sample_user/form/tabel', $data) ;
                }

                // header
                    public function header($idTbl, $id, $idSample) //id tabel proses , id jenis sample, idsample
                    {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idSample'] = $idSample ;
                        $data['header'] =$this->User_Sample_model->getDataForTabelHeader($idTbl) ;
                        $this->load->view('sample_user/form/tabel/header', $data);
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
                        $data['kolom'] =$this->User_Sample_model->getDataForTabelKolom($idTbl) ;
                        $this->load->view('sample_user/form/tabel/kolom', $data);  
                    }

                    public function isi_kolom($idTbl, $id, $idSample) {
                        $data['id'] = $id ;
                        $data['idTbl'] = $idTbl ;
                        $data['idSample'] = $idSample ;
                        $data['kolom'] =$this->User_Sample_model->getDataForTabelKolom($idTbl) ;
                        $this->load->view('sample_user/form/tabel/isi_kolom',$data);
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
                            echo $Arr ;
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
                        $data['footer'] =$this->User_Sample_model->getDataForTabelFooter($idTbl) ;
                        $this->load->view('sample_user/form/tabel/footer', $data);
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


        // form
    }

?>