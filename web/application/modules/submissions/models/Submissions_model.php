<?php
 
class Submissions_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function set ($sub) {
        // $sub['title']            
        // $sub['publication_year'] 
        // $sub['doi']              
        // $sub['comment'] 
        return $this->db->insert('Article_Submissions', $sub);
    }

    function get_submissions($user_id) {
        //retorna query com submissões do usuário
        $contrib_id = $this->get_contrib_id($user_id);
        $query      = $this->db->select('*')
                    ->from('Article_Submissions')
                    ->where('contrib_id', $contrib_id)
                    ->get();
        return $query;
    }

    function get_to_evaluation(){
        //retorna submissões com status = "Aguardando avaliação da equipe"
        $query = $this->db->select('*')
                          ->from('Article_Submissions')
                          ->where('status', 'Aguardando avaliação da equipe')
                          ->get();
        return $query;  
    }

    function get_contributor_name($contrib_id){
        $query = $this->db->select('u.first_name, u.last_name')
                          ->from('Login_Users as u, Contributors as c')
                          ->where('c.contrib_id', $contrib_id)
                          ->where('c.luser_id = u.luser_id')
                          ->get();
        $name = $query->row();
        return $name->first_name . ' ' . $name->last_name;
    }

    function get_contrib_id($luser_id){
        $query = $this->db->select('contrib_id')
               ->from('Contributors')
               ->where('luser_id', $luser_id)
               ->get();
        $result = $query->row();
        
        return $result->contrib_id;
        // $this->session->set_userdata('contrib_id', $id);
    }

    function edit_status($id, $new_status, $evaluated_by) {
        $data = array('status' => $new_status, 'evaluated_by' => $evaluated_by);
        $this->db->where('submission_id', $id);
        $this->db->set($data);
        return $this->db->update('Article_Submissions');    
    }

    function delete () {
    	
    }

}