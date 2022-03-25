<?php 

class Petugas extends CI_Controller{
    public function __construct() 
    {
        parent::__construct() ;
        $this->load->library('form_validation');
        $this->load->model('Petugas_model');
        $this->load->model('User_Sample_model');
        $this->load->model('Cetak_model');
        $this->load->model('_Riwayat') ;
    }

    public function index($id=null)
    {
        if($this->input->post('cariByDokumen')) {
            $cari = $this->input->post('cariJenisDok');
        }else{
            $cari = '' ;
        }

        if($id == 0) {
            $id = null ;
        }
        $this->load->model('_Date');
        $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Data Sampel'; 
        $data['bread'] = 'Dashboard / <a href="'.base_url().'sample"> Penerimaan Surat </a> / Sampel'; 
        $data['sample'] = $this->Petugas_model->getSample($id,$cari);
        if( ($this->session->userdata('key') != null) )
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('petugas/index',$data);
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function detail($idSurat,$idSampe,$id)
    {
        $this->load->model('_Date');
        
        $this->db->join('_sample','_sample.idSample = sample_batch.idSample');
        $this->db->select('namaSample, noBatch');
        $judulBatch = $this->db->get_where('sample_batch',['idBatch' => $id])->row_array();
        // $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Rincian Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = "Data Sampel <br>  
                        <h5>". $judulBatch['namaSample']. " No Batch ". $judulBatch['noBatch'] ." </h5>"; 
        $data['bread'] = 'Dashboard / <a href="'.base_url().'petugas/index/'.$idSurat.'"> Sampel </a> / Rincian Sampel'; 
        
        
        $data['batch'] = $this->Petugas_model->getDetailBatch($id);
        $data['jenisDokumen'] = $this->db->get('_jenisDokumen')->result_array() ;

        $data['id'] = $id ;
        // $data['idSample'] = $idSample ;
        $data['satuan'] = ['C','F','K','R'] ;
        if( ($this->session->userdata('key') != null) )
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('petugas/detail');
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }


    public function ubahIdProsesSample($id,$idSurat)
    {
        // echo $this->input->post('cmbProses');
        $this->db->where('idSample',$id); 
        if($this->db->update('_sample', [ 'idProses' => $this->input->post('cmbProses') ] ) ) {
            $pesan = [
                'pesan' => 'Data Berhasil Disimpan' ,
                'warna' => 'success'
            ];
        }else{
            $pesan = [
                'pesan' => 'Data Gagal Disimpan' ,
                'warna' => 'danger'
            ];
        }
        $this->session->set_flashdata('pesan');
        redirect("petugas/index/$idSurat/$id") ;
    }




    

    public function tambahSertifikat($idSurat,$idSample)
    {
        $query = [
            'noSertifikat' => $this->input->post('noSertifikat') ,
            'id_hasil_evaluasi' => $this->input->post('id_hasil_evaluasi') ,
            'tgl_realese' => $this->input->post('tgl_realese') 
        ];

        if( $this->db->insert('sertifikat', $query) ) {

            $pesan = [
                'pesan' => 'Data Berhasil DiSimpan' ,
                'warna' => 'success',
            ];

        }else{
            $pesan = [
                'pesan' => 'Data Gagal DiSimpan' ,
                'warna' => 'danger'
            ];
        }

        $this->session->set_flashdata($pesan) ;
        redirect("petugas/detail/$idSurat/$idSample") ;
    }

    public function ubahSertifikat($idSurat,$idSample)
    {
        $query = [
            'noSertifikat' => $this->input->post('noSertifikat') ,
            'id_hasil_evaluasi' => $this->input->post('id_hasil_evaluasi') ,
            'tgl_realese' => $this->input->post('tgl_realese') 
        ];

        $this->db->where('idSertifikat', $this->input->post('idSertifikat')) ;
        $this->db->set($query) ;
        if( $this->db->update('sertifikat') ) {

            $pesan = [
                'pesan' => 'Data Berhasil Ubah' ,
                'warna' => 'success',
            ];

        }else{
            $pesan = [
                'pesan' => 'Data Gagal Ubah' ,
                'warna' => 'danger'
            ];
        }

        $this->session->set_flashdata($pesan) ;
        redirect("petugas/detail/$idSurat/$idSample") ;
    }













    public function tambahVerifikasiBerkas($idSurat, $idSample, $id) 
    {
        // echo $this->input->post('file-very'); die
        date_default_timezone_set('Asia/Jakarta');
        $status = $this->input->post('status-very') ;
        $query = [
            'idBatch' => $id ,
            'tglVB' => date('Y-m-d'),
            'jamVB' => date("G:i:s"),
            'statusVB' => $status
        ];
        // jika ditolak
            if($this->db->insert('verifikasi_berkas', $query)) {
                if($status == 2) {
                    $this->_Riwayat->simpanRiwayat($id, 'Data dukung tidak sesuai silahkan lengkapi', 'Data Dukung', 1) ; 
                    $berkas = '' ;
                    if($this->input->post('file_pengirim')) {
                        $this->load->model('_Upload');
                        $file = $this->_Upload->uploadEksUser('file_pengirim',
                            'assets/file-upload/respon',
                            'pdf|jpg|png|jpeg',
                            "petugas/detail/$idSurat/$idSample/$id", 
                            'Respon_Tanggapan' 
                        );
                    }

                    $query_respon = [
                        'idBatch' => $id ,
                        'pesan_pengirim' => $this->input->post('keterangan-very'),
                        'tgl_respon_pengirim' => date('Y-m-d'),
                        'jam_respon_pengirim' => date('G:i:s'),
                        'tipe_pesan' => $this->input->post('tipe_pesan'),
                        'file_pengirim' => $berkas,
                        'status_pengirim' => 0
                    ];
                    $this->db->insert('_z_respon_tanggapan', $query_respon) ;
                }else{
                    $this->_Riwayat->simpanRiwayat($id, 'Data dukung sesuai','Data Dukung', 1) ; 
                }

                $pesan = [
                    'pesan' => 'Verifikasi Kelengkapan Dokumen Berhasil Disimpan',
                    'warna' => 'success'
                ] ;
            }else{
                $pesan = [
                    'pesan' => 'Verifikasi Kelengkapan Dokumen Gagal Disimpan',
                    'warna' => 'danger'
                ] ;
            }
        // jika ditolak

        $this->session->set_flashdata($pesan);
        redirect("petugas/detail/$idSurat/$idSample/$id") ;
    }

    public function uploadBiling($idSurat, $idSample, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('_Upload');
        $file = $this->_Upload->uploadEksUser('berkas-biling',
            'assets/file-upload/biling/file-biling',
            'pdf|jpg|png|jpeg',
            "petugas/detail/$idSurat/$idSample/$id", 
            'biling_pembayaran' 
        );
        $query = [
            'idBatch' => $id ,
            'kode_biling' => $file ,
            'tgl_kode_biling' => date('Y-m-d'),
            'jam_kode_biling' => date('G:i:s') ,
            'tgl_bayar' => '0000-00-00',
            'jam_bayar' => '00:00:00',
            'fileBuktiBayar' => '' ,
            'tgl_verifikasi_pembayaran' => '0000-00-00',
            'jam_verifikasi_bayar' => '00:00:00',
            'status_verifikasi_bayar' => 3
        ] ;

        if($this->db->insert('_bukti_bayar', $query)) {
            $this->_Riwayat->simpanRiwayat($id, "Mengirim Kode Biling", 'Pembayaran',1) ;
            
            $pesan = [
                'pesan' => 'Kode Biling Berhasil Disimpan' ,
                'warna' => 'success'
            ];
        }else{
            $pesan = [
            'pesan' => 'Kode Biling Berhasil Disimpan' ,
            'warna' => 'success'
            ];
        }

        $this->session->set_flashdata($pesan) ;
        redirect("petugas/detail/$idSurat/$idSample/$id") ;
    }

    public function hapusBuktiBayar($idSurat, $idSample, $id, $idBukti)
    {
        $this->db->where('idBuktiBayar', $idBukti) ;
        if($this->db->delete('_bukti_bayar')) {
            $pesan = [
                'pesan' => 'Bukti Bayar Berhasil DI Hapus',
                'warna' => 'success'
            ] ;
        }else{
            $pesan = [
                'pesan' => 'Bukti Bayar Gagal DI Hapus',
                'warna' => 'danger'
            ] ;
        }

        $this->session->set_flashdata($pesan) ;
        redirect("petugas/detail/$idSurat/$idSample/$id") ;
    }

    public function tambahVerifikasiPembayaran($idSurat, $idSample, $id, $idBukti, $status)
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = [
            'tgl_verifikasi_pembayaran' => date('Y-m-d') ,
            'jam_verifikasi_bayar' => date('G:i:s') ,
            'status_verifikasi_bayar' => $status
        ] ;
        // var_dump($query) ; die ;
        $this->db->set($query);
        $this->db->where('idBuktiBayar', $idBukti);
        if($this->db->update("_bukti_bayar")) {
            if($status == 1){
                $this->_Riwayat->simpanRiwayat($id, 'Konfirmasi Pembayaran Diterima', 'Pembayaran', 1);
            }else{
                $this->_Riwayat->simpanRiwayat($id, $this->input->post('keterangan-pembayaran-tolak', 'Pembayaran', 1));
                $this->_Riwayat->responTanggapan($id,
                    $this->input->post('keterangan-pembayaran-tolak'),
                    $this->input->post('tipe_pesan'),
                    0) ;
                
            }
            $pesan = [
                'pesan' => 'Verifikasi Pembayaran Berhasil Disimpan',
                'warna' => 'success'
            ] ; 
        }else{
            $pesan = [
                'pesan' => 'Verifikasi Pembayaran Berhasil Disimpan',
                'warna' => 'success'
            ] ; 
        }

        $this->session->set_flashdata($pesan);
        redirect("petugas/detail/$idSurat/$idSample/$id") ;
    }

