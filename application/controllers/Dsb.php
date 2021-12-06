<!-- dashboard untuk eksternal user -->
<?php 

    class Dsb extends CI_Controller{
        public function index()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Dashboard '. $this->session->userdata('eksNama'); 
            $data['header'] = 'Dashboard'; 
            $data['bread'] = 'Dashboard'; 
            if( $this->session->userdata('eksId') )
            {
                $this->load->view('temp/dsbHeader',$data);
                $this->load->view('dashboard/index');
                $this->load->view('temp/dsbFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                redirect('auth') ;
            }
        }
    }

?>