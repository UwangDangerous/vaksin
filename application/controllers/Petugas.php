<?php 

class Petugas extends CI_Controller{
    public function __construct() 
    {
        parent::__construct() ;
        $this->load->library('form_validation');
        $this->load->model('Petugas_model');
        $this->load->model('User_Sample_model');
        $this->load->model('Cetak_model');
    }

    public function index($id=null)
    {
        if($this->input->post('cariByDokumen')) {
            $cari = $this->input->post('cariJenisDok');
        }else{
            $cari = '' ;
        }

        if($id == 0) {
            $id = null ;
        }
        $this->load->model('_Date');
        $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = 'Data Sampel'; 
        $data['bread'] = 'Dashboard / <a href="'.base_url().'sample"> Penerimaan Surat </a> / Sampel'; 
        $data['sample'] = $this->Petugas_model->getSample($id,$cari);
        if( ($this->session->userdata('key') != null) )
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('petugas/index',$data);
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function detail($idSurat,$idSampe,$id)
    {
        $this->load->model('_Date');
        
        $this->db->join('_sample','_sample.idSample = sample_batch.idSample');
        $this->db->select('namaSample, noBatch');
        $judulBatch = $this->db->get_where('sample_batch',['idBatch' => $id])->row_array();
        // $idLevel = $this->session->userdata('idLevel') ;
        $data['judul'] = 'Rincian Data Sampel '. $this->session->userdata('namaLevel'); 
        $data['header'] = "Data Sampel <br>  
                        <h5>". $judulBatch['namaSample']. " No Batch ". $judulBatch['noBatch'] ." </h5>"; 
        $data['bread'] = 'Dashboard / <a href="'.base_url().'petugas/index/'.$idSurat.'"> Sampel </a> / Rincian Sampel'; 
        
        
        $data['batch'] = $this->Petugas_model->getDetailBatch($id);
        // $data['petugas'] = $this->Petugas_model->getPetugas($id);

        $data['id'] = $id ;
        if( ($this->session->userdata('key') != null) )
        {
            $this->load->view('temp/dashboardHeader',$data);
            $this->load->view('petugas/detail');
            $this->load->view('temp/dashboardFooter');
        }else{
            $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
            redirect('auth/inuser') ;
        }
    }

    public function tambahPetugas() {
        if( $iu = $this->input->post('ve') ) {
            $i = 0 ;
            for($i; $i<2; $i++) {

                if($i == 0) {
                    $level = 3; //evaluator
                }else{
                    $level = 4; //verifikator
                }
                
                $query = [
                    'idSample' => $this->input->post('idSample'),
                    'idIU' => $iu ,
                    'idLevel' => $level 
                ];
                // var_dump($query) ;
                $this->db->insert('petugas', $query);

            }

            $this->session->set_flashdata('pesan', "Petugas Berhasil Di Simpan");
            redirect("petugas") ;
                
        }else{
            $i = 0 ;
            for($i; $i<2; $i++) {

                if($i == 0) {
                    $level = 3; //evaluator
                    $iu = $this->input->post('evaluator') ;
                    
                    if($iu) {
                        $query = [
                            'idSample' => $this->input->post('idSample'),
                            'idIU' => $iu ,
                            'idLevel' => $level 
                        ];
                        // var_dump($query) ;
                        $this->db->insert('petugas', $query);
                    }
                }else{
                    $level = 4; //verifikator
                    $iu = $this->input->post('verifikator');
                    if($iu) {
                        $query = [
                            'idSample' => $this->input->post('idSample'),
                            'idIU' => $iu ,
                            'idLevel' => $level 
                        ];
                        // var_dump($query) ;
                        $this->db->insert('petugas', $query);
                    }
                }
                
            }
            $this->session->set_flashdata('pesan', "Petugas Berhasil Di Simpan");
            redirect("petugas") ;
        }


        // var_dump($query) ;
    }

    public function tambahPetugasSusulan($lvl) 
    {
        if($lvl == 4) {
            $iu = $this->input->post('verifikator') ;
            $petugas = "Verifikator" ;
        }else{
            $iu = $this->input->post('evaluator') ;
            $petugas = "Evaluator" ;
        }

        $query = [
            'idSample' => $this->input->post('idSample'),
            'idIU' => $iu ,
            'idLevel' => $lvl 
        ];

        $this->db->insert('petugas', $query);

        $this->session->set_flashdata('pesan', "Petugas $petugas Berhasil Ditambahkan");
        redirect("petugas") ;
        
    }

    public function ubahPetugasSusulan($lvl) 
    {
        if($lvl == 4) {
            $iu = $this->input->post('verifikator') ;
            $petugas = "Verifikator" ;
        }else{
            $iu = $this->input->post('evaluator') ;
            $petugas = "Evaluator" ;
        }

        $query = [
            'idSample' => $this->input->post('idSample'),
            'idIU' => $iu ,
            'idLevel' => $lvl 
        ];

        $this->db->where('idPetugas', $this->input->post('idPetugas'));
        $this->db->update('petugas', $query);

        $this->session->set_flashdata('pesan', "Petugas $petugas Berhasil Di Ubah");
        redirect("petugas") ;
        
    }

    public function inputDataKurang($id) 
    {
        $query=[
            'idSample' => $id,
            'clock_off' => date('Y-m-d'),
            'judul' => $this->input->post('judul'),
            'keterangan' => $this->input->post('keterangan',true),
            'clock_on' => '0000-00-00'
        ];

        if( $this->db->insert('clockoff', $query) ) {
            $queryRiwayat = [
                'idSample' => $id,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Clock Off ( '.$this->input->post('keterangan',true).' )'
            ];
            $this->db->insert('riwayatpekerjaan', $queryRiwayat);
            $pesan = [
                'pesan' => 'Data Berhasil Disimpan' ,
                'warna' => 'success'
            ];
            $this->session->set_flashdata($pesan);
            redirect('petugas/detail/'.$id) ;

            
        }else{
            $pesan = [
                'pesan' => 'Data Gagal Disimpan' ,
                'warna' => 'danger'
            ];
            $this->session->set_flashdata('pesan');
            redirect('petugas/detail/'.$id) ;
        }
    }

    public function ubahIdProsesSample($id,$idSurat)
    {
        // echo $this->input->post('cmbProses');
        $this->db->where('idSample',$id); 
        if($this->db->update('_sample', [ 'idProses' => $this->input->post('cmbProses') ] ) ) {
            $pesan = [
                'pesan' => 'Data Berhasil Disimpan' ,
                'warna' => 'success'
            ];
        }else{
            $pesan = [
                'pesan' => 'Data Gagal Disimpan' ,
                'warna' => 'danger'
            ];
        }
        $this->session->set_flashdata('pesan');
        redirect("petugas/index/$idSurat/$id") ;
    }




    

    public function tambahSertifikat($idSurat,$idSample)
    {
        $query = [
            'noSertifikat' => $this->input->post('noSertifikat') ,
            'id_hasil_evaluasi' => $this->input->post('id_hasil_evaluasi') ,
            'tgl_realese' => $this->input->post('tgl_realese') 
        ];

        if( $this->db->insert('sertifikat', $query) ) {

            $pesan = [
                'pesan' => 'Data Berhasil DiSimpan' ,
                'warna' => 'success',
            ];

        }else{
            $pesan = [
                'pesan' => 'Data Gagal DiSimpan' ,
                'warna' => 'danger'
            ];
        }

        $this->session->set_flashdata($pesan) ;
        redirect("petugas/detail/$idSurat/$idSample") ;
    }

    public function ubahSertifikat($idSurat,$idSample)
    {
        $query = [
            'noSertifikat' => $this->input->post('noSertifikat') ,
            'id_hasil_evaluasi' => $this->input->post('id_hasil_evaluasi') ,
            'tgl_realese' => $this->input->post('tgl_realese') 
        ];

        $this->db->where('idSertifikat', $this->input->post('idSertifikat')) ;
        $this->db->set($query) ;
        if( $this->db->update('sertifikat') ) {

            $pesan = [
                'pesan' => 'Data Berhasil Ubah' ,
                'warna' => 'success',
            ];

        }else{
            $pesan = [
                'pesan' => 'Data Gagal Ubah' ,
                'warna' => 'danger'
            ];
        }

        $this->session->set_flashdata($pesan) ;
        redirect("petugas/detail/$idSurat/$idSample") ;
    }













    public function tambahVerifikasiBerkas($idSurat, $idSample, $id) 
    {
        // echo $this->input->post('file-very'); die
        $status = $this->input->post('status-very');
        $file = '' ;
        $keterangan = 'Diterima' ;
        if($status == 1) {
            $this->load->model('_Upload');
            $file = $this->_Upload->uploadEksUser('berkas',
                'assets/file-upload/',
                'pdf|jpg|png|jpeg',
                "petugas/detail/$idSurat/$idSample/$id", 
                'biling batch no '. $this->input->post('namaFileTambahan-very') 
            );
        }else{
            $keterangan = $this->input->post('keterangan-very') ;
        }

        $query = [
            'idBatch' => $id ,
            'kode_biling' => $file,
            'tglVB' => date('Y-m-d'),
            'statusVB' => $status,
            'keteranganVB' => $keterangan
        ];

        if($this->db->insert('verifikasi_berkas', $query)) {
            $pesan = [
                'pesan' => 'Verifikasi Kelengkapan Dokumen Berhasil Disimpan',
                'warna' => 'success'
            ] ;
        }else{
            $pesan = [
                'pesan' => 'Verifikasi Kelengkapan Dokumen Gagal Disimpan',
                'warna' => 'danger'
            ] ;
        }

        $this->session->set_flashdata($pesan);
        redirect("petugas/detail/$idSurat/$idSample/$id") ;
    }
}

?>