    // petugas
        public function tambahPetugas($idSurat, $idSample,$id, $tugas)  //tambahPetugasEvaluator
        //3 evaluator
        //4 verifikator
        //5 penguji
        {
            if($tugas == 3) {
                $petugas = 'Evaluator' ;
            }elseif($tugas == 4){
                $petugas = 'Verifikator' ;
            }else{
                $petugas = 'Penguji' ;
            }
            if($this->input->post('petugas'.$tugas) == '-') {
                $pesan = [
                    'pesan' => 'Gagal Ditambah - Silahkan Pilih Petugas',
                    'warna' => 'danger'
                ];
                $this->session->set_flashdata($pesan) ;
                redirect("petugas/detail/$idSurat/$idSample/$id") ;
            }

            $query = [
                'idBatch' => $id,
                'idIU' => $this->input->post('petugas'.$tugas),
                'idLevel' => $tugas
            ] ;

            // var_dump($query) ;
            if($this->db->insert('petugas', $query)) {
                $this->_Riwayat->simpanRiwayat($id, "Petugas $petugas Ditambahkan" , 'Petugas', 1) ;
                $pesan = [
                    'pesan' => 'Petugas '.$petugas.' Berhasil Ditambah',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Petugas '.$petugas.' Gagal Ditambah',
                    'warna' => 'danger'
                ];
            }
            $this->session->set_flashdata($pesan) ;
            redirect("petugas/detail/$idSurat/$idSample/$id") ;
        }

