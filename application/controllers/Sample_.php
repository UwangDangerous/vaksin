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
                'jam_bayar' => date('h:i:s') ,
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
            redirect("sample_/batch/$idSurat/".$this->input->post('idSample') );

            
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
            redirect("sample_/batch/$idSurat/$idSample");

            
        }

        public function uploadDataDukungBatch($idSurat,$idSample) 
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser("berkas",'assets/file-upload/data-dukung','pdf','sample_/batch/'.$idSurat.'/'.$idSample, $this->input->post('namaJenisDataDukung').'_batch');
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
            redirect("sample_/batch/$idSurat/$idSample") ;

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
    }

?>