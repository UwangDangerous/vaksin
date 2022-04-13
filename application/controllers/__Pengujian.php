<?php 

    class __Pengujian extends CI_Controller{
        public function __construct()
        {
            parent :: __construct() ;
            $this->load->model('__Pengujian_model') ;
        }

        public function index()
        {
            $data['judul'] = 'Pengujian Sampel '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Pengujian Sampel'; 
            $data['bread'] = '<a href='.base_url().'dashboard>Dashboard</a> / Pengujian Sampel'; 
            $data['pengujian'] = $this->__Pengujian_model->getDataPengujian() ;
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('__pengujian/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
                
            }
        }

        public function simpan_hasil_pengujian($id, $idBatch)
        {
            //uji_yg_dilakukan //hasil //acuan //syarat //tgl_expiry_pengujian //berkas
            $this->load->model('_Upload') ;
            $file = $this->_Upload->uploadEksUser('berkas', 'assets/file-upload/hasil-pengujian', 'pdf|doc|docx','__pengujian', 'hasil_pengujian') ;

            $query = [
                'idJP_used' => $id,
                'uji_yg_dilakukan' => $this->input->post('uji_yg_dilakukan') ,
                'hasil' => $this->input->post('hasil') ,
                'syarat' => $this->input->post('syarat') ,
                'acuan' => $this->input->post('acuan') ,
                'tgl_kadaluarsa_sample' => $this->input->post('tgl_expiry_pengujian') ,
                'file_hasil_pengujian' => $file ,
                'tgl_selesai_pengujian' => date("Y-m-d")
            ];

            if($this->db->insert('hasil_pengujian', $query)){
                $this->load->model('_Riwayat') ;
                $this->_Riwayat->simpanRiwayat($idBatch, 'Pengujian '.$this->input->post('noAdm').' Selesai', 'Hasil Pengujian',1);
                $pesan = [
                    'pesan' => 'Hasil Pengujian Berhasil Disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Hasil Pengujian Gagal Disimpan',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flasdata($pesan) ;
            redirect('__pengujian') ;
        }
    }

?>