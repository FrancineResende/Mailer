<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/imunodb
	 *	- or -
	 * 		http://example.com/index.php/imunodb/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/imunodb/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
        parent::__construct();
	 }

	public function index(){
		// $this->data['title'] = 'ImunoDB | Base de Dados Latino-Americana de Mutações Genéticas em Imunodeficiências Primárias';
		
	//	$this->middle = 'home_view';
	//	$this->layout();
	}

	public function links(){
		// $this->data['title'] = "ImunoDB | Links úteis";

	//	$this->middle = 'links_uteis';
	//	$this->layout();
	}

	public function sobre (){
		// $this->data['title'] = "ImunoDB | Sobre a equipe";

	//	$this->middle = 'sobre_equipe';
	//	$this->layout();
	}

	public function contato(){
		// $this->data['title'] = "ImunoDB | Entre em contato conosco";

	//	$this->middle = 'contato_view';
	//	$this->layout();
	}

}
