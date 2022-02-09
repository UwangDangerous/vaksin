<?php 

    class Sample extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Sample_model');
        }

        public function index()
        {
            $this->load->model('_Date');
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Penerimaan Surat'; 
            $data['sample'] = $this->Sample_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sample/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambah($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'sample"> Penerimaan Surat </a> / Data Sample '; 
            // $data['sample'] = $this->Sample_model->getDataSample();

            
            $surat =  $this->Sample_model->judul($id);

            $data['judulSurat'] = $surat['keterangan'];
            $data['pengirim'] = $surat['namaEU'];
            $data['id'] = $id ;

            $data['sample'] =  $this->Sample_model->getSample($id);

            if( $this->session->userdata('key') != null)
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sample/tambah');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambahSample($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'Dashboard / Penerimaan Surat /<a href="'.base_url().'sample/tambah/'.$id.'"> Data Sample </a> / Tambah Sample '; 
            $data['sample'] = $this->Sample_model->getDataSample();
            $data['jenisSample'] = $this->db->get('jenisSample')->result_array();
            
            $surat =  $this->Sample_model->judul($id);

            $data['judulSurat'] = $surat['keterangan'];
            $data['pengirim'] = $surat['namaEU'];
            $data['id'] = $id ;

            $data['sample'] =  $this->Sample_model->getSample($id);

            if( $this->session->userdata('key') != null )
            {
                $this->form_validation->set_rules('nama', 'Nama Surat / Keterangan', 'required');
                $this->form_validation->set_rules('js', 'Jenis Sampel', 'required');
                $this->form_validation->set_rules('vial', 'Vial', 'required');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('sample/tambahSample',$data);
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->Sample_model->addSample($id);
                }
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function cetak($id) 
        {
            $data['id'] = $id ;
            $this->load->view('sample/cetak', $data);
        }

        public function buktiBayar() 
        {
            $this->load->model('_Date');
            $data['judul'] = 'Bukti Bayar '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Bukti Bayar'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Bukti Bayar'; 
            $data['buktiBayar'] = $this->Sample_model->getBuktiBayar();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sample/buktiBayar');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Login Kembali');
                redirect('auth') ;
            }
        }

        public function verifikasi_pembayaran()
        {
            date_default_timezone_set('Asia/Jakarta');
            $id = $this->input->post('idSample');
            $status = 0 ;
            if(isset($_POST['terima'])) {
                $status = 1 ;
            }
            
            if(isset($_POST['tolak'])){
                $status = 2 ;
            }

            $query=[
                'tgl_verifikasi_bayar' => date('Y-m-d') ,
                'jam_verifikasi_bayar' => date('G:i:s') ,
                'status_verifikasi_bayar' => $status
            ];

            $this->db->where('idBuktiBayar', $this->input->post('id'));
            if($status == 1) {
                $this->db->set($query);
                if( $this->db->update('_buktiBayar') ){
                    if($this->input->post('proses') == 1) {
                        $valid = 'Pembayaran Valid - (Awal Pengerjaan)' ;
                    }else{
                        $valid = 'Pembayaran Valid' ;
                    }
                    $query_riwayat = [
                        'idSample' => $id ,
                        'tgl_riwayat' => date('Y-m-d'),
                        'jam_riwayat' => date('G:i:s'), 
                        'keteranganRiwayat' => $valid 
                    ];

                    if($this->db->insert('riwayatpekerjaan', $query_riwayat) ) {
                        $pesan = [
                            'pesan' => 'Verifikasi Berhasil <a href="'.base_url().'petugas"> Sample </a>' ,
                            'warna' => 'success'
                        ] ;
                    }else{
                        $pesan = [
                            'pesan' => 'Verifikasi Gagal' ,
                            'warna' => 'danger'
                        ] ;
                    }

                }else{
                    $pesan = [
                        'pesan' => 'Verifikasi Gagal' ,
                        'warna' => 'danger'
                    ] ;
                }
            }else{
                if( $this->db->delete('_buktiBayar') ){
                    $file = "./assets/file-upload/bukti-bayar/".$this->input->post('namaFile');     
                    unlink("./assets/file-upload/bukti-bayar/b.pdf") ;
                    $query_riwayat = [
                        'idSample' => $id ,
                        'tgl_riwayat' => date('Y-m-d'),
                        'jam_riwayat' => date('G:i:s'), 
                        'keteranganRiwayat' => 'Pembayaran Tidak Valid - Silahkan upload bukti pembayaran kembali'
                    ];

                    if($this->db->insert('riwayatpekerjaan', $query_riwayat) ) {
                        $pesan = [
                            'pesan' => 'Verifikasi Berhasil - Data Dihapus <a href="'.base_url().'petugas"> Sample </a>' ,
                            'warna' => 'success'
                        ] ;
                    }else{
                        $pesan = [
                            'pesan' => 'Verifikasi Gagal' ,
                            'warna' => 'danger'
                        ] ;
                    }

                }else{
                    $pesan = [
                        'pesan' => 'Verifikasi Gagal' ,
                        'warna' => 'danger'
                    ] ;
                }
            }

            $this->session->set_flashdata($pesan);
            redirect('sample/buktiBayar') ;

        }
    }

?>