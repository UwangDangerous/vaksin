<?php 

    class _Upload extends CI_Model{
        public function uploadEksUser($namaBerkas, $path, $type,$redirect,$namaTambahan = '')
        {
            if( $_FILES[$namaBerkas]['name'] ) {
                $filename = explode("." , $_FILES[$namaBerkas]['name']) ;
                $ekstensi = strtolower(end($filename)) ;
                $config['upload_path'] = "./$path"; //assets/file-upload/surat 
                $config['allowed_types'] = "$type"; //'pdf|jpg|png|jpeg'
                $hashDate = substr(md5(date('Y-m-d H:i:s')),1,5) ;

                $namaInstansi = explode(' ',$this->session->userdata('eksNama'));
                $nama = '' ;
                $i = 0 ;
                for($i; $i<count($namaInstansi); $i++) {
                    $nama .= $namaInstansi[$i].'_' ;
                }

                $namaFile = explode(' ',$filename[0]);
                $file = '' ;
                $j = 0 ;
                for($j; $j<count($namaFile); $j++) {
                    $file .= $namaFile[$j].'_' ;
                }

                $tambahan = explode(' ',$namaTambahan);
                $tmbh = '' ;
                $x = 0 ;
                for($x; $x<count($tambahan); $x++) {
                    $tmbh .= $tambahan[$x].'_' ;
                }

                $berkas = rtrim($nama,'_').'_'.rtrim($file,'_').'_'.$hashDate.'_'.rtrim($tmbh,'_') ;

                $config['file_name'] = $berkas ;
                $this->load->library('upload',$config);

                if($this->upload->do_upload('berkas')){
                    $this->upload->initialize($config);
                }else{
                    $pesan = [
                        'pesan' => 'tipe file tidak sesuai',
                        'warna' => 'danger'
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("$redirect") ;  
                }

                return $config['file_name'].'.'.$ekstensi ;
            } else{
                $pesan = [
                    'pesan' => 'berkas tidak boleh kosong',
                    'warna' => 'danger'
                ];
                $this->session->set_flashdata($pesan);
                redirect("$redirect") ;  
            }
        }
    }

?>