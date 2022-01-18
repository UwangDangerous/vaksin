<?php 

    class Sample_model extends CI_Model{
        public function getDataSample() 
        {
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->order_by('idSurat','desc');
            return $this->db->get('_surat')->result_array();
        }

        public function addDokumen($id) 
        {
            $this->db->where('idPenerimaan', $id);
            return $this->db->get('dokumen')->result_array();
        }

        public function judul($id) 
        {
            $this->db->where('idPenerimaan', $id);
            $this->db->join('eksUser', 'eksUser.idEU = penerimaan.idEU');
            return $this->db->get("penerimaan")->row_array();
        }

        public function getSample($id) 
        {
            $this->db->where('idPenerimaan', $id);
            $this->db->join('jenisSample','sample.idJS = jenisSample.idJS');
            return $this->db->get("sample")->result_array();
        }

        public function addSample($id) 
        {
            $upload = $this->uploadCeklis($id);

            $query = [
                'idPenerimaan' => $this->input->post('id') ,
                'namaSample' => $this->input->post('nama', true),
                'vial' => $this->input->post('vial', true),
                'idJS' => $this->input->post('js', true),
                'tgl_terima_sample' => $this->input->post('tanggal', true),
                'ceklis' => $upload
            ];

            if($this->db->insert('sample', $query)){
                $pesan = [
                    'pesan' => 'Data Berhasil Di Tambah',
                    'warna' => 'success' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("sample/tambah/$id") ;
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("sample/tambah/$id") ;
            }
        }

        public function uploadCeklis($id)
        {

            if( $_FILES['berkas']['name'] ) {
                $filename = explode("." , $_FILES['berkas']['name']) ;
                $ekstensi = strtolower(end($filename)) ;
                $config['upload_path'] = './assets/file-upload/ceklis-evaluator'; 
                $config['allowed_types'] = 'pdf|zip';
                $hashDate = substr(md5(date('Y-m-d H:i:s')),1,5) ;

                $namaSurat = explode(' ',$this->input->post('nama'));
                $namaSurat = preg_replace("/[^a-zA-Z]/", "", $namaSurat);
                $nama = '' ;
                $i = 0 ;
                for($i; $i<count($namaSurat); $i++) {
                    $nama .= $namaSurat[$i].'_' ;
                }

                $berkas = 'Evaluasi_Dokumen_'.rtrim($nama,'_').'_'.$hashDate ; //rtrim($nama,'_').'_'.

                $config['file_name'] = $berkas ;
                $this->load->library('upload',$config);

                if($this->upload->do_upload('berkas')){
                    $this->upload->initialize($config);
                }else{
                    $pesan = [
                        'pesan' => 'tipe file tidak sesuai',
                        'warna' => 'danger'
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("sample/tambahSample/$id") ;  
                }

                return $config['file_name'].'.'.$ekstensi ;
            } else{
                $pesan = [
                    'pesan' => 'berkas tidak boleh kosong',
                    'warna' => 'danger'
                ];
                $this->session->set_flashdata($pesan);
                redirect("sample/tambahSample/$id") ;   
            }
        }
























        // bukti bayar
        public function getBuktiBayar() 
        {
            if($this->input->get('cari')) {
                $this->db->where('_buktiBayar.idSample', $this->input->get('cari'));
            }

            $this->db->join('_sample', '_sample.idSample = _buktibayar.idSample');
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', '_surat.idEU = eksuser.idEU');
            $this->db->select('noSurat, idBuktiBayar, namaSurat, namaEU, namaSample, tgl_bayar, fileBuktiBayar,status_verifikasi_bayar, _sample.idSample as idSample, _sample.idProses');
            return $this->db->get('_buktibayar')->result_array();
        }
    }

?>