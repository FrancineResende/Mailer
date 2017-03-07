<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once ('/opt/lampp/htdocs/ImunoDB/wp/wp-load.php');
define('WP_USE_THEMES', true);


class Teste extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}

	function index($pagename = NULL){
		wp();
		ob_start();
		include('/wp/wp-includes/template-loader.php');
		$template = ob_get_clean();
		$this->loadBlogContent($template);
	}
}
?>