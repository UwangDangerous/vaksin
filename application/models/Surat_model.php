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
            $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample') ;
            $this->db->select('count(idSurat) as jumlah');
            return $this->db->get("_sample")->row_array()['jumlah'];
        }

        public function addSurat()
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/surat','pdf|jpg|png|jpeg','surat/kirim');

            $query = [
                'noSurat' => $this->input->post('nosurat', true),
                'namaSurat' => $this->input->post('nama', true),
                'idEU' => $this->session->userdata('eksId'),
                'fileSurat' => $upload ,
                'tgl_kirim_surat' => $this->input->post('tanggal', true)
            ];

            if($this->db->insert('_surat', $query)){
                $pesan = [
                    'pesan' => 'Data Berhasil Di Tambah, Silahkan lengkapi data sampel untuk tahap selanjutnya',
                    'warna' => 'success' 
                ];

                $this->db->where('idEU', $this->session->userdata('eksId')) ;
                $this->db->select('idSurat') ;
                $this->db->order_by('idSurat','asc') ;
                $idSurat = 0 ;
                foreach($this->db->get('_surat')->result_array() as $surat) {
                    $idSurat = $surat['idSurat'] ;
                }

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

        public function getClockOFF()
        {
            $this->db->where('idEU', $this->session->userdata('eksId'));
            $this->db->join('_sample','_sample.idSample = clockoff.idSample');
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('clockoff_dokumen', 'clockoff_dokumen.idClockOff = clockoff.idClockOff','left');
            $this->db->order_by('clockOff.idClockOff', 'desc');
            $this->db->select('clockoff.idclockOff as idClockOff, namaSample, judul, keterangan, keterangan_cf, clock_on,clock_off, _sample.idSample,berkas_cf');
            return $this->db->get('clockoff')->result_array();
        }
        
        

    }

?>
