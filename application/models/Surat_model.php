<?php 

    class Surat_model extends CI_Model{
        public function getSurat() 
        {
            $this->db->where('idEU', $this->session->userdata('eksId'));
            return $this->db->get('_surat')->result_array();
        }

        public function getJumlahSample($id) 
        {
            $this->db->where('idSurat', $id);
            $this->db->select('count(idSurat) as jumlah');
            return $this->db->get("_sample")->row_array()['jumlah'];
        }

        public function addSurat()
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/surat','pdf|jpg|png|jpeg','surat/kirim');

            $query = [
                'namaSurat' => $this->input->post('nama', true),
                'isiSurat' => $this->input->post('Isi', true),
                'idEU' => $this->session->userdata('eksId'),
                'fileSurat' => $upload ,
                'tgl_kirim_surat' => 'Y-m-d'
            ];

            if($this->db->insert('_surat', $query)){
                $pesan = [
                    'pesan' => 'Data Berhasil Di Tambah',
                    'warna' => 'success' 
                ];
                $this->session->set_flashdata($pesan);
                redirect('surat') ;
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect('surat/kirim') ;
            }
        }
        
        

        // public function addDokumen($id) 
        // {
        //     $this->db->where('idPenerimaan', $id);
        //     return $this->db->get('dokumen')->result_array();
        // }

        // public function uploadDokumen()
        // {
        //     if( $_FILES['berkas']['name'] ) {
        //         $filename = explode("." , $_FILES['berkas']['name']) ;
        //         $ekstensi = strtolower(end($filename)) ;
        //         $config['upload_path'] = './assets/file-upload/dokumen-manufaktur'; 
        //         $config['allowed_types'] = 'pdf|zip';
        //         $hashDate = substr(md5(date('Y-m-d H:i:s')),1,5) ;

        //         $namaInstansi = explode(' ',$this->session->userdata('eksNama'));
        //         $nama = '' ;
        //         $i = 0 ;
        //         for($i; $i<count($namaInstansi); $i++) {
        //             $nama .= $namaInstansi[$i].'_' ;
        //         }

        //         $namaFile = explode(' ',$filename[0]);
        //         $file = '' ;
        //         $j = 0 ;
        //         for($j; $j<count($namaFile); $j++) {
        //             $file .= $namaFile[$j].'_' ;
        //         }

        //         $berkas = rtrim($nama,'_').'_'.rtrim($file,'_').'_'.$hashDate ;

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
        //             redirect('surat/kirim') ;  
        //         }

        //         return $config['file_name'].'.'.$ekstensi ;
        //     } else{
        //         $pesan = [
        //             'pesan' => 'berkas tidak boleh kosong',
        //             'warna' => 'danger'
        //         ];
        //         $this->session->set_flashdata($pesan);
        //         redirect('surat/kirim') ;  
        //     }
        // }
    }

?>

