<!-- _petugas adalah class asli untuk mengolah data petugas -->
<?php 

    class _Petugas extends CI_Controller{

        public function index($id, $idJenisManufacture)
        {
            $data['id'] = $id ;
            $data['idJenisManufacture'] = $idJenisManufacture ;

            $this->load->view("petugas/petugas/index", $data) ;
            echo "ok" ;
        }

    }

?>
