<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Bibliography extends CI_Controller {
 
    function __construct() {
        parent::__construct();
	     // Carrega o modelo 
	    $this->load->model('Bibliography_model', 'model', TRUE);
    }
 
   public function index () {
        // $this->load->helper('form');
        $data['titulo'] = "ImunoDB | Encontre os artigos utilizados em nossa base";
        $sql = "SELECT * FROM `artigos`";

        $data['result'] = $this->load->Bibliography_model.get($sql);
        $this->load->view('header.php', $data);
        $this->load->view('artigos_view.php', $data);
    }

    private function insert () {

    }

    private function edit () {

    }

    private function delete () {

    }

}