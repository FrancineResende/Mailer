<?php
class News extends MY_Controller {

	public function __construct(){
        parent::__construct();
        // $this->load->model('News_model', 'n_model');
        // $this->load->helper('url_helper');
        $this->load->helper('form');
    }

    public function index(){
    	$this->data['title'] = "ImunoDB | Notícias";

    	$this->middle = "news_view";
    	$this->layout();
    }
}