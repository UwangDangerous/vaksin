<?php 

    class User_Sample_model extends CI_Model{
        public function getDataSample($id) 
        {
            $this->db->where('_surat.idSurat', $id );
            $this->db->where('eksuser.idEU', $this->session->userdata('eksId') );
            $this->db->join('_surat', '_sample.idSurat = _surat.idSurat');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            // $this->db->join('_jenisDokumen', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenisSample', '_sample.idJenisSample = _jenisSample.idJenisSample');
            $this->db->join('_importir', '_sample.idSample = _importir.idSample','left');
            $this->db->order_by('_sample.idsample','desc');
            $this->db->select('_sample.idsample as idSample , namaSample, jenisSample , 
                                _jenisManufacture.idJenisManufacture as idJenisManufacture, namaEU, 
                                namaImportir, namaJenisManufacture, noMA, tgl_pengiriman, _surat.idSurat as idSurat'
                            );
            return $this->db->get('_sample')->result_array();
        }

        public function getDataSampleBatch($id) 
        {
            $this->db->where('_sample.idSample', $id );
            $this->db->where('eksuser.idEU', $this->session->userdata('eksId') );
            $this->db->join('_surat', '_sample.idSurat = _surat.idSurat');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = _sample.idJenisDokumen');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenisSample', '_sample.idJenisSample = _jenisSample.idJenisSample');
            return $this->db->get('_sample')->row_array();
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
                'idJenisManufacture' => $this->input->post('jm'),
                'noMA' => $this->input->post('noMA'),
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

        public function getJumlahDataDukung($idBatch, $jenis)
        {
            $this->db->where('idBatch', $idBatch);
            $this->db->where('idJenisDataDukung', $jenis);
            return $this->db->get('_dataDukung_batch')->num_rows();
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

        public function getBatch($id) 
        {
            $this->db->where('idSample', $id);
            return $this->db->get('sample_batch')->num_rows();
        }

        public function getDataBatch($id) 
        {
            $this->db->where('idSample', $id);
            return $this->db->get('sample_batch')->result_array();
        }

    }

?>