<?php 

    // class Surat_model extends CI_Model{
    //     public function uploadSurat()
    //     {
    //         if( $_FILES['berkas']['name'] ) {
    //             $filename = explode("." , $_FILES['berkas']['name']) ;
    //             $ekstensi = strtolower(end($filename)) ;
    //             $config['upload_path'] = './assets/file-upload/surat'; 
    //             $config['allowed_types'] = 'pdf|jpg|png|jpeg';
    //             $hashDate = substr(md5(date('Y-m-d H:i:s')),1,5) ;

    //             $namaInstansi = explode(' ',$this->session->userdata('eksNama'));
    //             $nama = '' ;
    //             $i = 0 ;
    //             for($i; $i<count($namaInstansi); $i++) {
    //                 $nama .= $namaInstansi[$i].'_' ;
    //             }

    //             $namaFile = explode(' ',$filename[0]);
    //             $file = '' ;
    //             $j = 0 ;
    //             for($j; $j<count($namaFile); $j++) {
    //                 $file .= $namaFile[$j].'_' ;
    //             }

    //             $berkas = rtrim($nama,'_').'_'.rtrim($file,'_').'_'.$hashDate ;

    //             $config['file_name'] = $berkas ;
    //             $this->load->library('upload',$config);

    //             if($this->upload->do_upload('berkas')){
    //                 $this->upload->initialize($config);
    //             }else{
    //                 $pesan = [
    //                     'pesan' => 'tipe file tidak sesuai',
    //                     'warna' => 'danger'
    //                 ];
    //                 $this->session->set_flashdata($pesan);
    //                 redirect('surat/kirim') ;  
    //             }

    //             return $config['file_name'].'.'.$ekstensi ;
    //         } else{
    //             $pesan = [
    //                 'pesan' => 'berkas tidak boleh kosong',
    //                 'warna' => 'danger'
    //             ];
    //             $this->session->set_flashdata($pesan);
    //             redirect('surat/kirim') ;  
    //         }
    //     }
        
    //     public function addSurat()
    //     {
    //         $upload = $this->uploadSurat();

    //         $query = [
    //             'namaFile' => $upload ,
    //             'keterangan' => $this->input->post('nama', true),
    //             'idEU' => $this->session->userdata('eksId'),
    //             'tgl_upload' => date('Y-m-d'),
    //             'tgl_pengiriman' => $this->input->post('tanggal', true)
    //         ];

    //         if($this->db->insert('penerimaan', $query)){
    //             $pesan = [
    //                 'pesan' => 'Data Berhasil Di Tambah',
    //                 'warna' => 'success' 
    //             ];
    //             $this->session->set_flashdata($pesan);
    //             redirect('surat') ;
    //         }else{
    //             $pesan = [
    //                 'pesan' => 'Data Gagal Di Tambah',
    //                 'warna' => 'danger' 
    //             ];
    //             $this->session->set_flashdata($pesan);
    //             redirect('surat/kirim') ;
    //         }
    //     }
        
    //     public function getSurat() 
    //     {
    //         $this->db->where('idEU', $this->session->userdata('eksId'));
    //         return $this->db->get('penerimaan')->result_array();
    //     }

    //     public function addDokumen($id) 
    //     {
    //         $this->db->where('idPenerimaan', $id);
    //         return $this->db->get('dokumen')->result_array();
    //     }

    //     public function uploadDokumen()
    //     {
    //         if( $_FILES['berkas']['name'] ) {
    //             $filename = explode("." , $_FILES['berkas']['name']) ;
    //             $ekstensi = strtolower(end($filename)) ;
    //             $config['upload_path'] = './assets/file-upload/dokumen-manufaktur'; 
    //             $config['allowed_types'] = 'pdf|zip';
    //             $hashDate = substr(md5(date('Y-m-d H:i:s')),1,5) ;

    //             $namaInstansi = explode(' ',$this->session->userdata('eksNama'));
    //             $nama = '' ;
    //             $i = 0 ;
    //             for($i; $i<count($namaInstansi); $i++) {
    //                 $nama .= $namaInstansi[$i].'_' ;
    //             }

    //             $namaFile = explode(' ',$filename[0]);
    //             $file = '' ;
    //             $j = 0 ;
    //             for($j; $j<count($namaFile); $j++) {
    //                 $file .= $namaFile[$j].'_' ;
    //             }

    //             $berkas = rtrim($nama,'_').'_'.rtrim($file,'_').'_'.$hashDate ;

    //             $config['file_name'] = $berkas ;
    //             $this->load->library('upload',$config);

    //             if($this->upload->do_upload('berkas')){
    //                 $this->upload->initialize($config);
    //             }else{
    //                 $pesan = [
    //                     'pesan' => 'tipe file tidak sesuai',
    //                     'warna' => 'danger'
    //                 ];
    //                 $this->session->set_flashdata($pesan);
    //                 redirect('surat/kirim') ;  
    //             }

    //             return $config['file_name'].'.'.$ekstensi ;
    //         } else{
    //             $pesan = [
    //                 'pesan' => 'berkas tidak boleh kosong',
    //                 'warna' => 'danger'
    //             ];
    //             $this->session->set_flashdata($pesan);
    //             redirect('surat/kirim') ;  
    //         }
    //     }
    // }

?>