<?php
/**
 * Created by IntelliJ IDEA.
 * User: flavio
 * Date: 21/03/16
 * Time: 10:28
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    //seta as variaveis
    var $template  = array();
    var $data      = array();
    //Carrega o layout
    public function layout() {
        //faz o template carregar na view
        $this->template['header']   = $this->load->view('layout/header', $this->data, true);
        $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
        $this->template['footer'] = $this->load->view('layout/footer', $this->data, true);

        $this->load->view('layout/index', $this->template);
    }
}