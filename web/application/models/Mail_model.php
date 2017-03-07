<?php
 
class Mail_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->load->database();
    }

}