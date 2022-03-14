<?php 

    class JenisSample extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
        }
        
        // jenis vaksin

            public function getDataVaksin() 
            {
                $this->db->join('_jenisKemasan', '_jenisKemasan.idJenisKemasan = _jenisSample.idJenisKemasan') ;
                $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _jenisSample.idJenisManufacture') ;
                return  $this->db->get('_jenisSample')->result_array();
            }

            public function index()
            {
                $idLevel = $this->session->userdata('idLevel') ;
                $data['judul'] = 'Daftar Vaksin '. $this->session->userdata('namaLevel'); 
                $data['header'] = 'Daftar Vaksin'; 
                $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Daftar Vaksin';
                $data['sample'] = $this->getDataVaksin() ;
                $data['produksi'] = $this->db->get('_jenisManufacture')->result_array();
                $data['kemasan'] = $this->db->get('_jenisKemasan')->result_array();
                if( ($this->session->userdata('key') != null) )
                {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('jenisSample/index');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                    redirect('auth/inuser') ;
                }
            }

            public function dokumen()
            {
                $idLevel = $this->session->userdata('idLevel') ;
                $data['judul'] = 'Jenis Dokumen '. $this->session->userdata('namaLevel'); 
                $data['header'] = 'Jenis Dokumen'; 
                $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Jenis Dokumen'; 

                $data['dok'] = $this->db->get('_jenisDokumen')->result_array();
                
                if( ($this->session->userdata('key') != null) )
                {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('jenisSample/dokumen');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                    redirect('auth/inuser') ;
                }
            }

            public function TambahData() 
            {
                $query = [
                    'jenisSample' => $this->input->post('nama'),
                    'pelulusan' => $this->input->post('lama'),
                    'jsIng' => $this->input->post('namaIng'),
                    'idJenisManufacture' => $this->input->post('produksi'),
                    'idJenisKemasan' => $this->input->post('kemasan')
                ];
                if( $this->db->insert('_jenisSample',$query) ) {

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
                $this->session->set_flashdata($pesan);
                redirect('jenisSample') ;
            }

            public function UbahData($id) 
            {
                $wadah = explode('|', $this->input->post('wadah')) ;
                $query = [
                    'jenisSample' => $this->input->post('nama'),
                    'pelulusan' => $this->input->post('lama'),
                    'wadah' => $wadah[0],
                    'jsIng' => $this->input->post('namaIng'),
                    'wIng' => $wadah[1],
                    'idJenisManufacture' => $this->input->post('produksi')
                ];
                $this->db->where('idJenisSample', $id);
                $this->db->update('_jenisSample',$query);

                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan' ,
                    'warna' => 'success' 
                ];
                $this->session->set_flashdata($pesan);
                redirect('jenisSample/index') ;
            }

            public function ubahDok($id) 
            {
                $query = [
                    'namaJenisDokumen' => $this->input->post('nama'),
                    'KeteranganDokumen' => $this->input->post('keterangan')
                ];

                $this->db->where('idJenisDokumen', $id);
                if($this->db->update('_jenisdokumen', $query)) {
                    $pesan = [
                        'pesan' => 'data berhasil disimpan' ,
                        'warna' => 'success' 
                    ];
                }else{
                    $pesan = [
                        'pesan' => 'data gagal disimpan' ,
                        'warna' => 'danger' 
                    ];
                }

                $this->session->set_flashdata($pesan);
                redirect('jenisSample/dokumen') ;
            }

        // jenis vaksin
        // ===========================================================================================================










        // jenis pengujian
            public function jenisPengujian() 
            {
                $data['judul'] =  "Pengujian"  . $this->session->userdata('namaLevel'); 
                $data['header'] =  "Pengujian" ; 
                $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Pengujian';
                $this->db->order_by('namaJenisPengujian','asc') ;
                $data['pengujian'] = $this->db->get('_jenisPengujian')->result_array();
                if( ($this->session->userdata('key') != null) )
                {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('jenisSample/jenisPengujian');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                    redirect('auth/inuser') ;
                }
            }

            public function tambahJenisPEngujian()
            {
                $query = [
                    'namaJenisPengujian' => $this->input->post('namaJenisPengujian'),
                    'jumlahSample' => $this->input->post('jumlahSample'),
                    'lamaPengujian' => $this->input->post('lamaPengujian')
                ];
                if($this->db->insert('_jenispengujian', $query)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Disimpan',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Disimpan',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect('jenisSample/jenisPengujian') ;
            }

            public function ubahJenisPengujian($id)
            {
                $query = [
                    'namaJenisPengujian' => $this->input->post('namaJenisPengujian'),
                    'jumlahSample' => $this->input->post('jumlahSample'),
                    'lamaPengujian' => $this->input->post('lamaPengujian')
                ];
                $this->db->where('idJenisPengujian', $id) ;
                $this->db->set($query) ;
                if($this->db->update('_jenispengujian')) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Ubah',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Ubah',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect('jenisSample/jenisPengujian') ;
            }

            public function hapusJenisPengujian($id)
            {
                $this->db->where('idJenisPengujian', $id) ;
                if($this->db->delete('_jenispengujian')) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Hapus',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Hapus',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect('jenisSample/jenisPengujian') ;
            }
        // jenis pengujian
        // =============================================================================================================










        // jenis sampel
            public function jenisSample()
            {
                $data['judul'] =  "Jenis Sampel"  . $this->session->userdata('namaLevel'); 
                $data['header'] =  "Jenis Sampel" ; 
                $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Jenis Sample';
                $this->db->order_by('idJenisManufacture','asc') ;
                $data['jenisSample'] = $this->db->get('_jenisManufacture')->result_array();
                if( ($this->session->userdata('key') != null) )
                {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('jenisSample/_jenisSample');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                    redirect('auth/inuser') ;
                }
            }

            public function tambahJenisManufacture()
            {
                if($this->db->insert('_jenismanufacture', ['namaJenisManufacture' => $this->input->post('namaJenisManufacture')])) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Disimpan',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Disimpan',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect("jenisSample/jenisSample") ;
            }

            public function ubahJenisManufacture($id)
            {
                $this->db->where('idJenisManufacture', $id) ;
                $this->db->set('namaJenisManufacture', $this->input->post('namaJenisManufacture') );
                if($this->db->update('_jenismanufacture')) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Diubah',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Diubah',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect("jenisSample/jenisSample") ;
            }

            public function hapusJenisManufacture($id)
            {
                $this->db->where('idJenisManufacture', $id) ;
                if($this->db->delete('_jenismanufacture')) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Dihapus',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Dihapus',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect("jenisSample/jenisSample") ;
            }
            
        // jenis sampel


        // jenis kemasan
            public function jenisKemasan()
            {
                $data['judul'] =  "Jenis Kemasan"  . $this->session->userdata('namaLevel'); 
                $data['header'] =  "Jenis Kemasan" ; 
                $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Jenis Kemasan';
                $this->db->order_by('idJenisKemasan','asc') ;
                $data['jenisKemasan'] = $this->db->get('_jenisKemasan')->result_array();
                if( ($this->session->userdata('key') != null) )
                {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('jenisSample/jenisKemasan');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                    redirect('auth/inuser') ;
                }
            }

            public function tambahJenisKemasan()
            {
                $query = [
                    'namaJenisKemasan' => $this->input->post('namaJenisKemasan'),
                    'ingJenisKemasan' => $this->input->post('ingJenisKemasan')
                ] ;
                if($this->db->insert('_jeniskemasan', $query)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Disimpan',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Disimpan',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect("jenisSample/jenisKemasan") ;
            }

            public function ubahJenisKemasan($id)
            {
                $query = [
                    'namaJenisKemasan' => $this->input->post('namaJenisKemasan'),
                    'ingJenisKemasan' => $this->input->post('ingJenisKemasan')
                ] ;
                $this->db->where('idJenisKemasan', $id) ;
                $this->db->set( $query );
                if($this->db->update('_jeniskemasan')) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Diubah',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Diubah',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect("jenisSample/jenisKemasan") ;
            }

            public function hapusJenisKemasan($id)
            {
                $this->db->where('idJenisKemasan', $id) ;
                if($this->db->delete('_jeniskemasan')) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Dihapus',
                        'warna' => 'success' 
                    ] ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Dihapus',
                        'warna' => 'danger' 
                    ] ;
                }

                $this->session->set_flashdata($pesan) ;
                redirect("jenisSample/jenisKemasan") ;
            }
            
        // jenis kemasan
        

        

        // tabel pengujian
            public function tabel_tambah_pengujian($id) 
            {
                $this->db->where('idJenisSample', $id) ;
                $judul = $this->db->get('_jenissample')->row_array()['jenisSample'] ;

                $this->db->order_by('idJenisPengujian','asc') ;
                $data['tabel_pengujian'] = $this->db->get('_jenispengujian')->result_array() ;
                $data['id'] = $id ;

                $data['judul'] =  "Tambah Pengujian $judul"  . $this->session->userdata('namaLevel'); 
                $data['header'] =  "Tambah Pengujian $judul" ; 
                $data['bread'] = 'Dashboard / <a href="'.base_url().'jenisSample"> Jenis Vaksin </a> / Tambah Pengujian';
                if( ($this->session->userdata('key') != null) )
                {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('jenisSample/tabel_tambah_pengujian');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                    redirect('auth/inuser') ;
                }
            }
        // tabel pengujian

        //pengaturan pengujian
            public function pengaturanPengujian($set, $idJenisSample, $idJenisPengujian)
            {
                if($set == 'aktif') {
                    $query = [
                        'idJenisSample' => $idJenisSample,
                        'idJenisPengujian' => $idJenisPengujian
                    ];

                    if($this->db->insert('_js_used', $query)) {
                        $pesan = [
                            'pesan' => "pengujian berhasil di $set".'an',
                            'warna' => "success"
                        ] ;
                    }else{
                        $pesan = [
                            'pesan' => "pengujian gagal di $set".'an',
                            'warna' => "danger"
                        ] ;
                    }
                }else{
                    $this->db->where('idJenisPengujian',$idJenisPengujian) ;
                    $this->db->where('idJenisSample',$idJenisSample) ;
                    if($this->db->delete('_js_used')) {
                        $pesan = [
                            'pesan' => "pengujian berhasil di $set".'an',
                            'warna' => "success"
                        ] ;
                    }else{
                        $pesan = [
                            'pesan' => "pengujian gagal di $set".'an',
                            'warna' => "danger"
                        ] ; 
                    }
                }

                    $this->session->set_flashdata($pesan) ;
                    redirect("jenisSample/tabel_tambah_pengujian/$idJenisSample") ;
            }
    } 

?>