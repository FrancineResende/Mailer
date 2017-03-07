<?php
class Mutations extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Mutations_model', 'm_model');
        // $this->load->helper('url_helper');
        $this->load->helper('form');
    }

    public function index(){

        $this->data['title'] = 'ImunoDB | Faça sua busca';

        $attributes         = array('class' => 'form-horizontal', 'id' => 'myform', 'method' => 'GET');
        $this->data['form'] = form_open('index.php/mutations/search', $attributes);

        $this->middle='mutations_view';
        $this->layout();

    }

    private function insert(){
        // $data = array('' => , );
        // $data['gene_name']      =
        // $data['sinonymous']     =
        // $data['type']           =
        // $data['inheritance']    =
        // $data['site']           =
        // $data['c_dna']          =
        // $data['protein']        =
        // $data['omim_phenotype'] =
        // $data['country_name']   =
        // $data['disease_name']   =
        // $data['doi']            =

        // $this->m_model->set($data);
    }

    public function search(){
        $get = array('' => '');

        $get['name'] = $this->input->get('name') ;
        $get['type'] = $this->input->get('type');
        $get['inheritance'] = $this->input->get('inheritance');
        $get['disease'] = $this->input->get('disease');
        $get['origin'] = $this->input->get('origin');

        $this->data['result'] = $this->m_model->get($get);
        $this->data['title'] = "ImunoDB | Resultado de busca";
        $this->middle = 'search_view';
        $this->layout();
    }

    private function edit () {

    }

    private function delete () {

    }
}
?>