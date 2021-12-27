<?php 

    class User_Sample_model extends CI_Model{
        public function getDataSample($id) 
        {
            $this->db->where('_surat.idSurat', $id );
            $this->db->where('eksuser.idEU', $this->session->userdata('eksId') );
            $this->db->join('_surat', '_sample.idSurat = _surat.idSurat');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenisSample', '_sample.idJenisSample = _jenisSample.idJenisSample');
            $this->db->order_by('idsample','desc');
            return $this->db->get('_sample')->result_array();
        }

        public function getJenisDataDukung($id) 
        {
            $this->db->where('idJenisManufacture', $id);
            return $this->db->get("_jenisDataDukung")->result_array();
        }

        // public function addDokumen($id) 
        // {
        //     $this->db->where('idPenerimaan', $id);
        //     return $this->db->get('dokumen')->result_array();
        // }


        public function addSample() 
        {
            $query = [
                'idSurat' => $this->input->post('id'),
                'namaSample' => $this->input->post('nama'),
                'idJenisSample' => $this->input->post('js'),
                'idJenisDokumen' => $this->input->post('jd'),
                'namaManufacture' => $this->input->post('namaManufacture'),
                'alamatManufacture' => $this->input->post('alamatManufacture'),
                'idJenisManufacture' => $this->input->post('jm'),
                'noMA' => $this->input->post('noMA'),
                'batchNo' => $this->input->post('batch'),
                'expiryDate' => $this->input->post('expiry'),
                'StorageTemperature' => $this->input->post('penyimpanan'),
                'tgl_pengiriman' => $this->input->post('tanggal')
            ];
            
            if($this->db->insert('_sample', $query) ) {
                $pesan = [
                    'pesan' => 'Sampel Berhasil Ditambahkan Silahkan <u>Lengkapi Dokumen</u>' ,
                    'warna' => 'success'
                ];

                $this->session->set_flashdata($pesan);
                redirect("sample_/index/".$this->input->post('id')) ;
            }else{
                $pesan = [
                    'pesan' => 'Sampel Gagal Ditambahkan' ,
                    'warna' => 'danger'
                ];

                $this->session->set_flashdata($pesan);
                redirect("sample_/index/".$this->input->post('id')) ;
            }

            // $this->db->where('idPenerimaan', $id);
            // $this->db->join('jenisSample','sample.idJS = jenisSample.idJS');
            // return $this->db->get("sample")->result_array();
        }


        public function cekDataDukung($sample, $jenis)
        {
            $this->db->where('idSample', $sample);
            $this->db->where('idJenisDataDukung', $jenis);
            $this->db->select('count(idDataDukung) as jumlah');
            return $this->db->get('_dataDukung')->row_array()['jumlah'];
        }

        public function jmlDokumenTerisi($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('_dataDukung')->num_rows();
        }

        public function jmlDokumen($id)
        {
            $this->db->where('idJenisManufacture', $id);
            return $this->db->get('_jenisDataDukung')->num_rows();
        }

        public function getImportir($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('_importir')->row_array() ;
        }

        public function cekBuktiBayar($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('_buktiBayar')->row_array();
        }

    }

?>