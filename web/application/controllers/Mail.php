<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('encryption');
		$this->load->helper('url');

	}

	public function index($nome, $email, $url){
		$nome  = $this->encryption->decrypt($nome);
		$email = $this->encryption->decrypt($email);
		$url   = $this->encryption->decrypt($url);

		$this->email->from('imunodb@gmail.com', 'ImunoDB');
        $this->email->reply_to('imunodb@gmail.com', 'ImunoDB');
        $this->email->$email;
        $this->email->subject('Confirmação de cadastro - ImunoDB');
        $this->email->message('Olá, '.$nome.'!'.'<br><br>'.
                              'Desejamos boas vindas à Base de Dados Latino-Americana de Mutações Genéticas em Imunodeficiências Primárias!'."<br><br>".
                              'Confirme seu cadastro clicando <a href="'.$url.'"">AQUI</a> ou acessando o link:'."<br><br>".
                              $url."<br><br>". //gerar link para confirmação do email
                              'bye bye'.'<br>'); // necessário arrumar texto da mensagem
                                               // provavelmente mudar para tipo html
        $this->email->send();
	}

}
