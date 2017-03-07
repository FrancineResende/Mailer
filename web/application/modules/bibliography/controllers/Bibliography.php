<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Bibliography extends MY_Controller {
 
    function __construct() {
        parent::__construct();
	    // Carrega o modelo 
	    $this->load->model('Bibliography_model', 'b_model', TRUE);
    }
 
   public function index () {
        $this->data['title'] = "ImunoDB | Encontre os artigos utilizados em nossa base";
        $this->data['query'] = $this->b_model->get();
        
        $this->middle = 'artigos_view';
        $this->layout();
    }

    private function insert () {

    }

    private function edit () {

    }

    private function delete () {

    }

}