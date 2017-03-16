<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('encryption');
        $this->load->library('email');
		$this->load->helper('url');

	}

	public function index($nome="", $email="", $url=""){
		$msg = "";
		if ($nome=="" or $email=="" or $url==""){
			$msg = "ERRO - Ausência de um ou mais parâmetros";
			// echo "ERRO - Ausência de um ou mais parâmetros";
			redirect("http://localhost/ImunoDB/users/confirm/".$msg);
		}
		else {
			$nome  = $this->encryption->decrypt($nome);
			$email = $this->encryption->decrypt($email);
			echo "url antes = ".$url."\n";
			$url   = $this->encryption->decrypt($url);
			echo "url depois = ".$url."\n";
			$this->email->from('imunodb@gmail.com', 'ImunoDB');
	        $this->email->reply_to('imunodb@gmail.com', 'ImunoDB');
	        $this->email->to($email);
	        $this->email->subject('Confirmação de cadastro - ImunoDB');
	        $this->email->message('Olá, '.$nome.'!'.'<br><br>'.
	                              'Desejamos boas vindas à Base de Dados Latino-Americana de Mutações Genéticas em Imunodeficiências Primárias!'."<br><br>".
	                              'Confirme seu cadastro clicando <a href="'.$url.'"">AQUI</a> ou acessando o link:'."<br><br>".
	                              $url."<br><br>". 
	                              'bye bye'.'<br>'); 
	                              // necessário arrumar texto da mensagem
	                              // provavelmente mudar para tipo html

	        echo $nome."\n";
	        echo $email."\n";
	        echo $url."\n";
	        // exit;
    	    if ($this->email->send(FALSE))
    	    	redirect("http://localhost/ImunoDB/users/confirm/".$msg."/1");
    	    else {
    	    	$msg = "ERRO - Email nao enviado";
    	    	echo "ERRO - Email nao enviado";
    	    	$this->email->print_debugger();
    	    	// redirect("http://localhost/ImunoDB/users/confirm/".$msg);
    	    }
		}

	}

}
