<?php 

    class Petugas_model extends CI_Model{
        public function getSample($id,$cari) 
        {
            // $this->db->where('idPenerimaan', $id);
            // $this->db->join('jenisSample','sample.idJS = jenisSample.idJS');
            $this->db->where("_jenisDokumen.idJenisDokumen like '%$cari%'");
            $this->db->where("_surat.idSurat like '%$id%'");
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenissample', '_jenissample.idJenisSample = _sample.idJenisSample');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = _sample.idJenisDokumen');
            $this->db->join('proses', 'proses.idProses = _sample.idProses');
            $this->db->order_by('idSample', 'desc');
            return $this->db->get("_sample")->result_array();
        }

        public function getPetugas($id)
        {
            $this->db->where('idSample', $id);
            $this->db->join('level', 'level.idLevel = petugas.idLevel');
            $this->db->join('inuser', 'inuser.idIU = petugas.idIU');
            return $this->db->get('petugas')->result_array();
        }

        public function getPilihPetugas($lvl) 
        {
            if($lvl != 5){
                $this->db->where("idLevel = $lvl or idLevel = 5");
            }else{
                $this->db->where("idLevel = 5");
            }
            $this->db->select('idIU,namaIU');
            $this->db->order_by('idLevel', 'asc');
            return $this->db->get('inUser')->result_array();
        }
        
        public function getDataPetugas($id, $idSample) 
        {
            $this->db->where("idSample = $idSample and idLevel = $id");
            return $this->db->get('petugas')->row_array();
            // var_dump($data) ;
        }


        public function getBuktiBayar($id) 
        {
            $this->db->where('idSample', $id);
            return $this->db->get('_buktiBayar')->row_array();
        }

        public function getDetailSample($id) 
        {
            $this->db->where('_sample.idSample', $id);
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenissample', '_jenissample.idJenisSample = _sample.idJenisSample');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = _sample.idJenisDokumen');
            $this->db->join('proses', 'proses.idProses = _sample.idProses');
            $this->db->join('_importir', '_importir.idSample = _sample.idSample', 'left');
            return $this->db->get('_sample')->row_array();
        }

        public function dataDukung($id) 
        {
            $this->db->where('idSample', $id);
            $this->db->join('_jenisDataDukung', '_jenisDataDukung.idJenisDataDukung = _dataDukung.idJenisDataDukung');
            return $this->db->get('_datadukung')->result_array() ;
        }

        public function RiwayatPekerjaan($id) 
        {
            $this->db->where('idSample', $id);
            return $this->db->get('riwayatPekerjaan')->result_array();
        }

        public function hasilEvaluasi($id)
        {
            $this->db->where('idSample', $id) ;
            if( $hasil = $this->db->get('evaluasi')->row_array() ) {
                return '<a href="'.base_url().'assets/file-upload/hasil-evaluasi/'.$hasil["hasilEvaluasi"].'" class="badge badge-primary" data-toggle="tooltip" title="Hasil Evaluasi" target="blank"><i class="fa fa-eye"></i></a>' ;
            }else{
                return '<i class="text-danger"> Ceklis Tidak Tersedia </i>' ;
            }
        }

        public function hasilVerifikasi($id)
        {
            $this->db->where('idSample', $id) ;
            $this->db->join('evaluasi', 'evaluasi.idEvaluasi = verifikasi.idEvaluasi') ;
            return $hasil = $this->db->get('verifikasi')->row_array() ;
            // if( $hasil = $this->db->get('verifikasi')->row_array() ) {
            //     return '<a href="'.base_url().'assets/file-upload/hasil-verifikasi/'.$hasil["hasilVerifikasi"].'" class="badge badge-primary" data-toggle="tooltip" title="Hasil Verifikasi" target="blank"><i class="fa fa-eye"></i></a> || oke' ;
            // }else{
            //     return '<i class="text-danger"> Ceklis Tidak Tersedia </i> || ' ;
            // }

        }

        public function getProses($idSample)
        {
            $this->db->where('idSample', $idSample);
            return $this->db->get('prosespengerjaan')->row_array();
        }
        
    }

?>

