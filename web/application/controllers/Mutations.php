<?php
class Mutations extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Mutations_model');
        // $this->load->helper('url_helper');
    }

    public function index(){
        $data['title'] = 'ImunoDB | Mutações';

    	$this->load->view('header', $data);
       	$this->load->view('mutations/index');
       	$this->load->view('templates/footer');
        }

    private function insert(){


    }

    public function search(){
        // $this->load->helper('form');
        $data['title'] = "ImunoDB | Busca";
        // $data['lista'] = $this->model->listar();
        $this->load->view('header', $data);
        $this->load->view('mutations/search');
        $this->load->view('templates/footer');

    }

    private function edit () {

    }

    private function delete () {

    }
}
?>