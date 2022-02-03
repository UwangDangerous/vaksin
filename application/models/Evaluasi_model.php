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