        public function ubahPetugas($idSurat, $idSample,$id,$tugas,$idPetugas) 
        {
            if($tugas == 3) {
                $petugas = 'Evaluator' ;
            }elseif($tugas == 4){
                $petugas = 'Verifikator' ;
            }else{
                $petugas = 'Penguji' ;
            }
            if($this->input->post('petugas'.$tugas) == '-') {
                $pesan = [
                    'pesan' => 'Gagal Diubah - Silahkan Pilih Petugas',
                    'warna' => 'danger'
                ];
                $this->session->set_flashdata($pesan) ;
                redirect("petugas/detail/$idSurat/$idSample/$id") ;
            }
            
            // var_dump($query) ;
            $this->db->where('idPetugas', $idPetugas) ;
            $this->db->set( ['idIU' => $this->input->post('petugas'.$tugas)] ) ;
            if($this->db->update('petugas')) {
                $this->_Riwayat->simpanRiwayat($id, "Petugas $petugas Diubah", 'Petugas', 2) ;
                $pesan = [
                    'pesan' => "Petugas $petugas Berhasil DiUbah",
                    "warna" => "success"
                ];
            }else{
                $pesan = [
                    "pesan" => "Petugas $petugas Gagal DiUbah",
                    "warna" => "danger"
                ];
            }
            
            $this->session->set_flashdata($pesan) ;
            redirect("petugas/detail/$idSurat/$idSample/$id") ;
        }

