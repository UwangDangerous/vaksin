<?php 

    class Evaluasi_model extends CI_Model{
        public function getDataSample() 
        {
            $this->db->where('petugas.idLevel', '3' );
            $this->db->where('idIU', $this->session->userdata('key') );
            $this->db->join('_sample', '_sample.idSample = petugas.idSample');
            $this->db->join('_jenisSample', '_sample.idJenisSample = _jenisSample.idJenisSample');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = _sample.idJenisDokumen');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            $this->db->order_by('_sample.idSample', 'desc');
            return $this->db->get('petugas')->result_array();
        }

        // public function getDataSampleEvaluasi($id) 
        // {
        //     $this->db->where('idSample', $id );
        //     return $this->db->get('sample')->row_array();
        // }

        // public function uploadHasilEvaluasi($id)
        // {

        //     if( $_FILES['berkas']['name'] ) {
        //         $filename = explode("." , $_FILES['berkas']['name']) ;
        //         $ekstensi = strtolower(end($filename)) ;
        //         $config['upload_path'] = './assets/file-upload/hasil-evaluasi'; 
        //         $config['allowed_types'] = 'pdf|zip';
        //         $hashDate = substr(md5(date('Y-m-d H:i:s')),1,5) ;

        //         $namaSurat = explode(' ',$this->input->post('namaSample'));
        //         $namaSurat = preg_replace("/[^a-zA-Z]/", "", $namaSurat);
        //         $nama = '' ;
        //         $i = 0 ;
        //         for($i; $i<count($namaSurat); $i++) {
        //             $nama .= $namaSurat[$i].'_' ;
        //         }

        //         $berkas = 'Hasil_Evaluasi_Dokumen_'.rtrim($nama,'_').'_'.$hashDate ; 

        //         $config['file_name'] = $berkas ;
        //         $this->load->library('upload',$config);

        //         if($this->upload->do_upload('berkas')){
        //             $this->upload->initialize($config);
        //         }else{
        //             $pesan = [
        //                 'pesan' => 'tipe file tidak sesuai',
        //                 'warna' => 'danger'
        //             ];
        //             $this->session->set_flashdata($pesan);
        //             redirect("evaluasi/tambah/$id") ;  
        //         }

        //         return $config['file_name'].'.'.$ekstensi ;
        //     } else{
        //         $pesan = [
        //             'pesan' => 'berkas tidak boleh kosong',
        //             'warna' => 'danger'
        //         ];
        //         $this->session->set_flashdata($pesan);
        //         redirect("evaluasi/tambah/$id") ;   
        //     }
        // }

        // public function addHasilEvaluasi($id) 
        // {
        //     $berkas = $this->uploadHasilEvaluasi($id);
        //     $i = 0;
        //     $fixVial = '' ;
        //     for($i; $i<$this->input->post('jmlVial') ; $i++) {
        //         if( $vial = $this->input->post("vial$i") ) {
        //             $fixVial .= $vial.',';
        //         }
        //     } 

        //     // var_dump(rtrim($fixVial, ',')) ;

        //     $query = [
        //         'idSample' => $this->input->post('idSample'),
        //         'batch' => $this->input->post('batch'),
        //         'vialLolos' => rtrim($fixVial,','),
        //         'doses' => $this->input->post('doses'),
        //         'tgl_expiry' => $this->input->post('tanggal'),
        //         'hasilEvaluasi' => $berkas
        //     ];

        //     if($this->db->insert('evaluasi', $query)){
        //         $this->session->set_flashdata(['pesan' => 'Data Berhasil Ditambahkan', 'warna' => 'success']);
        //         redirect("evaluasi") ;
        //     }else{
        //         $this->session->set_flashdata(['pesan' => 'Data Gagal Ditambahkan', 'warna' => 'danger']);
        //         redirect("evaluasi/tambah/$id/$petugas") ;
        //     }
        // }

        // public function cekEvaluasi($id) 
        // {
        //     $this->db->where('idSample', $id);
        //     return $this->db->get('evaluasi')->row_array();
        // }

        public function getDataDukung($id) 
        {
            $this->db->where('idSample', $id);
            $this->db->join('_jenisDataDukung', '_jenisDataDukung.idJenisDataDukung = _dataDukung.idJenisDataDukung');
            return $this->db->get('_dataDukung')->result_array();
        }

        public function buktiBayar($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('_buktiBayar')->row_array();
        }

        public function getDataEvaluasi($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('evaluasi')->row_array();
        }

        public function clockoff($id)
        {
            $this->db->where('idSample',$id);
            $this->db->order_by('idClockOff', 'desc');
            return $this->db->get('clockoff')->row_array() ;
        }

        public function clock_on($id)
        {
            $this->db->where('idSample',$id);
            $this->db->join('clockoff_dokumen', 'clockoff_dokumen.idClockOff = clockoff.idClockOff');
            return $this->db->get('clockoff')->result_array() ;
        }
        
    }

?>