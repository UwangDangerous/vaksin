<?php 

    class User_Sample_model extends CI_Model{
        public function getDataSample($id) 
        {
            $this->db->where('_surat.idSurat', $id );
            $this->db->where('eksuser.idEU', $this->session->userdata('eksId') );
            $this->db->join('_surat', '_sample.idSurat = _surat.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenisSample', '_sample.idJenisSample = _jenisSample.idJenisSample');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _jenisSample.idJenisManufacture');
            $this->db->join('_importir', '_sample.idSample = _importir.idSample','left');
            $this->db->order_by('_sample.idsample','desc');
            $this->db->select('_sample.idsample as idSample , namaSample, jenisSample , 
                                _jenisManufacture.idJenisManufacture as idJenisManufacture, namaEU, 
                                namaImportir, namaJenisManufacture, tgl_kadaluarsa, _surat.idSurat as idSurat,
                                _sample.idJenisSample as idJenisSample'
                            );
            return $this->db->get('_sample')->result_array();
        }

        public function riwayatDataSample($id)
        {
            $this->db->where('idSample', $id) ;
            return $this->db->get('riwayatPekerjaan')->result_array() ;
        }

        public function perihalSurat($id) 
        {
            $this->db->where('idSurat', $id);
            $this->db->select('namaSurat');
            $surat = $this->db->get('_surat')->row_array();
            return $surat['namaSurat'] ;
        }

        public function getDataSampleBatch($id) 
        {
            $this->db->where('_sample.idSample', $id );
            $this->db->where('eksuser.idEU', $this->session->userdata('eksId') );
            $this->db->join('_surat', '_sample.idSurat = _surat.idSurat');
            $this->db->join('_jenisSample', '_sample.idJenisSample = _jenisSample.idJenisSample');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _jenisSample.idJenisManufacture');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
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
            $ski = '' ;
            if($this->input->post('jm')) {
                if($this->input->post('jm')) {
                    $ski = $this->input->post('ski') ;
                } 
            } 
            $jenisDokumen = explode('|',$this->input->post('jd')) ;
            $jenisDokumen = $jenisDokumen[0] ;
            $query = [
                'idSurat' => $this->input->post('id'),
                'namaSample' => $this->input->post('nama'),
                'idJenisSample' => $this->input->post('js'),
                'tgl_kadaluarsa' => $this->input->post('exp'),
                'noSKI' => $ski
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
            return $this->db->get('sample_batch')->result_array();
        }

        public function getDataBatch($id) 
        {
            $this->db->where('sample_batch.idSample', $id);
            $this->db->join('_sample', 'sample_batch.idSample = _sample.idSample');
            $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample');
            $this->db->select('sample_batch.idSample as idSample, wadah, noBatch, dosis, vial, idBatch,pelulusan,pengujian, pengiriman');
            return $this->db->get('sample_batch')->result_array();
        }

        public function getInfoJumlahDoc($idJenisDataDukung, $idBatch) 
        {
            $this->db->where('idBatch', $idBatch);
            $this->db->where('idJenisDataDukung', $idJenisDataDukung);
            return $this->db->get('_datadukung_batch')->row_array();
        } 

        public function getInfoPetugas($id) 
        {
            $this->db->where('idSample', $id);
            return $this->db->get('petugas')->num_rows();
        }

        public function getDataVerifikasiBerkasJenisDokumen($id) 
        {
            $this->db->where('idBatch', $id);
            $this->db->select('idJenisDokumen');
            return $this->db->get('verifikasi_berkas')->row_array();
        }

        public function getJenisManufacture()
        {
            return $this->db->get('_jenisManufacture')->result_array() ;
        }

        public function getJenisSample() 
        {
            $this->db->join('_jenisManufacture', '_jenisSample.idJenisManufacture = _jenisManufacture.idJenisManufacture','inner') ;
            return $this->db->get('_jenisSample')->result_array() ;
        }

        public function cekPetugas($id) 
        {
            $this->db->where('_sample.idSample', $id) ;
            $this->db->join('sample_batch', 'sample_batch.idBatch = petugas.idBatch') ;
            $this->db->join('_sample', '_sample.idSample = sample_batch.idSample') ;
            return $this->db->get('petugas')->result_array() ;
        }

        

























        // form

        
            // general informasi
                public function getDataForGI($id)
                {
                    $this->db->where('idJenisSample', $id) ;
                    $this->db->where('tugasGI', 2) ;
                    $this->db->join('tbl_general_informasi', 'tbl_general_informasi.idGI = tbl_gi_used.idGI') ;
                    return $this->db->get('tbl_gi_used')->result_array() ;
                }
                public function getData_GI_Use($id)
                {
                    $this->db->where('idGI', $id) ;
                    $this->db->select('id_gi_used') ;
                    return $this->db->get('tbl_gi_used')->row_array()['id_gi_used'] ;
                }
            // general informasi

            // tabel
                public function getDataForTabel($id)
                {
                    $this->db->where('idJenisSample', $id) ;
                    $this->db->where('tugasTabel', 2) ;
                    return $this->db->get('tbl_proses')->result_array() ;
                }

                // header
                    public function getDataForTabelHeader($id)
                    {
                        $this->db->where('id_tbl_proses', $id) ;
                        return $this->db->get('tbl_proses_header')->result_array() ;
                    }

                    public function cekIsiDataHeader($idHeader, $idSample)
                    {
                        $this->db->where('idSample', $idSample);
                        $this->db->where('id_tbl_header', $idHeader);
                        return $this->db->get('isi_tbl_proses_header')->row_array();
                    }
                // header

                // kolom / body
                    public function getDataForTabelKolom($id)
                    {
                        $this->db->where('id_tbl_proses', $id) ;
                        return $this->db->get('tbl_proses_kolom')->result_array() ;
                    }

                    public function getDataFor_Isi_kolom_array($idTbl, $idSample)
                    {
                        $this->db->where('id_tbl_proses', $idTbl);
                        $this->db->where('idSample', $idSample);
                        $this->db->join('tbl_proses_kolom', 'tbl_proses_kolom.id_kolom = isi_tbl_kolom.id_kolom');
                        return $this->db->get('isi_tbl_kolom')->result_array();
                    }
                // kolom / body

                // footer
                    public function getDataForTabelFooter($idTbl) 
                    {
                        $this->db->where('id_tbl_proses', $idTbl) ;
                        return $this->db->get('tbl_proses_footer')->result_array() ;
                    }

                    public function cekIsiDataFooter($idFooter, $idSample) 
                    {
                        $this->db->where('idSample', $idSample);
                        $this->db->where('id_tbl_footer', $idFooter);
                        return $this->db->get('isi_tbl_proses_footer')->row_array();
                    }
                // footer

            // tabel

        // form

    }

?>