        public function tambahVerifikasiSample($idSurat, $idSample, $id)
        {
            $query = [
                'idBatch' => $id,
                'suhu_sample' => $this->input->post('suhu_sample'),
                'satuan_suhu' => $this->input->post('satuan_suhu'),
                'satuan_suhu' => $this->input->post('satuan_suhu'),
                'jumlah_sample' => $this->input->post('jumlah_sample'),
                'tgl_verifikasi_sample' => date('Y-m-d'),
                'jam_verifikasi_sample' => date('G:i:s'),
                'status_verifikasi_sample' => 1
            ];

            if($this->db->insert('verifikasi_sample_batch', $query)) {
                $pesan = [
                    'pesan' => 'data berhasil disimpan' ,
                    'warna' => 'success'
                ];
                $this->_Riwayat->simpanRiwayat($id, 'Sampel Untuk Pengujian Sesuai', 'Sampel Pengujian', 1) ;
            }else{
                $pesan = [
                    'pesan' => 'data gagal disimpan' ,
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("petugas/detail/$idSurat/$idSample/$id") ;
        }

        public function tambahVerifikasiSampleSalah($idSurat, $idSample, $id)
        {
            $query = [
                'idBatch' => $id,
                'suhu_sample' => $this->input->post('suhu_sample'),
                'satuan_suhu' => $this->input->post('satuan_suhu'),
                'satuan_suhu' => $this->input->post('satuan_suhu'),
                'jumlah_sample' => $this->input->post('jumlah_sample'),
                'tgl_verifikasi_sample' => date('Y-m-d'),
                'jam_verifikasi_sample' => date('G:i:s'),
                'status_verifikasi_sample' => 2
            ];

            if($this->db->insert('verifikasi_sample_batch', $query)) {
                $this->_Riwayat->simpanRiwayat($id, 'Sampel Untuk Pengujian Tidak Sesuai', 'Sampel Pengujian', 1) ;
                $berkas = '' ;
                if($this->input->post('file_pengirim')) {
                    $this->load->model('_Upload');
                    $file = $this->_Upload->uploadEksUser('file_pengirim',
                        'assets/file-upload/respon',
                        'pdf|jpg|png|jpeg',
                        "petugas/detail/$idSurat/$idSample/$id", 
                        'Respon_Tanggapan' 
                    );
                }

                $query_respon = [
                    'idBatch' => $id ,
                    'pesan_pengirim' => $this->input->post('pesan_pengirim'),
                    'tgl_respon_pengirim' => date('Y-m-d'),
                    'jam_respon_pengirim' => date('G:i:s'),
                    'tipe_pesan' => $this->input->post('tipe_pesan'),
                    'file_pengirim' => $berkas,
                    'status_pengirim' => 0
                ];
                if($this->db->insert('_z_respon_tanggapan', $query_respon)){
                    $pesan = [
                        'pesan' => 'data berhasil disimpan' ,
                        'warna' => 'success'
                    ];
                }else{
                    $pesan = [
                        'pesan' => 'data gagal disimpan' ,
                        'warna' => 'danger'
                    ];
                }
            }else{
                $pesan = [
                    'pesan' => 'data gagal disimpan' ,
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("petugas/detail/$idSurat/$idSample/$id") ;
        }
    //petugas
}

?>