<?php
 
class Admin_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('users/Users_model', 'u_model');
        // $this->load->helper('email');
        
    }

    function is_admin($email){
    	//verifica se usuário é admin ou não
    	$query = $this->db->select('level')
    					  ->from('Login_Users')
    					  ->where('email', $email)
    					  ->get();
    	$row = $query->row_array();

    	if ($row['level'] == 2)
            return true;
    	return false;
    }

    // function save_admin($email){
    //     //adiciona id de usuário na tabela de admins
    //     $luser_id = $this->u_model->get_id($email); 
    //     $data = array('user_id' => $user_id);
    //     return ($this->db->insert('Admins', $data));    
    // }
    //***************refazer função********************

    function get_name($email){
        $query   = $this->db->select('first_name, last_name')
                            ->from('Login_Users')
                            ->where('email', $email)
                            ->get();
        return $query->row(); 
    }

    function verify_country($country){
        //retorna true se o país (ou "Uninformed") está no BD
        $query = $this->db->select('country_name')
                          ->from('Countries')
                          ->where('country_name', $country)
                          ->get();
        if ($query->num_rows())
            return true;
        return false;
    }

    function verify_gene($gene){
        //retorna true se o gene está no BD
        $query = $this->db->select('gene_name')
                          ->from('Genes')
                          ->where('gene_name', $gene)
                          ->get();
        if ($query->num_rows())
            return true;
        return false;
    }

    function verify_disease($disease){
        //retorna true se o nome da doença está no BD
        $query = $this->db->select('disease_name')
                          ->from('Diseases')
                          ->where('disease_name', $disease)
                          ->get();
        if ($query->num_rows())
            return true;
        return false;
    }

    function verify_article($doi){
        //retorna true se o nome da doença está no BD
        $query = $this->db->select('doi')
                          ->from('Bibliography')
                          ->where('doi', $doi)
                          ->get();
        if ($query->num_rows())
            return true;
        return false;
    }
}
?>