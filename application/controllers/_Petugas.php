<!-- _petugas adalah class asli untuk mengolah data petugas -->
<?php 

    class _Petugas extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('_Petugas_model');
        }

        public function index($id, $idJenisManufacture, $idJenisDokumen)
        {
            $data['id'] = $id ;
            $data['idJenisManufacture'] = $idJenisManufacture ;
            $data['idJenisDokumen'] = $idJenisDokumen ;

            $this->load->view("petugas/petugas/index", $data) ;
        }

        public function evaluator($id,$idJenisManufacture, $idJenisDokumen) 
        {
            $data['id'] = $id ;
            $data['idJenisManufacture'] = $idJenisManufacture ;
            $data['idJenisDokumen'] = $idJenisDokumen ;
            $data['evaluator'] = $this->_Petugas_model->getDataPetugas(4); 
            
            $this->load->view("petugas/petugas/evaluator",$data) ;
        }

        // simpan petugas hanya untuk tugas pelulusan dan verifikasi
        public function simpanPetugas($id, $idJenisManufacture, $idJenisDokumen, $tugas)
        {

            if($tugas == 1) {
                $petugas = "Verifikator" ;
                $konformasi = 1 ;
            }else{
                $petugas = "Evaluator" ;
                $konformasi = 0 ;
            }

            $query = [
                'idBatch' => $id, 
                'idIU' => $this->input->post('idIU') ,
                'idTugas' => $tugas ,
                'konfirmasi' => $konformasi
            ] ;

            if($this->db->insert('petugas', $query)) {
                $this->load->model("_Riwayat") ;
                $this->_Riwayat->simpanRiwayat($id, "Tambah Petugas $petugas", "Petugas",1) ;
                $pesan = [
                    "pesan_$petugas" => "Petugas $petugas Berhasil Disimpan" ,
                    "warna_$petugas" => "success" 
                ];
            }else{
                $pesan = [
                    "pesan_$petugas" => "Petugas $petugas Gagal Disimpan" ,
                    "warna_$petugas" => "danger" 
                ];
            }

            $this->session->set_flashdata($pesan) ;
            if($tugas == 1) {
                $this->index($id, $idJenisManufacture,$idJenisDokumen) ;
            }else{
                $this->evaluator($id, $idJenisManufacture,$idJenisDokumen) ;
            }
        }

        // ubah petugas verifikator dan evaluator

        public function ubahPetugas($id, $idJenisManufacture, $idJenisDokumen, $tugas)
        {

            if($tugas == 1) {
                $petugas = "Verifikator" ;
            }else{
                $petugas = "Evaluator" ;
            }

            $this->db->where('idPetugas', $this->input->post('idPetugas')) ;
            $this->db->set('idIU', $this->input->post('idIU')) ;

            if($this->db->update('petugas')) {
                $this->load->model("_Riwayat") ;
                $this->_Riwayat->simpanRiwayat($id, "Ubah Petugas $petugas", "Petugas",1) ;
                $pesan = [
                    "pesan_$petugas" => "Petugas $petugas Berhasil DiUbah" ,
                    "warna_$petugas" => "success" 
                ];
            }else{
                $pesan = [
                    "pesan_$petugas" => "Petugas $petugas Gagal DiUbah" ,
                    "warna_$petugas" => "danger" 
                ];
            }

            $this->session->set_flashdata($pesan) ;
            if($tugas == 1) {
                $this->index($id, $idJenisManufacture,$idJenisDokumen) ;
            }else{
                $this->evaluator($id, $idJenisManufacture,$idJenisDokumen) ;
            }
        }



        // pengujian sing angel dewe
            public function pengujian($id)
            {
                $data['id'] = $id ;
                $data['pengujian'] = $this->_Petugas_model->getDataPengujian($id) ;
                $data['petugas'] = $this->_Petugas_model->getDataPetugas(4); 

                $this->load->view('petugas/petugas/pengujian', $data) ;
            }

            public function simpanPetugasPenguji($id)
            {
                $idJP = $this->input->post('idJP') ;

                $query = [
                    'idJP_used' => $idJP, 
                    'idIU' => $this->input->post('idIU') ,
                ] ;

                if($this->db->insert('petugas_penguji', $query)) {
                    $this->load->model("_Riwayat") ;
                    $this->_Riwayat->simpanRiwayat($id, "Tambah Petugas Penguji", "Petugas",1) ;
                    $pesan = [
                        "pesan_Penguji_$idJP" => "Petugas Penguji Berhasil Disimpan" ,
                        "warna_Penguji_$idJP" => "success" 
                    ];
                }else{
                    $pesan = [
                        "pesan_Penguji_$idJP" => "Petugas Penguji Gagal Disimpan" ,
                        "warna_Penguji_$idJP" => "danger" 
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->pengujian($id) ;
            }

            public function ubahPetugasPenguji($id)
            {
                $idJP = $this->input->post('idJP') ;
                $idPP = $this->input->post('idPP') ;
                $idIU = $this->input->post('idIU') ;

                $this->db->where('idPP', $idPP) ;
                $this->db->set('idIU', $idIU) ;
                if($this->db->update('petugas_penguji')) {
                    $this->load->model("_Riwayat") ;
                    $this->_Riwayat->simpanRiwayat($id, "Ubah Petugas Penguji", "Petugas",1) ;
                    $pesan = [
                        "pesan_Penguji_$idJP" => "Petugas Penguji Berhasil DIubah" ,
                        "warna_Penguji_$idJP" => "success" 
                    ];
                }else{
                    $pesan = [
                        "pesan_Penguji_$idJP" => "Petugas Penguji Gagal DIubah" ,
                        "warna_Penguji_$idJP" => "danger" 
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->pengujian($id) ; 
            }

            public function hapusPetugasPenguji($id, $idPP, $idJP)
            {

                $this->db->where('idPP', $idPP) ;
                if($this->db->delete('petugas_penguji')) {
                    $this->load->model("_Riwayat") ;
                    $this->_Riwayat->simpanRiwayat($id, "Hapus Petugas Penguji", "Petugas",1) ;
                    $pesan = [
                        "pesan_Penguji_$idJP" => "Petugas Penguji Berhasil Dihapus" ,
                        "warna_Penguji_$idJP" => "success" 
                    ];
                }else{
                    $pesan = [
                        "pesan_Penguji_$idJP" => "Petugas Penguji Gagal Dihapus" ,
                        "warna_Penguji_$idJP" => "danger" 
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->pengujian($id) ; 
            }
        // pengujian sing angel dewe

    }

?>
