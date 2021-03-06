<?php 

    class Cetak_model extends CI_Model{
        public function getJudulSample($id) 
        {
            $this->db->where('sample_batch.idBatch', $id);
            $this->db->join('_sample', '_sample.idSample = sample_batch.idSample') ;
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenissample', '_jenissample.idJenisSample = _sample.idJenisSample');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = sample_batch.idJenisDokumen');
            // $this->db->join('proses', 'proses.idProses = sample_batch.idProses');
            return $this->db->get('sample_batch')->row_array();
        }

        public function getDataGeneral_informasi($id)
        {
            $this->db->where('idJenisSample', $id) ;
            $this->db->join('tbl_general_informasi', 'tbl_general_informasi.idGI = tbl_gi_used.idGI') ;
            return $this->db->get('tbl_gi_used')->result_array() ;
        }

        public function getPetugasEvaluasi($idBatch) 
        {
            $this->db->where('idBatch',$idBatch);
            $this->db->where('petugas.idTugas', 2);
            $this->db->select('namaIU, inuser.idIU as idIU');
            $this->db->join('inuser', 'inuser.idIU = petugas.idIU');
            return $this->db->get('petugas')->row_array();
        }

        public function getPetugasVerivikasi($idBatch) 
        {
            $this->db->where('idBatch',$idBatch);
            $this->db->where('petugas.idTugas', 1);
            $this->db->select('namaIU, inuser.idIU as idIU, tanda_tangan');
            $this->db->join('inuser', 'inuser.idIU = petugas.idIU');
            return $this->db->get('petugas')->row_array();
        }

        public function getPetugasCheck()
        {
            $this->db->where('idLevel', 2);
            return $this->db->get('inuser')->row_array();
        }

        public function getInfoCeklis($idBatch)
        {
            $this->db->where('idBatch', $idBatch);
            return $this->db->get('hasil_evaluasi')->row_array();
        }

        public function getHasilVerifikasi($id) 
        {
            $this->db->where('id_hasil_evaluasi', $id);
            return $this->db->get('hasil_verifikasi')->row_array();
        }

        public function getHasilPeriksa($id) 
        {
            $this->db->where('id_hasil_evaluasi', $id);
            return $this->db->get('hasil_periksa')->row_array();
        }

        public function cekSertifikat($id)
        {
            $this->db->where('id_hasil_evaluasi', $id);
            return $this->db->get('sertifikat')->row_array() ;
        }

        public function getDataBatch($idSample)
        {
            $this->db->where('idSample', $idSample);
            return $this->db->get('sample_batch')->result_array();
        }

        public function getDataImportir($idSample)
        {
            $this->db->where('idSample',$idSample);
            return $this->db->get('_importir')->row_array();
        }


        // surat perintah kerja model
            public function getDataSurat($id)
            {
                $this->db->where('sample_batch.idBatch', $id) ;
                $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU') ;
                $this->db->join('_sample', '_sample.idSurat = _surat.idSurat') ;
                $this->db->join('sample_batch', 'sample_batch.idSample = _sample.idSample') ;

                $this->db->join('no_admin', 'no_admin.idBatch = sample_batch.idBatch') ;
                $this->db->join('verifikasi_sample_batch', 'verifikasi_sample_batch.idBatch = sample_batch.idBatch') ;
                $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample') ;
                $this->db->join('_jenisKemasan','_jenisKemasan.idJenisKemasan = _jenisSample.idJenisKemasan') ;

                $this->db->where('idTugas', 2) ; //evaluator
                $this->db->join('petugas', 'petugas.idBatch = sample_batch.idBatch') ;
                $this->db->join('inuser', 'inuser.idIU = petugas.idIU') ;

                $this->db->select('
                    noSurat, namaEU, namaDepan, tgl_kirim_surat,

                    noAdm,kodeAdm,kodeBulan,tahun,
                    namaSample, noBatch,

                    jumlah_sample,ingJenisKemasan,
                    
                    namaIU,tanda_tangan,nip,

                    tgl_verifikasi_sample
                ') ;
                return $this->db->get('_surat')->row_array() ;
            }

            public function getDataPengujian($id) {
                $this->db->where('idBatch', $id) ;
                $this->db->join('_jenisPekerjaan', '_jenisPekerjaan.idJenisPekerjaan = _jp_add.idJenisPekerjaan') ;
                $this->db->select('namaJenisPekerjaan') ;
                return $this->db->get('_jp_add')->result_array() ;
            }

            public function petugasVerifikasiPelulusan($id)
            {
                $this->db->where('idBatch', $id) ;
                $this->db->where('idTugas', 1) ;
                $this->db->join('inuser', 'inuser.idIU = petugas.idIU') ;
                $this->db->select('nip, tanda_tangan,namaIU') ;
                return $this->db->get('petugas')->row_array() ;
            }

            public function getDataSuratPengujian($id)
            {
                $this->db->where('_jp_used.idJP_used', $id) ;

                $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU') ;
                $this->db->join('_sample', '_sample.idSurat = _surat.idSurat') ;
                $this->db->join('sample_batch', 'sample_batch.idSample = _sample.idSample') ;
                $this->db->join('verifikasi_sample_batch', 'verifikasi_sample_batch.idBatch = sample_batch.idBatch') ;
                $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample') ;
                $this->db->join('_jenisKemasan','_jenisKemasan.idJenisKemasan = _jenisSample.idJenisKemasan') ;

                $this->db->join('_jp_used','_jp_used.idBatch = sample_batch.idBatch') ;
                $this->db->join('_jenisPengujian','_jenisPengujian.idJenisPengujian = _jp_used.idJenisPengujian') ;
                $this->db->join('no_admin_pengujian', 'no_admin_pengujian.idJP_used = _jp_used.idJP_used') ;
                $this->db->join('petugas_penguji', 'petugas_penguji.idJP_used = _jp_used.idJP_used') ;
                $this->db->join('inuser', 'inuser.idIU = petugas_penguji.idIU') ;
    
    
                $this->db->select('
                    noSurat, namaEU, namaDepan, tgl_kirim_surat,
    
                    PnoAdm as noAdm,PkodeAdm as kodeAdm,PkodeBulan as kodeBulan,Ptahun as tahun,
                    namaSample, noBatch,namaJenisPengujian,
    
                    jumlah_sample,ingJenisKemasan,
                    
                    namaIU,tanda_tangan,nip,
    
                    tgl_verifikasi_sample
                ') ;
                return $this->db->get('_surat')->row_array() ;
            }
        // surat perintah kerja model


























        // form penerimaan 
            public function getInformasiPenerimaan() 
            {
                return $this->db->get('_y_form_penerimaan_sample')->result_array() ;
            }
            public function getSubInformasiPenerimaan($id) 
            {
                $this->db->where('id_penerimaan',$id) ;
                return $this->db->get('_y_form_penerimaan_sample_sub')->result_array() ;
            }
            public function getInformasiContoh()
            {
                return $this->db->get('_y_penerimaan_contoh')->result_array() ;
            }
            public function getInformasiContohSub($id)
            {
                $this->db->where('id_contoh', $id) ;
                return $this->db->get('_y_penerimaan_contoh_sub')->result_array() ;
            }
            public function getDataSuratPengantar($id=7)
            {
                $this->db->where('idSurat', $id) ;
                $this->db ->join('eksuser', 'eksuser.idEU = _surat.idEU') ;
                return $this->db->get('_surat')->row_array() ;
            }
        // form penerimaan 
    }


?>