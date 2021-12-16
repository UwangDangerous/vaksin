<?php 

    class User_Sample_model extends CI_Model{
        public function getDataSample($id) 
        {
            $this->db->where('_surat.idSurat', $id );
            $this->db->where('eksuser.idEU', $this->session->userdata('eksId') );
            $this->db->join('_surat', '_sample.idSurat = _surat.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->order_by('idsample','desc');
            return $this->db->get('_sample')->result_array();
        }

        public function addDokumen($id) 
        {
            $this->db->where('idPenerimaan', $id);
            return $this->db->get('dokumen')->result_array();
        }

        public function getSample($id) 
        {
            $this->db->where('idPenerimaan', $id);
            $this->db->join('jenisSample','sample.idJS = jenisSample.idJS');
            return $this->db->get("sample")->result_array();
        }

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
                    'pesan' => 'Sampel Berhasil Ditambahkan Silahkan Lengkapi Dokumen' ,
                    'warna' => 'success'
                ];

                $this->session->set_flashdata($pesan);
                redirect("sample_/index/".$this->input->post('id')) ;
            }

            // $this->db->where('idPenerimaan', $id);
            // $this->db->join('jenisSample','sample.idJS = jenisSample.idJS');
            // return $this->db->get("sample")->result_array();
        }

    }

?>